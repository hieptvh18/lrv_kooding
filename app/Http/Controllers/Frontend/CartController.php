<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //view cart
    public function index()
    {
        // get recommend radom
        $recommened = Product::inRandomOrder()->limit(15)->get();
        return view('client.cart.cart',compact('recommened'));
    }

    // action add to cart(use session)
    public function add(Request $request)
    {
        // handle add to cart
        $product = Product::find($request->product_id)->toArray();
        $color = $request->color_id;
        $size = $request->size_id;
        $quantity = (int)$request->quantity;

        if (Auth::check()) {

            if(session()->has('carts')){
                session()->pull('carts');
            }

            //    save cart to database
            $cartUser = Cart::where('user_id', Auth::user()->id)->first();

            if ($cartUser) {
                // case trung bien the
                foreach ($cartUser as $key => $cart) {
                    if ($cart->product_id == $request->product_id && $cart->color_id == $color && $cart->size_id == $size) {
                        Cart::find($cart->id)->increment('quantity', $quantity);
                        return 'da login! ton tai cart va trung bien the nen tang slg!';
                    }
                }

                // case k trung thi add new item
                $cart = new Cart();
                $cart->user_id = Auth::user()->id;
                $cart->product_id = $request->product_id;
                $cart->color_id = $color;
                $cart->size_id = $size;
                $cart->quantity = $quantity;
                $save = $cart->save();
                if ($save) {
                    return 'da login -> luu thanh cong vao database!';
                }
                return 'da login -> luu khong thanh cong vao database!';
            }
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->color_id = $color;
            $cart->color_id = $size;
            $cart->product_id = $request->product_id;
            $cart->price = (int)$product['price'];
            $cart->discount = (int)$product['discount'];
            $cart->avatar = $product['avatar'];
            $cart->quantity = $quantity;
            $save = $cart->save();
            if ($save) {
                return 'da login -> luu thanh cong vao database!';
            }
            return 'da login -> luu khong thanh cong vao database!';

        } else {
            // not login => save cart to session
            // return $request->session()->pull('carts');
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
                        session()->put('carts',$cartData);
                        return 'chua login! da ton tai session cart va trung bien the nen tang so luong';
                    }
                }

                // != => add new item
                $item = [
                    "id"=>count(session('carts')) + 1,
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
                return 'chua login ! ton tai session va k trung bien the nen add new item';
            } else {

                // add new carts    
                $request->session()->put('carts', [$item]);
                return 'them moi item vao mang cart chua co san thanh cong';
            }
        }
    }

    // update qty item cart
    public function updateQuantity()
    {
    }
}
