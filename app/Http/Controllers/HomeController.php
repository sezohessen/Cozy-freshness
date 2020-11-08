<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Product;
use App\product_picture;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Setting;
use Laravel\Ui\Presets\React;

class HomeController extends Controller
{

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

	public function index() {
        $title=!empty(Setting::orderBy('id', 'DESC')->get()->first())?
        Setting::orderBy('id', 'DESC')->get()->first()->appname:
        "Cozy";
        $MainCat       = Category::active()
        ->orderBy('created_at','desc')
        ->take(3)
        ->get();
        $users              = User::all();
        $categories = $this->categories;
        $product_picture    = product_picture::all();
        $products           = Product::active()
        //Select from db depend on Relation
        ->whereHas('category', function ($query) {
            return $query->where('active', 1);
        })
        ->orderBy('created_at', 'desc')
        ->take(8)
        ->get();
        return view('users.main',compact('title','users','categories','products','MainCat'));
    }
    public function shop(Request $Request)
    {
        $title=!empty(Setting::orderBy('id', 'DESC')->get()->first())?
        Setting::orderBy('id', 'DESC')->get()->first()->appname."| Shop" :
        "Cozy | Shop";
        //dd($Request);
        //Can not passing  $Request->order in orderBy
        //Like orderBy('new_price',$Request->order)  --->> vulnerable SQL Injection
        // get active rows
        $query = Product::active()
        ->whereHas('category', function ($query) {
            return $query->where('active', 1);
        });
        // search filter

        //Start Filter Section
        /*
        -Select
        -Where
        -OrderBy
        */
        // -----------Search And Sort--------------
        if (isset($Request->order) && $Request->order == 'desc') {
            $query->selectRaw(" * , price - ((price * discount)/100) as new_price ");
        }elseif(isset($Request->order) && $Request->order == 'asc'){
            $query->selectRaw(" * , price - ((price * discount)/100) as new_price ");
        }

        if (isset($Request->search)){
            $query->where('name','like','%'.request('search').'%');
        }

        if (isset($Request->order) && $Request->order == 'desc') {
            $query->orderBy('new_price','desc');
        }elseif(isset($Request->order) && $Request->order == 'asc'){
            $query->orderBy('new_price','asc');
        }else{
            $query->orderBy('created_at', 'desc');
        }
        $products = $query->paginate(9);
        $products->appends(['order' => $Request->order, 'search' => $Request->search ]);
        //Select from db depend on Relation

        // -----------Search And Sort--------------
        //End Filter Section
        $all_product        = Product::active() //Prodcut Count
        ->whereHas('category', function ($query) {
            return $query->where('active', 1);
        })
        ->get();
        //dd($products->toSql());

        $product_picture    = product_picture::all();
        $categories         = Category::active()
        ->orderBy('created_at', 'desc')
        ->whereHas('products', function ($query) {
            return $query->where('active', 1);
        })
        ->get();
        $setting_shop_image=!empty(Setting::orderBy('id', 'DESC')->get()->first())?
        Setting::orderBy('id', 'DESC')->get()->first()->BGshop:null;
        return view('users.categories.show',compact('title','categories','products','product_picture','all_product',"setting_shop_image"
        ));
    }

    public function SpecificCateg(Request $Request,$id, $slug, $machine = 0)
    {

        $category       = Category::find($id);//If no matching model exist, it returns null.
        $title = 'Cozy | '.$category->name;
        if($category==NULL){
            return view('users.notfound');
        }
        $category_slug  = str_slug($category->name);
        //Valide URL
        if (!$category->active||($slug!=$category_slug)) {
            return view('users.notfound');
        }
        //Valide URL
        $query = Product::active($id);
        // -----------Search And Sort--------------
        if (isset($Request->order) && $Request->order == 'desc') {
            $query->selectRaw(" * , price - ((price * discount)/100) as new_price ");
        }elseif(isset($Request->order) && $Request->order == 'asc'){
            $query->selectRaw(" * , price - ((price * discount)/100) as new_price ");
        }

        if (isset($Request->search)){
            $request_search = request('search');
            $query->where('name','like','%'. $request_search .'%');
        }

        if (isset($Request->order) && $Request->order == 'desc') {
            $query->orderBy('new_price','desc');
        }elseif(isset($Request->order) && $Request->order == 'asc'){
            $query->orderBy('new_price','asc');
        }else{
            $query->orderBy('created_at', 'desc');
        }
        $products = $query->paginate(9);
        $products->appends(['order' => $Request->order, 'search' => $Request->search ]);
        // -----------Search And Sort--------------
        $all_product        = Product::active($id);
        $product_picture    = product_picture::all();
        $categories         = $this->categories;
        $category_info      = Category::where('id',$id)
        ->get()
        ->first();
        if($machine){
            return view('users.machine.show',compact('title','categories','products','product_picture','all_product',
        'category_info'));
        }else{
            return view('users.categories.show',compact('title','categories','products','product_picture','all_product',
        'category_info'));
        }

    }
    public function machine(Request $Request)
    {
        $title=!empty(Setting::orderBy('id', 'DESC')->get()->first())?
        Setting::orderBy('id', 'DESC')->get()->first()->appname."| Machine" :
        "Cozy | Machine";
        //dd($Request);
        //Can not passing  $Request->order in orderBy
        //Like orderBy('new_price',$Request->order)  --->> vulnerable SQL Injection
        // get active rows
        $query = Product::active()
        ->whereHas('category', function ($query) {
            return $query->where('active', 1);
        });
        // search filter

        //Start Filter Section
        /*
        -Select
        -Where
        -OrderBy
        */
        // -----------Search And Sort--------------
        if (isset($Request->order) && $Request->order == 'desc') {
            $query->selectRaw(" * , price - ((price * discount)/100) as new_price ");
        }elseif(isset($Request->order) && $Request->order == 'asc'){
            $query->selectRaw(" * , price - ((price * discount)/100) as new_price ");
        }

        if (isset($Request->search)){
            $query->where('name','like','%'.request('search').'%');
        }

        if (isset($Request->order) && $Request->order == 'desc') {
            $query->orderBy('new_price','desc');
        }elseif(isset($Request->order) && $Request->order == 'asc'){
            $query->orderBy('new_price','asc');
        }else{
            $query->orderBy('created_at', 'desc');
        }
        $products = $query->paginate(9);
        $products->appends(['order' => $Request->order, 'search' => $Request->search ]);
        //Select from db depend on Relation

        // -----------Search And Sort--------------
        //End Filter Section
        $all_product        = Product::active() //Prodcut Count
        ->whereHas('category', function ($query) {
            return $query->where('active', 1);
        })
        ->get();
        //dd($products->toSql());

        $product_picture    = product_picture::all();
        $categories         = Category::active()
        ->orderBy('created_at', 'desc')
        ->whereHas('products', function ($query) {
            return $query->where('active', 1);
        })
        ->get();
        $setting_shop_image=!empty(Setting::orderBy('id', 'DESC')->get()->first())?
        Setting::orderBy('id', 'DESC')->get()->first()->BGshop:null;
        return view('users.machine.show',compact('title','categories','products','product_picture','all_product',"setting_shop_image"
        ));
    }
}
