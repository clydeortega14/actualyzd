<div class="modal fade" id="cancel-form" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
                <h4 class="modal-title" id="create-schedule-modal-label">Reason For Cancelling</h4>
                <hr>
            </div>
            <form action="{{ route('cancel.booking', $booking->id) }}" method="POST">
            	@csrf
	            <div class="modal-body">
	            	<div class="form-group row">
						<label class="col-form-label col-sm-4 text-md-right">Reason:</label>
						<div class="col-sm-6">
							<textarea name="reason" class="form-control" placeholder="Please specify your reason here" rows="5" cols="50" required {{ !is_null($booking->reschedule) ? 'disabled' : ''}}>{{ is_null($booking->reschedule) ? '' : $booking->reschedule->reason }}</textarea>
						</div>
					</div>
	            </div>
	            <div class="modal-footer">
	            	@if(is_null($booking->reschedule))
	            		<button type="submit" class="btn btn-primary waves-effect">Submit</button>
	            	@endif
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
	            </div>
            </form>
		</div>
	</div>
</div>