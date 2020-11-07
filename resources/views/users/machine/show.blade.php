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
	<div class="page-content">
		<!-- Shop Section -->
		<section class="featured-hp-1 items-hp-6 shop-full-page shop-right-siderbar">
			<div class="container">
				<div class="featured-content woocommerce" style="padding:20px">
					<div class="row">
						<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
							<div class="widget-area">
								<!-- Search -->
								<div class="widget widget_search">
                                    <form class="search-form" method="get" role="search">
                                        <input type="text" hidden name="order" value="{{app('request')->input('order')}}">
										<input type="search" name="search" class="search-field" placeholder="Search..." value="{{ app('request')->input('search') }}">
										<button class="search-submit" type="submit">
											<i class="zmdi zmdi-search"></i>
										</button>
									</form>
								</div>
								<!-- Categories -->
								<div class="widget widget_product_categories">
									<h3 class="widget-title">Categories</h3>
									<ul class="product-categories">
                                        <li class="cat-item cat-parent">
                                            <a href="{{route("shop")}}"class="Category_name">
                                                <span>All </span>
                                            </a>
                                        </li>
                                        @foreach ($categories as $category)
                                            <li class="cat-item cat-parent">
                                                <a href="{{route('shop.category', ['id' => $category->id, 'slug' => str_slug($category->name),'mac'=> 1])}}" class="Category_name">
                                                    <span>{{$category->name}}</span>
                                                </a>
                                                <a href="#"><span>({{$category->products->where('active','1')->count()}})</span></a>
                                            </li>
                                        @endforeach
									</ul>
								</div>
								<!-- Banner -->
							</div>
						</div>
						<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
							<div class="content-area">
                                @if ($products->count())
								<div class="storefront-sorting">
									<p class="woocommerce-result-count">Showing 1 – {{$products->count()}} of {{$all_product->count()}} results</p>
                                    <form class="woocommerce-ordering" method="get">
                                        @csrf
                                        <input type="text" name="search" hidden value="{{app('request')->input('search')}}">
										<select name="order" class="orderby" id="SaveSelectionOrder">
                                            <option value="newest" selected="selected">Sort by newness</option>
											<option value="asc">Sort by price: low to high</option>
                                            <option value="desc">Sort by price: high to low</option>
										</select>
                                        <button class="btn btn-dark">GO ></button>
									</form>
                                </div>
								<div class="row">
                                    @foreach ($products as $product)
                                    <!-- Product -->
                                    <div class="col-md-4 col-lg-3">
                                        <div class="product type-product">
                                            <div class="woocommerce-LoopProduct-link">
                                                <div class="product-image"  style="cursor:pointer">
                                                    <div class="wp-post-image"  >
                                                        <img class="image-cover" src="{{Storage::url($product->pictures[0]->picture)}}" alt="{{$product->name}}">
                                                        @if (isset($product->pictures[1]->picture))
                                                            <img class="image-secondary" src="{{Storage::url($product->pictures[1]->picture)}}" alt="{{$product->name}}">
                                                        @endif
                                                    </div>
                                                    @if ($product->quantity==0||$product->quantity==NULL)
                                                        <a href="#" class="onsale">
                                                            Sale
                                                        </a>
                                                    @endif
                                                    @if ($product->discount!=0||$product->discount!=NULL)
                                                        <a href="#" class="onnew"  style="top: 55px">{{$product->discount}}%</a>
                                                    @endif
                                                    <div class="card-body">
                                                        <p class="woocommerce-loop-product__title">
                                                            <strong>
                                                                {{$product->name}}
                                                            </strong>
                                                            <br>
                                                            {{$product->description}}
                                                        </p>
                                                        <span class="price">
                                                            @if ($product->discount!=0||$product->discount!=NULL)
                                                                <ins>
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        {{$product->price - (($product->price * $product->discount)/100)}}
                                                                        <span class="woocommerce-Price-currencySymbol">L.E</span>
                                                                    </span>
                                                                </ins>
                                                                <del>
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        {{$product->price}}
                                                                        <span class="woocommerce-Price-currencySymbol">L.E</span>
                                                                    </span>
                                                                </del>
                                                            @else
                                                                <ins>
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        {{$product->price}}
                                                                        <span class="woocommerce-Price-currencySymbol">L.E</span>
                                                                    </span>
                                                                </ins>
                                                            @endif
                                                        </span>
                                                        @if ($product->quantity==0||$product->quantity==NULL)
                                                            <strong class="out-stock">Out of stock</strong>
                                                        @else
                                                            <div class="button add_to_cart_button">
                                                                <form method="POST" action="{{ route('machine.add',['id' => $product->id]) }}">
                                                                    @csrf
                                                                    <input type="number" name="quantity" id="quantity" value="1" hidden>
                                                                    <input type="machine" name="machine" id="machine" value="machine" hidden>
                                                                    <button type="submit" class="btn btn-dark">Add to Cart</button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                                @else
                                    <h1><strong>No Products to show</strong></h1>
                                @endif
                            </div>
							<div class="navigation pagination">
								<div class="page-numbers">
                                    {{ $products->appends(Request::only(['search', 'order', 'page']))->links() }}

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Shop Section -->
    </div>
    <a href="#" id="back-to-top"></a>
    <!--  JS  -->
    <!-- Jquery -->
    <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendor/bootrap/js/bootstrap.min.js')}}"></script>
    <!-- Waypoints Library -->
    <script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
    <!-- Owl Carousel 2 -->
      <script src="{{asset('vendor/owl/js/owl.carousel.min.js')}}"></script>
      <script src="{{asset('vendor/owl/js/OwlCarousel2Thumbs.min.js')}}"></script>
      <!-- Slider Revolution core JavaScript files -->
    <script src="{{asset('vendor/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
    <script src="{{asset('vendor/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
    <!-- Isotope Library-->
    <script type="text/javascript" src="{{asset('js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('js/imagesloaded.pkgd.min.js')}}"></script>
    <!-- Masonry Library -->
    <script type="text/javascript" src="{{asset('js/jquery.masonry.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/masonry.pkgd.min.js')}}"></script>
    <!-- fancybox-master Library -->
    <script type="text/javascript" src="{{asset('vendor/fancybox-master/js/jquery.fancybox.min.js')}}"></script>
    <!-- Google Map -->
    <script src="{{asset('js/theme-map.js')}}"></script>
    <!-- Countdown Library -->
    <script src="{{asset('vendor/countdown/jquery.countdown.min.js')}}"></script>
    <!-- Audio Library-->
    <script src="{{asset('vendor/mejs/mediaelement-and-player.min.js')}}"></script>
    <!-- noUiSlider Library -->
    <script type="text/javascript" src="{{asset('vendor/nouislider/js/nouislider.js')}}"></script>
    <!-- Form -->
    <script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/config-contact.js')}}"></script>
    <!-- Main Js -->
    <script src="{{asset('js/custom.js')}}"></script>
    </body>
    </html>
