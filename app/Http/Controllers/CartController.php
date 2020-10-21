<?php

namespace App\Http\Controllers;

use App\BillingOrder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Category;
use App\Comment;
use App\Order;
use App\Order_product;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
      $this->categories = Category::active()
      ->orderBy('created_at', 'desc')
      ->whereHas('products', function ($query) {
        return $query->where('active', 1);
      })
      ->take(6)
      ->get();
    }
    public function index()
    {
        $categories = $this->categories;
        $title      = 'Novas | cart';
        return view('users.carts.index',compact('title','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {

        $product    = Product::find($id);
        if($product->inStock==0){
            session()->flash('danger', 'Sorry product '.$product->name .' not availabe right now');
            return redirect()->back();
        }
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            if($cart[$id]['quantity'] < $product->inStock){
                $cart[$id]['quantity']++;
            }else{
                session()->flash('status', 'Product '.$product->name.' has only '.$product->inStock.' quantity');
                return redirect()->route('shop.cart');
            }
            session()->put('cart', $cart);
            return redirect()->route('shop.cart');
        }
        $cart[$id] = [
            "quantity" => $request->quantity,
        ];
        session()->put('cart', $cart);
        return redirect()->route('shop.cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id and $request->quantity)
        {
            $cart = session()->get('cart');
            $product = Product::find($id);
            if(!$product->count()){
                session()->flash('notfound', 'Sorry product not availabe right now ');
                return redirect()->route('shop.cart');
            }elseif($product->inStock < $request->quantity){
                session()->flash('leakquantity', 'Sorry product limit quantity');
                return redirect()->route('shop.cart');
            }

            $cart[$id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
            return redirect()->route('shop.cart');
        }
    }
    public function remove($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        session()->flash('status', 'Product removed successfully');
        return redirect()->back();

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function checkOut(Request $request)
    {
        $title      = 'Novas | Checkout';
        if(!Auth::user()){
            return redirect()->route('login');
        }else{
            if(!session('cart')){
                return redirect()->back();
            }
            $categories = $this->categories;
            return view('users.carts.check-out',compact('title','categories'));
        }
    }
    public function placeOrder(Request $request)
    {
        $this->validate($request,[
            'fullName'      => 'required',
            'governorate'   => 'required|max:40',
            'city'          => 'required|max:40',
            'address'       => 'required|max:100',
            'phone'         => 'required|max:20',
            'paymentMethod' => 'required'
        ]);
        $categories = $this->categories;
        if(session('cart')){
            /* Add Order */
            $order = Order::create([
                'user_id'           =>  Auth::user()->id,
                'total'             =>  $request->total,
                'shipping'          =>  0,
                'subtotal'          =>  $request->total,
                'ip'                =>  $request->ip(),
                'status'            =>  'withApproval',
                'fullName'          =>  $request->fullName,
                'governorate'       =>  $request->governorate,
                'city'              =>  $request->city,
                'address'           =>  $request->address,
                'phone'             =>  $request->phone,
                'paymentMethod'     =>  $request->paymentMethod
            ]);
            if($request->has('moreInfo')){
                $order->moreInfo = $request->moreInfo;
                $order->save();
            }
            foreach(session('cart') as $id => $cart_info){
                $product            = Product::find($id);
                $product->inStock   -= $cart_info['quantity'];
                $product->save();
                $orderProduct   = Order_product::create([
                    'product_id'    => $id,
                    'order_id'      => $order->id,
                    'quantity'      => $cart_info['quantity'],
                    'price'         => $product->price,
                    'discount'      => $product->discount
                ]);
            }
            /*Add order */
            $request->session()->forget('cart');//Clear seasion
            $title      = 'Novas | Orderd';
            return view('users.carts.thanks',compact('title','order','categories'));
        }else{
            session()->flash('not_available', 'Sorry product not available');
            return redirect()->route('shop.cart');
        }

    }
    public function trackOrder()
    {
        $title      = 'Novas | Tracking';
        $categories = $this->categories;
        $orders         = Order::where('user_id',Auth::user()->id)
        ->orderBy('created_at', 'desc')
        ->get();
        return view('users.carts.tracking',compact('title','orders','categories'));
    }
}
