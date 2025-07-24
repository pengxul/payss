<?php

declare(strict_types=1);

namespace Pengxul\Payss\Direction;

use Psr\Http\Message\ResponseInterface;
use Pengxul\Payss\Contract\DirectionInterface;
use Pengxul\Payss\Contract\PackerInterface;
use Pengxul\Payss\Exception\Exception;
use Pengxul\Payss\Exception\InvalidResponseException;

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
