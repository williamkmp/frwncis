<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProducts()
    {
        //TODO: add logic
        return view("products");
    }

    public function showAddProduct()
    {
        //TODO: add logic
        return view("add-product");
    }

    public function doAddProduct(Request $request)
    {
        //TODO: add logic
        return redirect()->back();
    }
}
