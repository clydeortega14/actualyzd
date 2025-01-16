<div class="tab-content" id="myTabContent">
  	<div class="tab-pane fade {{ Route::is('clients.edit', $client->id) ? 'show active' : '' }}">
  		<div class="m-3">
  			@include('pages.superadmin.clients.includes.company-info')
  		</div>
  	</div>
  	<div class="tab-pane fade {{ Route::is('clients.show.subscription', $client->id) ? 'show active' : '' }}">
  		<div class="m-3">
  			@include('pages.superadmin.clients.includes.subscription')
  		</div>
  	</div>
	
  	<div class="tab-pane fade {{ Route::is('clients.users', $client->id) ? 'show active' : '' }}">
  		<div class="m-3">
  			@include('pages.superadmin.clients.includes.employees')
  		</div>
  	</div>

	<div class="tab-pane fade">
		<div class="m-3">
			{{-- @include('pages.superadmin.clients.includes.employees') --}}
		</div>
	</div>
</div>