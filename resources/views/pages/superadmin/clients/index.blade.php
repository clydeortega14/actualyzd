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
                                        <th>ID</th>
                                        <th>Logo</th>
                                        <th>Company Name</th>
                                        <th>No. of employees</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><img src="{{ asset('admin-bsb/images/client-empty-logo.png') }}" height="40" width="40"></td>
                                        <td>San Miguel Corporation</td>
                                        <td>100 Employees</td>
                                        <td>32-4323</td>
                                        <td>
                                            <span class="label bg-red">Inactive</span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm">Action</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td><img src="{{ asset('admin-bsb/images/client-empty-logo.png') }}" height="40" width="40"></td>
                                        <td>Kahit Bahay Cooperatives</td>
                                        <td>150 Employees</td>
                                        <td>32-342432</td>
                                        <td>
                                            <span class="label bg-red">Inactive</span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm">Action</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>3</td>
                                        <td><img src="{{ asset('admin-bsb/images/client-empty-logo.png') }}" height="40" width="40"></td>
                                        <td>Sama-sama Multipurpose Coop</td>
                                        <td>300 Employees</td>
                                        <td>09384923843</td>
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
	    <!-- End Clients widgets -->
	</div>

@endsection