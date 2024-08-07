<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $primaryKey = 'OrderDetailID';
    public $incrementing = true;
    protected $fillable = ['OrderID', 'ProductID', 'MerchandiseID', 'Quantity', 'Price', 'ItemType'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderID', 'OrderID');
    }

    public function index()
{
    $orders = Order::with('orderDetails')->get();
    return response()->json($orders);
}
}

