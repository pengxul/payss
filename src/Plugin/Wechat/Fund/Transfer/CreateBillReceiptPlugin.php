<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Fund\Transfer;

use Pengxul\Pays\Exception\Exception;
use Pengxul\Pays\Exception\InvalidParamsException;
use Pengxul\Pays\Plugin\Wechat\GeneralPlugin;
use Pengxul\Pays\Rocket;

/**
 * @see https://pay.weixin.qq.com/wiki/doc/apiv3/apis/chapter4_3_7.shtml
 */
class CreateBillReceiptPlugin extends GeneralPlugin
{
    /**
     * @throws InvalidParamsException
     */
    protected function doSomething(Rocket $rocket): void
    {
        $payload = $rocket->getPayload();

        if (!$payload->has('out_batch_no')) {
            throw new InvalidParamsException(Exception::MISSING_NECESSARY_PARAMS);
        }
    }

    protected function getUri(Rocket $rocket): string
    {
        return 'v3/transfer/bill-receipt';
    }
}
