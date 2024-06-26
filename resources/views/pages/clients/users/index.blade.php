@extends('layouts.app')

@section('content')

	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">Members</h1>

		<div class="row">
			<div class="col-md-12">
				@include('alerts.message')
			</div>
			<div class="col-sm-12">
				<div class="card shadow mb-4">
					<div class="card-header py-4">
						<a href="{{ url('client/user/create') }}" class="btn btn-info btn-sm float-right">
							<i class="fa fa-plus"></i>
							<span>Add New Member</span>
						</a>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th></th>
										<th>Name</th>
										<th>Email</th>
										<th>Status</th>
									</tr>
								</thead>

								<tbody>
									@foreach($users as $user)
										@php
											$active = $user->is_active;
										@endphp
										
											<tr>
												<td><img src="{{ asset('sb-admin/img/undraw_profile.svg') }}" alt="{{ $user->name }}" height="45" width="45"class="text-center"></td>
												<td>{{ $user->name }}</td>
												<td>{{ $user->email }}</td>
												<td>
													@if(auth()->user()->can('can.update.user.status'))
														<input type="checkbox" name="user_status" class="cm-toggle blue" data-user="{{ $user->id }}" {{ $active ? 'checked' : '' }}></td>
													@endif
												<td>
														
													<a href="{{ url('client/user/edit/'.+$user->id) }}" >
														<i class="fa fa-edit"></i>
													</a> | 
													<a type="submit" href="#" class="delete-user" data-user-id="{{ $user->id }}">
														<i class="fa fa-trash"></i>
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
	</div>

@stop

@section('js_scripts')

<script>

	$(function() {

			const ajax = new Ajax;
			const psychologist = {

				initialize(){

					this.globalVars()
					this.events()

				},
				events(){
					//global this
					_this = this;

					$('[name="user_status"]').on('change', function() {
						let element = $(this);
						let is_checked = element.is(':checked');
									
						// Perform ajax request
						ajax.request({

							url: `/client/user/update_status/${element.data().user}`,
							method: 'PUT',
							data: { data: JSON.stringify({status: is_checked}) }

						}).done(data => {
							_this.sweet_alert.success(data.message);

						}).fail(error => {
							_this.sweet_alert.error(error.message);
						});
					});

					$('.delete-user').on('click', function() {

						let element = $(this);

						console.log(element.data().userId);

						_this.sweet_alert.confirmDialog()
							.then((result) => {

								if(result.isConfirmed) {

									// Perform ajax request
									ajax.request({

										url: `/client/user/delete/${element.data().userId}`,
										method: 'DELETE',
										data: { data: 1 }

									}).done(data => {
										_this.sweet_alert.success(data.message);
										element.closest('tr').remove();

									}).fail(error => {
										_this.sweet_alert.error(error.message);
									});
								}

						});
					});
				},
				globalVars(){

					this.sweet_alert = new SweetAlert();
				}
			}

			psychologist.initialize();
		});

</script>

@stop