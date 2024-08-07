<?php
namespace App\Http\Controllers;

use App\Models\Coffee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CoffeeController extends Controller
{
    public function index()
    {
        try {
            $Coffee = Coffee::all()->map(function ($Coffee) {
                return [
                    'ProductID' => $Coffee->ProductID,
                    'Name' => $Coffee->Name,
                    'Description' => $Coffee->Description,
                    'Ingredients' => $Coffee->Ingredients,
                    'Price' => $Coffee->Price,
                    'Stock' => $Coffee->Stock,
                    'CreatedAt' => $Coffee->CreatedAt,
                    'ImagePath' => $Coffee->ImagePath,
                ];
            });

            return response()->json($Coffee);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra khi lấy danh sách bánh!', ['context' => $e->getMessage()]);
            return response()->json(['message' => 'Có lỗi xảy ra!'], 500);
        }
    }
}
