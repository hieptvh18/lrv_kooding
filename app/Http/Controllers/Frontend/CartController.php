<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
        $recommened = Product::inRandomOrder()->where('status','!=',0)->limit(15)->get();

        // check 

        return view('client.cart.cart', compact('recommened'));
    }

    // action add to cart(use session)
    public function add(Request $request)
    {
        // handle add to cart
        $product = Product::find($request->product_id)->toArray();
        $color = $request->color_id;
        $size = $request->size_id;
        $quantity = (int)$request->quantity;

        $item = [
            'id' => 1,
            'product_id' => $request->product_id,
            'color_id' => $color,
            'size_id' => $size,
            'price' => (int)$product['price'],
            'dicount' => (int)$product['discount'],
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
                'dicount' => (int)$product['discount'],
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
        if(session('carts')){
            // check qty con lai
            $qtyExist = Stock::where('pro_id',$request->product_id)
                                ->where('color_id',$request->color_id)
                                ->where('size_id',$request->size_id)->first();

            if($request->quantity > $qtyExist->quantity){
                return redirect(route('client.cart'))->with('msg-er','Cập nhật số lượng không thành công do sản phẩm không đủ số lượng bạn cần!');
            }

            $cartData = session('carts');
            foreach($cartData as $key=>$val){
                if($val['id'] == $request->id){
                    $cartData[$key]['quantity'] = $request->quantity;
                    session()->pull('carts');
                    session()->put('carts',$cartData);
                    break;
                }
            }
            return redirect(route('client.cart'))->with('msg-suc','Cập nhật thành công item');
        }

    }

    // remove item cart
    public function remove($id){
        if(session('carts')){
            $cartData = session('carts');
            foreach($cartData as $key=>$val){
                if($val['id'] == $id){
                    unset($cartData[$key]);
                    session()->pull('carts');
                    session()->put('carts',$cartData);
                    break;
                }
            }
            return redirect(route('client.cart'))->with('msg-suc','Xóa thành công item khỏi giỏ hàng');
        }
    }
}
