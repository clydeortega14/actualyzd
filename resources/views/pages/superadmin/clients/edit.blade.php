@extends('admin-layouts.master')

@section('title', 'Edit Client')


@section('content')

	<div class="container-fluid">
		<div class="block-header">
			<h2>Edit Client</h2>
		</div>

		<div class="row clearfix">
			<div class="col-md-6">
				<div class="card">
					<div class="body">
						<form class="form-line">
							@csrf

							<div class="row clearfix justify-content-center">
								<div class="col-md-12">
									<img src="{{ $client->our_logo }}" class="img-responsive img-circle" height="100" width="100" style="display: block; margin-left: auto; margin-right: auto;width: 50%;">
								</div>
							</div>

							<div class="row clearfix">
		                        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-4 form-control-label">
		                            <label for="company-name">Company Name</label>
		                        </div>
		                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
		                            <div class="form-group">

		                                <div class="form-line @error('name') error @enderror ">
		                                    <input type="text" name="name" id="company-name" class="form-control @error('name') error @enderror " value="{{ $client->name }}" readonly>
		                                </div>

		                                @error('name')
		                                    <label class="error">{{ $message }}</label>
		                                @enderror
		                            </div>
		                        </div>
		                    </div>

		                    <div class="row clearfix">

		                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
		                            <label for="company-email">Company Email</label>
		                        </div>
		                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
		                            <div class="form-group">
		                                <div class="form-line @error('email') error @enderror">
		                                    <input type="text" name="email" id="company-email" class="form-control @error('email') error @enderror" value="{{ $client->email }}" readonly>
		                                </div>
		                                @error('email')
		                                    <label class="error">{{ $message }}</label>
		                                @enderror
		                            </div>
		                        </div>
		                    </div>

		                    <div class="row clearfix">
		                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
		                            <label for="no-of-employees">No. of employees</label>
		                        </div>
		                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
		                            <div class="form-group">
		                                <div class="form-line @error('no_of_employees') error @enderror">
		                                    <input type="number" name="no_of_employees" id="no-of-employees" class="form-control @error('no_of_employees') error @enderror" value="{{ $client->number_of_employees }}" readonly>
		                                </div>
		                                @error('no_of_employees')
		                                    <label class="error">{{ $message }}</label>
		                                @enderror
		                            </div>
		                        </div>
		                    </div>

		                    <div class="row clearfix">
		                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
		                            <label for="contact-number">Contact Number</label>
		                        </div>
		                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
		                            <div class="form-group">
		                                <div class="form-line @error('contact_number') error @enderror">
		                                    <input type="text" name="contact_number" id="contact-number" class="form-control @error('contact_number') error @enderror" value="{{ $client->contact_number }}" readonly>
		                                </div>
		                                @error('contact_number')
		                                    <label class="error">{{ $message }}</label>
		                                @enderror
		                            </div>
		                        </div>
		                    </div>

		                    

		                    <div class="row clearfix">
		                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
		                            <label for="company-address">Company Address</label>
		                        </div>
		                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
		                            <div class="form-group">
		                                <div class="form-line @error('address') error @enderror">
		                                    <textarea class="form-control no-resize  @error('address') error @enderror" rows="4" name="address" id="company-address" readonly>{{ $client->postal_address }}</textarea>
		                                </div>
		                                @error('address')
		                                    <label class="error">{{ $message }}</label>
		                                @enderror
		                            </div>
		                        </div>
		                    </div>

		                    <div class="row clearfix">
		                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
		                            <label for="company-address">Status</label>
		                        </div>
		                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
		                            <div class="form-group">
		                                <div class="form-line">
		                                	<select class="form-control show-tick" name="status">
		                                		<option value="1" {{ $client->is_active == 1 ? 'selected' : '' }}>Active</option>
		                                		<option value="0" {{ $client->is_active == 0 ? 'selected' : '' }}>Inactive</option>
		                                	</select>
		                                </div>
		                            </div>
		                        </div>
		                    </div>

		                    <div class="row clearfix">
		                    	<div class="col-md-12">
		                    		<div class="pull-right">
		                    			<a href="#" class="btn btn-danger btn-lg waves-effect">Cancel</a>
		                    			<button type="button" class="btn btn-primary btn-lg waves-effect">Save Changes</button>
		                    		</div>
		                    	</div>
		                    </div>
	                    </form>
					</div>
				</div>
			</div>

			<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						( 20 / 60 ) Users
					</div>

					<div class="body">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th></th>
										<th>Name</th>
										<th>Email</th>
										<th>Role</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection