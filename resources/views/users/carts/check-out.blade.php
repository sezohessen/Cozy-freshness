
@include('users.layouts.header.header')
	<div class="page-content">
		<!-- Breadcrumb Section -->
		<section class="breadcrumb-contact-us breadcrumb-section section-box" style="background-image: url({{ asset('images/shop-bc.jpg') }})">
			<div class="container">
				<div class="breadcrumb-inner">
					<h1>Shop</h1>
					<ul class="breadcrumbs">
						<li><a class="breadcrumbs-1" href="index.html">Home</a></li>
						<li><p class="breadcrumbs-2">Check Out</p></li>
					</ul>
				</div>
			</div>
		</section>
		<!-- End Breadcrumb Section -->

		<!-- Check Out Section -->
		<section class="checkout-section section-box">
			<div class="woocommerce">
				<div class="container">
					<div class="entry-content">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
								<div class="woocommerce-checkout-review-order">
									<h2 id="order_review_heading">Your order</h2>
									<table class="shop_table">
										<tbody>
                                            <?php $total = 0 ?>
                                            @foreach(session('cart') as $id => $cart_info)
                                            <?php $product = App\Product::find($id);
                                            $price   = $product->price - (($product->price * $product->discount)/100);
                                            $total  += $price * $cart_info['quantity'];
                                            ?>
                                            @if (!$product)
                                                <?php
                                                if(isset($cart[$id])) {
                                                    unset($cart_info[$id]);
                                                    session()->put('cart', $cart);
                                                }
                                                ?>
                                                @continue
                                            @endif
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        <img src="{{ asset('uploads/products/'.$product->pictures[0]->picture) }}" alt="product">
                                                        <div class="review-wrap">
                                                            <span class="cart_item_title">{{ $product->name }}</span>
                                                            <span class="product-quantity">x{{ $cart_info['quantity'] }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">
                                                                ${{  $price * $cart_info['quantity'] }}
                                                            </span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
										</tbody>
										<tfoot>
											<tr>
												<td>
													<ul>
														<li class="order-total">
															<span class="review-total-title">Total</span>
															<p>
																<span class="woocommerce-Price-amount amount">
																	<span class="woocommerce-Price-currencySymbol">${{ $total }}</span>
																</span>
															</p>
														</li>
													</ul>
												</td>
											</tr>
										</tfoot>
									</table>
								</div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
								<form action="{{ route('cart.placeOrder') }}" class="checkout woocommerce-checkout" method="POST">
                                    @csrf
									<div class="woocommerce-billing-fields">
										<h2>Delivery details</h2>
										<div class="woocommerce-billing-fields__field-wrapper">
											<p class="form-row-first">
                                                <input type="text" class="input-text " value="{{ old('fullName') }}"  name="fullName"  id="billing_first_name" placeholder="Full Name *"  >
                                                @if ($errors->has('fullName'))
                                                    <small class="badge badge-danger">{{$errors->first('fullName')}}</small>
                                                @endif
                                            </p>
                                            <p class="form-row-wide">
                                                <input type="text" class="input-text "  value="{{ old('location') }}" name="location" id="billing_location" placeholder="Location *" >
                                                @if ($errors->has('location'))
                                                    <small class="badge badge-danger">{{$errors->first('location')}}</small>
                                                @endif
                                            </p>
                                            <p class="form-row-first">
                                                <input type="tel" class="input-text " value="{{ old('phone') }}" name="phone" id="billing_phone" placeholder="Phone *" >
                                                @if ($errors->has('phone'))
                                                    <small class="badge badge-danger">{{$errors->first('phone')}}</small>
                                                @endif
                                            </p>
										</div>
                                    </div>
                                    <hr>
									<div class="woocommerce-additional-fields">
										<h2>Additional information</h2>
										<div class="woocommerce-additional-fields__field-wrapper">
											<p class="notes" id="order_comments_field">
												<label for="order_comments" class="">Order notes</label>
                                                <textarea name="moreInfo" class="input-text " id="order_comments"
                                                placeholder="Note about your order, eg. special notes fordelivery." >{{ old('moreInfo') }}</textarea>
                                            </p>
										</div>
                                    </div>
                                    <div class="woocommerce-checkout-review-order">
                                        <div class="woocommerce-checkout-payment">
                                            <ul class="payment_methods">
                                                <li class="wc_payment_method">
                                                    <input type="radio" id="now" class="input-radio" name="time" checked value="now" required>
                                                    <label for="now">Now</label>
                                                </li>
                                                <li class="wc_payment_method">
                                                    <input type="radio" name="time" id="afterOneHour" class="input-radio" value="afterOneHour" required>
                                                    <label for="afterOneHour">After 1 hour</label>
                                                </li>
                                                <li class="wc_payment_method">
                                                    <input type="radio" name="time" id="afterTwoHour" class="input-radio" value="afterTwoHour" required>
                                                    <label for="afterTwoHour">After 2 hour</label>
                                                </li>
                                                @if ($errors->has('time'))
                                                    <small class="badge badge-danger">{{$errors->first('time')}}</small>
                                                @endif
                                            </ul>
                                            <div class="place-order">
                                                <input type="submit" class="button alt au-btn btn-small" name="woocommerce_checkout_place_order" id="place_order" value="Place Order">
                                                <span><i class="zmdi zmdi-arrow-right"></i></span>
                                            </div>
                                            <input type="hidden" name="total" value="{{ $total }}" hidden>
                                        </div>
                                    </div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Check Out Section -->

	</div>
@include('users.layouts.footer.footer')
