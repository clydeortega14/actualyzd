<div class="modal fade" id="create_client" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
            <div class="modal-body">
			
			<form  method="POST" action="{{ route('add.client') }}" aria-label="" enctype="multipart/form-data">
			@csrf
				<div class="form-row">
					<div class="form-group col-md-6">
					<label for="inputEmail4">Client Name</label>
					<input name="client_name" type="text" class="form-control" id="inputEmail4" placeholder="" requried>
					</div>
					<div class="form-group col-md-6">
					<label for="inputPassword4">Email</label>
					<input name="Email" type="email" class="form-control" id="inputPassword4" placeholder="" requried>
					</div>
				</div>
				<div class="form-group">
					<label for="inputAddress">Contact Number</label>
					<input name="contact_number"  type="number" class="form-control" id="inputAddress" placeholder="" requried>
				</div>
				<div class="form-group">
					<label for="inputAddress2">Postal Address</label>
					<input name="postal_address" type="text" class="form-control" id="inputAddress2" placeholder="" requried>
				</div>
				
				<button type="submit" class="btn btn-primary">Submit new Client</button>
				</form>
            </div>
		</div>
	</div>
</div>