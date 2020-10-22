@include('users.layouts.header.header')
<hr>
	<div class="page-content">
		<!-- Coming Soon Section -->
		<section class="coming-soon-page" style="background-color:#ffffff }})">
			<div class="page-detail">
				<div class="page-inner">
                    <h1>Thank You </h1>
                    <img src="{{ asset('images/circle.png') }}" alt="Thanks">
                    <h4>ID delivery :{{ $order->id }}</h4>
                    <h4>Order Has been Sent :) </h4>
				</div>
			</div>
		</section>
		<!-- End Coming Soon Section -->
	</div>
@include('users.layouts.footer.footer')
