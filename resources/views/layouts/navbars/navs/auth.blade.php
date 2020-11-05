<?php use Illuminate\Support\Facades\DB;
  $notifications=  DB::table('notifications')->whereNull('read_at')->orderBy('created_at', 'DESC')->skip(0)->take(maximum_notify())->get();
  ?>
<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('Ecommerce') }}">{{ __('Website') }}</a>
        <!-- Form -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Order Submited ! </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" id="data-order">
               <div id="order-fullName">

                </div>
               <div id="order-Created-at">

                </div>
               <div id="order-time">

                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary"><a href="{{route("orders",'pending')}}" style="color: white"> Pending Orders </a>    </button>
            </div>
        </div>
        </div>
    </div>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="{{route("settings")}}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="{{route("home")}}" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" id="notify" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <div class="media-body ml-2 d-none d-lg-block">
                                <i class="ni ni-bell-55 " id="count_notify">
                                    {{count($notifications)}}
                                </i>

                        </div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
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
                                <a href="{{route("order.show",json_decode($notify->data)->id    )}}" class="dropdown-item">
                                    <object>
                                        <a href="{{route("notify_element",['notify'=>$notify->id])}}">
                                                <i class="ni ni-fat-remove text-red" style="font-size: 20px"></i>
                                        </a>
                                    </object>
                                    <span>{{json_decode($notify->data)->Name}}</span>,
                                    Created At <span>{{  \Carbon\Carbon::parse(json_decode($notify->data)->created_at)->timezone('Africa/Cairo')->format('h:i a ') }}</span>,
                                    Deliverd <span>{{ json_decode($notify->data)->Deliverd_After}}</span>
                                    <i class="ni ni-bold-right text-green"></i>
                                </a>
                            </div>
                        @endforeach
                    @endif


                </div>
            </li>

        </ul>
    </div>
</nav>

@push("js")
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('8c0041b384a6a51b30be', {
         cluster: 'eu'
        });

        var channel = pusher.subscribe('notify');
        channel.bind('send-order', function(data) {
            document.getElementById("order-fullName").innerHTML ="<strong>User Name </strong>"+JSON.parse(JSON.stringify(data['full_name']));
            document.getElementById("order-Created-at").innerHTML ="<strong>Created </strong> "+JSON.parse(JSON.stringify(data['time']));
            document.getElementById("order-time").innerHTML ="<strong> Supposed to Deliver </strong>"+JSON.parse(JSON.stringify(data['created_at']));
            document.getElementById("notify-submited").click();

        });
    </script>
@endpush
<!-- Button trigger modal -->
<button type="button" style="display: none"  id="notify-submited" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">

</button>
