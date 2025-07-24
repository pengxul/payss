<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Alipay\Trade;

use Pengxul\Payss\Plugin\Alipay\GeneralPlugin;

class OrderPlugin extends GeneralPlugin
{
    protected function getMethod(): string
    {
        return 'alipay.trade.order.pay';
    }
}
