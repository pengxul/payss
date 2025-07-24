<?php

declare(strict_types=1);

namespace Pengxul\Payss\Service;

use Pengxul\Payss\Contract\ServiceProviderInterface;
use Pengxul\Payss\Exception\ContainerException;
use Pengxul\Payss\Pay;
use Pengxul\Payss\Provider\Wechat;

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
