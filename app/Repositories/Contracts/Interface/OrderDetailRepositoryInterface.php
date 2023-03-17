<?php

namespace App\Repositories\Contracts\Interface;

use App\Repositories\BaseRepositoryInterface;

interface OrderDetailRepositoryInterface extends BaseRepositoryInterface
{
    public function createOrderDetail(?int $order_id, $order = []);

    public function checkDeleteAvailability(?int $order);
}