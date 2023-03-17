<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Bill;
use App\Repositories\Contracts\Interface\BillRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Constants\BillConstant;
use App\Constants\Constant;

class BillRepository extends BaseRepository implements BillRepositoryInterface
{
    public function getModel()
    {
        return Bill::class;
    }

    /**
     * @param object|null $order
     *
     * @return Bill|null
     */
    public function createBill(? object $order) : ?Bill
    {
        $data = [
            BillConstant::COLUMN['waiter_id']   => $order->waiter_id,
            BillConstant::COLUMN['guest_id']    => $order->guest_id,
            BillConstant::COLUMN['table_id']    => $order->table_id,
            BillConstant::COLUMN['total']       => $order->total,
            BillConstant::COLUMN['note']        => $order->note,
            BillConstant::COLUMN['status']      => $order->status,
        ];

        if (! $bill = $this->create($data)) return null;

        return $bill;
    }

    public function getLastBills($label, $dateFormat, $param1, $param2, $condition) : array
    {
        $bills      = [];
        $arrDays    = [];

        if ($condition === Constant::CONDITION_TENDAYSLASTMONTH) :
            $month = date(Constant::DATE_FORMAT_YMD, strtotime('now - 1 month'));
        endif;

        for ($i = 9; $i >= 0; $i--) :
            switch ($condition) {
                case Constant::CONDITION_TENMONTHSLASTYEAR:
                    $month      = date('m', strtotime('now - '. $i . 'month'));
                    $bills[]    = $this->model->whereMonth(BillConstant::COLUMN_CREATED_AT, $month)->sum(BillConstant::COLUMN_TOTAL);
                    break;
                case Constant::CONDITION_TENDAYSFROMNOW:
                    $day        = date(Constant::DATE_FORMAT_YMD, strtotime('now - '. $i . 'day'));
                    $bills[]    = $this->model->whereDate(BillConstant::COLUMN_CREATED_AT, $day)->sum(BillConstant::COLUMN_TOTAL);
                    break;
                case Constant::CONDITION_TENDAYSLASTMONTH:
                    $day        = date(Constant::DATE_FORMAT_YMD, strtotime($month. '- '. $i . 'day'));
                    $bills[]    = $this->model->whereDate(BillConstant::COLUMN_CREATED_AT, $day)->sum(BillConstant::COLUMN_TOTAL);
                    break;
                default:
                    break;
            }

            $arrLabel[] = $label . date($dateFormat, strtotime($param1 . ' - '. $i . $param2));
        endfor;

        return [
            'label'  => $arrLabel,
            'total' => $bills
        ];
    }

    /**
     * @param string|null $paramDate    //Số chênh lệch (1 day, 1 month, ...)
     * @param string|null $format       //Date format (Y-m-d, m, ...)
     * @param string|null $condition    //Month || day || Year
     *
     * @return array
     */
    public function getDifferent(?string $paramDate = '1', ?string $format, ?string $condition) : array
    {
        $current        = date($format, strtotime('now'));
        $old    = date($format, strtotime('now - '. $paramDate .' '. $condition));

        if ($condition == Constant::DATE_MONTH) :
            $bills      = $this->model->whereMonth(BillConstant::COLUMN_CREATED_AT, $current);
            $oldBills   = $this->model->whereMonth(BillConstant::COLUMN_CREATED_AT, $old);
        elseif ($condition == Constant::DATE_YEAR) :
            $bills      = $this->model->whereYear(BillConstant::COLUMN_CREATED_AT, $current);
            $oldBills   = $this->model->whereYear(BillConstant::COLUMN_CREATED_AT, $old);
        else:
            $bills      = $this->model->whereDate(BillConstant::COLUMN_CREATED_AT, $current);
            $oldBills   = $this->model->whereDate(BillConstant::COLUMN_CREATED_AT, $old);
        endif;

        $incomeDifferentialPercent  = (($bills->sum(BillConstant::COLUMN_TOTAL) - $oldBills->sum(BillConstant::COLUMN_TOTAL)) / ($oldBills->sum(BillConstant::COLUMN_TOTAL) ?: 1)) * 100;
        $billCountDifferential      = ((count($bills->get()) - count($oldBills->get())) / (count($oldBills->get()) ?: 1)) * 100;

        return [
            'income'    => [
                'current'     => $bills->sum(BillConstant::COLUMN_TOTAL),
                'old'   => $oldBills->sum(BillConstant::COLUMN_TOTAL)
            ],
            'count'     => [
                'current'     => count($bills->get()),
                'old'   => count($oldBills->get())
            ],
            'percent'   => [
                'income'    => (int) $incomeDifferentialPercent,
                'bill'      => (int) $billCountDifferential
            ]
        ];
    }
}
