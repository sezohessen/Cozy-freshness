@extends('layouts.app', ['title' => __('Category')])

@section('content')
    @include('admin.users.partials.header', ['title' => __('Orders ')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Order ID : ') . $order->id}}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('orders','pending') }}" class="btn btn-sm btn-primary">{{ __('Back to Orders') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h1 class="card-title">{{ $order->user->name }}</h1>
                                        <h4>Full name: <strong>{{ $order->fullName }}</strong><h4>
                                        <h4>Email: <strong>{{ $order->user->email }}</strong><h4>
                                        <h4>Phone: <strong>{{ $order->phone }}</strong><h4>
                                        <h4>Location: <strong>{{ $order->location }}</strong><h4>
                                        <h4>More information:
                                            @if ($order->moreInfo)
                                                <strong>{{ $order->moreInfo }}</strong>
                                            @else
                                                <strong>No info</strong>
                                            @endif

                                        <h4>
                                        <h4>Time: <strong>{{ $order->time }}</strong><h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h1 class="card-title">{{ucfirst(trans($order->status))}}</h1>
                                        <h4>Total: <strong>{{$order->total}}</strong><h4>
                                        <h4>Product Count: <strong>{{ $order->orders->count() }}</strong><h4>
                                        @if ($order->status=='withApproval')
                                            <p class="card-text"><strong>Orderd At :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                                        @elseif($order->status=='shipped')
                                            <p class="card-text"><strong>Shipped At :</strong> {{ Carbon\Carbon::parse($order->shipped)->format('H:i') }} </p>
                                            <span>{{ Carbon\Carbon::parse($order->shipped)->format('l, F j ')}}</span>
                                        @elseif($order->status=='delivered')
                                            <strong>Delivered At :</strong> {{ Carbon\Carbon::parse($order->delivered)->format('m/d H:i') }}
                                        @endif

                                        @if ($order->status == 'pending')
                                        <form action="{{ route('order.delivered',['id' => $order->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-lg btn-success">
                                                {{ __('Delivered') }}<i class="fa fa-check"></i>
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('order.delete',['id' => $order->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-lg btn-danger" onclick="return confirm('Are you sure?')">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                          </div>
                          <hr>
                          <h3 class="text-center">Order's Products</h3>
                          <hr>
                          <div class="row category_product_show">
                            @foreach ($orderProducts as $order)
                            <div class="card border-dark col-4">
                                <div class="card-header">
                                    <a href="{{route('products.show',$order->product->id)}}">
                                        {{$order->product->name}}
                                    </a>
                                    <strong>x {{ $order->quantity }}</strong>
                                </div>
                                <div class="card-body text-dark">
                                    <img src="{{asset('uploads/products/'.$order->product->pictures->first()->picture )}}" alt="{{$order->product->name}}" class="img-fluid img-thumbnail">
                                    <h5 class="card-title">Price One unit :<strong>{{$order->price}}$</strong></h5>
                                    <h5 class="card-title">Discount :<strong>{{$order->discount}}%</strong></h5>
                                    <h4 class="card-title">Final Price :<strong>{{($order->price - (($order->price * $order->discount)/100))* $order->quantity}}$</strong></h4>
                                    <p class="card-text">{{$order->product->description}}</p>
                                </div>
                                <a href="{{route('products.show',$order->product->id)}}" class="btn btn-primary">More</a>
                            </div>
                          @endforeach
                          </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
