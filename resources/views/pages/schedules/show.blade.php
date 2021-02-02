@extends('admin-layouts.master')

@section('title', 'Schedules')

@section('content')
	
	<div class="container-fluid">
		<div class="block-header">
			
		</div>

		<div class="row clearfix">
			<!-- Panel -->
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="card">
					<div class="body">
						<div class="panel panel-default panel-post">
			                <div class="panel-heading">
			                    <div class="media">
			                        <div class="media-left">
			                            <a href="#">
			                                <img src="{{ asset('admin-bsb/images/no-user.png') }}" />
			                            </a>
			                        </div>
			                        <div class="media-body">
			                            <h4 class="media-heading">
			                                <a href="#">Marc K. Hammond</a>
			                            </h4>
			                            Opened - 26 Oct 2018
			                        </div>
			                    </div>
			                </div>
			                <div class="panel-body">
			                    <div class="post">
			                        <div class="post-heading">
			                            <p>To raise awareness of cyber bullying.. <br>#notocyberbullying</p>
			                        </div>
			                        <div class="post-content">
			                            <img src="{{ asset('admin-bsb/images/profile-post-image.jpg') }}" class="img-responsive" />
			                        </div>
			                    </div>
			                </div>
			                <div class="panel-footer">
			                    <ul>
			                        <li class="m-b-5">
			                            <a href="#">
			                                <i class="material-icons">comment</i>
			                                <span>5 Comments</span>
			                            </a>
			                        </li>
			                    </ul>
			               		
			                	<div class="media">
	                                <div class="media-left">
	                                    <a href="javascript:void(0);">
	                                        <img class="media-object img-circle" src="{{ asset('admin-bsb/images/no-user.png') }}" width="64" height="64">
	                                    </a>
	                                </div>
	                                <div class="media-body">
	                                    <h4 class="media-heading">Noris Armos</h4> 
	                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
	                                    ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
	                                    turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis
	                                    in faucibus.
	                                </div>
	                            </div>

	                            <div class="media">
	                                <div class="media-left">
	                                    <a href="javascript:void(0);">
	                                        <img class="media-object img-circle" src="{{ asset('admin-bsb/images/no-user.png') }}" width="64" height="64">
	                                    </a>
	                                </div>
	                                <div class="media-body">
	                                    <h4 class="media-heading">Noris Armos</h4> 
	                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
	                                    ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
	                                    turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis
	                                    in faucibus.
	                                </div>
	                            </div>

	                            <div class="media">
	                                <div class="media-body">
	                                    <h4 class="media-heading">Current User</h4> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
	                                    ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
	                                    turpis.
	                                </div>
	                                <div class="media-right">
	                                    <a href="#">
	                                        <img class="media-object img-circle" src="{{ asset('admin-bsb/images/no-user.png') }}" width="64" height="64">
	                                    </a>
	                                </div>
	                            </div>

			                    <div class="form-group">
			                        <div class="form-line">
			                            <input type="text" class="form-control" placeholder="Type a comment" />
			                        </div>
			                    </div>
			                </div>
			            </div>
					</div>
				</div>
				
			</div>

			<!-- Counseling Details -->
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>Details</h2>
					</div>
					<div class="body">
						<ul class="list-group">
                            <li class="list-group-item">
                            	<img src="{{ asset('admin-bsb/images/empty-image.png') }}" class="img-responsive img-circle" height="70" width="70" style="display: block; margin-left: auto; margin-right: auto;width: 50%;">
                            </li>
                            <li class="list-group-item">
                            	Date <span class="badge bg-orange">February 25, 2021 8:30 am - 10:00 am</span>
                            </li>
                            <li class="list-group-item">
                            	Status <span class="badge bg-blue">New</span>
                            </li>
                            <li class="list-group-item">
                            	Psychologists <span class="badge"> Clyde Ortega</span>
                            </li>
                            <li class="list-group-item">
                            	Type of counseling <span class="badge bg-green">Group</span>
                            </li>

                            <li class="list-group-item">
                            	Display status <span class="badge bg-orange">Public</span>
                            </li>
                        </ul>
					</div>
				</div>

				<!-- Participants Widget -->
				<div class="card">
					<div class="header">
						Participants
					</div>
					<div class="body">
						<img class="media-object img-circle" src="{{ asset('admin-bsb/images/no-user.png') }}" width="30" height="30" data-toggle="tooltip" data-placement="top" title="Current User">
						<img class="media-object img-circle" src="{{ asset('admin-bsb/images/no-user.png') }}" width="30" height="30" data-toggle="tooltip" data-placement="top" title="Current User">
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection