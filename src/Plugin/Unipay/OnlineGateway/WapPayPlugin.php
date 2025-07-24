<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Unipay\OnlineGateway;

use Pengxul\Pays\Direction\ResponseDirection;
use Pengxul\Pays\Plugin\Unipay\GeneralPlugin;
use Pengxul\Pays\Rocket;

/**
 * @see https://open.unionpay.com/tjweb/acproduct/APIList?acpAPIId=754&apiservId=448&version=V2.2&bussType=0
 */
class WapPayPlugin extends GeneralPlugin
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
                'channelType' => '08',
            ])
        ;
    }
}
