<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Marketing\Coupon;

use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\ServiceNotFoundException;
use Pengxul\Pays\Plugin\Wechat\GeneralPlugin;
use Pengxul\Pays\Rocket;

use function Pengxul\Pays\get_wechat_config;

/**
 * @see https://pay.weixin.qq.com/wiki/doc/apiv3/apis/chapter9_1_12.shtml
 */
class SetCallbackPlugin extends GeneralPlugin
{
    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     */
    protected function doSomething(Rocket $rocket): void
    {
        $config = get_wechat_config($rocket->getParams());

        $rocket->mergePayload([
            'mchid' => $config['mch_id'] ?? '',
        ]);
    }

    protected function getUri(Rocket $rocket): string
    {
        return 'v3/marketing/favor/callbacks';
    }
}
