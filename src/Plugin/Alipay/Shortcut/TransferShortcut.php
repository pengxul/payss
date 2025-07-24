<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Alipay\Shortcut;

use Pengxul\Payss\Contract\ShortcutInterface;
use Pengxul\Payss\Plugin\Alipay\Fund\TransUniTransferPlugin;

class TransferShortcut implements ShortcutInterface
{
    public function getPlugins(array $params): array
    {
        return [
            TransUniTransferPlugin::class,
        ];
    }
}
