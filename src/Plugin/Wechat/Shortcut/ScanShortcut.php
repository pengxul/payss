<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Shortcut;

use Pengxul\Pays\Contract\ShortcutInterface;
use Pengxul\Pays\Plugin\Wechat\Pay\Native\PrepayPlugin;

class ScanShortcut implements ShortcutInterface
{
    public function getPlugins(array $params): array
    {
        return [
            PrepayPlugin::class,
        ];
    }
}
