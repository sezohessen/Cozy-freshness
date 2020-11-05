@include('users.layouts.header.header')
	<div class="page-content">
		<!-- Slider Revolution Section -->
		<section class="home-slider style-home-slider-hp-1">
        	<!-- the ID here will be used in the inline JavaScript below to initialize the slider -->
       		<div id="rev_slider_1" class="rev_slider fullscreenbanner" data-version="5.4.5">
	            <ul>
                    @foreach($MainCat as $cat)
	                <!-- BEGIN SLIDE 1 -->
	                <li data-transition="boxslide">
	                    <!-- SLIDE'S MAIN BACKGROUND IMAGE -->
	                    <img src="{{Storage::url($cat->picture)}}" alt="{{asset($cat->picture)}}" class="rev-slidebg">

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
							{{ App\Setting::orderBy('id', 'DESC')->get()->first()->appname}}
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
							{{$cat->name}}
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
                    @endforeach
	            </ul>
			</div>
		</section>
		<!-- End Slider Revolution Section -->

		<!-- Categories Section -->
		<section class="categories-hp-1 section-box">
			<div class="container">
				<div class="categories-content">
					<div class="row">
                        @foreach($MainCat as $cat)
                        <!-- Categories 1 -->
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="categories-detail">
								<a href="{{route('shop.category',['id' => $cat->id,'slug' => str_slug($cat->name)])}}" class="images">
                                    <img src="{{ Storage::url($cat->picture)}}" alt="{{$cat->name}}">
                                </a>
								<div class="product">
									<a href="{{route('shop.category',['id' => $cat->id,'slug' => str_slug($cat->name)])}}">
										<span class="name">
											<span class="line">- </span>
											{{$cat->name}}
										</span>
										<span class="quantity">- {{$cat->products->count()}} Products</span>
									</a>
								</div>
							</div>
						</div>
                        @endforeach
					</div>
				</div>
			</div>
		</section>
		<!-- End Categories Section -->


	</div>
@include('users.layouts.footer.footer')
