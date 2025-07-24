<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Fund\Transfer;

use Pengxul\Pays\Exception\Exception;
use Pengxul\Pays\Exception\InvalidParamsException;
use Pengxul\Pays\Plugin\Wechat\GeneralPlugin;
use Pengxul\Pays\Rocket;

/**
 * @see https://pay.weixin.qq.com/wiki/doc/apiv3/apis/chapter4_3_5.shtml
 */
class QueryOutBatchNoPlugin extends GeneralPlugin
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

        if (!$payload->has('out_batch_no') || !$payload->has('need_query_detail')) {
            throw new InvalidParamsException(Exception::MISSING_NECESSARY_PARAMS);
        }

        $outBatchNo = $payload->get('out_batch_no');

        $payload->forget('out_batch_no');

        return 'v3/transfer/batches/out-batch-no/'.$outBatchNo.
            '?'.$payload->query();
    }

    /**
     * @throws InvalidParamsException
     */
    protected function getPartnerUri(Rocket $rocket): string
    {
        $payload = $rocket->getPayload();

        if (!$payload->has('out_batch_no') || !$payload->has('need_query_detail')) {
            throw new InvalidParamsException(Exception::MISSING_NECESSARY_PARAMS);
        }

        $outBatchNo = $payload->get('out_batch_no');

        $payload->forget('out_batch_no');

        return 'v3/partner-transfer/batches/out-batch-no/'.$outBatchNo.
            '?'.$payload->query();
    }
}
