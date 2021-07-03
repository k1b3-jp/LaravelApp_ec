<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Stock;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $stocks = Stock::Paginate(6);
        return view('shop',compact('stocks'));
    }

    public function myCart()
    {
        $this->middleware('auth');
        $carts = Cart::all();
        return view('mycart',compact('carts'));
    }
}