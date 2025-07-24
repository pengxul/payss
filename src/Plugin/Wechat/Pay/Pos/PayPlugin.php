<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Pay\Pos;

use Pengxul\Pays\Plugin\Wechat\GeneralV2Plugin;
use Pengxul\Pays\Rocket;

/**
 * @see https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=9_10&index=1
 */
class PayPlugin extends GeneralV2Plugin
{
    protected function getUri(Rocket $rocket): string
    {
        return 'pay/micropay';
    }
}
