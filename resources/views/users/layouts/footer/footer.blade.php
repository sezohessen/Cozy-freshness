<?php     $setting = App\Setting::orderBy('id', 'DESC')->get()->first();?>
<footer class="footer-section section-box">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="footer-items">
                        <div class="logo">
                            <a href="{{route("Ecommerce")}}"><img src="{{ isset($setting->logo)? Storage::url($setting->logo):  asset("Constant_Images/Cozy.png")}}" alt="logo" width="150" ></a>
                        </div>
                        <p>{{$setting->description ?? "Cozy Delivery Work Shop"}}</p>
                        <div class="socials">
                            @if(isset($setting->facebook))
                                <a href="{{$setting->facebook}}"><i class="zmdi zmdi-facebook"></i></a>
                            @endif
                            @if(isset($setting->instagram))
                                <a href="{{$setting->instagram}}"><i class="zmdi zmdi-instagram"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                @if(isset($setting->whatsapp) || isset($setting->mail) || isset($setting->address))
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="footer-items footer-items-1">
                            <h4>Contact</h4>
                            @if(isset($setting->address))
                                <div class="contact">
                                    <i class="zmdi zmdi-map"></i>
                                    <span>{{$setting->address}}</span>
                                </div>
                            @endif
                            @if(isset($setting->whatsapp))
                                <div class="contact">
                                    <i class="zmdi zmdi-phone"></i>
                                    <span><a href="tel:{{$setting->whatsapp}}">+ (20){{$setting->whatsapp}}</a></span>
                                </div>
                            @endif
                            @if(isset($setting->mail))
                                <div class="contact">
                                    <i class="zmdi zmdi-email"></i>
                                    <span>{{$setting->mail}}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="footer-items footer-items-2">
                        <h4>Profile</h4>
                        <div class="profile">
                            <i class="zmdi zmdi-account"></i>
                            <span><a href="{{route("profile.edit")}}">My Account</a></span>
                        </div>
                        <div class="profile">
                            <i class="zmdi zmdi-shopping-cart"></i>
                            <span><a href="{{route("shop.cart")}}">Checkout</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

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
