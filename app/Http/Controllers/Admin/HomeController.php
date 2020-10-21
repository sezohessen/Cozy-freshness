<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users      = User::all();
        $categories = Category::all();
        $products   = Product::all();
        $comments   = Comment::all();
        $pending            = Order::where('status','withApproval')
        ->orderBy('created_at','desc')
        ->get();
        $shipped            = Order::where('status','shipped')
        ->orderBy('created_at','desc')
        ->get();
        $deliverd            = Order::where('status','delivered')
        ->orderBy('created_at','desc')
        ->get();
        $canceled            = Order::where('status','canceled')
        ->orderBy('created_at','desc')
        ->get();
        return view('admin.dashboard',compact('users','categories','products','comments','pending',
        'shipped','deliverd','canceled'));
    }
}
