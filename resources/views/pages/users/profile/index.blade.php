@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card mb-3">
          <div class="card-body">

            {{-- run `php artisan storage:link` --}}
            <img src="{{ $user->avatar ? $user->avatar : asset('images/user.png') }}" alt="{{ $user->name }}" class="img-fluid rounded mx-auto d-block ac-avatar">
            <div class="text-center mt-3">
              <h5>{{ $user->name }} <br>
                <small>{{ $user->email }}</small>
              </h5>

              {{-- <a href="/bookings/create" class="btn btn-primary mr-1">Book Session</a> --}}

              <a href="/users/profile/{{ $user->id }}/edit" class="btn btn-outline-primary mr-1">
                <i class="fa fa-pen"></i>
                Update Profile
              </a>
              <upload-avatar :user-id="{{ $user->id }}" token="{{ $user->api_token }}"></upload-avatar>

            </div>
            {{-- divider --}}
            <div class="my-4 ac-divider"></div>

            {{-- user activities --}}
            <div class="">
              user activities
            </div>

          </div>
        </div>
      </div>

      <div class="col-md-9">
        <div class="card mb-3">
          <div class="card-body">
            <div class="d-sm-flex justify-content-end">
              <div>
                <a href="/bookings/create" class="btn btn-primary btn-sm">Book Session</a>
              </div>
            </div>
          </div>
        </div>

        {{-- user schedules --}}
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Schedules</h5>
            <div class="d-sm-flex">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Session Start</th>
                    <th scope="col">Session End</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($user->schedules as $schedule)
                    <tr>
                      <td>{{ $schedule->start }}</td>
                      <td>{{ $schedule->end }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td col="2">No Schedules Available</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@push('custom_styles')
<style>
  .ac-upload input[type=file] {
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    opacity: 0;
  }

  .ac-divider {
    height: 0;
    border: 1px solid #ddd;
    overflow: hidden;
  }

  .ac-avatar {
    max-width: 100%;
    max-height: 320px;
  }
</style>
@endpush
