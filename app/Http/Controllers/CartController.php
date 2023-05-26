<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart()
    {
        //TODO: implement this
    }

    public function doCheckout()
    {
        //TODO: implement this
    }

    public function addItem($product_id)
    {
        $product_id = intval($product_id);
        $user = User::find(Auth::user()->id);
        $cartItem = $user->cartItems()->where("product_id", $product_id)->first();
        $itemInCart = ($cartItem != null);

        if($itemInCart){
            //incremnet
            $cartItem->quantity += 1;
        }else{
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
        //TODO: implement this
    }
}
