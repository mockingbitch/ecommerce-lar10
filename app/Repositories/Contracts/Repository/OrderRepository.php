<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Order;
use App\Repositories\Contracts\Interface\OrderRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Constants\UserConstant;
use App\Constants\OrderConstant;
use App\Constants\OrderDetailConstant;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getModel()
    {
        return Order::class;
    }

    /**
     * @param [type] $user
     * @param array $order
     *
     * @return array
     */
    public function createOrder($table_id, $user, $order = []) : array
    {
        $orderTable = $this->model->where(OrderConstant::COLUMN_TABLE_ID, $table_id)->first(); //check if exist order table

        if (null !== $orderTable && ! empty($orderTable)) :
            return [
                'existOrder' => true,
                'order' => $orderTable
            ];
        endif;

        $data = [
            OrderConstant::COLUMN_WAITER_ID => $user->role !== UserConstant::ROLE['guest'] ? $user->id : null,
            OrderConstant::COLUMN_GUEST_ID => $user->role === UserConstant::ROLE['guest'] ? $user->id : null,
            OrderConstant::COLUMN_TABLE_ID => array_key_first($order),
            OrderConstant::COLUMN_TOTAL => 0
        ];

        $orderTable = $this->create($data);

        return [
            'existOrder' => false,
            'order' => $orderTable
        ];;
    }

    /**
     * @param integer|null $table_id
     *
     * @return ?object
     */
    public function getTableOrder(?int $table_id) : ?object
    {
        return $this->model->where(OrderConstant::COLUMN_TABLE_ID, $table_id)->first();
    }

    /**
     * @param integer|null $id
     *
     * @return boolean
     */
    public function updateTotal(?int $id) : bool
    {
        $order = $this->find($id);
        $orderDetails = $order->orderDetails; //query by relationship
        $total = 0;

        foreach ($orderDetails as $item) :
            $total += $item->total;
        endforeach;

        if (! $this->update($order->id, [OrderConstant::COLUMN_TOTAL => $total])) :
            return false;
        endif;

        return true;
    }

    public function calculatePercentStatus(?int $table_id)
    {
        $percent = 0;
        $order = $this->model->where('table_id', $table_id)->first();

        if (null !== $order) :
            $orderDetails = $order->orderDetails;

            if (null !== $orderDetails) :
                $total = count($orderDetails->toArray());
                $count = 0;

                foreach ($orderDetails as $item) :
                    if ($item->status == OrderDetailConstant::STATUS_DELIVERED) :
                        $count++;
                    endif;
                endforeach;

                $percent = ($count / $total) * 100;
            endif;
        endif;

        return [
            'order' => $order,
            'percent' => $percent
        ];
    }
}