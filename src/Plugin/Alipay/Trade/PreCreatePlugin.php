<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Alipay\Trade;

use Pengxul\Payss\Exception\ContainerException;
use Pengxul\Payss\Exception\ServiceNotFoundException;
use Pengxul\Payss\Plugin\Alipay\GeneralPlugin;
use Pengxul\Payss\Rocket;
use Pengxul\Payss\Traits\SupportServiceProviderTrait;

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
