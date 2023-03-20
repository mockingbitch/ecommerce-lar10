<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Brand;
use App\Repositories\Contracts\Interface\BrandRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Constants\BrandConstant;
use App\Constants\Constant;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    public function getModel()
    {
        return Brand::class;
    }

    /**
     * @return Collection|null
     */
    public function getAvailableBrand() : ?Collection
    {
        return $this->model
                ->where(BrandConstant::COLUMN['status'], Constant::STATUS['available'])
                ->get();
    }
}
