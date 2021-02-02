@extends('admin-layouts.master')

@section('title', 'Clients')


@section('content')

	<div class="container-fluid">
		<div class="block-header">
	        <h2>CLIENTS LISTS</h2>
	    </div>

	    <!-- Clients widgets -->
	    <div class="row clearfix">
	    	<div class="col-12">
	    		<div class="card">
	    			<div class="body">
	    				<div class="table-responsive">
                            <table class="table table-hover basic-datatable table-striped table-bordered">
                                <thead>
                                    <tr>
                                        
                                        <th>Logo</th>
                                        <th>Company Name</th>
                                        <th>No. of employees</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            
                                            <td><img src="{{ $client->ourLogo() }}" height="40" width="40"  class="img-responsive img-circle"></td>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->number_of_employees }}</td>
                                            <td>{{ $client->contact_number }}</td>
                                            <td>
                                                <span class="label bg-red">Inactive</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-warning btn-sm">Action</a>
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
	    <!-- End Clients widgets -->
	</div>

@endsection