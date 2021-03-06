<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $stocks = Stock::Paginate(6);
        return view('shop',compact('stocks'));
    }

    public function myCart(Cart $cart)
    {
        $data = $cart->showCart();
        return view('mycart',$data);
    }

    public function addMycart(Request $request,Cart $cart)
    {
        //カートに追加の処理
       $stock_id=$request->stock_id;
       $message = $cart->addCart($stock_id);

       //追加後の情報を取得
       $data = $cart->showCart();
       
       return view('mycart', $data)->with('message',$message);
    }

    public function deleteCart(Request $request,Cart $cart)
    {
        $stock_id=$request->stock_id;
        $message = $cart->deleteCart($stock_id);

        //削除後のカート情報表示
        $data = $cart->showCart();

        return view('mycart',$data)->with('message',$message);
    }

    public function checkout(Cart $cart)
    {
        $checkout_info = $cart->checkoutCart();
        return view('checkout');
    }
}