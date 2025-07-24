<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Alipay\Shortcut;

use Pengxul\Payss\Contract\ShortcutInterface;
use Pengxul\Payss\Plugin\Alipay\HtmlResponsePlugin;
use Pengxul\Payss\Plugin\Alipay\Trade\PagePayPlugin;

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
