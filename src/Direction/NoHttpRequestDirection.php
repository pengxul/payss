<?php

declare(strict_types=1);

namespace Pengxul\Payss\Direction;

use Psr\Http\Message\ResponseInterface;
use Pengxul\Payss\Contract\DirectionInterface;
use Pengxul\Payss\Contract\PackerInterface;

class NoHttpRequestDirection implements DirectionInterface
{
    public function parse(PackerInterface $packer, ?ResponseInterface $response): ?ResponseInterface
    {
        return $response;
    }
}
