<div class="container">
	@include('alerts.message')

	<client-subscription></client-subscription>
	
{{-- 
	<form action="{{ route('client.subscription.renew') }}" method="POST">
		@csrf

		@if(count($client->subscriptions) > 0)
			@foreach($client->subscriptions as $sub)
				<div class="row justify-content-between mb-5 border-bottom">
					<div class="col-md-6">
						<div>
							<span>Subscribed to</span>
						</div>
						<div>
							<div>
								<h5 class="card-title">{{ $sub->package->name }}</h5>
							</div>
						</div>
						<div>
							<span>Exp {{ $sub->wholeDate() }}</span>
						</div>
					</div>
					<div class="col-md-6 d-flex align-items-center">

						<input type="hidden" name="client_subscription_id" value="{{ $sub->id }}">
						<input type="hidden" name="package_id" value="{{ $sub->package->id }}">

						<button type="submit" class="btn btn-outline-primary btn-sm">Renew</button>
					</div>
				</div>
			@endforeach
		@endif
	</form> --}}

	<div class="row">
		<div class="col-md-12">
			<div class="d-flex justify-content-between mb-3">
				<div class="d-flex align-items-center">
					<h5 class="card-title">Recent Transactions</h5>
				</div>
				<a href="{{ route('client.subscriptions', $client->id) }}" class="btn btn-outline-primary btn-sm">add subscription</a>
			</div>
			
			<ul class="list-group">
				@foreach($subscriptions as $sub)
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<div>
							<b>{{ $sub->package->name }}</b>
							<div class="mt-0">
								<small class="mt-0">{{ $sub->status->name }}</small>
							</div>
						</div>
						<div class="d-flex align-items-end">
							<span class="text-gray"><b>&#8369; {{ $sub->package->formattedPrice() }}</b> <br />
								<small>{{ $sub->created_at }}</small>
							</span>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>