@include('users.layouts.header.header')
		<!-- My Account Section -->
		<section class="my-account-section section-box">
            <hr>
			<div class="woocommerce">
				<div class="container">
					<div class="content-area">
						<div class="row">
							<div class="col-md-6" style="margin: 50px auto">
								<div class="entry-content">
									<h2 class="special-heading">Create account</h2>
                                    <form class="woocommerce-form-login" role="form" method="POST" action="{{ route('register') }}">
                                        @csrf
										<p class="woocommerce-form-row">
                                            <input class="woocommerce-Input input-text{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}"
                                             type="text" name="name" value="{{ old('name') }}"  autofocus>
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </p>
                                        <p class="woocommerce-form-row">
                                            <input class="woocommerce-Input input-text{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}"
                                             type="email" name="email" value="{{ old('email') }}"  autofocus>
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </p>
                                        <p class="woocommerce-form-row">
                                            <input class="woocommerce-Input input-text{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Your Phone') }}"
                                             type="text" name="phone" value="{{ old('phone') }}"  autofocus>
                                            @if ($errors->has('phone'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif
                                        </p>
                                        <p class="woocommerce-form-row">
                                            <input class="woocommerce-Input input-text{{ $errors->has('location') ? ' is-invalid' : '' }}" placeholder="{{ __('Your Location') }}"
                                             type="text" name="location" value="{{ old('location') }}"  autofocus>
                                            @if ($errors->has('location'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('location') }}</strong>
                                            </span>
                                            @endif
                                        </p>
										<p class="woocommerce-form-row">
                                            <input class="woocommerce-Input input-text {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" placeholder="{{ __('Password') }}" type="password" value="{{ old('password') }}" >
                                            @if ($errors->has('password'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </p>
                                        <p class="woocommerce-form-row">
                                             <input class="woocommerce-Input input-text {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password_confirmation" placeholder="{{ __('Confirm Password') }}" type="password" value="{{ old('password') }}" >
                                            @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                            @endif
                                        </p>
										<p class="form-button">
											<label>
												<input type="submit" class="woocommerce-Button au-btn btn-small" name="register" value="Register">
												<span class="arrow-right"><i class="zmdi zmdi-arrow-right"></i></span>
											</label>
										</p>
										<p class="woocommerce-LostPassword">
                                            <a href="{{ route('login') }}">
                                                {{ __('Already have account ?') }}
                                            </a>
                                        </p>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End My Account Section -->

	</div>
    @include('users.layouts.footer.footer')

