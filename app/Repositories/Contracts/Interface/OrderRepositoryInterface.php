<?php

namespace App\Repositories\Contracts\Interface;

use App\Repositories\BaseRepositoryInterface;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function createOrder($user, $order);

    public function getTableOrder(?int $table_id);
}