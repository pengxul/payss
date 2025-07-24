<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Alipay\Fund;

use Pengxul\Pays\Plugin\Alipay\GeneralPlugin;

class TransTobankTransferPlugin extends GeneralPlugin
{
    protected function getMethod(): string
    {
        return 'alipay.fund.trans.tobank.transfer';
    }
}
