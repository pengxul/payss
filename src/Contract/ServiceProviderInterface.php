<?php

declare(strict_types=1);

namespace Pengxul\Pays\Contract;

use Pengxul\Pays\Exception\ContainerException;

interface ServiceProviderInterface
{
    /**
     * @param mixed $data
     *
     * @throws ContainerException
     */
    public function register($data = null): void;
}
