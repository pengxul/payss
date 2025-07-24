<?php

declare(strict_types=1);

namespace Pengxul\Pays\Direction;

use Psr\Http\Message\ResponseInterface;
use Pengxul\Pays\Contract\DirectionInterface;
use Pengxul\Pays\Contract\PackerInterface;

class NoHttpRequestDirection implements DirectionInterface
{
    public function parse(PackerInterface $packer, ?ResponseInterface $response): ?ResponseInterface
    {
        return $response;
    }
}
