<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\OrderDetail;
use App\Repositories\Contracts\Interface\OrderDetailRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Constants\OrderConstant;
use App\Constants\OrderDetailConstant;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{
    public function getModel()
    {
        return OrderDetail::class;
    }

    /**
     * this function will return subtotal of order
     * @param integer|null $order_id
     * @param array $order
     * 
     * @return void
     */
    public function createOrderDetail(?int $order_id, $order = [])
    {
        $table = array_key_first($order);
        $orderItems = $order[$table]; //remove index table to get list items
        $subTotal = 0;

        foreach ($orderItems as $item) :
            $existedPendingProduct = null;
            $existedProduct = $this->model                  //check exist product in order
                ->where(OrderDetailConstant::COLUMN_PRODUCT_ID, $item['id'])
                ->where(OrderDetailConstant::COLUMN_ORDER_ID, $order_id)
                ->get();

            if ( null !== $existedProduct) :
                foreach ($existedProduct as $itemProduct) :
                    if (null !== $itemProduct && $itemProduct->status === OrderConstant::STATUS['pending']) :  //check last pending product
                        $existedPendingProduct = $itemProduct;
                    endif;
                endforeach;
            endif;

            if (null !== $existedPendingProduct and $existedPendingProduct->status === OrderConstant::STATUS['pending']) :  //increase number of quantity existed pending product
                $this->update($existedPendingProduct->id, [
                    OrderDetailConstant::COLUMN_TOTAL => $existedPendingProduct->total + ($item['quantity'] * $item['price']),
                    OrderDetailConstant::COLUMN_QUANTITY => $existedPendingProduct->quantity + $item['quantity'],
                    OrderDetailConstant::COLUMN_NOTE => $existedPendingProduct->note ? $existedPendingProduct->note . '<br/>' . $item['note'] : $item['note']
                ]);
            else :
                $data = [
                    OrderDetailConstant::COLUMN_PRODUCT_ID => $item['id'],
                    OrderDetailConstant::COLUMN_ORDER_ID => $order_id,
                    OrderDetailConstant::COLUMN_QUANTITY => $item['quantity'],
                    OrderDetailConstant::COLUMN_PRICE => $item['price'],
                    OrderDetailConstant::COLUMN_TOTAL => $item['price'] * $item['quantity'],
                    OrderDetailConstant::COLUMN_NOTE => $item['note'] ?? null
                ];

                if (! $this->create($data)) return 0;
            endif;
        endforeach;

        $arrayOrder = $this->model->where(OrderDetailConstant::COLUMN_ORDER_ID, $order_id)->get();
        
        foreach ($arrayOrder as $item) :
            $total = (int) $item->price * (int) $item->quantity;
            $subTotal += $total;
        endforeach;

        return $subTotal;
    }

    /**
     * @param integer|null $order_id
     * 
     * @return boolean
     */
    public function deleteByOrderId(?int $order_id) : bool
    {
        $result = $this->model->where(OrderDetailConstant::COLUMN_ORDER_ID, $order_id)->get();
        
        foreach ($result as $item) :
            if($item){
                if (! $item->delete()) return false;
            }    
        endforeach;

        return true;
    }

    /**
     * @param integer|null $order
     * 
     * @return boolean
     */
    public function checkDeleteAvailability(?int $order) : bool
    {
        $count = $this->model
                ->leftJoin('orders', 'orders.id', '=', 'orderdetails.order_id')
                ->select('orderdetails.*')
                ->where("orders.id", "=", $order)
                ->where("orderdetails.status", "=", OrderDetailConstant::STATUS_DELIVERED)
                ->get();

        if (count($count->toArray()) > 0) return false;

        return true;
    }
}