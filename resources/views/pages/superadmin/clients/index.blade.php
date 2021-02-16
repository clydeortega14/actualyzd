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
                        @include('alerts.message')
	    				<div class="table-responsive">
                            <table class="table table-hover basic-datatable table-striped table-bordered">
                                <thead>
                                    <tr>
                                        
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>No. of employees</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            
                                            <td>
                                                <img src="{{ $client->our_logo }}" height="40" width="40"  class="img-responsive img-circle">
                                            </td>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->number_of_employees }}</td>
                                            <td>{{ $client->contact_number }}</td>
                                            <td>
                                                @php
                                                    $active = $client->is_active;
                                                @endphp
                                                <span class="label {{ $active ? 'bg-green' : 'bg-red' }}">{{ $active ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-xs">
                                                    <i class="material-icons">edit</i>
                                                </a>
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