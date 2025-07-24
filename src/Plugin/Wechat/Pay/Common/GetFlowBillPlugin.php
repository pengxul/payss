<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Pay\Common;

use Pengxul\Pays\Plugin\Wechat\GeneralPlugin;
use Pengxul\Pays\Rocket;

class GetFlowBillPlugin extends GeneralPlugin
{
    protected function getUri(Rocket $rocket): string
    {
        return 'v3/bill/fundflowbill?'.http_build_query($rocket->getParams());
    }

    protected function getMethod(): string
    {
        return 'GET';
    }

    protected function doSomething(Rocket $rocket): void
    {
        $rocket->setPayload(null);
    }
}
