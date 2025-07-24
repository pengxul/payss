<?php

declare(strict_types=1);

namespace Pengxul\Payss\Exception;

use Throwable;

class InvalidConfigException extends Exception
{
    /**
     * @param mixed $extra
     */
    public function __construct(int $code = self::CONFIG_ERROR, string $message = 'Config Error', $extra = null, Throwable $previous = null)
    {
        parent::__construct($message, $code, $extra, $previous);
    }
}
