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
                                    <div class="col-md-3">
                                        <div class="product type-product">
                                            <div class="woocommerce-LoopProduct-link">
                                                <div class="product-image">
                                                    <div class="wp-post-image">
                                                        <img class="image-cover" src="{{asset('uploads/products/'.$product->pictures[0]->picture)}}" alt="{{$product->name}}">
                                                        @if (isset($product->pictures[1]->picture))
                                                            <img class="image-secondary" src="{{asset('uploads/products/'.$product->pictures[1]->picture)}}" alt="{{$product->name}}">
                                                        @endif
                                                    </div>
                                                    @if ($product->discount!=0||$product->discount!=NULL)
                                                        <a href="#" class="onnew">{{$product->discount}}%</a>
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
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>
                                                                        {{$product->price - (($product->price * $product->discount)/100)}}
                                                                    </span>
                                                                </ins>
                                                                <del>
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>
                                                                        {{$product->price}}
                                                                    </span>
                                                                </del>
                                                            @else
                                                                <ins>
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>
                                                                        {{$product->price}}
                                                                    </span>
                                                                </ins>
                                                            @endif
                                                        </span>
                                                        <div class="button add_to_cart_button">
                                                            <form method="POST" action="{{ route('cart.add',['id' => $product->id]) }}">
                                                                @csrf
                                                                <input type="number" name="quantity" id="quantity" value="1" hidden>
                                                                <button type="submit" class="btn btn-dark">Add to Cart</button>
                                                            </form>
                                                        </div>
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
 @include('users.layouts.footer.footer')
