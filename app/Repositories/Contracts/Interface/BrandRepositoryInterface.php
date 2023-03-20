<?php

namespace App\Repositories\Contracts\Interface;

use App\Repositories\BaseRepositoryInterface;

interface BrandRepositoryInterface extends BaseRepositoryInterface
{
    public function getAvailableBrand();
}
