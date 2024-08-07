<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'Products';

    protected $primaryKey = 'ProductID';

    public $timestamps = false;

    protected $fillable = [
        'Name',
        'Category',
        'Description',
        'Ingredients',
        'Price',
        'Stock',
        'CreatedAt',
        'ImagePath',
    ];
}
