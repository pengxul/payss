<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Alipay\Trade;

use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\ServiceNotFoundException;
use Pengxul\Pays\Plugin\Alipay\GeneralPlugin;
use Pengxul\Pays\Rocket;
use Pengxul\Pays\Traits\SupportServiceProviderTrait;

/**
 * @see https://opendocs.alipay.com/open/02ekfg?scene=common
 */
class PreCreatePlugin extends GeneralPlugin
{
    use SupportServiceProviderTrait;

    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     */
    protected function doSomethingBefore(Rocket $rocket): void
    {
        $this->loadAlipayServiceProvider($rocket);
    }

    protected function getMethod(): string
    {
        return 'alipay.trade.precreate';
    }
}
