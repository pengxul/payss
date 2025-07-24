<?php

declare(strict_types=1);

namespace Pengxul\Pays\Service;

use Pengxul\Pays\Contract\ServiceProviderInterface;
use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Pay;
use Pengxul\Pays\Provider\Alipay;

class AlipayServiceProvider implements ServiceProviderInterface
{
    /**
     * @param mixed $data
     *
     * @throws ContainerException
     */
    public function register($data = null): void
    {
        $service = new Alipay();

        Pay::set(Alipay::class, $service);
        Pay::set('alipay', $service);
    }
}
