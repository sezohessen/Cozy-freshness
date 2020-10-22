<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                <a href="{{ route('users.index') }}"><h5 class="card-title text-uppercase text-muted mb-0">Users</h5></a>
                                    <span class="h2 font-weight-bold mb-0">{{$users->count()}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                <a href="{{route('categories')}}"><h5 class="card-title text-uppercase text-muted mb-0">Categories</h5></a>
                                    <span class="h2 font-weight-bold mb-0">{{$categories->count()}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="{{route('products')}}"><h5 class="card-title text-uppercase text-muted mb-0">Products</h5></a>
                                    <span class="h2 font-weight-bold mb-0">{{$products->count()}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 ">
                    <div class="card card-stats mt-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Orders</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{ route('orders',['status'=>'pending']) }}" style="display:block">
                                                Pending :<strong>{{ $pending->count() }}</strong>
                                            </a>
                                            <a href="{{ route('orders',['status'=>'shipped']) }}" style="display:block">
                                                Shipped :<strong>{{ $shipped->count() }}</strong>
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ route('orders',['status'=>'delivered']) }}" style="display:block">
                                                Delivered :<strong>{{ $deliverd->count() }}</strong>
                                            </a>
                                            <a href="{{ route('orders',['status'=>'canceled']) }}" style="display:block">
                                                canceled :<strong>{{ $canceled->count() }}</strong>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-dark text-white rounded-circle shadow">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
