<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users          = User::all();
        $categories     = Category::all();
        $products       = Product::all();
        $comments       = Comment::all()
        ->sortByDesc('created_at');
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
        /* You could still use sortBy (at the collection level) instead of orderBy
        (at the query level) if you still want to use all() since it returns a collection of objects. */
        return view('admin.comments.index',compact('users','categories','products','comments','pending',
        'shipped','deliverd','canceled'));
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
        $this->validate($request,[
            'comment' =>'required|min:3|max:1000',
            'rate' =>'required',
        ]);
        $comment = Comment::where('product_id',$id)
        ->where('user_id',Auth::id())
        ->get()
        ->first();
        if($comment){
            session()->flash('exist', 'You have already review');
            return redirect()->back();
        }
        $post = Comment::create([
            'comment' =>$request->comment,
            'rate' =>$request->rate,
            'user_id' => Auth::id(),
            'product_id' => $id
        ]);
        session()->flash('status', 'Comment Was Added!');
        return redirect()->back();
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
    public function productComment($id)
    {
        $users          = User::all();
        $categories     = Category::all();
        $products       = Product::all();
        $comments       = Comment::where('product_id',$id)
        ->get();
        $product_info   = Product::find($id);
        $allComments    = Comment::all();
        return view('admin.comments.index',compact('comments','product_info','users','categories','products',
            'allComments'));
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
        $comment    = Comment::find($id);
        $comment->delete($id);
        session()->flash('status', 'The comment has been deleted!');
        return redirect()->back();
    }
}
