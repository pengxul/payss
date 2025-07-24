<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Unipay;

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

use function Pengxul\Pays\verify_unipay_sign;

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
        Logger::debug('[unipay][CallbackPlugin] 插件开始装载', ['rocket' => $rocket]);

        $this->formatPayload($rocket);

        $params = $rocket->getParams();
        $signature = $params['signature'] ?? false;

        if (!$signature) {
            throw new InvalidResponseException(Exception::INVALID_RESPONSE_SIGN, '', $params);
        }

        verify_unipay_sign($params, $rocket->getPayload()->sortKeys()->toString(), $signature);

        $rocket->setDirection(NoHttpRequestDirection::class)
            ->setDestination($rocket->getPayload())
        ;

        Logger::info('[unipay][CallbackPlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $next($rocket);
    }

    protected function formatPayload(Rocket $rocket): void
    {
        $payload = (new Collection($rocket->getParams()))
            ->filter(fn ($v, $k) => 'signature' != $k && !Str::startsWith($k, '_'))
        ;

        $rocket->setPayload($payload);
    }
}
