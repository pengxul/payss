<?php

declare(strict_types=1);

namespace Pengxul\Pays\Direction;

use Psr\Http\Message\ResponseInterface;
use Pengxul\Pays\Contract\DirectionInterface;
use Pengxul\Pays\Contract\PackerInterface;
use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\ServiceNotFoundException;
use Pengxul\Pays\Pay;
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
