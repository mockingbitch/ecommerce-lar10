<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Table;
use App\Repositories\Contracts\Interface\TableRepositoryInterface;
use App\Repositories\BaseRepository;

class TableRepository extends BaseRepository implements TableRepositoryInterface
{
    public function getModel()
    {
        return Table::class;
    }
}