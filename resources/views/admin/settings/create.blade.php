@extends('layouts.app', ['title' => __('Add Product')])

@section('content')
    @include('admin.users.partials.header', ['title' => __('Create Setting')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Create Setting') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('settings') }}" class="btn btn-sm btn-primary">{{ __('Back to Settings') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body product-create">
                        <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input type="hidden" name="admin" value="0">
                            <h6 class="heading-small text-muted mb-4">{{ __('Setting information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group required">
                                    <label class="form-control-label col-form-label" for="input-name">{{ __('App Name') }}</label>
                                    <input type="text" name="appname" id="input-name" class="form-control form-control-alternative{{ $errors->has('appname') ? ' is-invalid' : '' }}" placeholder="{{ __('App Name') }}" value="{{ old('appname') }}" required autofocus>
                                    @if ($errors->has('appname'))
                                    <small class="badge badge-danger">{{$errors->first('appname')}}</small>
                                    @endif
                                </div>
                                <div class="form-group required">
                                    <label for="description" class="form-control-label col-form-label">{{ __('Description') }}</label>
                                    <textarea name="description" class="form-control" id="description" rows="3" placeholder="{{ __('Description') }}"  required>{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                    <small class="badge badge-danger">{{$errors->first('description')}}</small>
                                    @endif
                                </div>
                                <div class="form-group row required">
                                    <label for="logo" class="col-2 col-form-label">logo</label>
                                    <div class="col-4">
                                    <input type="file" name="logo"  multiple required>
                                    @if ($errors->has('logo'))
                                        <small class="badge badge-danger">{{$errors->first('logo','The image is required.')}}</small>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row required">
                                    <label for="BGshop" class="col-2 col-form-label">Background Shop</label>
                                    <div class="col-4">
                                    <input type="file" name="BGshop"  multiple required>
                                    @if ($errors->has('BGshop'))
                                        <small class="badge badge-danger">{{$errors->first('BGshop','The image is required.')}}</small>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="form-control-label " for="input-name">{{ __('Mail') }}</label>
                                    <input type="email" name="mail" id="input-name" class="form-control form-control-alternative{{ $errors->has('mail') ? ' is-invalid' : '' }}" placeholder="{{ __('Mail') }}" value="{{ old('mail') }}"  autofocus>
                                    @if ($errors->has('mail'))
                                     <small class="badge badge-danger">{{$errors->first('mail')}}</small>
                                    @endif
                                </div>
                                <div class="form-group required">
                                    <label class="form-control-label " for="input-name">{{ __('Facebook') }}</label>
                                    <input type="text" name="facebook" id="input-name" class="form-control form-control-alternative{{ $errors->has('facebook') ? ' is-invalid' : '' }}" placeholder="{{ __('facebook Link') }}" value="{{ old('facebook') }}"  autofocus>
                                    @if ($errors->has('facebook'))
                                     <small class="badge badge-danger">{{$errors->first('facebook')}}</small>
                                    @endif
                                </div>
                                <div class="form-group required">
                                    <label class="form-control-label " for="input-name">{{ __('Instagram') }}</label>
                                    <input type="text" name="instagram" id="input-name" class="form-control form-control-alternative{{ $errors->has('instagram') ? ' is-invalid' : '' }}" placeholder="{{ __('Instagram Link') }}" value="{{ old('instagram') }}"  autofocus>
                                    @if ($errors->has('instagram'))
                                     <small class="badge badge-danger">{{$errors->first('instagram')}}</small>
                                    @endif
                                </div>
                                <div class="form-group required">
                                    <label class="form-control-label " for="input-name">{{ __('What\'s App') }}</label>
                                    <input type="text" name="whatsapp" id="input-name" class="form-control form-control-alternative{{ $errors->has('whatsapp') ? ' is-invalid' : '' }}" placeholder="{{ __('What\'s App Number') }}" value="{{ old('whatsapp') }}"  autofocus>
                                    @if ($errors->has('whatsapp'))
                                     <small class="badge badge-danger">{{$errors->first('whatsapp')}}</small>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Create') }}</button>
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
