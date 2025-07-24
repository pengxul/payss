<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Risk\Complaints;

use Pengxul\Pays\Direction\OriginResponseDirection;
use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\Exception;
use Pengxul\Pays\Exception\InvalidParamsException;
use Pengxul\Pays\Exception\ServiceNotFoundException;
use Pengxul\Pays\Plugin\Wechat\GeneralPlugin;
use Pengxul\Pays\Rocket;

use function Pengxul\Pays\get_wechat_config;

/**
 * @see https://pay.weixin.qq.com/wiki/doc/apiv3/apis/chapter10_2_14.shtml
 */
class ResponseComplaintPlugin extends GeneralPlugin
{
    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     */
    protected function doSomething(Rocket $rocket): void
    {
        $rocket->setDirection(OriginResponseDirection::class);

        $config = get_wechat_config($rocket->getParams());
        $payload = $rocket->getPayload();

        $payload->forget('complaint_id');

        if (!$payload->has('complainted_mchid')) {
            $rocket->mergePayload([
                'complainted_mchid' => $config['mch_id'] ?? '',
            ]);
        }
    }

    /**
     * @throws InvalidParamsException
     */
    protected function getUri(Rocket $rocket): string
    {
        $payload = $rocket->getPayload();

        if (!$payload->has('complaint_id')) {
            throw new InvalidParamsException(Exception::MISSING_NECESSARY_PARAMS);
        }

        return 'v3/merchant-service/complaints-v2/'.
            $payload->get('complaint_id').
            '/response';
    }
}
