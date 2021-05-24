<div class="modal fade" id="choice-edit" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
                <h4 class="modal-title" id="option-edit-modal-label">Edit Choice</h4>
                <hr>
            </div>
            <form id="choice-edit-form" action="" method="POST">
            	@csrf
            	@method('PUT')
	            <div class="modal-body">
	            	<input type="hidden" name="optionchoice_id" id="optionchoice-id" class="form-control" required>

	            	<div class="form-group row">
						<label class="col-form-label col-sm-4 text-md-right">Value:</label>
						<div class="col-sm-6">
							<input name="choice_value" id="choice-value-edit" class="form-control" required>
						</div>
					</div>
	            	<div class="form-group row">
						<label class="col-form-label col-sm-4 text-md-right">Display Name:</label>
						<div class="col-sm-6">
							<input name="choice_name" id="choice-name-edit" class="form-control" required>
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