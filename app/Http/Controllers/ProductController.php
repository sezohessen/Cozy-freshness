<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Category;
use App\Comment;
use App\Order;
use App\Product;
use App\product_picture;
use App\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users              = User::all();
        $categories         = Category::all();
        $products           = Product::all()->sortByDesc("id");
        $product_picture    = product_picture::all();
        $pending            = Order::where('status','pending')
        ->orderBy('created_at','desc')
        ->get();
        $deliverd            = Order::where('status','delivered')
        ->orderBy('created_at','desc')
        ->get();
        $canceled            = Order::where('status','canceled')
        ->orderBy('created_at','desc')
        ->get();
        return view('admin.products.index',compact('categories','users','products','product_picture',
        'pending','deliverd','canceled'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create',compact('categories'));
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
            'name' => 'required',
            'description' => 'max:255',
            'category_id' =>'required',
            'quantity' =>'required',
            'price' =>'required',
            'picture' =>'required|max:2',
            'picture.*'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if($request->hasfile('picture'))
        {
           foreach($request->file('picture') as $image)
           {
                $featrued_new_name = time().rand(11111,99999).$image->getClientOriginalName();
                $image->move('uploads/products/',$featrued_new_name);
                $data_img[] = $featrued_new_name;
           }
        }
        $product = Product::create([
            'name'          =>  $request->name,
            'category_id'   =>  $request->category_id,
            'price'         =>  $request->price,
            'quantity'      =>  $request->quantity
        ]);
        if($request->description){
            $product->description       =  $request->description;
            $product->save();
        }
        $this->CreateOrIgnore($product,$request->discount,'discount');
        foreach ($data_img as $data){
            $product_image = product_picture::create([
                'product_id'    =>$product->id,
                'picture'       =>$data
            ]);
        }
        session()->flash('status', 'The Product has been Created!');
        return redirect()->route('products');
    }
    public function CreateOrIgnore($table,$request,$name)
    {
        if(!is_null($request)){
            $table->$name = $request;
            $table->save();
        }else{
            $table->$name = 0;
            $table->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product            = Product::find($id);
        $product_pictures   = product_picture::where('product_id', $id)
        ->orderBy('id', 'desc')
        ->get();
        return view('admin.products.show',compact('product','product_pictures'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('admin.products.edit',compact('product','categories'));
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
        $product = Product::find($id);
        $this->validate($request,[
            'name' => 'required',
            'description' => 'max:255',
            'category_id' =>'required',
            'quantity' =>'required',
            'price' =>'required',
            'picture' =>'max:2',
            'picture.*'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->has('picture')){
            foreach( $request->file('picture') as $key=> $product_picture){
                $this->handleUploadedImage($product_picture,$product,$key);

            }
        }
        $product->name        =  $request->name;
        $product->quantity    =  $request->quantity;
        $product->price       =  $request->price;
        $product->category_id =  $request->category_id;
        $product->save();
        $this->CreateOrIgnore($product,$request->discount,'discount');
        if($request->description){
            $product->description       =  $request->description;
            $product->save();
        }
        session()->flash('status', 'The product has been updated!');
        return redirect()->route('products');
    }
    public function handleUploadedImage($image,$product,$key)
    {
        $featrued = $image;
        $featrued_new_name = time().rand(11111,99999).$featrued->getClientOriginalName();
        $featrued->move('uploads/products/',$featrued_new_name);
        if($key==0){
            //Delete Old Images On Update
            $oldRows =  product_picture::where('product_id', $product->id);
            foreach( $oldRows as $oldRow){
                File::delete('uploads/products/'.$oldRow->picture);
            }
            $oldRows->delete();
        }
        // Update Info Product_picture Table
        $product_image = product_picture::create([
            'product_id'    =>$product->id,
            'picture'       =>$featrued_new_name
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        $product->delete($id);
        session()->flash('status', 'The product has been deleted!');
        return redirect()->route('products');
    }
    public function activation($id)
    {
        $product = Product::find($id);
        if($product->active){
            $product->active = 0;
        }else{
            $product->active = 1;
        }
        $product->save();
        return redirect()->route('products');
    }
}
