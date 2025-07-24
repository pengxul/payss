<?php

declare(strict_types=1);

namespace Pengxul\Payss\Contract;

use Pengxul\Payss\Exception\ContainerException;

interface ServiceProviderInterface
{
    /**
     * @param mixed $data
     *
     * @throws ContainerException
     */
    public function register($data = null): void;
}
