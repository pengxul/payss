<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Wechat\Shortcut;

use Pengxul\Payss\Contract\ShortcutInterface;
use Pengxul\Payss\Plugin\Wechat\Pay\App\InvokePrepayPlugin;
use Pengxul\Payss\Plugin\Wechat\Pay\App\PrepayPlugin;

class AppShortcut implements ShortcutInterface
{
    public function getPlugins(array $params): array
    {
        return [
            PrepayPlugin::class,
            InvokePrepayPlugin::class,
        ];
    }
}
