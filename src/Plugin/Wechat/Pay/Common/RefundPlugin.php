<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Pay\Common;

use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\ServiceNotFoundException;
use Pengxul\Pays\Pay;
use Pengxul\Pays\Plugin\Wechat\GeneralPlugin;
use Pengxul\Pays\Rocket;

use function Pengxul\Pays\get_wechat_config;

class RefundPlugin extends GeneralPlugin
{
    protected function getUri(Rocket $rocket): string
    {
        return 'v3/refund/domestic/refunds';
    }

    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     */
    protected function doSomething(Rocket $rocket): void
    {
        $config = get_wechat_config($rocket->getParams());
        $payload = $rocket->getPayload();

        if (empty($payload->get('notify_url')) && !empty($config['notify_url'])) {
            $merge['notify_url'] = $config['notify_url'];
        }

        if (Pay::MODE_SERVICE === ($config['mode'] ?? null)) {
            $merge['sub_mchid'] = $payload->get('sub_mchid', $config['sub_mch_id'] ?? null);
        }

        $rocket->mergePayload($merge ?? []);
    }
}
