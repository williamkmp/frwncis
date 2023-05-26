<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function showProducts()
    {
        $products = Product::latest()->paginate(8);
        return view("products", compact("products"));
    }

    public function showAddProduct()
    {
        return view("add-products")
            ->with("types", ProductType::all());
    }

    public function doAddProduct(Request $request)
    {
        $request->validate([
            "name" => "required|max:50",
            "price" => "required|integer|min:1000",
            "description" => "required",
            "product_type" => "required|exists:product_types,id",
            "image" => "required|mimes:jpg,jpeg,png|max:10240"
        ]);

        $image_path = Storage::disk('public')->put('image/product', $request->file('image'), 'public');
        Product::create([
            "name" => $request->name,
            "price" => $request->price,
            "description" => $request->description,
            "product_type_id" => intval($request->product_type),
            "image_path" => "storage/" . $image_path,
        ]);

        return redirect()->route("showProducts")
            ->with("msg-success", "Prodcut Added Successfullly!");
    }

    public function showEditProduct($product_id)
    {
        $product_id = intval($product_id);
        $selectedProduct = Product::find($product_id);
        return view("edit-product")
            ->with("product", $selectedProduct)
            ->with("types", ProductType::all());
    }

    public function doEditProduct(Request $request, $product_id)
    {
        $product_id = intval($product_id);
        $selectedProduct = Product::find($product_id);
        $request->validate([
            "name" => "required|max:50",
            "price" => "required|integer|min:1000",
            "description" => "required",
            "product_type" => "required|exists:product_types,id",
            "image" => "required|mimes:jpg,jpeg,png|max:10240"
        ]);

        $new_image_path = Storage::disk('public')->put('image/product', $request->file('image'), 'public');
        $old_image_path = str_replace("storage/","",$selectedProduct->image_path);
        if(Storage::disk('public')->exists($old_image_path)){
            Storage::disk('public')->delete($old_image_path);
        }

        $selectedProduct->name = $request->name;
        $selectedProduct->price = $request->price;
        $selectedProduct->description = $request->description;
        $selectedProduct->product_type_id = intval($request->product_type);
        $selectedProduct->image_path = "storage/".$new_image_path;
        $selectedProduct->save();

        return redirect()->route("showProducts")
        ->with("msg-success", "Product Updated Successfully!");
    }

    public function doDeleteProduct($product_id)
    {
        $product_id = intval($product_id);
        $selectedProduct =  Product::find($product_id);
        $selectedProduct->delete();
        return redirect()->back();
    }
}
