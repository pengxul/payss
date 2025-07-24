<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Alipay\Trade;

use Pengxul\Pays\Plugin\Alipay\GeneralPlugin;

class OrderPlugin extends GeneralPlugin
{
    protected function getMethod(): string
    {
        return 'alipay.trade.order.pay';
    }
}
