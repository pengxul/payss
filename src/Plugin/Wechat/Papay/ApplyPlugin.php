<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Wechat\Papay;

use Pengxul\Payss\Plugin\Wechat\GeneralV2Plugin;
use Pengxul\Payss\Rocket;

/**
 * 申请代扣.
 *
 * @see https://pay.weixin.qq.com/wiki/doc/api/wxpay_v2/papay/chapter3_8.shtml
 */
class ApplyPlugin extends GeneralV2Plugin
{
    protected function getUri(Rocket $rocket): string
    {
        return 'pay/pappayapply';
    }
}
