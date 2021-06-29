@extends('layouts.app')


@section('content')

<style type="text/css">
body{
    background: #f7f7ff;
    margin-top:20px;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.me-2 {
    margin-right: .5rem!important;
}
</style>

	
<div class="container">
		<div class="main-body">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="{{asset('storage/'.$company_info->logo )}}" alt="Admin" class=" p-1 " width="110">
								<div class="mt-3">
									<h4>{{ $company_info->name }}</h4>
									<!-- <p class="text-secondary mb-1">Full Stack Developer</p>
									<p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p> -->
									<button class="btn btn-outline-primary" style="margin-left: 753px;" id="c_profile">Company Profile</button>
									<button class="btn btn-primary" id="c_employees">Company Employees</button>
						
								</div>
								<hr class="my-4">
							</div>
							@if(count($errors) > 0)
								<div class="alert alert-danger">
									Uploud Validation Error <br><br>
									<ul>
										@foreach ($errors->all() as $error)
										<li>{{ $error}}</li>
										@endforeach
									</ul>

								</div>
							@endif

							@if($message = Session::get('success'))
								<div class="alert alert-success alert-block">
									<button type="button" class="close" data-dismiss="alert">x</button>
									<strong>{{$message}}</strong>

								</div>
							@endif
							
							
							<ul class="list-group list-group-flush" id="main_info" >
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg> Company Name</h6>
									<span class="text-secondary">{{ $company_info->name }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> Email </h6>
									
									<span class="text-secondary">{{ $company_info->email }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> Phone</h6>
									<span class="text-secondary">{{ $company_info->contact_number }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="4" y1="12" x2="20" y2="12"></line><polyline points="14 6 20 12 14 18"></polyline></svg> Address</h6>
									<span class="text-secondary">{{ $company_info->postal_address }}</span>
								</li>
								
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> Number of Employees</h6>
									<span class="text-secondary">{{ $users->count() }}</span>
								</li>
								<br>
							<button type="button" id="show" class="btn btn-primary btn-lg btn-block">EDIT</button>
							<hr>
							</ul>
							
							
							<form method="POST" action="{{route('update.comapany_info')}}" enctype="multipart/form-data" style="display: none;" id="edit_info">
							@csrf
							<input type="text" name="client_id" hidden="" value="{{ $company_info->id }}">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg> Company Name</h6>
									<input type="text" name="company_name" class="form-control" value="{{ $company_info->name }}" style="width: 359px;border-style: groove;">
									
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> Email </h6>
									<input type="text" name="email" class="form-control" value="{{ $company_info->email }}" style="width: 359px;border-style: groove;">
									
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> Phone</h6>
									<input type="text" name="contact_number" class="form-control" value="{{ $company_info->contact_number }}" style="width: 359px;border-style: groove;">
									
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="4" y1="12" x2="20" y2="12"></line><polyline points="14 6 20 12 14 18"></polyline></svg> Address</h6>
									<input type="text" name="postal_address" class="form-control" value="{{ $company_info->postal_address }}" style="width: 359px;border-style: groove;">
									
									
								</li>
								
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> Number of Employees</h6>
									<input type="number" name="number_of_employees" class="form-control" value="{{ $users->count() }}" style="width: 359px;border-style: groove;">
									
								</li>
						
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap"  
								>
									
										<h6   class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg> Company Logo</h6>
										
										<img   src="{{asset('storage/'.$company_info->logo )}}" id="previewImg" alt="profile image" style="max-width:130px;margin-top:20px;">
										<input   type="file" name="file" class="form-control"  onchange="previewFile(this)"  style="width: 359px;border-style: groove;" >
									
									
								</li>
							</ul>
								<a class="btn btn-danger"id="cancel" style="margin-right: 12px;width: 149px;margin-left: 736px;">CANCEL</a>
								<button type="submit" class="btn btn-primary" style="width: 149px;">UPDATE</button> 
								
							

							</form>

							<!-- -----------------------company employees table  -->
							<!-- Modal -->
							<div class="modal fade" id="import-users" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Import Excel File for Company Users</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form method="POST" action="{{url('import_excel')}}" enctype="multipart/form-data"  id="edit_info">
										@csrf
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">Select File for Uploud</label>
											<input type="file" name="select_file" class="form-control">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Save changes</button>
										</div>
										
									</form>
								</div>
								
								</div>
							</div>
							</div>
							<!-- Modal -->
							<div class="card mb-4" id="Users" style="display:none;">
								<div class="card-header py-2">
									<div class="d-sm-flex justify-content-between p-3">
										<div>List of Company Users</div>
										<div>
											<a href="{{ isset($client) ? route('client.user.create', $client->id) : route('users.create') }}" class="btn btn-primary btn-sm">
												<i class="fa fa-plus"></i>
												<span>Create User</span>
											</a>
											<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#import-users">
												<i class="fa fa-upload"></i>
												<span>Import Users</span>
											</a>
											
										</div>
									</div>
								</div>

								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th></th>
													<th>Name</th>
													<th>Email</th>
													<th>Username</th>
													<th>Status</th>
													<th>Role</th>
													<th>Actions</th>
												</tr>
											</thead>

											<tbody>
												
											@foreach($users as $user)
											@php
												$active = $user->is_active;
											@endphp
											<tr data-client-id="{{ $user->client_id }}" class="user">
													<td><img src="{{ asset('sb-admin/img/undraw_profile.svg') }}" alt="{{ $user->name }}" height="45" width="45"class="text-center"></td>
													<td>{{ $user->name }}</td>
													<td>{{ $user->email }}</td>
													<td>{{ $user->username }}</td>
													<td>
														<span class="{{ $active ? 'badge badge-success' : 'badge badge-danger' }}">
															{{ $active ? 'Active' : 'Inactive' }}
														</span>
													</td>
													<td>
														@if(count($user->roles) > 0)
															@foreach($user->roles as $role)
																<span class="{{ $role->class }}">{{ $role->name }}</span>
															@endforeach
														@else
															<span class="badge badge-danger">Not Available</span>
														@endif
													</td>
													<td>
														<a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">
															<i class="fa fa-edit"></i>
														</a> | 
														<a href="#" class="btn btn-secondary btn-sm">
															<i class="fa fa-trash"></i>
														</a> |
														<a href="#" class="btn btn-{{ $user->is_active ? 'secondary' : 'primary' }} btn-sm"
															data-toggle="modal" data-target="#update-status-{{ $user->id}}">
															<i class="fa fa-eye"></i>
														</a>
														@include('pages.superadmin.clients.users.modals.update-status')
													</td>
												</tr>
										
											@endforeach

												
											</tbody>
										</table>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
  $("#show").click(function(){
	$("#main_info").hide();
	$("#Users").hide();

	$("#edit_info").show();
  });
  $("#cancel").click(function(){

	$("#main_info").show();
	$("#edit_info").hide();
  });
  $("#c_profile").click(function(){
	$("#main_info").show();
	$("#edit_info").hide();
	$("#Users").hide();

  });
  $("#c_employees").click(function(){
	$("#main_info").hide();
	$("#edit_info").hide();
	$("#Users").show();
  });
 

  
  
});

</script>
<script>
function previewFile(input){
	var file=$("input[type=file]").get(0).files[0];
	if(file)
	{
		var reader  = new FileReader();
		reader.onload = function(){
			$('#previewImg').attr("src", reader.result);
		}
		reader.readAsDataURL(file);
	}
  }
</script>
@stop
@section('js_scripts')
	<script>
	$(function() {

		$('#select-client').on('change', function() {
			let client = $('#select-client').val();
			let user = $('.user');
			if(client == 0) return user.show();
			
			user.hide();
			if(user.attr(`[data-client-id="${client}"]`) === undefined) {
				$('.user').attr(`[data-client-id="${client}"]`).show();
			}
		});

	});
	
	</script>
@stop