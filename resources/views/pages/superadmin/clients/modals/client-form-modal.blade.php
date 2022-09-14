<div class="modal fade" id="new-client" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
        		<h5 class="modal-title" id="clientFormTitle">Client Form</h5>
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    				<span aria-hidden="true">&times;</span>
    			</button>
    		</div>

    		<form action="{{ route('clients.store') }}" method="POST">
    			@csrf

	            <div class="modal-body">
	            	<div class="form-group row">
	            		<label class="col-form-label col-sm-4 text-md-right">Name</label>
	            		<div class="col-sm-6">
	            			<input type="text" name="name" class="form-control" value="{{ old('name') }}">
	            		</div>
	            	</div>

	            	<div class="form-group row">
	            		<label class="col-form-label col-sm-4 text-md-right">Email</label>
	            		<div class="col-sm-6">
	            			<input type="email" name="email" class="form-control" value="{{ old('email') }}">
	            		</div>
	            	</div>

	            	<div class="form-group row">
	            		<label class="col-form-label col-sm-4 text-md-right">Address</label>
	            		<div class="col-sm-6">
	            			<input type="text" name="address" class="form-control" value="{{ old('address') }}">
	            		</div>
	            	</div>

	            	<div class="form-group row">
	            		<label class="col-form-label col-sm-4 text-md-right">No. Of Employees</label>
	            		<div class="col-sm-6">
	            			<input type="number" name="no_of_employees" class="form-control" value="{{ old('no_of_employees') }}">
	            		</div>
	            	</div>

	            	<div class="form-group row">
	            		<label class="col-form-label col-sm-4 text-md-right">Contact #</label>
	            		<div class="col-sm-6">
	            			<input type="number" name="contact" class="form-control" value="{{ old('contact') }}">
	            		</div>
	            	</div>
	            </div>

	            <div class="modal-footer">
	            	<button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-primary">Submit</button>
	            </div>
            </form>
		</div>
	</div>
</div>