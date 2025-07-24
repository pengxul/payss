<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Alipay\Ebpp;

use Closure;
use Pengxul\Payss\Contract\PluginInterface;
use Pengxul\Payss\Logger;
use Pengxul\Payss\Rocket;

/**
 * @see https://opendocs.alipay.com/open/02hd34
 */
class PdeductSignCancelPlugin implements PluginInterface
{
    public function assembly(Rocket $rocket, Closure $next): Rocket
    {
        Logger::debug('[alipay][PdeductSignCancelPlugin] 插件开始装载', ['rocket' => $rocket]);

        $rocket->mergePayload([
            'method' => 'alipay.ebpp.pdeduct.sign.cancel',
            'biz_content' => array_merge(
                [
                    'agent_channel' => 'PUBLICPLATFORM',
                ],
                $rocket->getParams(),
            ),
        ]);

        Logger::info('[alipay][PdeductSignCancelPlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $next($rocket);
    }
}
