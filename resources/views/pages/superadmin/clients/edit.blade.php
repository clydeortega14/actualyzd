@extends('layouts.app')

@section('content')

	<div class="container-fluid" id="app">

		<div class="row clearfix mb-3">
	    	<div class="col-12">
                <h3 class="mb-3 text-gray-800">Client Profile</h3>
				
            </div>
        </div>

		<div class="row clearfix">
			<div class="col-md-4 border-right">
				<div class="card mb-3">
					{{-- <div class="card-header">Client Details</div> --}}
					<div class="card-body">
						<form action="#" method="POST">
							@csrf

							@if(isset($client))
								@method('PUT')
							@endif


							<div class="form-group">
	                            <label for="company-name">Company Name</label>
	                        	<input type="text" name="name" id="company-name" class="form-control @error('name') error @enderror " value="{{ $client->name }}" readonly>
		                    </div>

		                    <div class="form-group">
		                        <label for="company-email">Company Email</label>
		                        <input type="text" name="email" id="company-email" class="form-control @error('email') error @enderror" value="{{ $client->email }}" readonly>
		                    </div>

		                    <div class="form-group">
		                    	<label for="no-of-employees">No. of employees</label>
		                    	<input type="number" name="no_of_employees" id="no-of-employees" class="form-control @error('no_of_employees') error @enderror" value="{{ $client->number_of_employees }}" readonly>
		                    </div>

		                    <div class="form-group">
		                    	<label for="contact-number">Contact Number</label>
		                    	<input type="text" name="contact_number" id="contact-number" class="form-control @error('contact_number') error @enderror" value="{{ $client->contact_number }}" readonly>
		                    </div>

		                    <div class="form-group">
		                        <label for="company-address">Company Address</label>
		                        <textarea class="form-control no-resize  @error('address') error @enderror" rows="4" name="address" id="company-address" readonly>{{ $client->postal_address }}</textarea>
		                    </div>
	                    </form>
					</div>
				</div>
			</div>

			<div class="col-md-8">
				@include('alerts.message')


				<div class="card mb-3">
					<div class="card-body">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
						    	<button class="nav-link active" id="employees-tab" data-toggle="tab" data-target="#employees" type="button" role="tab" aria-controls="employees" aria-selected="true">
						    		Employees
						    	</button>
							</li>
							<li class="nav-item">
						    	<button class="nav-link" id="subscription-tab" data-toggle="tab" data-target="#subscription" type="button" role="tab" aria-controls="subscription" aria-selected="false">
						    		Subscriptions
						    	</button>
							</li>
						</ul>

						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="employees" role="tabpanel" aria-labelledby="employees-tab">
								<div class="mt-3">
									<div class="d-flex justify-content-end mb-3">
										<div>
											<a href="{{ isset($client) ? route('client.user.create', $client->id) : route('users.create') }}" class="btn btn-primary btn-sm">
												<i class="fa fa-plus"></i>
												<span>Create User</span>
											</a>
											{{-- <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#import-users">
												<i class="fa fa-upload"></i>
												<span>Import Users</span>
											</a>
											@include('pages.superadmin.users.modals.import-users') --}}
											
											
										</div>
										
									</div>
									
									<div class="container">
										<div class="row">
											<div class="col-sm" style="display: flex;">
												
													<input class="form-control" id="search" name="search" type="search" placeholder="Search..">
													
													<!-- <select class="form-select" aria-label="Default select example" >
														<option selected>Choose Status</option>
														<option value="1">Active</option>
														<option value="0">Deactivate</option>
														
													</select> -->
												
												
											</div>
											
											
										</div>
									</div>
									<br>
									
									<input type="text" hidden="" id="client" name="client" value="{{ $client->id }}">
									<div class="table-data">
										<table class="table" id="myTable" >
											<thead>
												<tr>
													
													<th>Name</th>
													<th>Email</th>
													<th>Status</th>
													<th>Actions</th>
													
												</tr>
											</thead>
											<tbody >
											
												 @foreach($users as $user)
													<tr>
														
														<td>{{ $user->name }}</td>
														<td>{{ $user->email }}</td>
														<td>
															<span class="{{ $user->is_active ? 'badge badge-primary' : 'badge badge-secondary'}}">
																{{ $user->is_active ? 'Active' : 'Inactive' }}
															</span>
														</td>
														<td>
															<a href="#" class="btn btn-{{ $user->is_active ? 'secondary' : 'primary' }} btn-sm"
																data-toggle="modal" data-target="#update-status-{{ $user->id}}">
																<i class="fa fa-eye"></i>
															</a> |

															@include('pages.superadmin.clients.users.modals.update-status')

															<a href="#" class="btn btn-secondary btn-sm">
																<i class="fa fa-trash"></i>
															</a>
														</td>
													</tr>
												@endforeach  
												</tbody>
												
											
										</table>
									{!!$users->links()!!}
									</div>

									
					
									
								</div>
							</div>
							<div class="tab-pane fade" id="subscription" role="tabpanel" aria-labelledby="subscription-tab">
								<div class="mt-4">
									@if(count($packages) > 0 && isset($client))
										<form action="{{ route('add.client.subscription') }}" method="POST">
										@csrf

										<input type="hidden" name="client_id" value="{{ $client->id}}"> 
											
											<div class="row">
												@if(is_null($client->subscription))

													<div class="d-flex justify-content-end">
														<div>
															<button type="submit" class="btn btn-success btn-sm">
																<i class="fa fa-plus"></i>
															</button>
															<a href="#" class="btn btn-danger btn-sm">
																<i class="fa fa-times"></i>
															</a>
														</div>
													</div>
													
													@foreach($packages as $package)
														<div class="col-md-4">
															<div class="card mb-3">
																<div class="card-header">
																	<div class="d-sm-flex justify-content-between">
																		<div>{{ $package->name }} - &#8369; {{ $package->formattedPrice() }}</div>
																		<div>{{ $package->no_of_months }} {{ $package->no_of_months <= 1 ? 'Month' : 'Months'}}</div>
																	</div>
																	
																</div>

																<div class="card-body">
																	<div class="row justify-content-center">
																		<ul>
																			@foreach($package->services as $service)
																				<li>{{ $service->limit.' '.$service->sessionType->name}}</li>
																			@endforeach
																		</ul>
																	</div>
																	
																</div>

																<div class="card-footer">
																	<div class="d-flex justify-content-center">
																		<input type="radio" name="package_id" value="{{ $package->id }}">
																	</div>
																</div>
															</div>
														</div>
													@endforeach
													
												@else
													@php
														$package = $client->subscription->package;
													@endphp
													<div class="col-md-12">
														<div class="card mb-3">
															<div class="card-header">
																<div class="d-flex justify-content-between">
																	<div>
																		{{ $package->name.' - '.$package->formattedPrice().' Pesos for '.$package->no_of_months.' Months' }}
																	</div>
																	<div>
																		<label>Expires At: </label> 
																		<b>{{ $client->subscription->wholeDate() }}</b>
																	</div>
																</div>
															</div>
															<div class="card-body">
																<div class="row justify-content-center">
																	<ul>
																		@foreach($package->services as $service)
																			<li>{{ $service->limit.' '.$service->sessionType->name}}</li>
																		@endforeach
																	</ul>
																</div>
															</div>
														</div>
													</div>
												@endif
											</div>
										</form>
									@else
										<div class="card mb-3">
											<div class="card-body text-center">
												<h5 class="card-title">Packages Available</h5>
											</div>
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
@section('js_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	
$(document).ready(function(){
	//pagination
	$(document).on('click', '.pagination a', function(e){
       e.preventDefault();
	   let page = $(this).attr('href').split('page=')[1]
	   
	   users(page);
    });

	function users(page){
		var cl = $("input[name='client']").val();
		$.ajax({
			url:"/pagination/pagination-data?page="+page,
			data:{page:page, cl : cl},
			success:function(data){
				$('.table-data').html(data);
			}
		})
	}

	//search
	$(document).on('keyup',function(e){
		e.preventDefault();
		let search_Clientuser = $('#search').val();
		var cl = $("input[name='client']").val();

		
		$.ajax({
            url:"{{ route('search.UserClient') }}",
            method:'GET',
            data:{search_Clientuser:search_Clientuser,cl : cl},
            
            success:function(res)
            {

                $('.table-data').html(res);
				if(res.status == 'nothing_found'){
					$('.table-data').html('<span class="text-danger">'+'Nothing Found'+'</span>');
				}
            }
        })
    });

	// fetch_customer_data();
	
	
	// function fetch_customer_data(query = '')
    // {
	// 	var cl = $("input[name='client']").val();
		
		
    //     $.ajax({
    //         url:"{{ route('search') }}",
    //         method:'GET',
    //         data:{query:query, cl : cl},
    //         dataType:'json',
    //         success:function(data)
    //         {
    //             $('tbody').html(data.table_data);
    //             $('#pag').html(data.table_data);
    //             $('#total_records').text(data.total_data);
    //         }
    //     })
    // }

	// $(document).on('keyup', '#search', function(){
    //     var query = $(this).val();
    //     fetch_customer_data(query);
    // });
//   $("#search").on("keyup", function() {
//     $value = $(this).val();
// 	$.ajax({
// 		type:'get',
// 		url:'{{URL::to('search')}}',
// 		data:{'search':$value},

// 		success:function(data){
// 			console.log(data);
// 			$('#content').html(data);
// 		}
// 	});
//   });
});
</script>
@stop