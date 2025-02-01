<div class="container mt-3 mb-4">
	<div class="row justify-content-center mb-3">
		<div class="col-md-8 text-center">
			<div>
				<span>Total Employees</span>
			</div>
			<div>
				<h1>{{ $employees->count() }}</h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 mb-3">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
				<div class="input-group-append">
				  <button class="btn btn-primary" type="button" id="button-addon2">Search</button>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<a href="{{ isset($client) ? route('client.user.create', $client->id) : route('users.create') }}" 
				class="btn btn-primary btn-sm float-right"
				>
				<i class="fa fa-plus"></i>
				<span>Add Employee</span>
			</a>
		</div>
			
		<div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
			<table class="table manage-candidates-top mb-0">
				<thead>
	              	<tr>
	                	<th>Name</th>
	                	<th class="text-center">Status</th>
	                	<th class="action text-right">Action</th>
	              	</tr>
	            </thead>
				<tbody>
					
					@foreach($employees as $user)
						<tr class="candidates-list">
							<td class="title">
			                  	<div class="thumb">
			                    	<img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
			                  	</div>
			                  	<div class="candidate-list-details">
				                    <div class="candidate-list-info">
				                      	<div class="candidate-list-title">
				                        	<h5 class="mb-0"><a href="#">{{ $user->name }}</a></h5>
				                      	</div>
				                      	<div class="candidate-list-option">
					                        <ul class="list-unstyled">
					                          	<li><i class="fas fa-filter pr-1"></i>added {{ $user->created_at->diffForHumans() }}</li>
					                          	<li><i class="fas fa-user pr-1"></i>{{ implode(",", $user->roles->pluck('display_name')->toArray() ) }}</li>
					                        </ul>
				                      	</div>
				                    </div>
			                  	</div>
			                </td>
			                <td class="candidate-list-favourite-time text-center">
			                  	<a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>
			                  	<span class="candidate-list-time order-1">{{ $user->status_name }}</span>
			                </td>
			                <td>
			                  	<ul class="list-unstyled mb-0 d-flex justify-content-end">
			                    	<li><a href="#" class="text-primary" data-toggle="modal" data-target="#update-status-{{ $user->id}}"data-original-title="view"><i class="far fa-eye"></i></a></li>
			                    	<li><a href="{{ route('users.edit', $user->id) }}" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
			                    	<li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>
			                  	</ul>


			                  	@include('pages.superadmin.clients.users.modals.update-status')
			                </td>
						</tr>

					@endforeach 
				</tbody>
			</table>
			
		</div>
	</div>
</div>
