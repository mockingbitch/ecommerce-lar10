<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'phone',
        'note',
        'subTotal',
        'status'
    ];

    public function orderDetail()
    {
        return $this->hasMany(\App\Models\OrderDetail::class, 'order_id', 'id');
    }
}
