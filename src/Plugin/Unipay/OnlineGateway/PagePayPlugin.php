<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Unipay\OnlineGateway;

use Pengxul\Payss\Direction\ResponseDirection;
use Pengxul\Payss\Plugin\Unipay\GeneralPlugin;
use Pengxul\Payss\Rocket;

/**
 * @see https://open.unionpay.com/tjweb/acproduct/APIList?acpAPIId=754&apiservId=448&version=V2.2&bussType=0
 */
class PagePayPlugin extends GeneralPlugin
{
    protected function getUri(Rocket $rocket): string
    {
        return 'gateway/api/frontTransReq.do';
    }

    protected function doSomething(Rocket $rocket): void
    {
        $rocket->setDirection(ResponseDirection::class)
            ->mergePayload([
                'bizType' => '000201',
                'txnType' => '01',
                'txnSubType' => '01',
                'channelType' => '07',
            ])
        ;
    }
}
