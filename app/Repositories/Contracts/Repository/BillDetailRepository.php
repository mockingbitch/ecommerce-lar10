<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\BillDetail;
use App\Repositories\Contracts\Interface\BillDetailRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Constants\BillDetailConstant;

class BillDetailRepository extends BaseRepository implements BillDetailRepositoryInterface
{
    public function getModel()
    {
        return BillDetail::class;
    }

    /**
     * @param object|null $bill
     * @param object|null $order
     *
     * @return boolean
     */
    public function createBillDetail(?object $bill, ?object $order) : bool
    {
        $orderDetail = $order->orderDetails; //get by relationship

        foreach ($orderDetail as $item) :
            $data = [
                BillDetailConstant::COLUMN['bill_id'] => $bill->id,
                BillDetailConstant::COLUMN['product_name'] => $item->product->name,
                BillDetailConstant::COLUMN['quantity'] => $item->quantity,
                BillDetailConstant::COLUMN['price'] => $item->price,
                BillDetailConstant::COLUMN['total'] => $item->total
            ];

            $billDetail = $this->create($data);

            if (! $billDetail) return false;
        endforeach;

        return true;
    }
}