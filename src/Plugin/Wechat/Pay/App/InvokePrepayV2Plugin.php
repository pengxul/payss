<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Pay\App;

use Exception;
use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\ServiceNotFoundException;
use Pengxul\Pays\Rocket;
use Pengxul\Supports\Config;
use Pengxul\Supports\Str;

use function Pengxul\Pays\get_wechat_config;
use function Pengxul\Pays\get_wechat_sign_v2;

/**
 * @see https://pay.weixin.qq.com/wiki/doc/api/app/app.php?chapter=8_5
 */
class InvokePrepayV2Plugin extends \Pengxul\Pays\Plugin\Wechat\Pay\Common\InvokePrepayPlugin
{
    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     * @throws Exception
     */
    protected function getInvokeConfig(Rocket $rocket, string $prepayId): Config
    {
        $params = $rocket->getParams();

        $config = new Config([
            'appId' => $this->getAppId($rocket),
            'partnerId' => get_wechat_config($params)['mch_id'] ?? null,
            'prepayId' => $prepayId,
            'package' => 'Sign=WXPay',
            'nonceStr' => Str::random(32),
            'timeStamp' => time().'',
        ]);

        $config->set('sign', get_wechat_sign_v2($params, $config->all()));

        return $config;
    }

    protected function getConfigKey(): string
    {
        return 'app_id';
    }
}
