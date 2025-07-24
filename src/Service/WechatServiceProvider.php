<?php

declare(strict_types=1);

namespace Pengxul\Pays\Service;

use Pengxul\Pays\Contract\ServiceProviderInterface;
use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Pay;
use Pengxul\Pays\Provider\Wechat;

class WechatServiceProvider implements ServiceProviderInterface
{
    /**
     * @param mixed $data
     *
     * @throws ContainerException
     */
    public function register($data = null): void
    {
        $service = new Wechat();

        Pay::set(Wechat::class, $service);
        Pay::set('wechat', $service);
    }
}
