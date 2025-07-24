<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Unipay\Shortcut;

use Pengxul\Payss\Contract\ShortcutInterface;
use Pengxul\Payss\Plugin\Unipay\HtmlResponsePlugin;
use Pengxul\Payss\Plugin\Unipay\OnlineGateway\PagePayPlugin;

class WebShortcut implements ShortcutInterface
{
    public function getPlugins(array $params): array
    {
        return [
            PagePayPlugin::class,
            HtmlResponsePlugin::class,
        ];
    }
}
