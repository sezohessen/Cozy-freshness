@include('users.layouts.header.header')

	<div class="page-content">
		<!-- Breadcrumb Section -->
        <section class="breadcrumb-contact-us breadcrumb-section section-box"
        @if (isset($category_info))
            style="background-image: url({{asset('uploads/categories/'.$category_info->picture)}})"
        @else
            style="background-image: url({{asset('images/shop-bc.jpg')}})"
        @endif
        >
			<div class="container">
				<div class="breadcrumb-inner">
					<h1>
                        @if (isset($category_info))
                            {{$category_info->name}}
                        @else
                            Shop
                        @endif
                    </h1>
					<ul class="breadcrumbs">
                        <li><a class="breadcrumbs-1" href="{{route('Ecommerce')}}">Home</a></li>
                        <li>
                            @if (isset($category_info))
                            {{$category_info->name}}
                            @else
                                Shop
                            @endif
                        </li>
                    </ul>
                    <p>
                        @if (isset($category_info))
                        {{$category_info->description}}
                        @else
                            Shop
                        @endif
                    </p>
				</div>
			</div>
		</section>
		<!-- End Breadcrumb Section -->

		<!-- Shop Section -->
		<section class="featured-hp-1 items-hp-6 shop-full-page shop-right-siderbar">
			<div class="container">
				<div class="featured-content woocommerce">
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
								<!-- Filter -->
								<div class="widget_price_filter">
									<h3 class="widget-title">Filter By Price</h3>
									<form method="POST">
	                                    <div class="price_slider_wrapper">
	                                        <div class="price_slider ui-slider ui-slider-horizontal">
	                                            <div id="slider-margin"></div>
	                                        </div>
	                                        <div class="price_slider_amount">
	                                            <div class="price_label">
	                                                Price:
	                                                <span class="from" id="value-lower">1</span>
	                                                -
	                                                <span class="to" id="value-upper">1000</span>
	                                            </div>
	                                            <button type="submit" class="button au-btn-black btn-small">Filter</button>
	                                        </div>
	                                    </div>
	                                </form>
								</div>
								<!-- Categories -->
								<div class="widget widget_product_categories">
									<h3 class="widget-title">Categories</h3>
									<ul class="product-categories">
                                        @foreach ($categories as $category)
                                            <li class="cat-item cat-parent">
                                                <a href="{{route('shop.category', ['id' => $category->id, 'slug' => str_slug($category->name)])}}" class="Category_name">
                                                    <span>{{$category->name}}</span>
                                                </a>
                                                <a href="#"><span>({{$category->products->where('active','1')->count()}})</span></a>
                                            </li>
                                        @endforeach
									</ul>
								</div>
								<!-- Banner -->
								<div class="widgets widget_banner">
									<img src="{{asset('images/widget_banner.jpg')}}" alt="banner">
									<div class="widget_banner-content">
										<span>ON SALE</span>
										<p>Awa Pendant Lamp</p>
										<a href="shop-full-width.html">Shop Now<i class="zmdi zmdi-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
							<div class="content-area">
                                @if ($products->count())
								<div class="storefront-sorting">
									<p class="woocommerce-result-count">Showing 1 – {{$products->count()}} of {{$all_product->count()}} results</p>
                                    <form class="woocommerce-ordering" method="get">
                                        <input type="text" name="search" hidden value="{{app('request')->input('search')}}">
										<select name="order" class="orderby" id="SaveSelectionOrder">
											<option value="popularity">Sort by popularity</option>
											<option value="rating">Sort by average rating</option>
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
                                    <div class="col-4">
                                        <div class="product type-product">
                                            <div class="woocommerce-LoopProduct-link">
                                                <div class="product-image">
                                                    <a href="{{route('shop.product',['id' => $product->id ,'slug' => str_slug($product->name)])}}" class="wp-post-image">
                                                        <img class="image-cover" src="{{asset('uploads/products/'.$product->pictures[0]->picture)}}" alt="{{$product->name}}">
                                                        @if (isset($product->pictures[1]->picture))
                                                            <img class="image-secondary" src="{{asset('uploads/products/'.$product->pictures[1]->picture)}}" alt="{{$product->name}}">
                                                        @endif
                                                    </a>
                                                    @if ($product->inStock==0||$product->inStock==NULL)
                                                        <a href="#" class="onsale">
                                                            Sale
                                                        </a>
                                                    @endif
                                                    @if ($product->discount!=0||$product->discount!=NULL)
                                                        <a href="#" class="onnew" style="top: 50px">{{$product->discount}}%</a>
                                                    @endif
                                                    @if ($product->inStock!=0||$product->inStock!=NULL)
                                                        <form method="POST" action="{{ route('cart.add',['id' => $product->id]) }}">
                                                            @csrf
                                                            <input type="number" name="quantity" id="quantity" value="1" hidden>
                                                            <div class="yith-wcwl-add-button show">
                                                                <button  class="add_to_wishlist btn btn-defaul">
                                                                    <i class="zmdi zmdi-favorite-outline"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    @endif
                                                    <div class="button add_to_cart_button">
                                                        <a href="#">
                                                            <img src="{{asset('images/icons/shopping-cart-black-icon.png')}}" alt="cart">
                                                        </a>
                                                    </div>
                                                    <h5 class="woocommerce-loop-product__title">
                                                        <a href="{{route('shop.product',['id' => $product->id ,'slug' => str_slug($product->name)])}}">
                                                            {{$product->name}}
                                                        </a>
                                                    </h5>
                                                    <span class="price">
                                                        @if ($product->discount!=0||$product->discount!=NULL)
                                                            <del>
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">$</span>
                                                                    {{$product->price}}
                                                                </span>
                                                            </del>
                                                            <ins>
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">$</span>
                                                                    {{$product->price - (($product->price * $product->discount)/100)}}
                                                                </span>
                                                            </ins>
                                                        @else
                                                            <ins>
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">$</span>
                                                                    {{$product->price}}
                                                                </span>
                                                            </ins>
                                                        @endif
                                                        {{-- Select Depend on Product id --}}

                                                        <?php
                                                            $avr_star       = App\Comment::where('product_id',$product->id)
                                                            ->selectRaw('SUM(rate)/COUNT(user_id) AS avg_rating')
                                                            ->first()
                                                            ->avg_rating;
                                                            $product_star = round($avr_star);
                                                        ?>
                                                        {{-- Select Depend on Product id --}}
                                                        @if ($product_star!=0)
                                                            <div class="shop-star-rating">
                                                                @for ($i = 1; $i <=  5; $i++)
                                                                    @if ($product_star>=$i)
                                                                        <i class="zmdi zmdi-star"></i>
                                                                    @else
                                                                        <i class="zmdi zmdi-star-outline"></i>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                        @endif
                                                    </span>
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
 @include('users.layouts.footer.footer')
