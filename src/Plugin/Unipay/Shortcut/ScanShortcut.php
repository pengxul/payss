<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Unipay\Shortcut;

use Pengxul\Payss\Contract\ShortcutInterface;
use Pengxul\Payss\Exception\Exception;
use Pengxul\Payss\Exception\InvalidParamsException;
use Pengxul\Payss\Plugin\Unipay\QrCode\ScanFeePlugin;
use Pengxul\Payss\Plugin\Unipay\QrCode\ScanNormalPlugin;
use Pengxul\Payss\Plugin\Unipay\QrCode\ScanPreAuthPlugin;
use Pengxul\Payss\Plugin\Unipay\QrCode\ScanPreOrderPlugin;
use Pengxul\Supports\Str;

class ScanShortcut implements ShortcutInterface
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

        throw new InvalidParamsException(Exception::SHORTCUT_MULTI_ACTION_ERROR, "Scan action [{$typeMethod}] not supported");
    }

    protected function defaultPlugins(): array
    {
        return [
            ScanNormalPlugin::class,
        ];
    }

    protected function preAuthPlugins(): array
    {
        return [
            ScanPreAuthPlugin::class,
        ];
    }

    protected function preOrderPlugins(): array
    {
        return [
            ScanPreOrderPlugin::class,
        ];
    }

    protected function feePlugins(): array
    {
        return [
            ScanFeePlugin::class,
        ];
    }
}
