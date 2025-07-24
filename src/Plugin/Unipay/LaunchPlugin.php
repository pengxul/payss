<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Unipay;

use Closure;
use Pengxul\Payss\Contract\PluginInterface;
use Pengxul\Payss\Exception\ContainerException;
use Pengxul\Payss\Exception\InvalidConfigException;
use Pengxul\Payss\Exception\InvalidResponseException;
use Pengxul\Payss\Exception\ServiceNotFoundException;
use Pengxul\Payss\Logger;
use Pengxul\Payss\Rocket;
use Pengxul\Supports\Collection;

use function Pengxul\Payss\should_do_http_request;
use function Pengxul\Payss\verify_unipay_sign;

class LaunchPlugin implements PluginInterface
{
    /**
     * @throws ContainerException
     * @throws InvalidConfigException
     * @throws InvalidResponseException
     * @throws ServiceNotFoundException
     */
    public function assembly(Rocket $rocket, Closure $next): Rocket
    {
        /* @var Rocket $rocket */
        $rocket = $next($rocket);

        Logger::debug('[unipay][LaunchPlugin] 插件开始装载', ['rocket' => $rocket]);

        if (should_do_http_request($rocket->getDirection())) {
            $response = Collection::wrap($rocket->getDestination());
            $signature = $response->get('signature');
            $response->forget('signature');

            verify_unipay_sign(
                $rocket->getParams(),
                $response->sortKeys()->toString(),
                $signature
            );

            $rocket->setDestination($response);
        }

        Logger::info('[unipay][LaunchPlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $rocket;
    }
}
