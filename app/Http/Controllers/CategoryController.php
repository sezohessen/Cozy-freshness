<?php

namespace App\Http\Controllers;
use App\User;
use App\Category;
use App\Comment;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users      = User::all();
        $categories = Category::all()->sortByDesc("id");
        $products   = Product::all();
        $pending            = Order::where('status','pending')
        ->orderBy('created_at','desc')
        ->get();
        $deliverd            = Order::where('status','delivered')
        ->orderBy('created_at','desc')
        ->get();
        $canceled            = Order::where('status','canceled')
        ->orderBy('created_at','desc')
        ->get();
        return view('admin.categories.index',compact('categories','users','products','pending',
        'deliverd','canceled'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'         =>  'required',
            'description'  =>  'required|max:255',
            'picture'      =>  'required',
            'picture.*'    =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $featrued = $request->picture;
        $featrued_new_name = time().rand(11111,99999).$featrued->getClientOriginalName();
        $featrued->move('uploads/categories/',$featrued_new_name);
        $post = Category::create([
            'name'          =>  $request->name,
            'description'   =>  $request->description,
            'picture'       =>  $featrued_new_name,
            'active'        =>  1,
        ]);
        session()->flash('status', 'The Category has been Created!');
        return redirect()->route('categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::all();
        $comments   = Comment::all();
        $category   = Category::find($id);
        $products   = Product::where('category_id', $id)
        ->orderBy('id', 'desc')
        ->get();
        $orders         = Order::where('status','withApproval')
        ->orderBy('created_at','desc')
        ->get();
        $shipped    = Order::where('status','shipped')
        ->orderBy('created_at','desc')
        ->get();
        return view('admin.categories.show',compact('category','categories','products','comments','orders',
        'shipped'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit',compact('category'));
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
        $category = Category::find($id);
        $this->validate($request,[
            'name'         =>  'required',
            'description'  =>  'required|max:255',
            'picture.*'    =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $this->handleUploadedImage($request,$request->file('picture'),$category);
        $category->name        =   $request->name;
        $category->description =   $request->description;

        $category->save();
        session()->flash('status', 'The Category has been updated!');
        return redirect()->route('categories');
    }
    public function handleUploadedImage($request,$image,$category)
    {
        if (!is_null($image)) {
            $featrued = $request->picture;
            $featrued_new_name = time().rand(11111,99999).$featrued->getClientOriginalName();
            $featrued->move('uploads/categories/',$featrued_new_name);
            $category->picture = $featrued_new_name;
        }
    }
    public function activation($id)
    {
        $category = Category::find($id);
        if($category->active){
            $category->active = 0;
        }else{
            $category->active = 1;
        }
        $category->save();
        return redirect()->route('categories');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete($id);
        session()->flash('status', 'The Category has been Destroyed!');
        return redirect()->route('categories');
    }
}
