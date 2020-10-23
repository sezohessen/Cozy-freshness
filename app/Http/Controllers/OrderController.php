<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Order;
use App\Order_product;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status)
    {
        //Recents orders
        $users              = User::all();
        $categories         = Category::all();
        $products           = Product::all();
        $pending            = Order::where('status','pending')
        ->orderBy('created_at','desc')
        ->get();
        $deliverd            = Order::where('status','delivered')
        ->orderBy('created_at','desc')
        ->get();
        $canceled            = Order::where('status','canceled')
        ->orderBy('created_at','desc')
        ->get();
        if($status == 'pending'){
            $orders         = Order::where('status','pending')
            ->orderBy('created_at','desc')
            ->get();
        }elseif($status == 'delivered'){
            $orders         = Order::where('status','delivered')
            ->orderBy('created_at','desc')
            ->get();
        }else{
            $orders         = Order::where('status','canceled')
            ->orderBy('created_at','desc')
            ->get();
        }
        return view('admin.orders.index',compact('categories','users','products',
        'orders','pending','deliverd','canceled','status'));
    }
    public function shipped($id)
    {
        $order          = Order::find($id);
        $order->status  = 'shipped';
        $order->shipped = Carbon::now();
        $order->save();
        session()->flash('done','Order Shipped Successfully!');
        return redirect()->back();
    }
    public function delivered($id)
    {
        $order              = Order::find($id);
        $order->status      = 'delivered';
        $order->delivered   = Carbon::now();
        $order->save();
        session()->flash('done','Order deliverd Successfully!');
        return redirect()->back();
    }
    public function canceled($id)
    {
        $order          = Order::find($id);
        $order->status  = 'canceled';
        $order->save();
        session()->flash('done','Order canceled Successfully!');
        return redirect()->back();
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order      = Order::find($id);
        $orderProducts   = Order_product::where('order_id',$id)
        ->get();
        return view('admin.orders.show',compact('order','orderProducts'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order  = Order::find($id);
        $order->delete($id);
        session()->flash('done', 'Order has been deleted!');
        return redirect()->back();
    }
}
