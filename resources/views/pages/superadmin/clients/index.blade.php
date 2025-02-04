@extends('layouts.app')

@section('title', 'Clients')


@section('content')

	<div class="container-fluid">
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
	    			<div class="card-body">
                        
	    				<div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th style="text-align: right;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            <td>
                                                {{ $client->name }}
                                            </td>
                                            <td>
                                                @php
                                                    $active = $client->is_active;
                                                @endphp
                                                <span class="label {{ $active ? 'badge badge-success' : 'badge badge-danger' }}">{{ $active ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            <td align="right">
                                                @if(auth()->user()->hasRole('superadmin'))

                                                    @if($active)
                                                    
                                                        @if(is_null($client->subscription))

                                                            <a href="{{ route('client.subscriptions', $client->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Subscription">
                                                                <i class="fa fa-bell"></i>
                                                            </a>

                                                        @else
                                                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Client Profile">
                                                                <i class="fa fa-edit"></i>
                                                            </a>

                                                        @endif |

                                                    @endif

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