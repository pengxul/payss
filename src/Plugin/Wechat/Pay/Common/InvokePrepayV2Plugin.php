<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Pay\Common;

use Exception;
use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\ServiceNotFoundException;
use Pengxul\Pays\Rocket;
use Pengxul\Supports\Config;
use Pengxul\Supports\Str;

use function Pengxul\Pays\get_wechat_sign_v2;

/**
 * @see https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=7_7&index=6
 */
class InvokePrepayV2Plugin extends InvokePrepayPlugin
{
    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     * @throws Exception
     */
    protected function getInvokeConfig(Rocket $rocket, string $prepayId): Config
    {
        $config = new Config([
            'appId' => $this->getAppId($rocket),
            'timeStamp' => time().'',
            'nonceStr' => Str::random(32),
            'package' => 'prepay_id='.$prepayId,
            'signType' => 'MD5',
        ]);

        $config->set('paySign', get_wechat_sign_v2($rocket->getParams(), $config->toArray()));

        return $config;
    }
}
