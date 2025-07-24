<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Alipay\Shortcut;

use Pengxul\Pays\Contract\ShortcutInterface;
use Pengxul\Pays\Plugin\Alipay\HtmlResponsePlugin;
use Pengxul\Pays\Plugin\Alipay\Trade\PagePayPlugin;

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
