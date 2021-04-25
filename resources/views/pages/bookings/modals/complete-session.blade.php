<div class="modal fade" id="complete-session" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
            <div class="modal-body">
            	<div class="text-center">
					<p class="h6 text-gray-900">Are you sure? you want to complete session </p>
					<div class="form-group">
						<button class="btn btn-primary"
						onclick="event.preventDefault();
                        document.getElementById('complete-session-form').submit();">YES</button>
						<form id="complete-session-form" action="{{ route('booking.complete', $booking->id) }}" method="POST" style="display: none;">
							@csrf
							@method('PUT')
						</form>
						<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">NO</button>
					</div>
				</div>
            </div>
		</div>
	</div>
</div>