@extends('layouts.sb-admin.master')

@section('content')
	
	<div class="block-header">
		<h2>TimeLists</h2>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="card mb-3">
				<div class="card-header">
					<a href="{{ route('time-lists.create') }}" class="btn btn-info btn-sm float-right">
						<i class="fa fa-plus"></i>
						<span>add time</span>
					</a>
				</div>
				<div class="card-body">
					@include('alerts.message')
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>FROM</th>
									<th>TO</th>
									<th></th>
								</tr>
							</thead>

							<tbody>
								@foreach($timelists as $time)
                                    <tr>
                                    	<td>{{ $time->id }}</td>
                                    	<td>{{ $time->parseTimeFrom() }}</td>
                                    	<td>{{ $time->parseTimeTo() }}</td>
                                    	<td>
                                    		<a href="{{ route('time-lists.edit', $time->id ) }}">
                                    			<i class="fa fa-edit"></i>
                                    		</a> |
                                    		<a href="#" class="delete-time" data-id="{{ $time->id }}">
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
@stop

@section('js_scripts')
	
	<script>
		
		$(function(){

			const sweet_alert = new SweetAlert;
			const ajax = new Ajax;

			$('.delete-time').on('click', function(e){

				e.preventDefault();

				sweet_alert.confirmDialog().then((result) => {

					if(result.isConfirmed){

						ajax.request({

							url: `/time-lists/${$(this).attr('data-id')}`,
							method: 'DELETE',

						}).done(data => {

							$(this).closest('tr').remove();
							sweet_alert.success(data.message);

						});

					}else{

						sweet_alert.success('File is safe!')
					}
				})
			})

		});
	</script>
@endsection