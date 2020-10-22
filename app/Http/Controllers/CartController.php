<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Category;
use App\Order;
use App\Order_product;
use App\Product;
use Carbon\Carbon;
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
            'location'   => 'required|max:60',
            'phone'         => 'required|max:20',
            'time' => 'required'
        ]);
        $categories = $this->categories;
        if(session('cart')){
            /* Add Order */
            $order = Order::create([
                'user_id'           =>  Auth::user()->id,
                'total'             =>  $request->total,
                'status'            =>  'pending',
                'fullName'          =>  $request->fullName,
                'phone'             =>  $request->phone,
                'location'          =>  $request->location,
                'time'              =>  $request->time,
                'pending'           =>  Carbon::now()->toDateTimeString(),
            ]);
            if($request->has('moreInfo')){
                $order->moreInfo = $request->moreInfo;
                $order->save();
            }
            foreach(session('cart') as $id => $cart_info){
                $product            = Product::find($id);
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
            return redirect()->route('shop');
        }

    }
}
