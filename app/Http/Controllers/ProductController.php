<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::all()->map(function($product) {
                return [
                    'ProductID' => $product->ProductID,
                    'Name' => $product->Name,
                    'Description' => $product->Description,
                    'Ingredients' => $product->Ingredients,
                    'Price' => $product->Price,
                    'Category' => $product->Category,
                    'Stock' => $product->Stock,
                    'Image' => $product->ImagePath,
                ];
            });
        
            return response()->json(['products' => $products]);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra khi lấy danh sách sản phẩm!', ['context' => $e->getMessage()]);
            return response()->json(['message' => 'Có lỗi xảy ra!'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'category' => 'required|in:Cake,Coffee,Cookie,OtherDrink',
                'description' => 'required|string',
                'ingredients' => 'required|string',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'createdAt' => 'required|date',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            ]);
    
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images/products', 'public');
            }
    
            $product = new Product();
            $product->Name = $request->name;
            $product->Category = $request->category;
            $product->Description = $request->description;
            $product->Ingredients = $request->ingredients;
            $product->Price = $request->price;
            $product->Stock = $request->stock;
            $product->CreatedAt = $request->createdAt;
            $product->ImagePath = $imagePath;
            $product->save();
    
            // Lưu vào bảng loại sản phẩm tương ứng
            switch ($request->category) {
                case 'Cake':
                    \App\Models\Cake::create([
                        'ProductID' => $product->ProductID,
                        'Description' => $request->description,
                        'Ingredients' => $request->ingredients,
                        'Price' => $request->price,
                        'Stock' => $request->stock,
                        'CreatedAt' => $request->createdAt,
                    ]);
                    break;
                case 'Cookie':
                    \App\Models\Cookie::create([
                        'ProductID' => $product->ProductID,
                        'Description' => $request->description,
                        'Ingredients' => $request->ingredients,
                        'Price' => $request->price,
                        'Stock' => $request->stock,
                        'CreatedAt' => $request->createdAt,
                    ]);
                    break;
                case 'Coffee':
                    \App\Models\Coffee::create([
                        'ProductID' => $product->ProductID,
                        'Description' => $request->description,
                        'Ingredients' => $request->ingredients,
                        'Price' => $request->price,
                        'Stock' => $request->stock,
                        'CreatedAt' => $request->createdAt,
                    ]);
                    break;
                case 'OtherDrink':
                    \App\Models\OtherDrink::create([
                        'ProductID' => $product->ProductID,
                        'Description' => $request->description,
                        'Ingredients' => $request->ingredients,
                        'Price' => $request->price,
                        'Stock' => $request->stock,
                        'CreatedAt' => $request->createdAt,
                    ]);
                    break;
            }
    
            return response()->json(['message' => 'Product added successfully!']);
        } catch (ValidationException $e) {
            Log::error('Có lỗi xảy ra khi thêm sản phẩm!', ['context' => $e->errors()]);
            return response()->json(['message' => 'Có lỗi xảy ra!', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra khi thêm sản phẩm!', ['context' => $e->getMessage()]);
            return response()->json(['message' => 'Có lỗi xảy ra!'], 500);
        }
    }
        protected function updateCake($productId, Request $request)
    {
        $cake = \App\Models\Cake::where('ProductID', $productId)->first();
        if ($cake) {
            $cake->Description = $request->description;
            $cake->Ingredients = $request->ingredients;
            $cake->Price = $request->price;
            $cake->Stock = $request->stock;
            $cake->CreatedAt = $request->createdAt;
            $cake->save();
        }
    }
    
    protected function updateCookie($productId, Request $request)
    {
        $cookie = \App\Models\Cookie::where('ProductID', $productId)->first();
        if ($cookie) {
            $cookie->Description = $request->description;
            $cookie->Ingredients = $request->ingredients;
            $cookie->Price = $request->price;
            $cookie->Stock = $request->stock;
            $cookie->CreatedAt = $request->createdAt;
            $cookie->save();
        }
    }
    
    protected function updateCoffee($productId, Request $request)
    {
        $coffee = \App\Models\Coffee::where('ProductID', $productId)->first();
        if ($coffee) {
            $coffee->Description = $request->description;
            $coffee->Ingredients = $request->ingredients;
            $coffee->Price = $request->price;
            $coffee->Stock = $request->stock;
            $coffee->CreatedAt = $request->createdAt;
            $coffee->save();
        }
    }
    
    protected function updateOtherDrink($productId, Request $request)
    {
        $otherDrink = \App\Models\OtherDrink::where('ProductID', $productId)->first();
        if ($otherDrink) {
            $otherDrink->Description = $request->description;
            $otherDrink->Ingredients = $request->ingredients;
            $otherDrink->Price = $request->price;
            $otherDrink->Stock = $request->stock;
            $otherDrink->CreatedAt = $request->createdAt;
            $otherDrink->save();
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'category' => 'required|in:Cake,Coffee,Cookie,OtherDrink',
                'description' => 'required|string',
                'ingredients' => 'required|string',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'createdAt' => 'required|date',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            ]);
    
            $product = Product::find($id);
    
            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }
    
            $imagePath = $product->ImagePath;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images/products', 'public');
            }
    
            $product->Name = $request->name;
            $product->Category = $request->category;
            $product->Description = $request->description;
            $product->Ingredients = $request->ingredients;
            $product->Price = $request->price;
            $product->Stock = $request->stock;
            $product->CreatedAt = $request->createdAt;
            $product->ImagePath = $imagePath;
            $product->save();
    
            // Cập nhật dữ liệu vào bảng loại sản phẩm
            switch ($request->category) {
                case 'Cake':
                    $this->updateCake($id, $request);
                    break;
                case 'Cookie':
                    $this->updateCookie($id, $request);
                    break;
                case 'Coffee':
                    $this->updateCoffee($id, $request);
                    break;
                case 'OtherDrink':
                    $this->updateOtherDrink($id, $request);
                    break;
            }
    
            return response()->json(['message' => 'Product updated successfully!']);
        } catch (ValidationException $e) {
            Log::error('Có lỗi xảy ra khi cập nhật sản phẩm!', ['context' => $e->errors()]);
            return response()->json(['message' => 'Có lỗi xảy ra!', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra khi cập nhật sản phẩm!', ['context' => $e->getMessage()]);
            return response()->json(['message' => 'Có lỗi xảy ra!'], 500);
        }
    }
        public function show($id)
{
    try {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json([
            'ProductID' => $product->ProductID,
            'Name' => $product->Name,
            'Description' => $product->Description,
            'Ingredients' => $product->Ingredients,
            'Price' => $product->Price,
            'Category' => $product->Category,
            'Stock' => $product->Stock,
            'Image' => $product->ImagePath,
        ]);
    } catch (\Exception $e) {
        Log::error('Có lỗi xảy ra khi lấy chi tiết sản phẩm!', ['context' => $e->getMessage()]);
        return response()->json(['message' => 'Có lỗi xảy ra!'], 500);
    }
}
}
