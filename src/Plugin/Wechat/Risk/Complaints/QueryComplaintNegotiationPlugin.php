<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Wechat\Risk\Complaints;

use Pengxul\Payss\Exception\Exception;
use Pengxul\Payss\Exception\InvalidParamsException;
use Pengxul\Payss\Plugin\Wechat\GeneralPlugin;
use Pengxul\Payss\Rocket;

/**
 * @see https://pay.weixin.qq.com/wiki/doc/apiv3/apis/chapter10_2_12.shtml
 */
class QueryComplaintNegotiationPlugin extends GeneralPlugin
{
    protected function getMethod(): string
    {
        return 'GET';
    }

    protected function doSomething(Rocket $rocket): void
    {
        $rocket->setPayload(null);
    }

    /**
     * @throws InvalidParamsException
     */
    protected function getUri(Rocket $rocket): string
    {
        $payload = $rocket->getPayload();
        $complaintId = $payload->get('complaint_id');

        if (is_null($complaintId)) {
            throw new InvalidParamsException(Exception::MISSING_NECESSARY_PARAMS);
        }

        $payload->forget('complaint_id');

        return 'v3/merchant-service/complaints-v2/'.
            $complaintId.
            '/negotiation-historys?'.$payload->query();
    }
}
