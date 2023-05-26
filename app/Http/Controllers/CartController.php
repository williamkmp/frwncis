<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Location;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function showCart()
    {
        $user = User::find(Auth::user()->id);
        $cartItems = CartItem::with("product")->where("user_id", $user->id)->get();
        $itemCount = CartItem::where('user_id', $user->id)->sum('quantity');
        $priceTotal = DB::table("cart_items")
            ->join("products", "products.id", "=", "cart_items.product_id")
            ->join("users", "users.id", "=", "cart_items.user_id")
            ->where('users.id', $user->id)
            ->selectRaw("cart_items.quantity * products.price AS total")
            ->get()->sum("total");

        return view("cart")
            ->with("cartItems", $cartItems)
            ->with("itemCount", $itemCount)
            ->with("priceTotal", $priceTotal)
            ->with("locations", Location::all());
    }

    public function doCheckout(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $cartIsEmpty = !CartItem::where("user_id", $user->id)->exists();
        if ($cartIsEmpty) {
            return redirect()->back()->with("msg-error", "Cart Is Empty");
        }

        $location_id = intval($request->location_id);
        $cartItems = CartItem::with("product")->where("user_id", $user->id)->get();
        $priceTotal = DB::table("cart_items")
            ->join("products", "products.id", "=", "cart_items.product_id")
            ->join("users", "users.id", "=", "cart_items.user_id")
            ->where('users.id', $user->id)
            ->selectRaw("cart_items.quantity * products.price AS total")
            ->get()->sum("total");

        $newTranHeader = new TransactionHeader([
            "user_id" => $user->id,
            "location_id" => $location_id,
            "isPicked" => false,
            "total" => $priceTotal
        ]);

        $newTranHeader->save();

        foreach ($cartItems as $cartItem ) {
            $newTranHeader->transactionDetails()->save(new TransactionDetail([
                "product_name" => $cartItem->product->name,
                "price" => $cartItem->product->price,
                "quantity" => $cartItem->quantity,
                "subtotal" => ($cartItem->quantity * $cartItem->product->price)
            ]));
        }

        CartItem::where('user_id', $user->id)->delete();

        return redirect()->route("showProducts")
            ->with("msg-success", "Checkout Successfull!");
    }

    public function addItem($product_id)
    {
        $product_id = intval($product_id);
        $user = User::find(Auth::user()->id);
        $cartItem = $user->cartItems()->where("product_id", $product_id)->first();
        $itemInCart = ($cartItem != null);

        if ($itemInCart) {
            //incremnet
            $cartItem->quantity += 1;
        } else {
            //add as new item with quantity 1
            $cartItem = new CartItem;
            $cartItem->user_id = Auth::user()->id;
            $cartItem->product_id = $product_id;
            $cartItem->quantity = 1;
        }

        $cartItem->save();
        return redirect()->back();
    }

    public function deleteItem($product_id)
    {
        $product_id = intval($product_id);
        $user = User::find(Auth::user()->id);
        $user->cartItems()->where("product_id", $product_id)->delete();
        return redirect()->back();
    }

    public function decrementItem($product_id)
    {
        $product_id = intval($product_id);
        $user = User::find(Auth::user()->id);
        $cartItem = $user->cartItems()->where("product_id", $product_id)->first();

        if ($cartItem->quantity <= 1) {
            $user->cartItems()->where("product_id", $product_id)->delete();
        } else {
            $cartItem->quantity -= 1;
            $cartItem->save();
        }
        return redirect()->back();
    }
}
