<?php

namespace App\Repositories\Contracts\Interface;

use App\Repositories\BaseRepositoryInterface;

interface BillDetailRepositoryInterface extends BaseRepositoryInterface
{
    public function createBillDetail(?object $bill, ?object $order);
}