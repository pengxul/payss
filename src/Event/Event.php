<?php

declare(strict_types=1);

namespace Pengxul\Payss\Event;

use Pengxul\Payss\Rocket;

class Event
{
    public ?Rocket $rocket = null;

    public function __construct(?Rocket $rocket = null)
    {
        $this->rocket = $rocket;
    }
}
