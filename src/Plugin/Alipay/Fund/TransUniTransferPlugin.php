<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Alipay\Fund;

use Closure;
use Pengxul\Payss\Contract\PluginInterface;
use Pengxul\Payss\Logger;
use Pengxul\Payss\Rocket;

/**
 * @see https://opendocs.alipay.com/open/02byuo?scene=common
 */
class TransUniTransferPlugin implements PluginInterface
{
    public function assembly(Rocket $rocket, Closure $next): Rocket
    {
        Logger::debug('[alipay][TransUniTransferPlugin] 插件开始装载', ['rocket' => $rocket]);

        $rocket->mergePayload([
            'method' => 'alipay.fund.trans.uni.transfer',
            'biz_content' => array_merge(
                [
                    'biz_scene' => 'DIRECT_TRANSFER',
                    'product_code' => 'TRANS_ACCOUNT_NO_PWD',
                ],
                $rocket->getParams(),
            ),
        ]);

        Logger::info('[alipay][TransUniTransferPlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $next($rocket);
    }
}
