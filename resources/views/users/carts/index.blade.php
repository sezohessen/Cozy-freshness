
@include('users.layouts.header.header')
	<div class="page-content">
		<!-- Breadcrumb Section -->
		<section class="breadcrumb-contact-us breadcrumb-section section-box" style="background-image: url({{ isset($setting->BGshop) ?  Storage::url($setting->BGshop) : asset('images/shop-bc.jpg') }})">
			<div class="container">
				<div class="breadcrumb-inner">
					<h1>Cart</h1>
					<ul class="breadcrumbs">
						<li><a class="breadcrumbs-1" href="index.html">Home</a></li>
						<li><p class="breadcrumbs-2">Cart Items</p></li>
					</ul>
				</div>
			</div>
        </section>
		<!-- End Breadcrumb Section -->

        <!-- Shop Cart Section -->
    @if(session('cart'))
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
										<th class="product-price">Price</th>
										<th class="product-quantity">Quantity</th>
										<th class="product-subtotal">Total</th>
									</tr>
								</thead>
								<tbody>
                                <?php $total = 0 ?>
                                    @foreach(session('cart') as $id => $cart_info)
                                    <?php
                                    $product = App\Product::find($id);
                                    $price   = $product->price - (($product->price * $product->discount)/100);
                                    $total  += $price * $cart_info['quantity'];
                                    ?>
                                        @if (!$product)
                                            <?php
                                            if(isset($cart_info[$id])) {
                                                unset($cart_info[$id]);
                                                session()->put('cart', $cart_info);
                                            }
                                            ?>
                                            @continue
                                        @endif
									<tr class="woocommerce-cart-form__cart-item cart_item">
										<td class="product-remove">
                                            <a href="{{ route('cart.remove',['id'=>$id]) }}" class="remove">
                                               <i class="zmdi zmdi-close"></i>
                                            </a>
										</td>
										<td class="product-name" data-title="Product">
                                            <a href="{{ route('shop.product',['id' =>$id ,'slug' =>str_slug($product->name)]) }}">
                                                <img src="{{ Storage::url($product->pictures[0]->picture)  }}" alt="product">
                                            </a>
                                            <a href="{{ route('shop.product',['id' =>$id ,'slug' =>str_slug($product->name)]) }}">
                                                {{ $product->name }}  x{{ $product->quantity }}
                                            </a>
										</td>
										<td class="product-price" data-title="Price">
											<span class="woocommerce-Price-amount amount">
												<span class="woocommerce-Price-currencySymbol">$</span>
												{{ $price }}
											</span>
										</td>
										<td class="product-quantity" data-title="Quantity">
											<div class="quantity form-group" style="width:60px">
                                                <form action="{{ route('cart.update',['id'=>$id]) }}" method="POST">
                                                    @csrf
                                                    <select class="custom-select mr-sm-2" onchange="this.form.submit()"
                                                    name="quantity"  style="cursor: pointer" >

                                                        @for ($i = 1; $i <= 10; $i++)
                                                            @if ($i == $cart_info['quantity'])
                                                              <option value="{{ $cart_info['quantity'] }}" selected>{{ $cart_info['quantity'] }}</option>
                                                            @else
                                                              <option value="{{ $i }}">{{ $i }}</option>
                                                            @endif

                                                        @endfor
                                                    </select>
                                                </form>
		                                    </div>
										</td>
										<td class="product-subtotal" data-title="Total">
											<span class="woocommerce-Price-amount amount">
												<span class="woocommerce-Price-currencySymbol">$</span>
												{{  $price * $cart_info['quantity'] }}
											</span>
										</td>
                                    </tr>
                                    @endforeach
									<tr>
										<td colspan="6" class="actions">
											<div class="coupon">
												<a href="{{route('shop')}}" class="button au-btn btn-small">Continue shopping <span><i class="zmdi zmdi-arrow-right"></i></span></a>
											</div>
											{{-- <div class="action-btn">
												<input type="submit" class="button au-btn btn-small" name="update_cart" value="Update Cart">
												<span><i class="zmdi zmdi-arrow-right"></i></span>
											</div> --}}
										</td>
									</tr>
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
													<span class="woocommerce-Price-currencySymbol">$</span>
													{{ $total }}
												</span>
											</td>
										</tr>
									</tbody>
								</table>
								<div class="wc-proceed-to-checkout">
                                    <form action="{{ route('cart.checkOut') }}" class="woocommerce-cart-form" method="GET">
                                        @csrf
                                        <input type="text" value="{{ $total }}" name="total" hidden>
                                        <button class="checkout-button button wc-forward au-btn btn-small " style="cursor: pointer">Proceed to Checkout<i class="zmdi zmdi-arrow-right"></i></a>
                                    </form>
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
        <a href="{{ route('shop') }}"> <button class="btn btn-primary">Back To Shopping</button></a>
    </div>

    @endif
		<!-- End Shop Cart Section -->

	</div>
@include('users.layouts.footer.footer')
