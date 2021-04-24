<div class="modal fade" id="no-show" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
            <div class="modal-body">
            	<div class="d-flex align-items-center justify-content-center">
            		<div>
						<p class="h6 text-gray-900">Are you sure? the counselee didn't come ? </p>
						<div class="form-group text-center">
							<button class="btn btn-primary btn-sm waves-effect"
							onclick="event.preventDefault();
		                    document.getElementById('no-show-form').submit();">YES</button>
							<form id="no-show-form" action="{{ route('booking.no.show', $booking->id) }}" method="POST" style="display: none;">
								@csrf
								@method('PUT')
							</form>
							<button type="button" class="btn btn-danger waves-effect btn-sm" data-dismiss="modal">NO</button>
						</div>
            			
            		</div>	
				</div>
				
            </div>
		</div>
	</div>
</div>