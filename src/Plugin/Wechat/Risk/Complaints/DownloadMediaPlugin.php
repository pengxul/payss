<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Risk\Complaints;

use Pengxul\Pays\Direction\OriginResponseDirection;
use Pengxul\Pays\Exception\Exception;
use Pengxul\Pays\Exception\InvalidParamsException;
use Pengxul\Pays\Plugin\Wechat\GeneralPlugin;
use Pengxul\Pays\Rocket;

/**
 * @see https://pay.weixin.qq.com/wiki/doc/apiv3/apis/chapter10_2_18.shtml
 */
class DownloadMediaPlugin extends GeneralPlugin
{
    /**
     * @throws InvalidParamsException
     */
    protected function getUri(Rocket $rocket): string
    {
        $payload = $rocket->getPayload();

        if (!$payload->has('media_url')) {
            throw new InvalidParamsException(Exception::MISSING_NECESSARY_PARAMS);
        }

        return $payload->get('media_url');
    }

    protected function getMethod(): string
    {
        return 'GET';
    }

    protected function doSomething(Rocket $rocket): void
    {
        $rocket->setDirection(OriginResponseDirection::class);

        $rocket->setPayload(null);
    }
}
