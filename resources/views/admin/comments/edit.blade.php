@extends('layouts.app', ['title' => __('Edit Category')])

@section('content')
    @include('admin.users.partials.header', ['title' => __('Edit Category')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Edit  Category') }} {{$category->name}}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('categories') }}" class="btn btn-sm btn-primary">{{ __('Back to Categories') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input type="hidden" name="admin" value="0">
                            <h6 class="heading-small text-muted mb-4">{{ __('Category information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                     placeholder="{{ __('Name') }}" value="{{ $category->name }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea name="description" class="form-control" id="description" rows="3" 
                                    placeholder="{{ __('Description') }}" >{{ $category->description }}</textarea>
                                    @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('picture') ? ' has-danger' : '' }}">
                                    <label for="picture">Photo</label>
                                    <input type="file" class="form-control-file" name="picture">
                                    @if ($errors->has('picture'))
                                    <small class="badge badge-danger">{{$errors->first('picture','The Photo is required.')}}</small>
                                    @endif
                                </div>  
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
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