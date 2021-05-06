<div class="modal fade" id="update-status-{{ $client->id}}" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
            <div class="modal-body">
            	<div class="text-center">
					<p class="h6 text-gray-900">Are you sure? You want to <b>{{ $client->is_active ? 'Deactivate' : 'Activate'}}</b> {{ $client->name }}</p>
					<div class="form-group">
						<button class="btn btn-primary"
						onclick="event.preventDefault();
                        document.getElementById('update-status-form-{{ $client->id }}').submit();">YES</button>
						<form id="update-status-form-{{ $client->id }}" action="{{ route('clients.update', $client->id) }}" method="POST" style="display: none;">
							@csrf
							@method('PUT')
							{{-- <input type="text" name="" value="{{ $client->id }}"> --}}
						</form>
						<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">NO</button>
					</div>
				</div>
            </div>
		</div>
	</div>
</div>