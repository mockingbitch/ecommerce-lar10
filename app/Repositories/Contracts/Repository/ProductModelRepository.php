<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\ProductModel;
use App\Repositories\Contracts\Interface\ProductModelRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Constants\ProductModelConstant;

class ProductModelRepository extends BaseRepository implements ProductModelRepositoryInterface
{
    public function getModel()
    {
        return ProductModel::class;
    }

    /**
     * @param integer $category_id
     *
     * @return object
     */
    public function getProductsByCategory(int $category_id) : object
    {
        return $this->model->where(ProductModelConstant::COLUMN_CATEGORY_ID, $category_id)->get();
    }

    public function getProductsByBrand(int $brand_id)
    {
        return $this->model->where(ProductModelConstant::COLUMN_BRAND_ID, $brand_id)->get();
    }

    public function getListProduct($request)
    {
        $query = $this->model;

        if ($request->category_id) :
            $query = $query->where(ProductModelConstant::COLUMN_CATEGORY_ID, $request->category_id);
        endif;
        if ($request->brand_id) :
            $query = $query->where(ProductModelConstant::COLUMN_BRAND_ID, $request->brand_id);
        endif;

        return $query->get();
    }
}
