@extends('layouts.app', ['title' => __('User Management')])

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ $status }} {{ __('Orders') }}</h3>
                            </div>
                            <div class="col-4">
                                <form action="" method="get">
                                    @csrf
                                    <select class="custom-select" name="order" id="" style="width:70%">
                                        @if ($today==1)
                                            <option value="today" selected>Today</option>
                                        @else
                                            <option value="today">Today</option>
                                        @endif

                                        @if ($week==1)
                                            <option value="week" selected>Last week</option>
                                        @else
                                            <option value="week">Last week</option>
                                        @endif

                                        @if ($month==1)
                                            <option value="month" selected>Last month</option>
                                        @else
                                            <option value="month">Last month</option>
                                        @endif
                                        
                                        @if ($all==1)
                                            <option value="all" selected>All</option>
                                        @else
                                            <option value="all">All</option>
                                        @endif
                                    </select>
                                    <button class="btn btn-dark">GO ></button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('done'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('done') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        @if ($orders->count())
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">{{ __('User Name') }}</th>
                                    <th scope="col">{{ __('Time') }}</th>
                                    <th scope="col">{{ __('Needed') }}</th>
                                    <th scope="col">{{ __('Price') }}</th>
                                    <th scope="col">{{ __('Location') }}</th>
                                    <th scope="col">{{ __('Phone') }}</th>
                                    <th scope="col">{{ __('Change Status') }}</th>
                                    @if ($status != 'delivered' && $status != 'canceled')
                                    <th scope="col"></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td style="padding: 0;text-align:center">
                                            <p>
                                                <a href="{{ route('order.show',$order->id) }}" class="bg-info" style="border-radius: 100%;padding:3px 10px;">
                                                    <i class="fa fa-info text-white"></i>
                                                </a>
                                            </p>
                                        </td>
                                        <td>
                                            <p>{{ $order->user->name }}</p>
                                        </td>
                                        <td>
                                            @if ($status == 'pending')
                                                {{ Carbon\Carbon::parse($order->pending)->format('h:i A') }}
                                            @elseif($status == 'delivered')
                                                {{ Carbon\Carbon::parse($order->pending)->format('h:i A') }}
                                            @else
                                                {{ $order->updated_at->format('h:i A') }}
                                            @endif
                                        </td>
                                        <td>
                                            <p>{{ $order->time }}</p>
                                        </td>
                                        <td>
                                            <p style="margin: 0">{{ $order->total }}$</p>
                                        </td>
                                        <td>
                                            <p>{{ $order->location }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $order->phone }}</p>
                                        </td>
                                        <td>
                                            @if ($status == 'pending')
                                            <form action="{{ route('order.delivered',['id' => $order->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    {{ __('delivered') }}<i class="fa fa-check"></i>
                                                </button>
                                            </form>
                                            @else
                                            <form action="{{ route('order.delete',['id' => $order->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                            @endif
                                        </td>
                                        @if ($order->status!='delivered' && $order->status!='canceled')
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('order.canceled', ['id' => $order->id]) }}"
                                                    onclick="return confirm('Are you sure?')">{{ __('cancel') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="text-center" style="margin: 50px 0 ">
                                <h1>There is no orders to be showen </h1>
                            </div>
                        @endif
                    </div>
                    <div class="navigation pagination">
                        <div class="page-numbers">
                            {{ $orders->appends(Request::only(['order']))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
