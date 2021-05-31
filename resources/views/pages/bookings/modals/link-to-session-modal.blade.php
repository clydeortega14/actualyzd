<div class="modal fade" id="link-to-session-{{ $booking->id }}" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                <h5 class="modal-title" id="add-link-to-session">Add Link For Session</h5>
                <hr>
            </div>
            <form action="{{ route('booking.link.to.session', $booking->id) }}" method="POST">
            	@csrf
            	@method('PUT')
	            <div class="modal-body">
	            	<div class="form-group">
						<label>Add Link Here</label>
						<textarea name="link_to_session" class="form-control" placeholder="Paste link to session here" rows="5" cols="50" required>{{ $booking->link_to_session }}</textarea>
					</div>
	            </div>
	            <div class="modal-footer">
	            	<button type="submit" class="btn btn-primary waves-effect">Submit</button>
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">CLOSE</button>
	            </div>
            </form>
		</div>
	</div>
</div>