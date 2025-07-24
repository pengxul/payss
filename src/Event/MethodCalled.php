<?php

declare(strict_types=1);

namespace Pengxul\Payss\Event;

use Pengxul\Payss\Rocket;

class MethodCalled extends Event
{
    public string $provider;

    public string $name;

    public array $params;

    public function __construct(string $provider, string $name, array $params, ?Rocket $rocket = null)
    {
        $this->provider = $provider;
        $this->name = $name;
        $this->params = $params;

        parent::__construct($rocket);
    }
}
