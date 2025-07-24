<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Alipay\Fund;

use Closure;
use Pengxul\Pays\Contract\PluginInterface;
use Pengxul\Pays\Direction\ResponseDirection;
use Pengxul\Pays\Logger;
use Pengxul\Pays\Rocket;

/**
 * @see https://opendocs.alipay.com/open/03rbye
 */
class TransPagePayPlugin implements PluginInterface
{
    public function assembly(Rocket $rocket, Closure $next): Rocket
    {
        Logger::debug('[alipay][TransPagePayPlugin] 插件开始装载', ['rocket' => $rocket]);

        $rocket->setDirection(ResponseDirection::class)
            ->mergePayload([
                'method' => 'alipay.fund.trans.page.pay',
                'biz_content' => $rocket->getParams(),
            ])
        ;

        Logger::info('[alipay][TransPagePayPlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $next($rocket);
    }
}
