<?php

declare(strict_types=1);

namespace Pengxul\Payss\Direction;

use Psr\Http\Message\ResponseInterface;
use Pengxul\Payss\Contract\DirectionInterface;
use Pengxul\Payss\Contract\PackerInterface;
use Pengxul\Payss\Exception\ContainerException;
use Pengxul\Payss\Exception\ServiceNotFoundException;
use Pengxul\Payss\Pay;
use Pengxul\Supports\Collection;

class CollectionDirection implements DirectionInterface
{
    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     */
    public function parse(PackerInterface $packer, ?ResponseInterface $response): Collection
    {
        return new Collection(
            Pay::get(ArrayDirection::class)->parse($packer, $response)
        );
    }
}
