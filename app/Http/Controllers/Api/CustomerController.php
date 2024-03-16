<?php

namespace App\Http\Controllers\Api;

use App\Models\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{

    public function index(){
    
        $customers = Customers::latest()->paginate(5);

        return new CustomerResource(true, 'List Data Customers', $customers);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'no_telp'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $customer = Customers::create([
            'name'     => $request->name,
            'no_telp'   => $request->no_telp,
        ]);

        return new CustomerResource(true, 'Data Customers Berhasil Ditambahkan!', $customer);
    }
}
