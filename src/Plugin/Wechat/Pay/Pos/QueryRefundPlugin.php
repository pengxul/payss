<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Wechat\Pay\Pos;

use Pengxul\Payss\Plugin\Wechat\GeneralV2Plugin;
use Pengxul\Payss\Rocket;

/**
 * @see https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=9_5
 */
class QueryRefundPlugin extends GeneralV2Plugin
{
    protected function getUri(Rocket $rocket): string
    {
        return 'pay/refundquery';
    }
}
