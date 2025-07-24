<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Unipay\QrCode;

use Pengxul\Payss\Plugin\Unipay\GeneralPlugin;
use Pengxul\Payss\Rocket;

/**
 * @see https://open.unionpay.com/tjweb/acproduct/APIList?acpAPIId=794&apiservId=468&version=V2.2&bussType=0
 */
class ScanPreAuthPlugin extends GeneralPlugin
{
    protected function getUri(Rocket $rocket): string
    {
        return 'gateway/api/backTransReq.do';
    }

    protected function doSomething(Rocket $rocket): void
    {
        $rocket->mergePayload([
            'bizType' => '000000',
            'txnType' => '02',
            'txnSubType' => '05',
            'channelType' => '08',
        ]);
    }
}
