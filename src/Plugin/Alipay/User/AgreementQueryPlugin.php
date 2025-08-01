<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Alipay\User;

use Closure;
use Pengxul\Payss\Contract\PluginInterface;
use Pengxul\Payss\Logger;
use Pengxul\Payss\Rocket;

/**
 * @see https://opendocs.alipay.com/open/02fkao?ref=api&scene=8837b4183390497f84bb53783b488ecc
 */
class AgreementQueryPlugin implements PluginInterface
{
    public function assembly(Rocket $rocket, Closure $next): Rocket
    {
        Logger::debug('[alipay][AgreementQueryPlugin] 插件开始装载', ['rocket' => $rocket]);

        $rocket->mergePayload([
            'method' => 'alipay.user.agreement.query',
            'biz_content' => array_merge(
                ['personal_product_code' => 'CYCLE_PAY_AUTH_P'],
                $rocket->getParams()
            ),
        ]);

        Logger::info('[alipay][AgreementQueryPlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $next($rocket);
    }
}
