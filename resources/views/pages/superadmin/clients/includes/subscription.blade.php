<div class="container">
	@include('alerts.message')

	@if(auth()->user()->hasRole('superadmin'))
		<div class="row d-flex justify-content-end mb-5">
			<div class="col-md-4" align="right">
				<a href="{{ route('client.subscriptions', $client->id) }}" class="btn btn-primary btn-sm">Add More Subscription</a>
			</div>
		</div>
	@endif
	
	<client-subscription :client="{
		client: {{ $client }}
	}" :roles="{{ auth()->user()->roles->pluck('name') }}"></client-subscription>
	
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

			<ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="recent-trans-tab" data-toggle="tab" data-target="#recent-trans" type="button" role="tab" aria-controls="recent-trans">Recent Transactions</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="booking-history-tab" data-toggle="tab" data-target="#booking-history" type="button" role="tab" aria-controls="booking-history">Booking History</button>
				</li>
			</ul>

			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="recent-trans" role="tabpanel" aria-labelledby="recent-trans-tab">
					<div class="pl-4">
						<ul class="list-group">
							@foreach($subscriptions as $sub)
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<div>
										<b>{{ $sub->package->name }}</b> - <small>{{ $sub->reference_no }}</small>
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
				<div class="tab-pane fade" id="booking-history" role="tabpanel" aria-labelledby="recent-trans-tab">
					<div class="pl-4">
						{{-- Booking History Component --}}
						<bookings-history :clientID={{ $client->id }}></bookings-history>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>