@extends('admin-layouts.master')


@section('title', 'Psychologists')


@section('content')
	
	<div class="container-fluid">
		<div class="block-header">
	        <h2>PSYCHOLOGISTS LISTS</h2>
	    </div>

	    <div class="row clearfix">
	    	<div class="col-12">
	    		<div class="card">
	    			<div class="header">
	    				<h2></h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
	    			</div>

	    			<div class="body">
	    				<div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>License</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                        	<div class="user-info">
                                        		
                                        	<div class="image">
                                        		<img src="{{ asset('admin-bsb/images/user.png') }}" height="48" width="48" class="img-circle">
                                        	</div>
                                        	</div>
                                        </td>
                                        <td>Juan Tamad</td>
                                        <td>juan@tamad.gmail.com</td>
                                        <td>...</td>
                                        <td>099823433</td>
                                        <td>
                                            <span class="label bg-green">Active</span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm">Action</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        	<div class="user-info">
                                        		
                                        	<div class="image">
                                        		<img src="{{ asset('admin-bsb/images/user.png') }}" height="48" width="48" class="img-circle">
                                        	</div>
                                        	</div>
                                        </td>
                                        <td>Pablo Escomorino</td>
                                        <td>pablo@morino21.gmail.com</td>
                                        <td>...</td>
                                        <td>09383784832</td>
                                        <td>
                                            <span class="label bg-red">Inactive</span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm">Action</a>
                                        </td>
                                    </tr>

                                    
                                </tbody>
                            </table>
                        </div>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	</div>

@endsection