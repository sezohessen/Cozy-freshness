
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
<div class="page-content">
    <!-- Shop Cart Section -->
@if(session('machine'))
    <section class="shop-cart-section section-box">
        <div class="woocommerce">
            <div class="container">
                <div class="entry-content">
                    @if (session('status'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (session('notfound'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('notfound') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (session('leakquantity'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('leakquantity') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div  class="woocommerce-cart-form">
                        @csrf
                        <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                            <thead>
                                <tr>
                                    <th class="product-remove"></th>
                                    <th class="product-name">Product</th>
                                    <th class="product-name">Code</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $total = 0 ?>
                                @foreach(session('machine') as $id => $cart_info)
                                <?php
                                $product = App\Product::find($id);
                                $price   = $product->price - (($product->price * $product->discount)/100);
                                $total  += $price * $cart_info['quantity'];
                                ?>
                                    @if (!$product)
                                        <?php
                                        if(isset($cart_info[$id])) {
                                            unset($cart_info[$id]);
                                            session()->put('machine', $cart_info);
                                        }
                                        ?>
                                        @continue
                                    @endif
                                <tr class="woocommerce-cart-form__cart-item cart_item">
                                    <td class="product-remove">
                                        <a href="{{ route('machine.remove',['id'=>$id]) }}" class="remove">
                                           <i class="zmdi zmdi-close"></i>
                                        </a>
                                    </td>
                                    <td class="product-name" data-title="Product" style="width: 230px">
                                        <a href="{{ route('shop.product',['id' =>$id ,'slug' =>str_slug($product->name)]) }}">
                                            <img src="{{ Storage::url($product->pictures[0]->picture)  }}" alt="product">
                                        </a>
                                        <a href="{{ route('shop.product',['id' =>$id ,'slug' =>str_slug($product->name)]) }}">
                                            {{ $product->name }}
                                        </a>
                                    </td>
                                    <td class="product-price" data-title="Price">
                                        <span class="woocommerce-Price-amount amount">
                                            {{ $product->code }}
                                        </span>
                                    </td>
                                    <td class="product-price" data-title="Price">
                                        <span class="woocommerce-Price-amount amount">
                                            {{ $price }}
                                            <span class="woocommerce-Price-currencySymbol">L.E</span>
                                        </span>
                                    </td>
                                    <td class="product-quantity" data-title="Quantity">
                                        <span>{{ $cart_info['quantity'] }}</span>
                                    </td>
                                    <td class="product-subtotal" data-title="Total">
                                        <span class="woocommerce-Price-amount amount">
                                            {{  $price * $cart_info['quantity'] }}
                                            <span class="woocommerce-Price-currencySymbol">L.E</span>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-collaterals">
                        <div class="cart_totals">
                            <h2>Cart totals</h2>
                            <table class="shop_table shop_table_responsive">
                                <tbody>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td data-title="Total">
                                            <span class="woocommerce-Price-amount amount">
                                                {{ $total }}
                                                <span class="woocommerce-Price-currencySymbol">L.E</span>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="wc-proceed-to-checkout">
                                <a href="{{ route('machine',1)}}" class="button au-btn btn-small">Done <span><i class="zmdi zmdi-arrow-right"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
@if (session('not_available'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('not_available') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="text-center" style="margin: 100px auto">
    <h4>There is not cart items to show </h4>
    <a href="{{ route('machine') }}"> <button class="btn btn-primary">Back To Shopping</button></a>
</div>

@endif
    <!-- End Shop Cart Section -->

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

