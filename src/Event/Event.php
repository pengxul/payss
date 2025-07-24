<?php

declare(strict_types=1);

namespace Pengxul\Pays\Event;

use Pengxul\Pays\Rocket;

class Event
{
    public ?Rocket $rocket = null;

    public function __construct(?Rocket $rocket = null)
    {
        $this->rocket = $rocket;
    }
}
