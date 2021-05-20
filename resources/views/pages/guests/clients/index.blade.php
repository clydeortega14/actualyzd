@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">Client Application Form</div>
                    <div class="card-body">

                        @if(session('success'))

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ session('success') }}.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        @endif

                        <form action="{{ route('guest.clients.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-sm-4 text-md-right">{{ __('Company Name') }}</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter Company Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-4 text-md-right">{{ __('Company Email') }}</label>
                                <div class="col-sm-6">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter Company Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-4 text-md-right">{{ __('Contact No.') }}</label>
                                <div class="col-sm-6">
                                    <input type="number" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror" value="{{ old('contact_number') }}" placeholder="Enter Contact Number">
                                    @error('contact_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-4 text-md-right">{{ __('No. of Employees') }}</label>
                                <div class="col-sm-6">
                                    <input type="number" name="no_of_employees" class="form-control @error('no_of_employees') is-invalid @enderror" value="{{ old('no_of_employees') }}" placeholder="Enter No of employees">
                                    @error('no_of_employees')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-4 text-md-right">{{ __('Address') }}</label>
                                <div class="col-sm-6">
                                    <textarea type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Enter Address"></textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit Now</button>
                                    <a href="{{ route('login') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection