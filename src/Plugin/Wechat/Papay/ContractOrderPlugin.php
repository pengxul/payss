<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Papay;

use Pengxul\Pays\Plugin\Wechat\GeneralV2Plugin;
use Pengxul\Pays\Rocket;

/**
 * 支付中签约.
 *
 * @see https://pay.weixin.qq.com/wiki/doc/api/wxpay_v2/papay/chapter3_5.shtml
 */
class ContractOrderPlugin extends GeneralV2Plugin
{
    protected function getUri(Rocket $rocket): string
    {
        return 'pay/contractorder';
    }
}
