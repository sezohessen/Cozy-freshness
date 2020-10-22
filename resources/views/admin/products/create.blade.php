@extends('layouts.app', ['title' => __('Add Product')])

@section('content')
    @include('admin.users.partials.header', ['title' => __('Add Product')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Add Product') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('products') }}" class="btn btn-sm btn-primary">{{ __('Back to Products') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body product-create">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input type="hidden" name="admin" value="0">
                            <h6 class="heading-small text-muted mb-4">{{ __('Product information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group required">
                                    <label class="form-control-label col-form-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                    <small class="badge badge-danger">{{$errors->first('name')}}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-control-label col-form-label">{{ __('Description') }}</label>
                                    <textarea name="description" class="form-control" id="description" rows="3" placeholder="{{ __('Description') }}" value="{{ old('description') }}" ></textarea>
                                    @if ($errors->has('description'))
                                    <small class="badge badge-danger">{{$errors->first('description')}}</small>
                                    @endif
                                </div>
                                <div class="form-group row required">
                                    <label for="category" class="col-2 col-form-label">Selet Category</label>
                                    <div class="col-4">
                                        <select class="form-control" id="category" name="category_id" required>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                  </div>
                                <div class="form-group row required">
                                    <label for="quantity" class="col-2 col-form-label">Quantity</label>
                                    <div class="col-4">
                                      <input class="form-control" name="quantity" type="number" id="quantity" placeholder="Quantity" required>
                                      <i class="fa fa-shopping-cart"></i>
                                      @if ($errors->has('quantity'))
                                      <small class="badge badge-danger">{{$errors->first('quantity')}}</small>
                                      @endif
                                    </div>
                                </div>
                                <div class="form-group row required">
                                    <label for="Price" class="col-2 col-form-label">Price(Dollar)</label>
                                    <div class="col-4">
                                      <input type="number" name="price" min="0" step="1"  id="Price" class="form-control" placeholder="Price" required>
                                      <i class="fa fa-dollar-sign"></i>
                                      @if ($errors->has('price'))
                                      <small class="badge badge-danger">{{$errors->first('price')}}</small>
                                      @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Discount" class="col-2 col-form-label">Discount(%)</label>
                                    <div class="col-4">
                                      <input type="number" name="discount" min="0" max="100" step="1"  id="Discount" class="form-control" placeholder="Discount">
                                      <i class="fa fa-percentage"></i>
                                      @if ($errors->has('discount'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('discount') }}</strong>
                                      </span>
                                      @endif
                                    </div>
                                </div>
                                <div class="form-group row required">
                                    <label for="picture" class="col-2 col-form-label">Photo(up to 2)</label>
                                    <div class="col-4">
                                    <input type="file" name="picture[]"  multiple required>
                                    @if ($errors->has('picture'))
                                    <small class="badge badge-danger">{{$errors->first('picture','The image is required and must be less or equal 3 images.')}}</small>
                                    @endif
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Add') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
