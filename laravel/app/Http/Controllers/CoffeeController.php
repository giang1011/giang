<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coffee;
use App\Models\Product;

class CoffeeController extends Controller
{
    public function getCoffees()
    {
        try {
            $coffees = Coffee::join('products', 'coffees.ProductID', '=', 'products.ProductID')
                            ->select('products.ProductID', 'products.Name', 'products.Price', 'coffees.CoffeeType', 'coffees.Ingredients', 'products.Description')
                            ->get();
            return response()->json($coffees);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
