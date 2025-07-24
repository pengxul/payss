<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Unipay\QrCode;

use Pengxul\Payss\Exception\ContainerException;
use Pengxul\Payss\Exception\ServiceNotFoundException;
use Pengxul\Payss\Pay;
use Pengxul\Payss\Rocket;

use function Pengxul\Payss\get_unipay_config;

/**
 * @see https://open.unionpay.com/tjweb/acproduct/APIList?acpAPIId=792&apiservId=468&version=V2.2&bussType=0
 */
class QueryPlugin extends \Pengxul\Payss\Plugin\Unipay\OnlineGateway\QueryPlugin
{
    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     */
    protected function getUri(Rocket $rocket): string
    {
        $config = get_unipay_config($rocket->getParams());

        if (Pay::MODE_SANDBOX === ($config['mode'] ?? Pay::MODE_NORMAL)) {
            return 'https://101.231.204.80:5000/gateway/api/backTransReq.do';
        }

        return parent::getUri($rocket);
    }
}
