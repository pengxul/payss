<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Fund\Profitsharing;

use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\ServiceNotFoundException;
use Pengxul\Pays\Pay;
use Pengxul\Pays\Plugin\Wechat\GeneralPlugin;
use Pengxul\Pays\Rocket;

use function Pengxul\Pays\get_wechat_config;

/**
 * @see https://pay.weixin.qq.com/wiki/doc/apiv3/apis/chapter8_1_9.shtml
 */
class DeleteReceiverPlugin extends GeneralPlugin
{
    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     */
    protected function doSomething(Rocket $rocket): void
    {
        $config = get_wechat_config($rocket->getParams());

        $wechatId = [
            'appid' => $config['mp_app_id'] ?? null,
        ];

        if (Pay::MODE_SERVICE === ($config['mode'] ?? null)) {
            $wechatId['sub_mchid'] = $rocket->getPayload()
                ->get('sub_mchid', $config['sub_mch_id'] ?? '')
            ;
        }

        $rocket->mergePayload($wechatId);
    }

    protected function getUri(Rocket $rocket): string
    {
        return 'v3/profitsharing/receivers/delete';
    }
}
