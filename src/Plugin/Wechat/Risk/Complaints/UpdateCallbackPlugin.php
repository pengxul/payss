<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Risk\Complaints;

use Pengxul\Pays\Plugin\Wechat\GeneralPlugin;
use Pengxul\Pays\Rocket;

/**
 * @see https://pay.weixin.qq.com/wiki/doc/apiv3/apis/chapter10_2_4.shtml
 */
class UpdateCallbackPlugin extends GeneralPlugin
{
    protected function getMethod(): string
    {
        return 'PUT';
    }

    protected function doSomething(Rocket $rocket): void
    {
    }

    protected function getUri(Rocket $rocket): string
    {
        return 'v3/merchant-service/complaint-notifications';
    }
}
