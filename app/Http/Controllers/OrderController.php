<?php

namespace App\Http\Controllers;
use App\Order;
use App\Order_product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ->whereDate('created_at', Carbon::today())
    /*
            ->orderBy('created_at','desc')
            ->get();
    */
    public function index($status,Request $Request)
    {
        if($status == 'pending'){
            $query         = Order::where('status','pending');
        }elseif($status == 'delivered'){
            $query         = Order::where('status','delivered');
        }else{
            $query         = Order::where('status','canceled');
        }
        // --------- Select Box -------------
        $today  = 0;
        $week   = 0;
        $month  = 0;
        $all    = 0;

        // -----------Search And Sort--------------
        if (isset($Request->order) && $Request->order == 'today') {
            $query->whereDate('created_at', Carbon::today())
            ->orderBy('created_at','desc');
            $today = 1;
        }elseif (isset($Request->order) && $Request->order == 'week') {
            $date = \Carbon\Carbon::today()->subDays(7);
            $query->whereDate('created_at','>=', $date)
            ->orderBy('created_at','desc');
            $week = 1;
        }elseif (isset($Request->order) && $Request->order == 'month') {
            $date = \Carbon\Carbon::today()->subDays(30);
            $query->whereDate('created_at','>=', $date)
            ->orderBy('created_at','desc');
            $month = 1;
        }elseif (isset($Request->order) && $Request->order == 'all') {
            $query->orderBy('created_at','desc');
            $all = 1;
        }else{
            $query->whereDate('created_at', Carbon::today())
            ->orderBy('created_at','desc');
            $today = 1;
        }
        $orders = $query->paginate(10);
        $orders->appends(['order' => $Request->order]);

        return view('admin.orders.index',compact('orders','status','today','week','month','all'));
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
