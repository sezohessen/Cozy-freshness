@extends('layouts.app', ['title' => __('User Management')])

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            @if ($products->count())
            <div class="container-fluid mt--7">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">{{ __('Products') }}</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">{{ __('Add product') }}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>

                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">{{ __('Pic') }}</th>
                                            <th scope="col">{{ __('Name') }}</th>
                                            <th scope="col">{{ __('Category') }}</th>
                                            <th scope="col">{{ __('Active') }}</th>
                                            <th scope="col">{{ __('Additional') }}</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="img-td ">
                                                    <img src="{{ Storage::url($product->pictures->first()->picture)}}" alt="{{$product->name}}" class="img-fluid img-thumbnail" width="100px" height="100px">
                                                </td>
                                                <style>
                                                    @media only screen and (max-width: 360px) {
                                                  .img-td {
                                                      padding:0 !important;
                                                  }
                                               }
                                               </style>
                                                <td>
                                                    <p>{{$product->name}}</p>
                                                </td>
                                                <td>
                                                    <a href="{{route('categories.show',$product->category->id)}}">
                                                        {{$product->category->name}}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($product->active==1)
                                                        <a href="{{route('products.activation',$product->id)}}" onclick="return confirm('Are you sure?')">
                                                            <button type="button" class="btn btn-danger" >
                                                                {{ __('Inactive') }}
                                                            </button>
                                                        </a>
                                                    @else
                                                        <a href="{{route('products.activation',$product->id)}}" onclick="return confirm('Are you sure?')">
                                                            <button type="button" class="btn btn-success">
                                                                {{ __('Active') }}
                                                            </button>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('products.show',$product->id)}}">
                                                        <button class="btn">See More</button>
                                                    </a>
                                                </td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="{{ route('products.edit', $product->id) }}">{{ __('Edit') }}</a>
                                                            <a class="dropdown-item" href="{{ route('products.destroy', $product->id) }}" onclick="return confirm('Are you sure?')">{{ __('Delete') }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="navigation pagination">
                                    <div class="page-numbers">
                                        {{ $products->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center" style="margin: 50px 0 ">
                <h1>There is no products to be showen </h1>
                <a href="{{route('products.create')}}"> <button type="button" class="btn btn-primary">Create Product</button></a>
            </div>
            @endif
        </div>
    </div>
</div>
@include('layouts.footers.auth')
</div>
@endsection
