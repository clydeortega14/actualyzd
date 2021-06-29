@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col"></div>

      <div class="col-md-9">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Edit Profile</h5>

            <form method="POST" action="/users/profile/{{ $user->id }}">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="nameError" placeholder="Enter name" value="{{ old('name') ?? $user->name }}">

                @error('name')
                  <small id="nameError" class="form-text text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" aria-describedby="usernameError" placeholder="Enter username" value="{{ old('username') ?? $user->username }}">

                @error('username')
                  <small id="usernameError" class="form-text text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter e-mail address" value="{{ old('email') ?? $user->email }}">

                @error('email')
                  <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                @enderror

                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
              <a href="/users/profile/{{ $user->id }}" class="btn btn-outline-primary">Cancel</a>
            </form>
          </div>
        </div>
      </div>

      <div class="col"></div>
    </div>
  </div>
@stop

@push('custom_styles')
<style>
</style>
@endpush
