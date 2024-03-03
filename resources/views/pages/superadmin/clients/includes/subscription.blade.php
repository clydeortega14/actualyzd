<div class="container">
	<div class="row justify-content-between mb-3">
		@php
			$subscription = $client->subscription->package;
		@endphp
		<div class="col-md-6">
			<div>
				<span>Subscribed to</span>
			</div>
			<div>
				
				<div>
					<h1>{{ $subscription->name }}</h1>
				</div>
			</div>
			<div>
				<span>Exp {{ $client->subscription->wholeDate() }}</span>
			</div>
		</div>
		<div class="col-md-6">
			<div>
				<span>Subscription Price</span>
			</div>
			<div>
				<h1> &#8369; {{ $subscription->formattedPrice() }}</h1>
			</div>
			<div>
				<span>{{ $subscription->no_of_months.' Month/s' }}</span>
			</div>
		</div>
	</div>

	<div class="row mt-5">
		<div class="col-md-12">
			<div>
				<h5 class="card-title">
					Details
				</h5>
			</div>
			<div>
				<ul class="list-group">
					@foreach($subscription->services as $service)
						<li class="list-group-item d-flex justify-content-between align-items-center">
						    <b>{{$service->sessionType->name}}</b>
						    <span class="badge badge-primary badge-pill">{{ $service->limit }}</span>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>