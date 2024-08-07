<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coffee extends Model
{
    protected $primaryKey = 'ProductID';

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID', 'ProductID');
    }
}
