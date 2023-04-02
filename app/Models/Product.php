<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'product_model_id',
        'price',
        'content',
        'color',
        'ram',
        'image',
        'quantity',
        'status'
    ];

    public function product_model()
    {
        return $this->belongsTo(\App\Models\ProductModel::class, 'product_model_id');
    }
}
