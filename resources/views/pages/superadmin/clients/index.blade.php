@extends('layouts.app')

@section('title', 'Clients')


@section('content')

	<div class="container-fluid" id="app">
	    <!-- Clients widgets -->
	    <div class="row clearfix mb-3">
	    	<div class="col-12">
                <h3 class="mb-3 text-gray-800">Clients</h3>
            </div>
        </div>

        <div class="row clearfix mb-3">
            <div class="col-md-12">
                @include('alerts.message')
	    		<div class="card mb-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            Client Lists
                            
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#new-client">
                                <i class="fa fa-plus"></i>
                                <span>Create New Client</span>
                            </a>

                            @include('pages.superadmin.clients.modals.client-form-modal')
                        </div>
                    </div>
                <div class="card-header py-2">
						<div class="d-sm-flex justify-content-between p-3">
							<div>Client Lists</div>
							<div>
								<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create_client">
									<i class="fa fa-plus"></i>
									<span>Create Client</span>
								</a>
								
								@include('pages.superadmin.clients.users.modals.create-client')
								@include('pages.superadmin.users.modals.import-users')
							</div>
						</div>
					</div>
                  
	    			<div class="card-body">
                    <!-- <clientlist-user> </clientlist-user> -->
                    <div class="col-md" style="display: flex;">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search Client " />
                    <select class="form-select " id="status" aria-label="Default select example"  style="background-color: #7386d5;color: white;text-align: center;margin-left: 10px;">
                        <option selected >Choose Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        
                    </select>
                        
                        
                    </div>
                    
                    <br>
                    
	    				<div class="table-data">
                        
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>No. of employees</th>
                                        <th>Status</th>
                                        <th style="text-align: center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->postal_address }}</td>
                                            
                                            <td>{{ $client->contact_number }}</td>
                                            <td>{{ $client->number_of_employees }}</td>
                                            <td>
                                                @php
                                                    $active = $client->is_active;
                                                @endphp
                                                <span class="label {{ $active ? 'badge badge-success' : 'badge badge-danger' }}">{{ $active ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            <td align="right">
                                                @if(auth()->user()->hasRole('superadmin'))
                                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a> |
                                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-{{ $client->is_active ? 'danger' : 'success' }} btn-sm"
                                                        data-toggle="modal" data-target="#update-status-{{ $client->id }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    @include('pages.superadmin.clients.modals.update-status')
                                                @endif
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                   
                                </tbody>
                            </table>  
                            {!! $clients->render() !!} 
                            

                        </div>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	    <!-- End Clients widgets -->
	</div>

@endsection

@section('js_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	
$(document).ready(function(){
	//search
	$(document).on('keyup',function(e){
		e.preventDefault();
		let search_Client = $('#search').val();
		$.ajax({
            url:"{{ route('search.Client') }}",
            method:'GET',
            data:{search_Client:search_Client},
            
            success:function(res)
            {
				
                $('.table-data').html(res);
				if(res.status == 'nothing_found'){
					$('.table-data').html('<span class="text-danger">'+'Client User Not Found'+'</span>');
				}
            }
        })
    });
    //status
	$(document).on('change',function(e){
		e.preventDefault();
		let status = $('#status').val();
       
		$.ajax({
            url:"{{ route('filter.status.Client') }}",
            method:'GET',
            data:{status:status},
            
            success:function(res)
            {
				
                $('.table-data').html(res);
				if(res.status == 'nothing_found'){
					$('.table-data').html('<span class="text-danger">'+'Client User Not Found'+'</span>');
				}
            }
        })
    });
});
</script>

@stop

