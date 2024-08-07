<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'ProductID';
    protected $fillable = [
        'Name', 
        'Description', 
        'Price', 
        'Category', 
        'Stock',
        'Ingredients', 
        'Image' 
    ];

    public function cake()
    {
        return $this->hasOne(Cake::class, 'ProductID', 'ProductID');
    }

    public function coffee()
    {
        return $this->hasOne(Coffee::class, 'ProductID', 'ProductID');
    }
}
