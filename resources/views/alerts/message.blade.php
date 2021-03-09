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

@if($errors->any())
	
	@foreach($errors->all() as $error)
		<div class="alert alert-danger alert-dismissible" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    {{ $error }}
	</div>
	@endforeach

@endif