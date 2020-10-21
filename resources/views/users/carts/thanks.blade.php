@include('users.layouts.header.header')
	<div class="page-content">
		<!-- Coming Soon Section -->
		<section class="coming-soon-page" style="background-image: url({{ asset('images/coming-soon-bg.jpg') }})">
			<div class="page-detail">
				<div class="page-inner">
                    <h1>Thank You </h1>
                    <h4>ID tracking :{{ $order->id }}</h4>
                    <h4>Order Has been Sent to be Shipped</h4>
                    <button class="btn btn-primary"><a href="{{ route('cart.tracking') }}" class="text-light">Track Order</a> </button>
				</div>
			</div>
		</section>
		<!-- End Coming Soon Section -->
	</div>
@include('users.layouts.footer.footer')
