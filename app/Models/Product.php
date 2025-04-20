<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';  // Updated table name to match English convention
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'category_id',    // Updated column name to match English convention
        'image',          // Updated column name to match English convention
        'product_name',   // Updated column name to match English convention
        'description',    // Updated column name to match English convention
        'sale_price',     // Updated column name to match English convention
    ];
}

