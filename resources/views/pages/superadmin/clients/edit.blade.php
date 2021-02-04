@extends('admin-layouts.master')

@section('title', 'Edit Client')


@section('content')

	<div class="container-fluid">
		<div class="block-header">
			<h2>Edit Client</h2>
		</div>

		<div class="row clearfix">
			<div class="col-md-6">
				<div class="card">
					<div class="body">
						<form class="form-line">
							@csrf

							<div class="row clearfix justify-content-center">
								<div class="col-md-12">
									<img src="{{ $client->our_logo }}" class="img-responsive img-circle" height="100" width="100" style="display: block; margin-left: auto; margin-right: auto;width: 50%;">
								</div>
							</div>

							<div class="row clearfix">
		                        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-4 form-control-label">
		                            <label for="company-name">Company Name</label>
		                        </div>
		                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
		                            <div class="form-group">

		                                <div class="form-line @error('name') error @enderror ">
		                                    <input type="text" name="name" id="company-name" class="form-control @error('name') error @enderror " value="{{ $client->name }}" readonly>
		                                </div>

		                                @error('name')
		                                    <label class="error">{{ $message }}</label>
		                                @enderror
		                            </div>
		                        </div>
		                    </div>

		                    <div class="row clearfix">
		                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
		                            <label for="company-email">Company Email</label>
		                        </div>
		                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
		                            <div class="form-group">
		                                <div class="form-line @error('email') error @enderror">
		                                    <input type="text" name="email" id="company-email" class="form-control @error('email') error @enderror" value="{{ $client->email }}" readonly>
		                                </div>
		                                @error('email')
		                                    <label class="error">{{ $message }}</label>
		                                @enderror
		                            </div>
		                        </div>
		                    </div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection