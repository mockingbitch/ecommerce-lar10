<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'product_models';
    
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'brand_id',
        'content',
        'image',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(\App\Models\Brand::class, 'brand_id');
    }
}
