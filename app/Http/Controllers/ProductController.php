<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function detail($id)
    {
        $product_data = [];
        $product_data['items'] = Product::find($id);
        return view('products.detail', $product_data);
    }

    public function addToCart(Request $request)
    {
        if ($request->session()->has('logId')) {
            $cart = new Cart();
            $cart->user_id = $request->session()->get('logId');
            $cart->product_id = $request->product_id;
            $cart->save();
            return redirect('dashboard');
        } else {
            return redirect('login');
        }
    }

    static function cartItem()
    {
        $userId = Session::get('logId');
        return Cart::where('user_id', $userId)->count();
    }

    public function cartList()
    {
        $userId = Session::get('logId');
        $product_list = [];
        $product_list['products'] = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->select('products.*', 'cart.id as cartId')
            ->get();

        return view('products.cartlist', $product_list);
    }

    public function cartRemove($id)
    {
        Cart::destroy($id);

        return redirect('cartlist');
    }

    public function orderNow()
    {
        $userId = Session::get('logId');
        $total_amount = [];
        $total_amount['total'] = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->select('products.*', 'cart.id as cartId')
            ->sum('products.price');

        return view('products.order', $total_amount);
    }

    public function orderPlace(Request $request)
    {
        $userId = Session::get('logId');

        $allcarts = Cart::where('user_id', $userId)->get();

        foreach ($allcarts as $cart) {
            $order = new Order();
            $order->product_id = $cart['product_id'];
            $order->user_id = $cart['user_id'];
            $order->status = 'pending';
            $order->payment_method = $request->payment;
            $order->payment_status = 'pending';
            $order->address = $request->address;

            $order->save();

            Cart::where('user_id', $userId)->delete();
        }


        return redirect('dashboard');
    }

    public function userOrders()
    {
        $order_table = [];

        $userId = Session::get('logId');

        $order_table['orders'] = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.user_id', $userId)
            ->get();

        return view('products.userorder', $order_table);
    }


    public function searchProduct(Request $request)
    {
        $search = $request['search'] ?? " ";

        if ($search!= " ") {
            $Product_detail = Product::where('name', '=', $search)->get();
        } else {
            $product_detail = Product::all();
        }

        $data = compact('product_detail','search');
        return redirect()->route('detail');
    }
}
