<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Alipay\User;

use Closure;
use Pengxul\Payss\Contract\PluginInterface;
use Pengxul\Payss\Logger;
use Pengxul\Payss\Rocket;

/**
 * @see https://opendocs.alipay.com/open/02fkap?ref=api&scene=90766afb41f74df6ae1676e89625ebac
 */
class AgreementUnsignPlugin implements PluginInterface
{
    public function assembly(Rocket $rocket, Closure $next): Rocket
    {
        Logger::debug('[alipay][AgreementUnsignPlugin] 插件开始装载', ['rocket' => $rocket]);

        $rocket->mergePayload([
            'method' => 'alipay.user.agreement.unsign',
            'biz_content' => array_merge(
                ['personal_product_code' => 'CYCLE_PAY_AUTH_P'],
                $rocket->getParams()
            ),
        ]);

        Logger::info('[alipay][AgreementUnsignPlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $next($rocket);
    }
}
