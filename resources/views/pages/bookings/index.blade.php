@extends('layouts.sb-admin.master')


@section('css_links')

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/fullcalendar/css/main.css') }}">

@endsection

@section('content')

	<div class="container">

		<div class="row justify-content-center">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="card mb-3">
					<div class="card-body">
						<div id="calendar"></div>
					</div>
				</div>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card mb-3">
					<div class="card-header">
						Pick a Time
					</div>
					<div class="card-body">
						<div class="row">
							@foreach($time_lists as $time)
							    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							    	<div class="form-group">
							    		<input type="radio" name="time" value="{{ $time->id }}" />
							    		<label>{{ $time->parseTimeFrom().' - '.$time->parseTimeTo() }}</label>
							    	</div>
							    </div>
							@endforeach
						</div>	
					</div>	
				</div>

				<div class="card mb-3">
					<div class="card-header">
						Psychologists
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="card mb-3 text-center">	
									<img src="{{ asset ('sb-admin/img/undraw_profile.svg') }}" alt="Psychologist Image" width="80" height="80" class="mx-auto d-block pt-3">
									<div class="card-body">
										<h5 class="card-title">Psychologist One</h5>
										<a href="#" class="btn btn-primary">Select</a>
									</div>
								</div>
							</div>	

							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="card mb-3 text-center">	
									<img src="{{ asset ('sb-admin/img/undraw_profile.svg') }}" alt="Psychologist Image" width="80" height="80" class="mx-auto d-block pt-3">
									<div class="card-body">
										<h5 class="card-title">Psychologist One</h5>
										<a href="#" class="btn btn-primary">Select</a>
									</div>
								</div>
							</div>	

							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="card mb-3 text-center">	
									<img src="{{ asset ('sb-admin/img/undraw_profile.svg') }}" alt="Psychologist Image" width="80" height="80" class="mx-auto d-block pt-3">
									<div class="card-body">
										<h5 class="card-title">Psychologist One</h5>
										<a href="#" class="btn btn-primary">Select</a>
									</div>
								</div>
							</div>	
						</div>	
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="card mb-3">
					<div class="card-header">
						Tell us a bit about yourself
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<h6>Have you ever been to counseling or therapy before?</h6>
								<div class="form-group mb-4">
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="counseling_before" id="counseling-before-yes" value="yes">
										<label class="form-check-label" for="counseling-before">Yes</label>
									</div>

									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="counseling_before" id="counseling-before-no" value="no">
										<label class="form-check-label" for="counseling-before-no">No</label>
									</div>
								</div>

								<h6>Over the last 2 weeks, how often have you been bothered by the following problems?</h6>
								<br>
								<h6 class="text-center"><b>Mental Challenges</b></h6>
								<br>
								<ol>
									<li>
										<h6><b>I feel down, hopeless and I don't enjoy the things that I normally do.</b></h6>
										<div class="form-group mb-4">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_one" id="mc-one-never" value="1">
												<label class="form-check-label" for="mc-one-never">Never</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_one" id="mc-one-rare" value="2">
												<label class="form-check-label" for="mc-one-rare">Rare</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_one" id="mc-one-sometimes" value="3">
												<label class="form-check-label" for="mc-one-sometimes">Sometimes</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_one" id="mc-one-often" value="4">
												<label class="form-check-label" for="mc-one-often">Often</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_one" id="mc-two-always" value="5">
												<label class="form-check-label" for="mc-two-always">Always</label>
											</div>
										</div>
									</li>

									<li>
										<h6><b>I feel nervous, anxious or on edge</b></h6>
										<div class="form-group mb-4">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_two" id="mc-two-never" value="1">
												<label class="form-check-label" for="mc-two-never">Never</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_two" id="mc-two-rare" value="2">
												<label class="form-check-label" for="mc-two-rare">Rare</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_two" id="mc-two-sometimes" value="3">
												<label class="form-check-label" for="mc-two-sometimes">Sometimes</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_two" id="mc-two-often" value="4">
												<label class="form-check-label" for="mc-two-often">Often</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_two" id="mc-one-always" value="5">
												<label class="form-check-label" for="mc-one-always">Always</label>
											</div>
										</div>
									</li>

									<li>
										<h6><b>I feel empty or i don't feel anything inside.</b></h6>
										<div class="form-group mb-4">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_three" id="mc-three-never" value="1">
												<label class="form-check-label" for="mc-three-never">Never</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_three" id="mc-three-rare" value="2">
												<label class="form-check-label" for="mc-three-rare">Rare</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_three" id="mc-two-sometimes" value="3">
												<label class="form-check-label" for="mc-three-sometimes">Sometimes</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_three" id="mc-three-often" value="4">
												<label class="form-check-label" for="mc-three-often">Often</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="mc_three" id="mc-three-always" value="5">
												<label class="form-check-label" for="mc-three-always">Always</label>
											</div>
										</div>
									</li>
								</ol>


								<h6 class="text-center"><b>Work Issues</b></h6>
								<br>
								<ol>
									<li>
										<h6><b>I feel that the company's culture does not fit me.</b></h6>
										<div class="form-group mb-4">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="wi_one" id="mc-three-never" value="1">
												<label class="form-check-label" for="mc-three-never">Never</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="wi_one" id="mc-three-rare" value="2">
												<label class="form-check-label" for="mc-three-rare">Rare</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="wi_one" id="mc-three-sometimes" value="3">
												<label class="form-check-label" for="mc-three-sometimes">Sometimes</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="wi_one" id="mc-three-often" value="4">
												<label class="form-check-label" for="mc-three-often">Often</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="wi_one" id="mc-three-always" value="5">
												<label class="form-check-label" for="mc-three-always">Always</label>
											</div>
										</div>
									</li>

									<li>
										<h6><b>I have problems with superior.</b></h6>
										<div class="form-group mb-4">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="wi_two" id="mc-three-never" value="1">
												<label class="form-check-label" for="mc-three-never">Never</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="wi_two" id="mc-three-rare" value="2">
												<label class="form-check-label" for="mc-three-rare">Rare</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="wi_two" id="mc-three-sometimes" value="3">
												<label class="form-check-label" for="mc-three-sometimes">Sometimes</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="wi_two" id="mc-three-often" value="4">
												<label class="form-check-label" for="mc-three-often">Often</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="wi_two" id="mc-three-always" value="5">
												<label class="form-check-label" for="mc-three-always">Always</label>
											</div>
										</div>
									</li>

									<li>
										<h6><b>I have problems with workmates.</b></h6>
										<div class="form-group mb-4">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="three" id="mc-three-never" value="1">
												<label class="form-check-label" for="mc-three-never">Never</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="three" id="mc-three-rare" value="2">
												<label class="form-check-label" for="mc-three-rare">Rare</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="three" id="mc-three-sometimes" value="3">
												<label class="form-check-label" for="mc-three-sometimes">Sometimes</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="three" id="mc-three-often" value="4">
												<label class="form-check-label" for="mc-three-often">Often</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="three" id="mc-three-always" value="5">
												<label class="form-check-label" for="mc-three-always">Always</label>
											</div>
										</div>
									</li>
								</ol>

								<h6 class="text-center"><b>Personal Problems</b></h6>
								<ol>
									<li>
										<h6><b>I feel stressed and bothered by my family</b></h6>
										<div class="form-group mb-4">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_one" id="mc-three-never" value="1">
												<label class="form-check-label" for="mc-three-never">Never</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_one" id="mc-three-rare" value="2">
												<label class="form-check-label" for="mc-three-rare">Rare</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_one" id="mc-three-sometimes" value="3">
												<label class="form-check-label" for="mc-three-sometimes">Sometimes</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_one" id="mc-three-often" value="4">
												<label class="form-check-label" for="mc-three-often">Often</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_one" id="mc-three-always" value="5">
												<label class="form-check-label" for="mc-three-always">Always</label>
											</div>
										</div>
									</li>

									<li>
										<h6><b>I feel stressed and bothered by my partner/husband/wife.</b></h6>
										<div class="form-group mb-4">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_two" id="mc-three-never" value="1">
												<label class="form-check-label" for="mc-three-never">Never</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_two" id="mc-three-rare" value="2">
												<label class="form-check-label" for="mc-three-rare">Rare</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_two" id="mc-three-sometimes" value="3">
												<label class="form-check-label" for="mc-three-sometimes">Sometimes</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_two" id="mc-three-often" value="4">
												<label class="form-check-label" for="mc-three-often">Often</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_two" id="mc-three-always" value="5">
												<label class="form-check-label" for="mc-three-always">Always</label>
											</div>
										</div>
									</li>

									<li>
										<h6><b>I feel detached to my social circle i.e. workplace, friends, family etc</b></h6>
										<div class="form-group mb-4">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_three" id="mc-three-never" value="1">
												<label class="form-check-label" for="mc-three-never">Never</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_three" id="mc-three-rare" value="2">
												<label class="form-check-label" for="mc-three-rare">Rare</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_three" id="mc-three-sometimes" value="3">
												<label class="form-check-label" for="mc-three-sometimes">Sometimes</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_three" id="mc-three-often" value="4">
												<label class="form-check-label" for="mc-three-often">Often</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="pp_three" id="mc-three-always" value="5">
												<label class="form-check-label" for="mc-three-always">Always</label>
											</div>
										</div>
									</li>
								</ol>
								<h6 class="text-center"><b>Intent to self harm</b></h6>
								<br>
								<ol>
									<li>
										<h6><b>	I plan to harm myself</b></h6>
										<div class="form-group mb-4">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="self_harm" id="mc-three-never" value="1">
												<label class="form-check-label" for="mc-three-never">Yes</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="self_harm" id="mc-three-rare" value="2">
												<label class="form-check-label" for="mc-three-rare">No</label>
											</div>
										</div>
									</li>
								</ol>
								<br>
								<div class="form-group">
									<textarea name="open_ended" cols="30" rows="5" class="form-control" placeholder="Are you experiencing any specific issues you'd like to focus on that is not stated above?"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-12">
				<div class="form-group">
					<button type="button" class="btn btn-primary btn-block">Submit</button>
					<a href="#" class="btn btn-danger btn-block">Cancel</a>
				</div>
			</div>
		</div>
	</div>
@stop

@section('js_scripts')
	<script type="text/javascript" src="{{ asset('assets/fullcalendar/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/date.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/fullcalendar/js/custom.js') }}"></script>
	<script>

		const custom_calendar = new CustomCalendar;

		//Initialize calendar
		window.addEventListener('load', (event) => {

			let calendarOptions = {
				editable: true,
		      	navLinks:  true,
		      	selectable:  true,
		      	dayMaxEvents: true, // allow "more" link when too many events
		      	events: [],
			}

			custom_calendar.render(calendarOptions);
		})

	</script>
@endsection