<div class="row">
	<div class="col-md-5">
		<a href="#">
			<img src="{{
				is_null($client->logo) ? 

				'/images/logo-01.png' :

				asset('storage/client-logo/'.$client->logo)

			}}" class="img-fluid mx-auto d-block rounded-circle" width="175" height="175">
		</a>
	</div>

	<div class="col-md-7">
		<ul class="list-group">
		  	<li class="list-group-item d-flex justify-content-between align-items-center">
		    	<b>Company Name</b>
		    	<span>{{ $client->name }}</span>
		  	</li>
		  	<li class="list-group-item d-flex justify-content-between align-items-center">
	    		<b>Company Email</b>
		    	<span>{{ $client->email }}</span>
		  	</li>
		  	<li class="list-group-item d-flex justify-content-between align-items-center">
		   		<b>Contact Number</b>
		    	<span>{{ $client->contact_number }}</span>
		  	</li>
		  	<li class="list-group-item d-flex justify-content-between align-items-center">
		   		<b>Company Address</b>
		    	<span>{{ $client->postal_address }}</span>
		  	</li>
		  	<li class="list-group-item d-flex justify-content-between align-items-center">
		   		<b>Registered</b>
		    	<span>{{ $client->created_at->diffForHumans() }}</span>
		  	</li>
		  	<li class="list-group-item d-flex justify-content-between align-items-center">
		   		<b>Active</b>
		    	<span>
		    		<div class="custom-control custom-switch">
					  <input type="checkbox" class="custom-control-input" id="status-{{ $client->id }}" {{ $client->is_active ? 'checked' : '' }}>
					  <label class="custom-control-label" for="status-{{ $client->id }}"></label>
					</div>
		    	</span>
		  	</li>
		</ul>
	</div>
</div>