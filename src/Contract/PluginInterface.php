<?php

declare(strict_types=1);

namespace Pengxul\Payss\Contract;

use Closure;
use Pengxul\Payss\Rocket;

interface PluginInterface
{
    public function assembly(Rocket $rocket, Closure $next): Rocket;
}
