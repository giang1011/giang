<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Lấy danh sách khách hàng
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    // Thêm khách hàng mới
    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|string|max:100',
            'LastName' => 'required|string|max:100',
            'Email' => 'required|string|email|max:255|unique:customers',
            'PhoneNumber' => 'nullable|string|max:20',
            'Address' => 'nullable|string|max:255',
        ]);

        $customer = Customer::create($request->all());
        return response()->json($customer, 201);
    }

    // Cập nhật thông tin khách hàng
    public function update(Request $request, $id)
    {
        $request->validate([
            'FirstName' => 'required|string|max:100',
            'LastName' => 'required|string|max:100',
            'Email' => 'required|string|email|max:255|unique:customers,Email,' . $id,
            'PhoneNumber' => 'nullable|string|max:20',
            'Address' => 'nullable|string|max:255',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return response()->json($customer);
    }

    // Xóa khách hàng
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(null, 204);
    }
}
