<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Unipay\Shortcut;

use Pengxul\Pays\Contract\ShortcutInterface;
use Pengxul\Pays\Plugin\Unipay\HtmlResponsePlugin;
use Pengxul\Pays\Plugin\Unipay\OnlineGateway\WapPayPlugin;

class WapShortcut implements ShortcutInterface
{
    public function getPlugins(array $params): array
    {
        return [
            WapPayPlugin::class,
            HtmlResponsePlugin::class,
        ];
    }
}
