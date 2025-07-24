<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Alipay;

use Closure;
use Pengxul\Pays\Contract\PluginInterface;
use Pengxul\Pays\Direction\NoHttpRequestDirection;
use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\Exception;
use Pengxul\Pays\Exception\InvalidConfigException;
use Pengxul\Pays\Exception\InvalidResponseException;
use Pengxul\Pays\Exception\ServiceNotFoundException;
use Pengxul\Pays\Logger;
use Pengxul\Pays\Rocket;
use Pengxul\Supports\Collection;
use Pengxul\Supports\Str;

use function Pengxul\Pays\verify_alipay_sign;

class CallbackPlugin implements PluginInterface
{
    /**
     * @throws ContainerException
     * @throws InvalidConfigException
     * @throws ServiceNotFoundException
     * @throws InvalidResponseException
     */
    public function assembly(Rocket $rocket, Closure $next): Rocket
    {
        Logger::debug('[alipay][CallbackPlugin] 插件开始装载', ['rocket' => $rocket]);

        $this->formatPayload($rocket);
        $sign = $rocket->getParams()['sign'] ?? false;

        if (!$sign) {
            throw new InvalidResponseException(Exception::INVALID_RESPONSE_SIGN, '', $rocket->getParams());
        }

        verify_alipay_sign($rocket->getParams(), $this->getSignContent($rocket->getPayload()), $sign);

        $rocket->setDirection(NoHttpRequestDirection::class)
            ->setDestination($rocket->getPayload())
        ;

        Logger::info('[alipay][CallbackPlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $next($rocket);
    }

    protected function formatPayload(Rocket $rocket): void
    {
        $payload = (new Collection($rocket->getParams()))
            ->filter(fn ($v, $k) => '' !== $v && !is_null($v) && 'sign' != $k && 'sign_type' != $k && !Str::startsWith($k, '_'))
        ;

        $rocket->setPayload($payload);
    }

    protected function getSignContent(Collection $payload): string
    {
        return $payload->sortKeys()->toString();
    }
}
