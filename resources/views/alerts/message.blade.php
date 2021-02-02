<!-- has exception  -->
@if(session('exception'))
	<div class="alert bg-pink alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('exception') }}
    </div>
@endif

<!-- success -->
@if(session('success'))
	<div class="alert bg-green alert-dismissible" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    {{ session('success') }}
	</div>
@endif

<!-- has validation errors -->

@if($errors->any())
	
	@foreach($errors->all() as $error)

		<div class="alert bg-pink alert-dismissible" role="alert">
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        {{ $error }}
	    </div>

	@endforeach

@endif