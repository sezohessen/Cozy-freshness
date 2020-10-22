@include('users.layouts.header.header')
	<div class="page-content">
		<!-- Slider Revolution Section -->
		<section class="home-slider style-home-slider-hp-1">
        	<!-- the ID here will be used in the inline JavaScript below to initialize the slider -->
       		<div id="rev_slider_1" class="rev_slider fullscreenbanner" data-version="5.4.5">
	            <ul>
	                <!-- BEGIN SLIDE 1 -->
	                <li data-transition="boxslide">
	                    <!-- SLIDE'S MAIN BACKGROUND IMAGE -->
	                    <img src="{{asset('uploads/categories/'.$first_Slider->picture)}}" alt="{{asset($first_Slider->picture)}}" class="rev-slidebg">

	                    <!-- BEGIN LAYER -->
	                    <div class="tp-caption tp-resizeme slide-caption-title-1"
	                        data-frames='[{"delay":500,"speed":1000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"y:-20px;opacity:0;","ease":"Power3.easeInOut"}]'
                    		data-fontsize="['20', '25', '30', '35']"
                    		data-lineheight="['32', '35', '40', '45']"
                    		data-color="#d59f9f"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['center','center','center','center']"
	                        data-y="['middle','middle','middle','middle']"
	                        data-hoffset="['0', '0', '0', '0']"
							data-voffset="['-227', '-200', '-175', '-130']"
							data-width="['187', '250', '300', '350']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							BEST SELLERS
	                	</div>
	                    <div class="tp-caption tp-resizeme slide-caption-title-2"
	                        data-frames='[{"delay":1000,"speed":1000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"y:-20px;opacity:0;","ease":"Power3.easeInOut"}]'
	                        data-fontsize="['90', '90', '80', '80']"
	                        data-lineheight="['70', '70', '60', '60']"
							data-color="#fff"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['center','center','center','center']"
	                        data-y="['middle','middle','middle','middle']"
	                        data-hoffset="['0', '0', '0', '0']"
							data-voffset="['-140', '-117', '-110', '-90']"
							data-width="['1200', '850', '850', '800']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							<span>SOFA</span> COLLECTION
	                	</div>
	                	<div class="tp-caption tp-resizeme slide-caption-title-3"
	                        data-frames='[{"delay":0,"speed":300,"frame":"0","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
	                        data-fontsize="['80', '80', '80', '90']"
	                        data-lineheight="['60', '60', '50', '50']"
							data-color="['#666','#fff','#fff','#fff']"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['right','right','right','right']"
	                        data-y="['bottom','bottom','bottom','bottom']"
	                        data-hoffset="['27', '18', '18', '60']"
							data-voffset="['28', '30', '30', '30']"
							data-width="['250', '250', '300', '350']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							01
	                	</div>
	                	<div class="tp-caption tp-resizeme slide-caption-title-3"
	                        data-frames='[{"delay":0,"speed":300,"frame":"0","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
	                        data-fontsize="['13', '15', '20', '35']"
	                        data-lineheight="['32', '35', '40', '45']"
							data-color="['#666','#fff','#fff','#fff']"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['right','right','right','right']"
	                        data-y="['bottom','bottom','bottom','bottom']"
	                        data-hoffset="['14', '-23', '-20', '35']"
							data-voffset="['63', '56', '50', '37']"
							data-width="['187', '250', '300', '350']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							/
	                	</div>
	                	<div class="tp-caption tp-resizeme slide-caption-title-3"
	                        data-frames='[{"delay":0,"speed":300,"frame":"0","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
	                        data-fontsize="['20', '25', '30', '40']"
	                        data-lineheight="['32', '35', '40', '45']"
							data-color="['#666','#fff','#fff','#fff']"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['right','right','right','right']"
	                        data-y="['bottom','bottom','bottom','bottom']"
	                        data-hoffset="['-6', '-43', '-40', '15']"
							data-voffset="['63', '56', '50', '37']"
							data-width="['187', '250', '300', '350']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							03
	                	</div>
		          		<!-- END LAYER -->
	                </li>
	                <!-- END SLIDE 1 -->

					<!-- BEGIN SLIDE 2 -->
	                <li data-transition="boxslide">
	                    <!-- SLIDE'S MAIN BACKGROUND IMAGE -->
	                    <img src="{{asset('uploads/categories/'.$second_Slider->picture)}}" alt="{{asset($second_Slider->picture)}}" class="rev-slidebg">

	                    <!-- BEGIN LAYER -->
	                    <div class="tp-caption tp-resizeme slide-caption-title-1"
	                        data-frames='[{"delay":500,"speed":1000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"y:-20px;opacity:0;","ease":"Power3.easeInOut"}]'
                    		data-fontsize="['20', '25', '30', '35']"
                    		data-lineheight="['32', '35', '40', '45']"
                    		data-color="#3d4552"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['center','center','center','center']"
	                        data-y="['middle','middle','middle','middle']"
	                        data-hoffset="['0', '0', '0', '0']"
							data-voffset="['-227', '-200', '-175', '-130']"
							data-width="['187', '250', '300', '350']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							BEST SELLERS
	                	</div>
	                    <div class="tp-caption tp-resizeme slide-caption-title-2"
	                        data-frames='[{"delay":1000,"speed":1000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"y:-20px;opacity:0;","ease":"Power3.easeInOut"}]'
	                        data-fontsize="['90', '90', '80', '80']"
	                        data-lineheight="['70', '70', '60', '60']"
							data-color="#fff"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['center','center','center','center']"
	                        data-y="['middle','middle','middle','middle']"
	                        data-hoffset="['0', '0', '0', '0']"
							data-voffset="['-140', '-117', '-110', '-90']"
							data-width="['1200', '850', '850', '800']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							<span>SOFA</span> COLLECTION
	                	</div>
	                	<div class="tp-caption tp-resizeme slide-caption-title-3"
	                        data-frames='[{"delay":0,"speed":300,"frame":"0","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
	                        data-fontsize="['80', '80', '80', '90']"
	                        data-lineheight="['60', '60', '50', '50']"
							data-color="['#666','#fff','#fff','#fff']"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['right','right','right','right']"
	                        data-y="['bottom','bottom','bottom','bottom']"
	                        data-hoffset="['27', '27', '27', '60']"
							data-voffset="['28', '30', '30', '30']"
							data-width="['250', '250', '300', '350']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							02
	                	</div>
	                	<div class="tp-caption tp-resizeme slide-caption-title-3"
	                        data-frames='[{"delay":0,"speed":300,"frame":"0","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
	                        data-fontsize="['13', '15', '20', '35']"
	                        data-lineheight="['32', '35', '40', '45']"
							data-color="['#666','#fff','#fff','#fff']"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['right','right','right','right']"
	                        data-y="['bottom','bottom','bottom','bottom']"
	                        data-hoffset="['3', '-23', '-20', '32']"
							data-voffset="['63', '56', '50', '37']"
							data-width="['187', '250', '300', '350']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							/
	                	</div>
	                	<div class="tp-caption tp-resizeme slide-caption-title-3"
	                        data-frames='[{"delay":0,"speed":300,"frame":"0","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
	                        data-fontsize="['20', '25', '30', '40']"
	                        data-lineheight="['32', '35', '40', '45']"
							data-color="['#666','#fff','#fff','#fff']"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['right','right','right','right']"
	                        data-y="['bottom','bottom','bottom','bottom']"
	                        data-hoffset="['-17', '-43', '-40', '15']"
							data-voffset="['63', '56', '50', '37']"
							data-width="['187', '250', '300', '350']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							03
	                	</div>
		          		<!-- END LAYER -->
	                </li>
	                <!-- END SLIDE 2 -->

	                <!-- BEGIN SLIDE 3 -->
	                <li data-transition="boxslide">
	                    <!-- SLIDE'S MAIN BACKGROUND IMAGE -->
	                    <img src="{{asset('uploads/categories/'.$third_Slider->picture)}}" alt="{{asset('uploads/categories/'.$third_Slider->picture)}}" class="rev-slidebg">

	                    <!-- BEGIN LAYER -->
	                    <div class="tp-caption tp-resizeme slide-caption-title-1"
	                        data-frames='[{"delay":500,"speed":1000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"y:-20px;opacity:0;","ease":"Power3.easeInOut"}]'
                    		data-fontsize="['20', '25', '30', '35']"
                    		data-lineheight="['32', '35', '40', '45']"
                    		data-color="#3d4552"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['center','center','center','center']"
	                        data-y="['middle','middle','middle','middle']"
	                        data-hoffset="['0', '0', '0', '0']"
							data-voffset="['-227', '-200', '-175', '-130']"
							data-width="['187', '250', '300', '350']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							BEST SELLERS
	                	</div>
	                    <div class="tp-caption tp-resizeme slide-caption-title-2"
	                        data-frames='[{"delay":1000,"speed":1000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"y:-20px;opacity:0;","ease":"Power3.easeInOut"}]'
	                        data-fontsize="['90', '90', '80', '80']"
	                        data-lineheight="['70', '70', '60', '60']"
							data-color="#fff"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['center','center','center','center']"
	                        data-y="['middle','middle','middle','middle']"
	                        data-hoffset="['0', '0', '0', '0']"
							data-voffset="['-140', '-117', '-110', '-90']"
							data-width="['1200', '850', '850', '800']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							<span>SOFA</span> COLLECTION
	                	</div>
	                	<div class="tp-caption tp-resizeme slide-caption-title-3"
	                        data-frames='[{"delay":0,"speed":300,"frame":"0","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
	                        data-fontsize="['80', '80', '80', '90']"
	                        data-lineheight="['60', '60', '50', '50']"
							data-color="['#666','#fff','#fff','#fff']"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['right','right','right','right']"
	                        data-y="['bottom','bottom','bottom','bottom']"
	                        data-hoffset="['27', '27', '27', '60']"
							data-voffset="['28', '30', '30', '30']"
							data-width="['250', '250', '300', '350']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							03
	                	</div>
	                	<div class="tp-caption tp-resizeme slide-caption-title-3"
	                        data-frames='[{"delay":0,"speed":300,"frame":"0","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
	                        data-fontsize="['13', '15', '20', '35']"
	                        data-lineheight="['32', '35', '40', '45']"
							data-color="['#666','#fff','#fff','#fff']"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['right','right','right','right']"
	                        data-y="['bottom','bottom','bottom','bottom']"
	                        data-hoffset="['3', '-23', '-20', '32']"
							data-voffset="['63', '56', '50', '37']"
							data-width="['187', '250', '300', '350']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							/
	                	</div>
	                	<div class="tp-caption tp-resizeme slide-caption-title-3"
	                        data-frames='[{"delay":0,"speed":300,"frame":"0","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
	                        data-fontsize="['20', '25', '30', '40']"
	                        data-lineheight="['32', '35', '40', '45']"
							data-color="['#666','#fff','#fff','#fff']"
                    		data-textAlign="['center', 'center', 'center', 'center']"
	                        data-x="['right','right','right','right']"
	                        data-y="['bottom','bottom','bottom','bottom']"
	                        data-hoffset="['-17', '-43', '-40', '15']"
							data-voffset="['63', '56', '50', '37']"
							data-width="['187', '250', '300', '350']"
							data-whitespace="normal"
							data-basealign="slide"
							data-responsive_offset="off" >
							03
	                	</div>
		          		<!-- END LAYER -->
	                </li>
	                <!-- END SLIDE 3 -->
	            </ul>
			</div>
		</section>
		<!-- End Slider Revolution Section -->

		<!-- Categories Section -->
		<section class="categories-hp-1 section-box">
			<div class="container">
				<div class="categories-content">
					<div class="row">
						<!-- Categories 1 -->
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="categories-detail">
								<a href="{{route('shop.category',['id' => $first_Slider->id,'slug' => str_slug($first_Slider->name)])}}" class="images">
                                    <img src="{{asset('uploads/categories/'.$first_Slider->picture)}}" alt="{{$first_Slider->name}}">
                                </a>
								<div class="product">
									<a href="{{route('shop.category',['id' => $first_Slider->id,'slug' => str_slug($first_Slider->name)])}}">
										<span class="name">
											<span class="line">- </span>
											{{$first_Slider->name}}
										</span>
										<span class="quantity">- {{$first_Slider->products->count()}} Products</span>
									</a>
								</div>
							</div>
						</div>
						<!-- Categories 2 -->
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="categories-detail">
								<a href="{{route('shop.category',['id' => $second_Slider->id,'slug' => str_slug($second_Slider->name)])}}" class="images">
                                    <img src="{{asset('uploads/categories/'.$second_Slider->picture)}}" alt="{{$second_Slider->name}}">
                                </a>
								<div class="product">
									<a href="{{route('shop.category',['id' => $second_Slider->id,'slug' => str_slug($second_Slider->name)])}}">
										<span class="name">
											<span class="line">- </span>
											{{$second_Slider->name}}
										</span>
										<span class="quantity">- {{$second_Slider->products->count()}} Products</span>
									</a>
								</div>
							</div>
						</div>
						<!-- Categories 3 -->
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="categories-detail">
								<a href="{{route('shop.category',['id' => $third_Slider->id,'slug' => str_slug($third_Slider->name)])}}" class="images">
                                    <img src="{{asset('uploads/categories/'.$third_Slider->picture)}}" alt="{{$third_Slider->name}}">
                                </a>
								<div class="product">
									<a href="{{route('shop.category',['id' => $third_Slider->id,'slug' => str_slug($third_Slider->name)])}}">
										<span class="name">
											<span class="line">- </span>
											{{$third_Slider->name}}
										</span>
										<span class="quantity">- {{$third_Slider->products->count()}} Products</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Categories Section -->


		<!-- Banner Section -->
		<section class="banner-hp-1 section-box">
			<div class="container">
				<div class="banner-content">
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-4 cl-sm-12 col-12">
							<div class="banner-left">
								<a href="#" class="bg-image">
									<img src="images/hp-1-banner-1.jpg" alt="banner">
								</a>
								<div class="info">
									<a href="#" class="sale">SALE UP TO</a>
									<span>50% OFF</span>
									<a href="shop-full-width.html" class="shop">Shop Now<i class="zmdi zmdi-arrow-right"></i></a>
								</div>
							</div>
						</div>
						<div class="col-xl-8 col-lg-8 col-md-8 cl-sm-12 col-12">
							<div class="banner-right">
								<a href="#" class="bg-image">
									<img src="images/hp-1-banner-2.jpg" alt="banner">
								</a>
								<div class="info">
									<p class="text-1">Get <span>30%</span> Off</p>
									<p class="text-2">on Elisa Armchair collection</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Banner Section -->

		<!-- Testimonials Section -->
		<section class="testimonials-hp-1">
			<div class="container-fluid">
				<div class="testimonials-content">
					<div id="testimonials-hp-1" class="owl-carousel owl-theme">
						<!-- Item 1 -->
						<div class="item">
							<div class="row">
								<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 left-block">
									<div class="images">
										<img src="images/hp-1-testimonials-1.png" alt="testimonials">
									</div>
								</div>
								<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 right-block">
									<div class="testimonials-detail">
										<i class="zmdi zmdi-quote"></i>

									</div>
								</div>
							</div>
						</div>
						<!-- Item 2 -->
						<div class="item">
							<div class="row">
								<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 left-block left-block-2">
									<div class="images">
										<img src="images/hp-1-testimonials-2.png" alt="testimonials">
									</div>
								</div>
								<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 right-block">
									<div class="testimonials-detail">
										<i class="zmdi zmdi-quote"></i>
										<p>I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born.</p>
										<h5>Anna Taylor</h5>
										<span>- Designer -</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Testimonials Section -->

		<!-- Insta Follow Section -->
		<section class="insta-hp-1 section-box">
			<div class="container">
				<div class="insta-content">
					<h2>Follow Instagram</h2>
					<span>@Novas.InteriorDesign</span>
					<div class="row">
						<!-- Insta 1 -->
						<div class="col">
							<div class="insta-detail">
								<a href="https://www.instagram.com/" class="insta-image">
									<img src="images/hp-1-ig-1.jpg" alt="insta-1">
									<div class="overlay"></div>
								</a>
							</div>
						</div>
						<!-- Insta 2 -->
						<div class="col">
							<div class="insta-detail">
								<a href="#" class="insta-image">
									<img src="images/hp-1-ig-2.jpg" alt="insta-2">
									<div class="overlay"></div>
								</a>
							</div>
						</div>
						<!-- Insta 3 -->
						<div class="col">
							<div class="insta-detail">
								<a href="#" class="insta-image">
									<img src="images/hp-1-ig-3.jpg" alt="insta-3">
									<div class="overlay"></div>
								</a>
							</div>
						</div>
						<!-- Insta 4 -->
						<div class="col">
							<div class="insta-detail">
								<a href="#" class="insta-image">
									<img src="images/hp-1-ig-4.jpg" alt="insta-4">
									<div class="overlay"></div>
								</a>
							</div>
						</div>
						<!-- Insta 5 -->
						<div class="col">
							<div class="insta-detail">
								<a href="#" class="insta-image">
									<img src="images/hp-1-ig-5.jpg" alt="insta-5">
									<div class="overlay"></div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Insta Follow Section -->
	</div>
@include('users.layouts.footer.footer')
