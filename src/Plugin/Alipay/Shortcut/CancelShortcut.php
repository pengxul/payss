<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Alipay\Shortcut;

use Pengxul\Pays\Contract\ShortcutInterface;
use Pengxul\Pays\Plugin\Alipay\Trade\CancelPlugin;

class CancelShortcut implements ShortcutInterface
{
    public function getPlugins(array $params): array
    {
        return [
            CancelPlugin::class,
        ];
    }
}
