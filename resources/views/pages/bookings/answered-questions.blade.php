@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				{{ Breadcrumbs::render('booking.answered.questions', $booking) }}

				<div class="card mb-3">
					<div class="card-header">
						Onboarding Questions & Answers
					</div>
					<div class="card-body">
						<ul>
							@foreach($categories as $category)
								@if(count($category->questionnaires) > 0)
                                    <li>
                                    	<h4 class="text-gray text-info"><strong>{{ $category->name }}</strong></h4>
                                    	@include('pages.bookings.components.questionnaire')
                                    </li>
								@endif
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection