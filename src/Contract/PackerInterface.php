<?php

declare(strict_types=1);

namespace Pengxul\Payss\Contract;

interface PackerInterface
{
    public function pack(array $payload): string;

    public function unpack(string $payload): ?array;
}
