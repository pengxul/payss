<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Alipay\Data;

use Pengxul\Pays\Plugin\Alipay\GeneralPlugin;

/**
 * @see https://opendocs.alipay.com/open/029i7e
 */
class BillEreceiptQueryPlugin extends GeneralPlugin
{
    protected function getMethod(): string
    {
        return 'alipay.data.bill.ereceipt.query';
    }
}
