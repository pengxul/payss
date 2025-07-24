<?php

declare(strict_types=1);

namespace Pengxul\Payss\Service;

use Pengxul\Payss\Contract\ServiceProviderInterface;
use Pengxul\Payss\Exception\ContainerException;
use Pengxul\Payss\Pay;
use Pengxul\Payss\Provider\Unipay;

class UnipayServiceProvider implements ServiceProviderInterface
{
    /**
     * @param mixed $data
     *
     * @throws ContainerException
     */
    public function register($data = null): void
    {
        $service = new Unipay();

        Pay::set(Unipay::class, $service);
        Pay::set('unipay', $service);
    }
}
