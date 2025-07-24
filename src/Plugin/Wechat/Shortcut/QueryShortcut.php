<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Wechat\Shortcut;

use Pengxul\Pays\Contract\ShortcutInterface;
use Pengxul\Pays\Exception\Exception;
use Pengxul\Pays\Exception\InvalidParamsException;
use Pengxul\Pays\Plugin\Wechat\Pay\Common\QueryPlugin;
use Pengxul\Pays\Plugin\Wechat\Pay\Common\QueryRefundPlugin;
use Pengxul\Supports\Str;

class QueryShortcut implements ShortcutInterface
{
    /**
     * @throws InvalidParamsException
     */
    public function getPlugins(array $params): array
    {
        if (isset($params['combine_out_trade_no'])) {
            return $this->combinePlugins();
        }

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

    protected function refundPlugins(): array
    {
        return [
            QueryRefundPlugin::class,
        ];
    }

    protected function combinePlugins(): array
    {
        return [
            \Pengxul\Pays\Plugin\Wechat\Pay\Combine\QueryPlugin::class,
        ];
    }
}
