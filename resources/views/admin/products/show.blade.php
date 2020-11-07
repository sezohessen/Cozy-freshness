@extends('layouts.app', ['title' => __('product')])

@section('content')
    @include('admin.users.partials.header', ['title' => __('Products')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('product ') . $product->name}}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('products') }}" class="btn btn-sm btn-primary">{{ __('Back to products') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card mb-3 product-show">
                            <div class="row product-show-img">
                                @foreach ($product_pictures as $key => $product_picture)
                                        @if ($key==0)
                                            <div class="col-12 m-4">
                                                <img class="img-thumbnail center-img" src="{{Storage::url($product_picture->picture)}}"
                                                alt="Card image cap" width="500px" height="500px">
                                                <hr>
                                            </div>
                                        @else
                                            <div class="col-4">
                                                <img src="{{Storage::url($product_picture->picture) }}"
                                                alt="Card image cap" width="100%">
                                            </div>
                                        @endif
                                @endforeach
                            </div>
                            <div class="card-body">
                                <h1 class="card-title">{{$product->name}}</h1>
                                <h3 class="red">Price : <span>{{$product->price}} L.E</span> </h3>
                                <h3 class="red">Code : <span>{{$product->code}}</span> </h3>
                                <strong class="red">Available Quantity : <span>{{$product->quantity}} pieces</span> </strong>
                                <hr>
                                <p class="card-text">{{$product->description}}</p>
                                <hr>
                                <strong>Category : <a href="{{route('categories.show',$product->category_id)}}">{{$product->category->name}}</a> </strong>
                                @if ($product->discount==0||$product->discount==NULL)
                                    <h3>Discount : <span>No discount yet.</span></h3>
                                @else
                                    <h3>Discount : <span>{{$product->discount}}%</span></h3>
                                @endif
                                <p class="card-text"><small class="text-muted"> <strong>Updated At :</strong> {{ $product->updated_at->format('d/m/Y H:i') }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
