<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Alipay\Trade;

use Closure;
use Pengxul\Pays\Contract\PluginInterface;
use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\ServiceNotFoundException;
use Pengxul\Pays\Logger;
use Pengxul\Pays\Rocket;
use Pengxul\Pays\Traits\SupportServiceProviderTrait;

/**
 * @see https://opendocs.alipay.com/open/02fkat?ref=api&scene=common
 */
class PayPlugin implements PluginInterface
{
    use SupportServiceProviderTrait;

    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     */
    public function assembly(Rocket $rocket, Closure $next): Rocket
    {
        Logger::debug('[alipay][PayPlugin] 插件开始装载', ['rocket' => $rocket]);

        $this->loadAlipayServiceProvider($rocket);

        $rocket->mergePayload([
            'method' => 'alipay.trade.pay',
            'biz_content' => array_merge(
                [
                    'product_code' => 'FACE_TO_FACE_PAYMENT',
                    'scene' => 'bar_code',
                ],
                $rocket->getParams(),
            ),
        ]);

        Logger::info('[alipay][PayPlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $next($rocket);
    }
}
