@extends('layouts.app', ['title' => __('Category')])

@section('content')
    @include('admin.users.partials.header', ['title' => __('Categories ')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Category ') . $category->name}}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('categories') }}" class="btn btn-sm btn-primary">{{ __('Back to Categories') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card mb-3">
                            <img class="card-img-top" src="{{asset('uploads/categories/'.$category->picture)}}" alt="Card image cap" width="100%" height="400px">
                            <div class="card-body">
                                <h1 class="card-title">{{$category->name}}</h1>
                                <p class="card-text">{{$category->description}}</p>
                                <strong>Contain : <span>{{$category->products->count()}}</span> Products</strong>
                                <p class="card-text"><small class="text-muted"> <strong>Updated At :</strong> {{ $category->updated_at->format('d/m/Y H:i') }}</small></p>
                            </div>
                          </div>
                          <hr>
                          <h3 class="text-center">Category's Products</h3>
                          <hr>
                          <div class="row category_product_show">
                            @foreach ($products as $product)
                            <div class="card border-dark col-4">
                                <div class="card-header"> <a href="{{route('products.show',$product->id)}}">{{$product->name}}</a></div>
                                <div class="card-body text-dark">
                                    <img src="{{asset('uploads/products/'.$product->pictures[0]->picture)}}" alt="{{$product->pictures[0]->picture}}" class="img-fluid img-thumbnail">   
                                    <h5 class="card-title"><strong>Price :{{$product->price}}$</strong></h5>
                                    <p class="card-text">{{$product->description}}</p>
                                </div>
                                <a href="{{route('products.show',$product->id)}}" class="btn btn-primary">More</a>
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