<template id="time-psych">
	
	<div class="modal fade" id="timePsych" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="timePsychLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="timePsychLabel">Select Time and Psychologists</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 border-right">
							<h5 class="card-title text-center mb-3">Select Time</h5>
							<div class="custom-control custom-radio mb-3 ml-3">
								<input type="radio" name="time" class="custom-control-input" id="1" value="1">
								<label class="custom-control-label" for="1">7:00 AM - 8:00 AM</label>
							</div>
							<div class="custom-control custom-radio mb-3 ml-3">
								<input type="radio" name="time" class="custom-control-input" id="2" value="2">
								<label class="custom-control-label" for="2">8:00 AM - 9:00 AM</label>
							</div>
						</div>

						<div class="col-md-6">
							<h5 class="card-title text-center mb-3">Select Psychologist</h5>
							<div class="custom-control custom-radio mb-3 ml-3">
								<input type="radio" name="psychologist" class="custom-control-input" id="psych-1" value="psychologist1">
								<label class="custom-control-label" for="psych-1">Psychologist One</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</template>


<script>
	

	export default {
		name: "TimePsych"
	}
</script>