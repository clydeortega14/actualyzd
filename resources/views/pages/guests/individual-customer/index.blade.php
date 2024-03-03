@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">Register as individual customer</div>
                    <div class="card-body">

                        @if(session('success'))

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ session('success') }}.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        @endif

                        <form action="{{ route('guests.store.applying.individual') }}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label class="col-form-label col-sm-4 text-md-right">{{ __('Name') }}</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-4 text-md-right">{{ __('Email') }}</label>
                                <div class="col-sm-6">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-4 text-md-right">{{ __('Password') }}</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Enter password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-4 text-md-right">{{ __('Confirm Password') }}</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Retype Password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Register</button>
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