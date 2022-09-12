<!-- has exception  -->
@if(session('exception'))
	<div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('exception') }}
    </div>
@endif

<!-- success -->
@if(session('success'))
	<div class="alert alert-success alert-dismissible" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    {{ session('success') }}
	</div>
@endif

<!-- error session -->
@if(session('error'))
	<div class="alert alert-danger alert-dismissible" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    {{ session('error') }}
	</div>
@endif
<!-- end error session -->

<!-- validation errors -->
@if($errors->any())
	
		<div class="alert alert-danger alert-dismissible" role="alert">
	    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			@foreach($errors->all() as $error)
	    		<ul>
	    			<li>{{ $error }}</li>
	    		</ul>
			@endforeach
	</div>

@endif
<!-- end validation errors-->