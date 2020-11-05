<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Needs
	================================================== -->
	<meta charset="utf-8">
	<title>{{ $title ?? "Cozy" }}</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Mobile Specific Metas
  	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Favicon
  	================================================== -->
  	<link rel="shortcut icon" href="{{asset('favicon.png')}}" />
  	<!-- Font
  ================================================== -->
  	<link rel="stylesheet" type="text/css" href="{{asset('fonts/material-design-iconic-font/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/linearicons/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/poppins-font.css')}}">
	<!-- CSS
  ================================================== -->
	<!-- Bootrap -->
    <link rel="stylesheet" href="{{asset('vendor/bootrap/css/bootstrap.min.css')}}"/>
	<!-- Owl Carousel 2 -->
	<link rel="stylesheet" href="{{asset('vendor/owl/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('vendor/owl/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/owl/css/animate.css')}}">
    {{-- Fontawesome --}}
    <link rel="stylesheet" href="{{asset('vendor/fontawesome/fontawesome.min.css')}}"/>
    <!-- Slider Revolution CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/revolution/css/settings.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/revolution/css/layers.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/revolution/css/navigation.css')}}">
    <!-- fancybox-master Library -->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/fancybox-master/css/jquery.fancybox.min.css')}}">
    <!-- Audio Library-->
    <link rel="stylesheet" href="{{asset('vendor/mejs/mediaelementplayer.css')}}">
    <!-- noUiSlider Library -->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/nouislider/css/nouislider.css')}}">
    <!-- Main Style Css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}"/>
</head>
<?php     $setting = App\Setting::orderBy('id', 'DESC')->get()->first();?>
<body class="homepages-1">
	<!-- Images Loader -->
	<div class="images-preloader">
	    <div id="preloader_1" class="rectangle-bounce">
	        <span></span>
	        <span></span>
	        <span></span>
	        <span></span>
	        <span></span>
	    </div>
	</div>
	<header class="header">
		<!-- Show Desktop Header -->
		<div class="show-desktop-header header-hp-1 style-header-hp-1">
			<div id="js-navbar-fixed" class="menu-desktop">
				<div class="container-fluid">
					<div class="menu-desktop-inner">
						<!-- Logo -->
						<div class="logo">
                            <a href="{{route("Ecommerce")}}"><img src="{{isset($setting->logo) ? Storage::url($setting->logo) : asset('Constant_Images/Cozy.png')}}" alt="logo"
                                width="60" height="60" style="border-radius: 50%">
                                &nbsp;
                                <span  class="logo-brand-span">
                                    {{$setting->appname ?? "Cozy"}}
                                </span>
                            </a>
						</div>
						<!-- Main Menu -->
						<nav class="main-menu">
							<ul>
								<li class="menu-item">
									<a href="{{route('Ecommerce')}}" class="current">
									Home
									</a>
								</li>
								<li class="menu-item">
									<a href="{{route('shop')}}" class="Category_name">
									Menu | Shop
									</a>
									<ul class="sub-menu">
                                        @foreach ($categories as $category)
                                            <li>
                                                <a href="{{route('shop.category',['id' => $category->id,'slug' => str_slug($category->name)])}}" class="Category_name">
                                                        {{$category->name}} ({{$category->products->where('active','1')->count()}})
                                                </a>
                                            </li>
                                        @endforeach
                                        <li>
                                            <a href="{{ route('shop') }}">More</a>
                                        </li>
									</ul>
								</li>
								<li class="menu-item mega-menu">
									<a href="{{route('shop.cart')}}">
									Cart
									</a>
                                </li>
                                <li class="menu-item">
                                    @if (Auth::user())
                                        <a href="{{route('shop')}}" >
                                            {{ Auth::user()->name }}
                                        </a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="{{ route('profile.edit') }}">Account Settings</a>
                                            </li>
                                            <li>
                                                <form  id="form1" action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                   <a href="javascript:;" onclick="document.getElementById('form1').submit();">{{__("Logout")}}</a>
                                                </form>
                                            </li>
                                        </ul>
                                    @else
                                        <p>Login | Sign Up<i class="fa fa-arrow-bottom"></i></p>
                                        <ul class="sub-menu user">
                                           <li style="padding:0px 7px;">
                                            <button class="login btn btn-xs btn-primary "><a href="{{route('login')}}">Login</a></button>
                                            <p>Don't have account ?</p>
                                            <button class="login btn btn-xs btn-primary "><a   href="{{ route('register') }}">Sign Up</a></button>
                                           </li>
                                        </ul>
                                    @endif
								</li>
							</ul>
						</nav>
						<!-- Header Right -->
						<div class="header-right">
							<!-- Cart -->
							<div class="site-header-cart">
								<div class="cart-contents">
                                    <span>
                                        @if ((session('cart')))
                                            {{ count((array) session('cart')) }}
                                        @endif
                                    </span>
                                    <img src="{{asset('images/icons/shopping-cart-black-icon.png')}}" alt="cart">
								</div>
								<div class="widget_shopping_cart">
									<div class="widget_shopping_cart_content">
                                        @if (session('cart'))
										<ul class="woocommerce-mini-cart cart_list product_list_widget ">
                                            <?php $total = 0 ?>
                                            @foreach (session('cart') as $id => $cart_info)
                                            <?php
                                            $product = App\Product::find($id);
                                            $price   = $product->price - (($product->price * $product->discount)/100);
                                            $total  += $price * $cart_info['quantity'];
                                            ?>
                                            <li class="woocommerce-mini-cart-item mini_cart_item clearfix">
												<a class="product-image" href="#">
                                                    <img src="{{ Storage::url($product->pictures[0]->picture)}}" alt="cart-1">
												</a>
												<a class="product-title" href="#">{{ $product->name }}</a>
												<span class="quantity">
													{{ $cart_info['quantity'] }} ×
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														{{ $price }}
													</span>
												</span>
												<a href="{{ route('cart.remove',['id'=>$id]) }}" class="remove">
													<span class="lnr lnr-cross"></span>
												</a>
											</li>
                                            @endforeach
										</ul>

										<p class="woocommerce-mini-cart__total total">
											<span>Subtotal:</span>
											<span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">$</span>

												{{ $total }}
											</span>
										</p>
										<p class="woocommerce-mini-cart__buttons buttons">
											<a href="{{ route('shop.cart') }}" class="button wc-forward au-btn btn-small">View Cart</a>
											<a href="{{ route('cart.checkOut') }}" class="button checkout wc-forward au-btn au-btn-black btn-small">Checkout</a>
                                        </p>
                                        @else
                                        <strong>No products yet</strong>
                                        @endif
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>
		<!-- Show Mobile Header -->
		<div  id="js-navbar-mb-fixed" class="show-mobile-header">
			<!-- Logo And Hamburger Button -->
			<div class="mobile-top-header">
				<div class="logo-mobile">
					<a href="{{ route('Ecommerce') }}"><img src="{{asset('images/icons/logo-black.png')}}" alt="logo"></a>
				</div>
				<button class="hamburger hamburger--spin hidden-tablet-landscape-up" id="toggle-icon">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>
			<!-- Au Navbar Menu -->
			<div class="au-navbar-mobile navbar-mobile-1">
				<div class="au-navbar-menu">
					<ul>
                        <li class="menu-item">
                            <a href="{{route('Ecommerce')}}" class="current">
                            HOME
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('shop')}}" class="Category_name">
                            Menu | Shop
                            </a>
                            <ul class="sub-menu">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{route('shop.category',['id' => $category->id,'slug' => str_slug($category->name)])}}" class="Category_name">
                                                {{$category->name}} ({{$category->products->where('active','1')->count()}})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="menu-item mega-menu">
                            <a href="{{route('shop.cart')}}">
                            Cart
                            </a>
                        </li>
                        <li class="menu-item">
                            @if (Auth::user())
                                <i class="fas fa-angle-down"></i>
                                <a href="{{route('shop')}}" >
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('profile.edit') }}">Account Settings</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <a href="{{ route('logout') }}"><button type="submit" class="btn logout">logout</button></a>
                                        </form>

                                    </li>
                                </ul>
                            @else
                                <ul class="sub-menu user">
                                   <li style="padding:0px 7px;">
                                   <a href="{{route('login')}}">Login</a>
                                    <a href="{{ route('register') }}">Sign Up</a>
                                   </li>
                                </ul>
                            @endif
                        </li>
                    </ul>
				</div>
			</div>
		</div>
	</header>
