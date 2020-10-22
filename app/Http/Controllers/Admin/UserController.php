<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Category;
use App\Comment;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
class UserController extends Controller
{

    public function index(User $model)
    {
        $users      = User::all();
        $categories = Category::all();
        $products   = Product::all();
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
        return view('admin.users.index', compact('users','categories','products','pending',
        'shipped','deliverd','canceled'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password')),
                                        'admin' => 0])->all());
        return redirect()->route('users.index')->withStatus(__('User successfully created.'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|min:5|max:30',
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed',
        ];

        $this->validate($request, $rules);

        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
        ));

        return redirect()->route('users.index')->withStatus(__('User successfully updated.'));
    }

    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('users.index')->withStatus(__('User successfully deleted.'));
    }
}
