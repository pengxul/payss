<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Alipay\Trade;

use Closure;
use Pengxul\Payss\Contract\PluginInterface;
use Pengxul\Payss\Direction\ResponseDirection;
use Pengxul\Payss\Exception\ContainerException;
use Pengxul\Payss\Exception\ServiceNotFoundException;
use Pengxul\Payss\Logger;
use Pengxul\Payss\Rocket;
use Pengxul\Payss\Traits\SupportServiceProviderTrait;

/**
 * @see https://opendocs.alipay.com/open/02e7gq?scene=common
 */
class AppPayPlugin implements PluginInterface
{
    use SupportServiceProviderTrait;

    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     */
    public function assembly(Rocket $rocket, Closure $next): Rocket
    {
        Logger::debug('[alipay][AppPayPlugin] 插件开始装载', ['rocket' => $rocket]);

        $this->loadAlipayServiceProvider($rocket);

        $rocket->setDirection(ResponseDirection::class)
            ->mergePayload([
                'method' => 'alipay.trade.app.pay',
                'biz_content' => array_merge(
                    ['product_code' => 'QUICK_MSECURITY_PAY'],
                    $rocket->getParams(),
                ),
            ])
        ;

        Logger::info('[alipay][AppPayPlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $next($rocket);
    }
}
