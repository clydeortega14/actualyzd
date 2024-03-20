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
		<div class="d-flex align-content-end mb-3">
			<div>
				<a href="{{ isset($client) ? route('client.user.create', $client->id) : route('users.create') }}" 
					class="btn btn-primary btn-sm"
					>
					<i class="fa fa-plus"></i>
					<span>Create User</span>
				</a>
			</div>
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
			<div class="text-center mt-3 mt-sm-3">
            	<ul class="pagination justify-content-center mb-0">
              		<li class="page-item disabled"> <span class="page-link">Prev</span> </li>
              		<li class="page-item active" aria-current="page"><span class="page-link">1 </span> <span class="sr-only">(current)</span></li>
              		<li class="page-item"><a class="page-link" href="#">2</a></li>
              		<li class="page-item"><a class="page-link" href="#">3</a></li>
              		<li class="page-item"><a class="page-link" href="#">...</a></li>
              		<li class="page-item"><a class="page-link" href="#">25</a></li>
              		<li class="page-item"> <a class="page-link" href="#">Next</a> </li>
            	</ul>
          	</div>
		</div>
	</div>
</div>
