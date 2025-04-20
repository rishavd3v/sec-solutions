<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';  // Updated table name to match English convention
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'category_name',  // Updated column name to match English convention
    ];
}

