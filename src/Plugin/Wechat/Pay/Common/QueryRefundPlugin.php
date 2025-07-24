<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Pay\Common;

use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\Exception;
use Pengxul\Pays\Exception\InvalidParamsException;
use Pengxul\Pays\Exception\ServiceNotFoundException;
use Pengxul\Pays\Plugin\Wechat\GeneralPlugin;
use Pengxul\Pays\Rocket;

use function Pengxul\Pays\get_wechat_config;

class QueryRefundPlugin extends GeneralPlugin
{
    /**
     * @throws InvalidParamsException
     */
    protected function getUri(Rocket $rocket): string
    {
        $payload = $rocket->getPayload();

        if (!$payload->has('out_refund_no')) {
            throw new InvalidParamsException(Exception::MISSING_NECESSARY_PARAMS);
        }

        return 'v3/refund/domestic/refunds/'.$payload->get('out_refund_no');
    }

    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     */
    protected function getPartnerUri(Rocket $rocket): string
    {
        $config = get_wechat_config($rocket->getParams());
        $url = parent::getPartnerUri($rocket);

        return $url.'?sub_mchid='.$rocket->getPayload()->get('sub_mchid', $config['sub_mch_id'] ?? '');
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
