<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Unipay\Shortcut;

use Pengxul\Pays\Contract\ShortcutInterface;
use Pengxul\Pays\Exception\Exception;
use Pengxul\Pays\Exception\InvalidParamsException;
use Pengxul\Pays\Plugin\Unipay\OnlineGateway\CancelPlugin;
use Pengxul\Supports\Str;

class CancelShortcut implements ShortcutInterface
{
    /**
     * @throws InvalidParamsException
     */
    public function getPlugins(array $params): array
    {
        $typeMethod = Str::camel($params['_action'] ?? 'default').'Plugins';

        if (method_exists($this, $typeMethod)) {
            return $this->{$typeMethod}();
        }

        throw new InvalidParamsException(Exception::SHORTCUT_MULTI_ACTION_ERROR, "Cancel action [{$typeMethod}] not supported");
    }

    protected function defaultPlugins(): array
    {
        return [
            CancelPlugin::class,
        ];
    }

    protected function qrCodePlugins(): array
    {
        return [
            \Pengxul\Pays\Plugin\Unipay\QrCode\CancelPlugin::class,
        ];
    }
}
