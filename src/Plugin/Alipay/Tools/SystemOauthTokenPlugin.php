<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Alipay\Tools;

use Pengxul\Pays\Plugin\Alipay\GeneralPlugin;
use Pengxul\Pays\Rocket;

/**
 * @see https://opendocs.alipay.com/open/02ailc
 */
class SystemOauthTokenPlugin extends GeneralPlugin
{
    protected function doSomethingBefore(Rocket $rocket): void
    {
        $rocket->mergePayload($rocket->getParams());
    }

    protected function getMethod(): string
    {
        return 'alipay.system.oauth.token';
    }
}
