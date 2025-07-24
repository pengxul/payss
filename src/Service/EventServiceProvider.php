<?php

declare(strict_types=1);

namespace Pengxul\Pays\Service;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Pengxul\Pays\Contract\EventDispatcherInterface;
use Pengxul\Pays\Contract\ServiceProviderInterface;
use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Pay;

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
