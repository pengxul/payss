<?php

declare(strict_types=1);

namespace Pengxul\Pays\Direction;

use Psr\Http\Message\ResponseInterface;
use Pengxul\Pays\Contract\DirectionInterface;
use Pengxul\Pays\Contract\PackerInterface;
use Pengxul\Pays\Exception\Exception;
use Pengxul\Pays\Exception\InvalidResponseException;

class OriginResponseDirection implements DirectionInterface
{
    /**
     * @throws InvalidResponseException
     */
    public function parse(PackerInterface $packer, ?ResponseInterface $response): ?ResponseInterface
    {
        if (!is_null($response)) {
            return $response;
        }

        throw new InvalidResponseException(Exception::INVALID_RESPONSE_CODE);
    }
}
