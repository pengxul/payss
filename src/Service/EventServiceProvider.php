<?php

declare(strict_types=1);

namespace Pengxul\Payss\Service;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Pengxul\Payss\Contract\EventDispatcherInterface;
use Pengxul\Payss\Contract\ServiceProviderInterface;
use Pengxul\Payss\Exception\ContainerException;
use Pengxul\Payss\Pay;

class EventServiceProvider implements ServiceProviderInterface
{
    /**
     * @param mixed $data
     *
     * @throws ContainerException
     */
    public function register($data = null): void
    {
        if (class_exists(EventDispatcher::class)) {
            Pay::set(EventDispatcherInterface::class, new EventDispatcher());
        }
    }
}
