<?php use Illuminate\Support\Facades\DB;
  $notifications=  DB::table('notifications')->whereNull('read_at')->orderBy('created_at', 'DESC')->skip(0)->take(maximum_notify())->get();
  ?>
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{isset($setting->logo) ? Storage::url($setting->logo) : asset('Constant_Images/Cozy.png')}}" alt="logo"
            width="100"style="border-radius: 50%">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main-notify" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <i class="ni ni-bell-55 " id="count_notify">
                {{count($notifications)}}
            </i>
        </button>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main-notify">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{isset($setting->logo) ? Storage::url($setting->logo) : asset('Constant_Images/Cozy.png')}}" alt="logo"
                        style="border-radius: 50%">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main-notify" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav nav align-items-center d-md-none">
                @if(count($notifications)==0)
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">{{ __('There are no Notification yet !') }}</h6>
                </div>
            @else
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">{{ __('Notification !') }}</h6>
                </div>
                <a  class="dropdown-item" href="{{route("notify_clear")}}" style="font-weight: 800">
                    Mark all as Read
                        <i class="ni ni-check-bold text-green"></i>
                </a>
                @foreach($notifications as $notify)
                <div class=" dropdown-header">
                    <a href="{{route("order.show",json_decode($notify->data)->id )}}" class="dropdown-item">
                        <object>
                            <a href="{{route("notify_element",['notify'=>$notify->id])}}">
                                <i class="ni ni-fat-remove text-red" style="font-size: 20px"></i>
                        </a>
                        </object>
                        Created At <span>{{  \Carbon\Carbon::parse(json_decode($notify->data)->created_at)->timezone('Africa/Cairo')->format('h:i a ') }}</span>,
                        Deliverd <span>{{ json_decode($notify->data)->Deliverd_After}}</span>
                        <i class="ni ni-bold-right text-green"></i>
                    </a>
                </div>

                @endforeach
            @endif
            </ul>
        </div>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{isset($setting->logo) ? Storage::url($setting->logo) : asset('Constant_Images/Cozy.png')}}" alt="logo"
                            " style="border-radius: 50%">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('Ecommerce') }}">
                        <i class="ni ni-planet text-primary"></i>
                {{
                           !empty(App\Setting::orderBy('id', 'DESC')->get()->first())?
                           App\Setting::orderBy('id', 'DESC')->get()->first()->appname :
                        "Cozy "
                 }}
                    </a>
                </li>
                @if(auth()->user()->admin == 1)
                    <li class="nav-item">
                        <a class="nav-link active" href="#admin" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                            <i class="fas fa-user-secret" style="color: #f4645f;"></i>
                            <span class="nav-link-text" style="color: #f4645f;">{{ __('Admin') }}</span>
                        </a>

                        <div class="collapse show" id="admin">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admins.create') }}">
                                        {{ __('New Admin') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admins.index') }}">
                                        {{ __('Admin Management') }}
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="#user" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fas fa-users" style="color: #f4645f;"></i>
                        <span class="nav-link-text">{{ __('Users') }}</span>
                    </a>

                    <div class="collapse" id="user">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.create') }}">
                                    {{ __('New User') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.index') }}">
                                    {{ __('User Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route("categories")}}">
                        <i class="fa fa-list-alt text-blue"></i> {{ __('Categories') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("products")}}">
                        <i class="fas fa-tag text-blue"></i> {{ __('Products') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("orders",['status'=>"pending"])}}">
                        <i class="ni ni-send text-yellow"></i> {{ __('Pending Orders') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("orders",['status'=>"delivered"])}}">
                        <i class="ni ni-check-bold text-green"></i> {{ __('Deliverd Orders') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("orders",['status'=>"canceled"])}}">
                        <i class="ni ni-fat-remove text-red"></i> {{ __('Canceld Orders') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("settings")}}">
                        <i class="ni ni-settings-gear-65 text-grey"></i> {{ __('Settings') }}
                    </a>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <!-- <h6 class="navbar-heading text-muted">Documentation</h6> -->
            <!-- Navigation -->
            <!-- <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
                        <i class="ni ni-palette"></i> Foundation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html">
                        <i class="ni ni-ui-04"></i> Components
                    </a>
                </li>
            </ul> -->
        </div>
    </div>
</nav>
