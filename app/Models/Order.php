<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'OrderID';
    public $incrementing = true;
    protected $fillable = ['CustomerID', 'OrderDate', 'TotalAmount', 'Status', 'OrderType'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'OrderID', 'OrderID');
    }
}
