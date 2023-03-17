<?php

namespace App\Repositories\Contracts\Interface;

use App\Repositories\BaseRepositoryInterface;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getAvailableCategories();
}