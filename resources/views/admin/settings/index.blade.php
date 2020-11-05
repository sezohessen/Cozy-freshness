@extends('layouts.app', ['title' => __('User Management')])
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid" style="padding-top: 60px">
        <div class="header-body">
    @if (!empty($setting))
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
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

                    <div class="table-responsive" style="height: 200px;">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Logo') }}</th>
                                    <th scope="col">{{ __('App Name') }}</th>
                                    <th scope="col">{{ __('Description') }}</th>
                                    @if(isset($setting->address))
                                    <th scope="col">{{ __('Address') }}</th>
                                    @endif
                                    @if(isset($setting->mail))
                                    <th scope="col">{{ __('Mail') }}</th>
                                    @endif
                                    @if(isset($setting->facebook))
                                    <th scope="col">{{ __('facebook') }}</th>
                                    @endif
                                    @if(isset($setting->instagram))
                                    <th scope="col">{{ __('instagram') }}</th>
                                    @endif
                                    @if(isset($setting->whatsapp))
                                    <th scope="col">{{ __('whatsapp') }}</th>
                                    @endif
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="{{Storage::url($setting->logo)}}" alt="{{$setting->appname}}" class="img-fluid img-thumbnail" width="100px" height="100px">
                                    </td>
                                    <td>
                                        <p>{{$setting->appname}}</p>
                                    </td>
                                    <td>
                                        <p>{{  Str::limit($setting->description, 20)}} </p>
                                    @if (isset($setting->address))
                                        <td>
                                            <p>{{$setting->address}}</p>
                                        </td>
                                    @endif
                                    @if (isset($setting->mail))
                                        <td>
                                            <p>{{  Str::limit($setting->mail, 13) }}</p>
                                        </td>
                                    @endif
                                    @if(isset($setting->facebook))
                                        <td>
                                            <p>{{ Str::limit($setting->facebook, 13) }}</p>
                                        </td>
                                    @endif
                                    @if(isset($setting->instagram))
                                        <td>
                                            <p>{{ Str::limit($setting->instagram, 13) }}</p>
                                        </td>
                                    @endif
                                    @if(isset($setting->whatsapp))
                                        <td>
                                            <p>{{  Str::limit($setting->whatsapp, 13) }}</p>
                                        </td>
                                    @endif
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{ route('settings.edit', $setting->id) }}">{{ __('Edit') }}</a>
                                                <a class="dropdown-item" href="{{ route('settings.destroy', $setting->id) }}" onclick="return confirm('Are you sure?')">{{ __('Delete') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
    @else
    <div class="text-center" style="margin: 50px 0 ">
        <h1>There is no settings to be showen </h1>
        <a href="{{route('settings.create')}}"> <button type="button" class="btn btn-primary">Create Setting</button></a>
    </div>

    @endif
        </div>
    </div>
</div>

@include('layouts.footers.auth')
</div>

@endsection
