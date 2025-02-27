<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'category_id',
        'product_name',
        'product_code',
        'product_qty',
        'price',
        'description',
        'product_thumbnail',
        'featured',
        'new_arrival',
        'supplier_id',
    ];
}
