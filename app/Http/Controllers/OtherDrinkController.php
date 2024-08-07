<?php
namespace App\Http\Controllers;

use App\Models\OtherDrink;
use Illuminate\Http\Request;

class OtherDrinkController extends Controller
{
    public function store($productId, Request $request)
    {
        $otherDrink = new OtherDrink();
        $otherDrink->ProductID = $productId;
        $otherDrink->Description = $request->input('description');
        $otherDrink->Ingredients = $request->input('ingredients');
        $otherDrink->Price = $request->input('price');
        $otherDrink->Stock = $request->input('stock');
        $otherDrink->CreatedAt = $request->input('createdAt');
        $otherDrink->save();
    }
}
