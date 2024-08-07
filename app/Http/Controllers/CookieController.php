<?php
namespace App\Http\Controllers;

use App\Models\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CookieController extends Controller
{
    public function index()
    {
        try {
            $cookie = Cookie::all()->map(function ($cookie) {
                return [
                    'ProductID' => $cookie->ProductID,
                    'Name' => $cookie->Name,
                    'Description' => $cookie->Description,
                    'Ingredients' => $cookie->Ingredients,
                    'Price' => $cookie->Price,
                    'Stock' => $cookie->Stock,
                    'CreatedAt' => $cookie->CreatedAt,
                    'ImagePath' => $cookie->ImagePath,
                ];
            });

            return response()->json($cookie);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra khi lấy danh sách bánh!', ['context' => $e->getMessage()]);
            return response()->json(['message' => 'Có lỗi xảy ra!'], 500);
        }
    }
}
