<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cake;
use App\Models\Product;

class CakeController extends Controller
{
    public function getCakes()
    {
        $cakes = Cake::join('products', 'cakes.ProductID', '=', 'products.ProductID')
                     ->select('products.ProductID', 'products.Name', 'products.Price', 'cakes.CakeType', 'cakes.Ingredients', 'products.Description')
                     ->get();
        return response()->json($cakes);
    }
}
