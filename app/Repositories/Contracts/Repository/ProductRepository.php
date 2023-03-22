<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Product;
use App\Repositories\Contracts\Interface\ProductRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Constants\ProductConstant;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    /**
     * @param integer $category_id
     *
     * @return object
     */
    public function getProductsByCategory(int $category_id) : object
    {
        return $this->model->where(ProductConstant::COLUMN_CATEGORY_ID, $category_id)->get();
    }

    public function getProductsByBrand(int $brand_id)
    {
        return $this->model->where(ProductConstant::COLUMN_BRAND_ID, $brand_id)->get();
    }

    public function getListProduct($request)
    {
        $query = $this->model;

        if ($request->category_id) :
            $query = $query->where(ProductConstant::COLUMN_CATEGORY_ID, $request->category_id);
        endif;
        if ($request->brand_id) :
            $query = $query->where(ProductConstant::COLUMN_BRAND_ID, $request->brand_id);
        endif;

        return $query->get();
    }
}
