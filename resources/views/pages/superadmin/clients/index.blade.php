@extends('layouts.app')

@section('title', 'Clients')


@section('content')

	<div class="container-fluid">
	    <!-- Clients widgets -->
	    <div class="row clearfix">
	    	<div class="col-12">
                <h1 class="h3 mb-3 text-gray-800">Clients</h1>
                <hr>
                <a href="{{ route('home') }}" class="btn btn-info mb-3">
                    <i class="fa fa-arrow-left">
                        <span>Return Back</span>
                    </i>
                </a>

                @include('alerts.message')
	    		<div class="card mb-3">
                    <div class="card-header">Client Lists</div>
	    			<div class="card-body">
                        
	    				<div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>No. of employees</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th>expires_at</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->number_of_employees }}</td>
                                            <td>{{ $client->contact_number }}</td>
                                            <td>
                                                @php
                                                    $active = $client->is_active;
                                                @endphp
                                                <span class="label {{ $active ? 'badge badge-success' : 'badge badge-danger' }}">{{ $active ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            <td>
                                                @if(!is_null($client->subscription))
                                                <span class="badge badge-secondary">{{ $client->subscription->wholeDate() }}</span>
                                                @else
                                                    <span>N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('client.users.index', $client->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fa fa-users"></i>
                                                </a> 
                                                @if(auth()->user()->hasRole('superadmin'))|
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
                        </div>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	    <!-- End Clients widgets -->
	</div>

@endsection