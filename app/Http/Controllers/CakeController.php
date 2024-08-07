<?php
namespace App\Http\Controllers;

use App\Models\Cake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CakeController extends Controller
{
    public function index()
    {
        try {
            $cakes = Cake::all()->map(function ($cake) {
                return [
                    'ProductID' => $cake->ProductID,
                    'Name' => $cake->Name,
                    'Description' => $cake->Description,
                    'Ingredients' => $cake->Ingredients,
                    'Price' => $cake->Price,
                    'Stock' => $cake->Stock,
                    'CreatedAt' => $cake->CreatedAt,
                    'ImagePath' => $cake->ImagePath,
                ];
            });

            return response()->json($cakes);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra khi lấy danh sách bánh!', ['context' => $e->getMessage()]);
            return response()->json(['message' => 'Có lỗi xảy ra!'], 500);
        }
    }
}
