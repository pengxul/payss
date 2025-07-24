<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Ecommerce\Refund;

use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\Exception;
use Pengxul\Pays\Exception\InvalidParamsException;
use Pengxul\Pays\Exception\ServiceNotFoundException;
use Pengxul\Pays\Plugin\Wechat\GeneralPlugin;
use Pengxul\Pays\Rocket;

use function Pengxul\Pays\get_wechat_config;

/**
 * @see https://pay.weixin.qq.com/wiki/doc/apiv3_partner/apis/chapter7_6_5.shtml
 */
class QueryReturnAdvancePlugin extends GeneralPlugin
{
    /**
     * @throws InvalidParamsException
     */
    protected function getUri(Rocket $rocket): string
    {
        throw new InvalidParamsException(Exception::NOT_IN_SERVICE_MODE);
    }

    /**
     * @throws ContainerException
     * @throws InvalidParamsException
     * @throws ServiceNotFoundException
     */
    protected function getPartnerUri(Rocket $rocket): string
    {
        $payload = $rocket->getPayload();
        $config = get_wechat_config($rocket->getParams());
        $subMchId = $payload->get('sub_mchid', $config['sub_mch_id'] ?? '');

        if (!$payload->has('refund_id')) {
            throw new InvalidParamsException(Exception::MISSING_NECESSARY_PARAMS);
        }

        return 'v3/ecommerce/refunds/'.$payload->get('refund_id').'/return-advance?sub_mchid='.$subMchId;
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
