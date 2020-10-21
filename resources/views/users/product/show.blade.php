
@include('users.layouts.header.header')
	<div class="page-content">
		<!-- Breadcrumb Section -->
		<section class="breadcrumb-contact-us breadcrumb-section section-box" style="background-image: url({{asset('uploads/categories/'.$product->category->picture)}})">
			<div class="container">
				<div class="breadcrumb-inner">
					<h1>Shop</h1>
					<ul class="breadcrumbs">
						<li><a class="breadcrumbs-1" href="index.html">{{ $product->category->name }}</a></li>
						<li><p class="breadcrumbs-2">{{ $product->name }}</p></li>
					</ul>
				</div>
			</div>
		</section>
		<!-- End Breadcrumb Section -->

		<!-- Shop Section -->
		<section class="shop-single-v1-section section-box featured-hp-1 featured-hp-4">
			<div class="woocommerce">
				<div class="container">
                    @if (session('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('danger') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
					<div class="content-area">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
								<div class="woocommerce-product-gallery">
                                    @if ($product->inStock==0||$product->inStock==NULL)
                                        <a href="#" class="onsale">
                                            Sale
                                        </a>
                                    @endif
									<div class="owl-carousel">
                                        @foreach ( $product_pictures as $product_picture)
                                            <div class="item">
                                                <img src="{{asset('uploads/products/'.$product_picture->picture)}}" alt="product">
                                            </div>
                                        @endforeach
									</div>
								</div>
                            </div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
								<div class="summary entry-summary">
									<h1 class="product_title entry-title">{{ $product->name }}</h1>
									<div class="woocommerce-product-rating">
                                        @if ($product_star!=0)
                                            <div class="star-rating">
                                                @for ($i = 1; $i <=  5; $i++)
                                                    @if ($product_star>=$i)
                                                        <i class="zmdi zmdi-star"></i>
                                                    @else
                                                        <i class="zmdi zmdi-star-outline"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <a href="#" class="woocommerce-review-link">( {{ number_format($avr_star,1) }} of  {{ $comments->count() }} customer review)</a>
                                        @else
                                            <strong>No reviews Yet</strong>
                                        @endif

									</div>
									<p class="price">
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
                                                <span  class="onnew" style="top: 50px">{{$product->discount}}%</span>
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
									</p>
									<div class="woocommerce-product-details__short-description">
										<p>{{ $product->description }}</p>
                                    </div>
                                    @if ($product->inStock==0||$product->inStock==NULL)
                                            <strong class="bg-danger text-white" style="padding:5px;display:inline-block;margin:10px 0px">Sold Out</strong>
                                    @else
                                        <form class="cart" method="POST" action="{{ route('cart.add',['id' => $product->id]) }}">
                                            @csrf
                                            <div class="quantity">
                                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->inStock }}" class="nput-text qty text">
                                                <span class="modify-qty plus" onclick="Increase()">+</span>
                                                <span class="modify-qty minus" onclick="Decrease()">-</span>
                                            </div>
                                            <button type="submit" class="single_add_to_cart_button button alt au-btn btn-small">Add to cart<i class="zmdi zmdi-arrow-right"></i></button>
                                        </form>
                                    @endif

									<div class="product_meta">
										<span class="sku_wrapper">
											In Stock:
											<span class="sku">{{ $product->inStock }}</span>
                                        </span>
                                        <span class="sku_wrapper">
											Quantity:
											<span class="sku">{{ $product->quantity }}</span>
										</span>
										<span class="posted_in">
											Category:
											<a href="{{route('shop.category', ['id' => $product->category->id, 'slug' => str_slug($product->category->name)])}}">{{ $product->category->name }}</a>
                                        </span>
                                        {{-- comment

										<span class="tagged_as">
											Tag:
											<a href="#">Home Decor, Lightting</a>
                                        </span>
                                        --}}
									</div>
									<div class="product-share">
										<span>Share:</span>
										<a href="#"><i class="zmdi zmdi-facebook"></i></a>
										<a href="#"><i class="zmdi zmdi-twitter"></i></a>
										<a href="#"><i class="zmdi zmdi-tumblr"></i></a>
										<a href="#"><i class="zmdi zmdi-instagram"></i></a>
									</div>
                                </div>
                                <div class="col-12">
                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if (session('exist'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('exist') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
								<div class="woocommerce-tabs">
									<ul class="nav nav-tabs wc-tabs" id="myTab" role="tablist">
										<li class="nav-item description_tab" id="tab-title-description" role="tab" aria-controls="tab-description" aria-selected="true">
											<a class="nav-link active" href="#tab-description" data-toggle="tab">Description</a>
										</li>
										<li class="nav-item additional_information_tab" id="tab-title-additional_information" role="tab" aria-controls="tab-additional_information" aria-selected="false">
									    	<a class="nav-link" href="#tab-additional_information" data-toggle="tab">Additional information</a>
									  	</li>
										<li class="nav-item reviews_tab" id="tab-title-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">
									    	<a class="nav-link" href="#tab-reviews" data-toggle="tab">Reviews({{ $comments->count() }})</a>
									  	</li>
									</ul>
									<div class="tab-content" id="myTabContent">
										<div class="woocommerce-Tabs-panel tab-pane fade show active" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description">
											<p>{{ $product->description }}</p>
										</div>
										<div class="woocommerce-Tabs-panel tab-pane" id="tab-additional_information" role="tabpanel" aria-labelledby="tab-title-additional_information">
											<table class="shop_attributes">
												<tbody>
													<tr>
														<th>Weight</th>
                                                        @if ($product->weight==0||$product->weight==NULL)
                                                        <td class="product_weight">Unknown</td>
                                                        @else
                                                            <td class="product_weight">{{$product->weight}} KG</td>
                                                        @endif
													</tr>
													<tr>
														<th>Dimensions</th>
														<td class="product_dimensions">H: 76 cm W: 56 cm D: 52 cm</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="woocommerce-Tabs-panel tab-pane" id="tab-reviews" role="tabpanel" aria-labelledby="tab-title-reviews">
											<div class="woocommerce-Reviews" id="reviews">
												<h2>{{ $comments->count() }} review for Reframe Your Viewpoints</h2>
												<div id="comments">
													<div class="comment-list">
                                                        @foreach ($comments as $comment)
                                                            <div class="comment-item">
                                                                <div class="comment-content">
                                                                    <img src="{{asset('images/shop-single-v1-4.jpg')}}" alt="customer">
                                                                    <div class="comment-body">
                                                                        <div class="comment-author">
                                                                            <span class="author">{{ $comment->user->name }}</span>
                                                                            <div class="star-rating">
                                                                                {{-- Warning genius Trick ;) --}}
                                                                                @for ($i = 1; $i <= 5; $i++)
                                                                                    @if ($comment->rate >= $i)
                                                                                        <i class="zmdi zmdi-star"></i>
                                                                                    @else
                                                                                        <i class="zmdi zmdi-star-outline"></i>
                                                                                    @endif
                                                                                @endfor
                                                                                {{-- Warning genius Trick ;) --}}
                                                                            </div>
                                                                        </div>
                                                                        <span class="comment-time">{{ $comment->created_at->format('F j, Y') }}</span>
                                                                        <p>{{ $comment->comment }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
													</div>
                                                </div>
                                                @if (!$hasComment)
                                                    @if (Auth::user())
                                                    <div id="review_form_wrapper">
                                                        <div id="review_form">
                                                            <div id="respond" class="comment-respond">
                                                                <form id="commentform" class="comment-form"
                                                                action="{{ route('product.comment',['id'=>$product->id, 'slug' => str_slug($product->name)] ) }}"
                                                                method="POST">
                                                                    @csrf
                                                                    <p class="comment-notes">
                                                                        <span>Add a review</span>
                                                                        <span id="email-notes">
                                                                            Your email address will not be published. Required fields are marked
                                                                            <span class="required">*</span>
                                                                        </span>
                                                                    </p>
                                                                    <div class="comment-form-rating">
                                                                        <h5>Your rating</h5>
                                                                        <div class="rate">
                                                                            <input type="radio" id="star5" name="rate" value="5" />
                                                                            <label for="star5" title="Very good">5 stars</label>
                                                                            <input type="radio" id="star4" name="rate" value="4" />
                                                                            <label for="star4" title="Good">4 stars</label>
                                                                            <input type="radio" id="star3" name="rate" value="3" />
                                                                            <label for="star3" title="Nice">3 stars</label>
                                                                            <input type="radio" id="star2" name="rate" value="2" />
                                                                            <label for="star2" title="Bad">2 stars</label>
                                                                            <input type="radio" id="star1" name="rate" value="1" />
                                                                            <label for="star1" title="Very bad">1 star</label>
                                                                        </div>
                                                                    </div>
                                                                    <p class="comment-form-comment">
                                                                        <textarea id="comment" name="comment" required placeholder="Write Your Review..."></textarea>
                                                                    </p>
                                                                    <p class="form-submit">
                                                                        <input name="submit" type="submit" id="submit" class="submit au-btn btn-small" value="Submit">
                                                                        <span><i class="zmdi zmdi-arrow-right"></i></span>
                                                                    </p>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <p class="comment-notes">
                                                        <a href="{{ route('login') }}">Login to post comment</a>
                                                    </p>
                                                    @endif
                                                @endif
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="related">
							<h2 class="special-heading">Related Products</h2>
							<div class="owl-carousel owl-theme" id="related-products">
                                @if ($products->count())
                                    @foreach ($products as $product)
                                        <div class="item">
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
                                                        <div class="yith-wcwl-add-button show">
                                                            <a href="#" class="add_to_wishlist">
                                                                <i class="zmdi zmdi-favorite-outline"></i>
                                                            </a>
                                                        </div>
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
                                @else
                                    <h4>There are not related <strong>products</strong></h4>
                                @endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Shop Section -->
	</div>
@include('users.layouts.footer.footer')
