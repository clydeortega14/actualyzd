<ul class="nav nav-pills">
  	<li class="nav-item">
    	<a href="{{ route('clients.edit', $client->id) }}" class="nav-link {{ Route::is('clients.edit', $client->id) ? 'active' : '' }}">
  			Main Information
  		</a>
  	</li>
  	<li class="nav-item">
  		<a href="{{ route('client.show.subscription', $client->id) }}" class="nav-link {{ Route::is('client.show.subscription', $client->id) ? 'active' : '' }}">
  			Subscription
  		</a>
  	</li>
  	<li class="nav-item">
  		<a href="{{ route('client.show.users', $client->id) }}" class="nav-link {{ Route::is('client.show.users', $client->id) ? 'active' : '' }}">
  			Employees
  		</a>
  	</li>
</ul>