<?php

namespace App\Repositories\Contracts\Interface;

use App\Repositories\BaseRepositoryInterface;

interface StorageRepositoryInterface extends BaseRepositoryInterface
{
    public function getStorageByModel(?int $model);
}