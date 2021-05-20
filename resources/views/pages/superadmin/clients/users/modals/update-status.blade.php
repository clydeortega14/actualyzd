<div class="modal fade" id="update-status-{{ $user->id}}" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
            <div class="modal-body">
            	<div class="text-center">
					<p class="h6 text-gray-900">Are you sure? You want to <b>{{ $user->is_active ? 'Deactivate' : 'Activate'}}</b> {{ $user->name }}</p>
					<div class="form-group">
						<button class="btn btn-primary"
						onclick="event.preventDefault();
                        document.getElementById('update-status-form-{{ $user->id }}').submit();">YES</button>
						<form id="update-status-form-{{ $user->id }}" action="{{ route('client.user.update.status', $user->id) }}" method="POST" style="display: none;">
							@csrf
							@method('PUT')
						</form>
						<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">NO</button>
					</div>
				</div>
            </div>
		</div>
	</div>
</div>