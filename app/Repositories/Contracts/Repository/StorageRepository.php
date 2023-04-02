<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Storage;
use App\Repositories\Contracts\Interface\StorageRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Constants\StorageConstant;

class StorageRepository extends BaseRepository implements StorageRepositoryInterface
{
    public function getModel()
    {
        return Storage::class;
    }

    /**
     * @param integer|null $model
     * 
     * @return object
     */
    public function getStorageByModel(?int $model) : object
    {
        return $this->model->where('product_model_id', $model)->get();
    }
}
