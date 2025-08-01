<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Unipay\Shortcut;

use Pengxul\Payss\Contract\ShortcutInterface;
use Pengxul\Payss\Exception\Exception;
use Pengxul\Payss\Exception\InvalidParamsException;
use Pengxul\Payss\Plugin\Unipay\OnlineGateway\QueryPlugin;
use Pengxul\Supports\Str;

class QueryShortcut implements ShortcutInterface
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

        throw new InvalidParamsException(Exception::SHORTCUT_MULTI_ACTION_ERROR, "Query action [{$typeMethod}] not supported");
    }

    protected function defaultPlugins(): array
    {
        return [
            QueryPlugin::class,
        ];
    }

    protected function qrCodePlugins(): array
    {
        return [
            \Pengxul\Payss\Plugin\Unipay\QrCode\QueryPlugin::class,
        ];
    }
}
