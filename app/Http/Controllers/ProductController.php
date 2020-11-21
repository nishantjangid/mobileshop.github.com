<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\wishlist;

use Illuminate\Support\Facades\DB;
use Session;

class ProductController extends Controller
{


    public function getHomeProducts()
    {
        $products = DB::table('products')
        ->limit(8)
        ->orderBy('id','desc')
        ->get();
        return view('home',['products'=>$products]);
    }

    public function productDetails($productTitle)
    {
        $product = DB::table('products')
        ->select('*')
        ->where('product_title','=',$productTitle)
        ->first();
        // return $product;
        return view('product_detail',['productInfo'=>$product]);
    }

    public function getShopProduct(Request $req)
    {
        // $pages = Product::paginate(6);
        if($req->pricerange > 0)
        {
            $products = DB::table('products')
            ->where('product_price','<',$req->pricerange)
            ->orderBy('id','desc')
            ->select('*')
            ->paginate(6);            
        }
        elseif($req->pricerange == 0)
        {
            $proCat = Category::all();
            // return $proCat;
            $products = DB::table('products')
            ->orderBy('id','desc')
            ->select('*')
            ->paginate(6);
        }
        else
        {
            $proCat = Category::all();
            // return $proCat;
            $products = DB::table('products')
            ->orderBy('id','desc')
            ->select('*')
            ->paginate(6);            
        }
        // if(Request::get('pricerange') == $req->pricerange)
        // {
        //     return $req->pricerange;
        //     $products = DB::table('products')
        //     ->where('product_price','<',)
        //     ->orderBy('id','desc')
        //     ->select('*')
        //     ->paginate(6);            
        // }


        return view('shop',['products'=>$products]);
    }
    // public function proMayLike()
    // {
    //     $products = Product::all();
    //     return $products;
    //     return view('product_detail',['proMayLikes'=>$products]);
    // }

    public function addToCart(Request $req)
    {
        $customer_id = Session::get('user')['id'];

        if($req->session()->has('user')){

            $CartProId = Cart::where('product_id',$req->product_id)->where('customer_id',$customer_id)->count();
            if($CartProId>0)
            {
                alert()->Warning('This product already added in your cart')->persistent('Close')->autoClose(3000);
            }else{
                $cart = new Cart();
                $cart->customer_id = $req->session()->get('user')['id'];
                $cart->product_id = $req->product_id;
                $cart->product_qty = $req->product_qty;

                $cart->save();
                alert()->success('Product Has been added in you cart')->persistent('Close')->autoClose(3000);
            }

            return back();
        }
        else{
            return redirect("/login");
        }
    }

    static function cartItem()
    {
        $customer_id = Session::get('user')['id'];
        return Cart::where('customer_id',$customer_id)->count();
    }

    public function cartDetails()
    {
        $customer_id = Session::get('user')['id'];
        $cartItemCount = Cart::where('cart.customer_id',$customer_id)
        ->count();
        // return $cartItemCount;
        $cartDetails = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.customer_id',$customer_id)
        ->select('products.*','cart.id as cart_id','cart.product_qty as qty')
        ->get();
        // return $cartDetails;
        return view('cart',['cartDetail'=>$cartDetails,'CartItemCount'=>$cartItemCount]);
    }

    function deleteItemFromCart($id)
    {
        $customer_id = Session::get('user')['id'];
        DB::table('cart')
        ->where('id','=',$id)
        ->where('customer_id','=',$customer_id)
        ->delete();
        return redirect('cart');
    }

    function searchProduct(Request $req)
    {
        // return $req->input();
        $products = DB::table("products")
        ->where('product_title', 'Like', '%'.$req->input('q').'%')
        ->select('*')
        ->paginate(6);
        // return $products;
        return view('search',['products'=>$products]);
    }

    function changePrice(Request $req)
    {
        $customer_id = Session::get('user')['id'];
        $query = Cart::where('product_id',$req->proId)
        ->where('customer_id',$customer_id)
        ->update(['product_qty'=>$req->quantity]);
        if($query == 1)
        {
            $msg=1;
        }
        else
        {
            $msg = 0;
        }
        return $msg;
    }

    function payments()
    {
        $customer_id = Session::get('user')['id'];
        $cartDetails = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.customer_id',$customer_id)
        ->select('products.*','cart.id as cart_id','cart.product_qty as qty')
        ->get();        
        return view('/payments',['cartDetail'=>$cartDetails]);
    }

    function finalPayments(Request $req)
    {
        $customer_id = Session::get('user')['id']; 
        $allCart = Cart::where('customer_id',$customer_id)->get();
        foreach($allCart as $cart)
        {
            $order = new Order;
            $order->product_id = $cart['product_id'];
            $order->customer_id = $cart['customer_id'];
            $order->address = Session::get('user')['address'];
            $order->mobile = Session::get('user')['mobile'];
            $order->status = "Pending";
            $order->payment_method = $req->payment_method;
            $order->payment_status = "Pending";
            $order->save();
        }
        Cart::where('customer_id',$customer_id)->delete();
        alert()->success('Your Order Successfully Placed')->persistent('Close')->autoClose(3000);
        return redirect('/');        
    }

    
    function stripePayment(Request $req)
    {
        $customer_id = Session::get('user')['id']; 
        $allCart = Cart::where('customer_id',$customer_id)->get();

        $totalPrice = $req->total_price;
        // return $req->name;
        \Stripe\Stripe::setApiKey('sk_test_51HTJMjKEJ7PNXUvYpx9seKF8aKbPSn63lbNZQV9mIynZ96L9KdxKqne4fzZObOt2515D6RHyvwhpARRT2EP1uPru00dShErGNL');
        $charge = \Stripe\Charge::create ([
                "amount" => $totalPrice*100,
                "currency" => "inr",
                "source" => $req->stripeToken,
                "description" => "Payment receive by mobeeshop."
        ]);   
        // dd($charge);


        foreach($allCart as $cart)
        {
            $order = new Order;
            $order->product_id = $cart['product_id'];
            $order->customer_id = $cart['customer_id'];
            $order->address = Session::get('user')['address'];
            $order->mobile = $req->mobile;
            $order->status = "Pending";
            $order->payment_method = "Card";
            $order->payment_status = "Successfully";
            $order->save();
        }
        Cart::where('customer_id',$customer_id)->delete();
                
        alert()->success('Your Payment Successfully Done!')->persistent('Close')->autoClose(3000);
        return view('payments');

    }

    function wishlist($id){
        // return $id;
        $customer_id = Session::get('user')['id']; 
        $allCart = Cart::where('customer_id',$customer_id)
        ->where('product_id',$id)
        ->get();
        foreach($allCart as $cart)
        {
            $wishlist = new wishlist;
            $wishlist->product_id = $cart['product_id'];
            $wishlist->customer_id = $cart['customer_id'];
            $wishlist->product_qty = $cart['product_qty'];
            $wishlist->save();
        }        
        Cart::where('product_id',$id)
        ->where('customer_id',$customer_id)
        ->delete();

        session()->flash('alertSuccess');            
        return redirect('/cart');
    }

    public function wishLists()
    {
        $customer_id = Session::get('user')['id'];
        // return $cartItemCount;
        $wishlists = DB::table('wishlists')
        ->join('products','wishlists.product_id','=','products.id')
        ->where('wishlists.customer_id',$customer_id)
        ->select('products.*','wishlists.id as wishlist_id','wishlists.product_qty as qty')
        ->get();
        // return $cartDetails;
        return view('wishlist',['wishlists'=>$wishlists]);
    }    

    function DeletewishList($id)
    {
        $customer_id = Session::get('user')['id'];
        DB::table('wishlists')
        ->where('id','=',$id)
        ->where('customer_id','=',$customer_id)
        ->delete();
        return redirect('wishlist');
    }

    function wishlistToCart($id){
        $customer_id = Session::get('user')['id']; 
        $allwishlist = wishlist::where('customer_id',$customer_id)
        ->where('product_id',$id)
        ->get();
        foreach($allwishlist as $wishlist)
        {
            $cart = new Cart;
            $cart->product_id = $wishlist['product_id'];
            $cart->customer_id = $wishlist['customer_id'];
            $cart->product_qty = $wishlist['product_qty'];
            $cart->save();
        }        
        wishlist::where('product_id',$id)
        ->where('customer_id',$customer_id)
        ->delete();

        session()->flash('alertSuccess');            
        return redirect('/wishlist');        
    }

    // admin area

}
