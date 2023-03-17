<?php

namespace App\Repositories\Contracts\Interface;

use App\Repositories\BaseRepositoryInterface;

interface BillRepositoryInterface extends BaseRepositoryInterface
{
    public function createBill(? object $order);
    public function getLastBills(?string $label, ?string $dateFormat, ?string $param1, ?string $param2, ?string $condition);
    public function getDifferent(?string $paramDate = '1', ?string $format, ?string $condition);
}