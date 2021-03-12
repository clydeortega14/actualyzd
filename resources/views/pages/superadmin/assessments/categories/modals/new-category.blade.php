<div class="modal fade" id="new-question" tabindex="-1" aria-labelledby="new-question" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
        	<label for="question" class="col-form-label col-sm-4 text-md-right">Question</label>
        	<div class="col-sm-6">
        		<textarea type="text" name="question" class="form-control"></textarea>
        	</div>
        </div>

        <div class="form-group row">
        	<label for="option" class="col-form-label col-sm-4 text-md-right">Option</label>
        	<div class="col-sm-6">
        		<select type="combobox" name="option" class="form-control">
        			<option value="" disabled selected>-- Choose Option--</option>
        			@foreach($options as $option)
        				<option value="{{ $option->id }}">{{ $option->name }}</option>
        			@endforeach
        		</select>
        	</div>
        </div>


        <div class="form-group row">
        	<label for="" class="text-md-right col-sm-4 col-form-label"></label>
        	<div class="col-sm-6">
        		
        		<div id="option-choices">
        			<div class="d-sm-flex align-items-center justify-content-between mt-4">
						<div>
							<h6 class="text-gray">Option Choices</h6>
						</div>
						<div>Add choices</div>
					</div>
					<div id="choices-lists">
						
					</div>
        		</div>
        	</div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>