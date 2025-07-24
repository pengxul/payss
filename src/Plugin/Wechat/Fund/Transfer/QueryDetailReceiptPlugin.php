<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Wechat\Fund\Transfer;

use Pengxul\Payss\Exception\Exception;
use Pengxul\Payss\Exception\InvalidParamsException;
use Pengxul\Payss\Plugin\Wechat\GeneralPlugin;
use Pengxul\Payss\Rocket;

/**
 * @see https://pay.weixin.qq.com/wiki/doc/apiv3/apis/chapter4_3_10.shtml
 */
class QueryDetailReceiptPlugin extends GeneralPlugin
{
    protected function getMethod(): string
    {
        return 'GET';
    }

    /**
     * @throws InvalidParamsException
     */
    protected function doSomething(Rocket $rocket): void
    {
        $payload = $rocket->getPayload();

        if (!$payload->has('out_detail_no') || !$payload->has('accept_type')) {
            throw new InvalidParamsException(Exception::MISSING_NECESSARY_PARAMS);
        }

        $rocket->setPayload(null);
    }

    protected function getUri(Rocket $rocket): string
    {
        return 'v3/transfer-detail/electronic-receipts?'.$rocket->getPayload()->query();
    }
}
