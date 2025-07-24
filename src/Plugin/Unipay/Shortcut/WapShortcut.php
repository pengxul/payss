<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Unipay\Shortcut;

use Pengxul\Payss\Contract\ShortcutInterface;
use Pengxul\Payss\Plugin\Unipay\HtmlResponsePlugin;
use Pengxul\Payss\Plugin\Unipay\OnlineGateway\WapPayPlugin;

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
