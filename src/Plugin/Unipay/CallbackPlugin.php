<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Unipay;

use Closure;
use Pengxul\Payss\Contract\PluginInterface;
use Pengxul\Payss\Direction\NoHttpRequestDirection;
use Pengxul\Payss\Exception\ContainerException;
use Pengxul\Payss\Exception\Exception;
use Pengxul\Payss\Exception\InvalidConfigException;
use Pengxul\Payss\Exception\InvalidResponseException;
use Pengxul\Payss\Exception\ServiceNotFoundException;
use Pengxul\Payss\Logger;
use Pengxul\Payss\Rocket;
use Pengxul\Supports\Collection;
use Pengxul\Supports\Str;

use function Pengxul\Payss\verify_unipay_sign;

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
