<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Alipay\Fund;

use Pengxul\Payss\Plugin\Alipay\GeneralPlugin;

class TransTobankTransferPlugin extends GeneralPlugin
{
    protected function getMethod(): string
    {
        return 'alipay.fund.trans.tobank.transfer';
    }
}
