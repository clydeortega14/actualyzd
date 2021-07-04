@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    @if (session('success'))
      <div class="row">
        <div class="col"></div>
          <div class="col-md-9">
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
          </div>
        <div class="col"></div>
      </div>
    @endif

    <div class="row">
      <div class="col"></div>


      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Profile Information</h5>

            <form method="POST" action="/users/profile/{{ $user->id }}">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="nameError" placeholder="Enter name" value="{{ old('name') ?? $user->name }}" required>

                @error('name')
                  <small id="nameError" class="form-text text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" aria-describedby="usernameError" placeholder="Enter username" value="{{ old('username') ?? $user->username }}" required>

                @error('username')
                  <small id="usernameError" class="form-text text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter e-mail address" value="{{ old('email') ?? $user->email }}" required>

                @error('email')
                  <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
              <a href="/users/profile/{{ $user->id }}" class="btn btn-outline-primary">Cancel</a>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Change Password</h5>

            <form method="POST" action="/users/profile/{{ $user->id }}/change-password">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="currentPassword">Current Password</label>
                <input type="password" class="form-control" name="current_password" id="currentPassword" aria-describedby="currentPasswordError" placeholder="Enter your current password" required>

                @error('current_password')
                  <small id="currentPasswordError" class="form-text text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" name="new_password" id="newPassword" aria-describedby="newPasswordError" placeholder="Enter your new password" required>

                @error('new_password')
                  <small id="newPasswordError" class="form-text text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="form-group">
                <label for="newConfirmPassword">New Password</label>
                <input type="password" class="form-control" name="new_confirm_password" id="newConfirmPassword" aria-describedby="newConfirmPasswordError" placeholder="Confirm your new password" required>

                @error('new_confirm_password')
                  <small id="newConfirmPasswordError" class="form-text text-danger">{{ $message }}</small>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
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
