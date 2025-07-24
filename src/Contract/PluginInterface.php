<?php

declare(strict_types=1);

namespace Pengxul\Pays\Contract;

use Closure;
use Pengxul\Pays\Rocket;

interface PluginInterface
{
    public function assembly(Rocket $rocket, Closure $next): Rocket;
}
