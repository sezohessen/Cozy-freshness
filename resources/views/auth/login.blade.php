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
									<h2 class="special-heading">Login account</h2>
                                    <form class="woocommerce-form-login" role="form" method="POST" action="{{ route('login') }}">
                                        @csrf
										<p class="woocommerce-form-row">
                                            <input class="woocommerce-Input input-text {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" value="admin@argon.com" required autofocus>
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </p>
										<p class="woocommerce-form-row">
                                            <input class="woocommerce-Input input-text {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" placeholder="{{ __('Password') }}" type="password" value="secret" required>
                                            @if ($errors->has('password'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
										</p>
										<p class="form-button">
											<label>
												<input type="submit" class="woocommerce-Button au-btn btn-small" name="login" value="Login">
												<span class="arrow-right"><i class="zmdi zmdi-arrow-right"></i></span>
											</label>
											<label class="woocommerce-form__label">
												<input class="woocommerce-form__input" name="rememberme" type="checkbox" id="rememberme" value="forever">
												<span>Remember me</span>
											</label>
										</p>
										<p class="woocommerce-LostPassword">
                                            <a href="{{ route('register') }}">
                                                {{ __('Create new account') }}
                                            </a>
                                        </p>
                                        <p class="woocommerce-LostPassword" style="float: right">
                                            @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">
                                                {{ __('Forgot password?') }}
                                            </a>
                                            @endif
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

