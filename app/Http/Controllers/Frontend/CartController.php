<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;

class CartController extends Controller
{
    //view cart
    public function index()
    {
        // get recommend radom
        $recommened = Product::inRandomOrder()->where('status', '!=', 0)->limit(15)->get();

        // check login
        if (Auth::check()) {
            $cartUser = Cart::where('user_id', Auth::user()->id)->get()->toArray();
            return view('client.cart.cart-save-database', compact('recommened', 'cartUser'));
        }

        return view('client.cart.cart', compact('recommened'));
    }

    //  add to cart(use session)
    public function add(Request $request)
    {
        // define
        $product = Product::find($request->product_id)->toArray();
        $color = $request->color_id;
        $size = $request->size_id;
        $quantity = (int)$request->quantity;

        // add cart save db
        if (Auth::check()) {
            $cartExist = Cart::all();
            foreach ($cartExist as $key => $item) {
                if ($item->product_id == $product['id'] && $item->color_id == $color && $item->size_id == $size) {

                    // increament qty
                    $item->quantity = $item['quantity'] + $quantity;
                    $item->save();

                    return Cart::all()->toArray();
                }
            }

            // add new
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product['id'],
                'color_id' => $color,
                'size_id' => $size,
                'quantity' => $quantity
            ]);

            return Cart::where('user_id',Auth::user()->id)->get()->toArray();
        }

        // add to cart use session
        $item = [
            'id' => 1,
            'product_id' => $request->product_id,
            'color_id' => $color,
            'size_id' => $size,
            'price' => (int)$product['price'],
            'discount' => (int)$product['discount'],
            'avatar' => $product['avatar'],
            'slug' => $product['slug'],
            'quantity' => $quantity,
        ];

        // check session cart exist != null
        if ($request->session()->has('carts')) {

            $cartData = session('carts');
            // check trung bien the or khac
            foreach ($cartData as $key => $cart) {
                if ($cart['product_id'] == $request->product_id && $cart['color_id'] == $color && $cart['size_id'] == $size) {
                    $cartData[$key]['quantity'] += $quantity;

                    // set lai session voi slg moi dc them
                    session()->pull('carts');
                    session()->put('carts', $cartData);
                    return session('carts');
                }
            }

            // != => add new item
            $item = [
                "id" => count(session('carts')) + 1,
                'product_id' => $request->product_id,
                'color_id' => $color,
                'size_id' => $size,
                'price' => (int)$product['price'],
                'discount' => (int)$product['discount'],
                'avatar' => $product['avatar'],
                'slug' => $product['slug'],
                'quantity' => $quantity,
            ];

            $request->session()->push('carts', $item);
            return session('carts');
        } else {

            // add new carts    
            $request->session()->put('carts', [$item]);
            return session('carts');
        }
    }


    // update qty item cart
    public function update(Request $request)
    {

        // update cart use db
        // check qty con lai

        $qtyExist = Stock::where('pro_id', $request->product_id)
            ->where('color_id', $request->color_id)
            ->where('size_id', $request->size_id)->first();

        if ($request->quantity > $qtyExist->quantity) {
            return redirect(route('client.cart'))->with('msg-er', 'Cập nhật số lượng không thành công do sản phẩm không đủ số lượng bạn cần!');
        }

        if (Auth::check()) {

            $cartUser = Cart::where('user_id', Auth::user()->id)->get();
            foreach($cartUser as $key=>$val){
                if ($val['id'] == $request->id) {
                    $val->quantity = $val->quantity = $request->quantity;
                    $val->save();
                    break;
                }
            }

        } else {
            // update cart use session
            // cap nhat slg moi

            $cartData = session('carts');
            foreach ($cartData as $key => $val) {
                if ($val['id'] == $request->id) {
                    $cartData[$key]['quantity'] = $request->quantity;
                    session()->pull('carts');
                    session()->put('carts', $cartData);
                    break;
                }
            }
        }


        return redirect(route('client.cart'))->with('msg-suc', 'Cập nhật thành công item');
    }


    // remove item cart
    public function remove($id)
    {
        if(Auth::check()){
            $cartUser = Cart::all();
            foreach($cartUser as $key=>$val){
                if ($val->id == $id) {
                    Cart::destroy($id);    
                    break;                
                }
            }
        }else {
            $cartData = session('carts');
            foreach ($cartData as $key => $val) {
                if ($val['id'] == $id) {
                    unset($cartData[$key]);
                    session()->pull('carts');
                    session()->put('carts', $cartData);
                    break;
                }
            }
        }
        return redirect(route('client.cart'))->with('msg-suc', 'Xóa thành công item khỏi giỏ hàng');
    }

    // get data session cart
    public function getSessionCart()
    {
        if(session('carts')){
            return session('carts');
        }
        return 0;
    }
}
