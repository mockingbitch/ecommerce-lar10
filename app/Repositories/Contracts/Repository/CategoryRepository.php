<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Category;
use App\Repositories\Contracts\Interface\CategoryRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Constants\CategoryConstant;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    /**
     * @return Collection|null
     */
    public function getAvailableCategories() : ?Collection
    {
        return $this->model
                ->where(CategoryConstant::COLUMN['status'], Constant::STATUS['available'])
                ->get();
    }
}