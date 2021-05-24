<div class="modal fade" id="option-edit" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
                <h4 class="modal-title" id="option-edit-modal-label">Edit Option</h4>
                <hr>
            </div>
            <form id="option-edit-form" action="" method="POST">
            	@csrf
            	@method('PUT')
	            <div class="modal-body">
	            	<div class="form-group row">
						<label class="col-form-label col-sm-4 text-md-right">ID:</label>
						<div class="col-sm-6">
							<input name="option_id" id="option-id-edit" class="form-control" readonly>
						</div>
					</div>
	            	<div class="form-group row">
						<label class="col-form-label col-sm-4 text-md-right">Name:</label>
						<div class="col-sm-6">
							<input name="option_name" id="option-id-name" class="form-control">
						</div>
					</div>
	            </div>
	            <div class="modal-footer">
	            	<button type="submit" class="btn btn-primary waves-effect">Save</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
	            </div>
            </form>
		</div>
	</div>
</div>