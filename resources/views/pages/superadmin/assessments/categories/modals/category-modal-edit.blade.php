<div class="modal fade" id="category-edit" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
                <h4 class="modal-title" id="option-edit-modal-label">Edit Category</h4>
                <hr>
            </div>
            <form id="category-edit-form" action="" method="POST">
            	@csrf
            	@method('PUT')
	            <div class="modal-body">
	            	<div class="form-group row">
						<label class="col-form-label col-sm-4 text-md-right">Category Name:</label>
						<div class="col-sm-6">
							<input name="category_name" id="category-name-edit" class="form-control" required>
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