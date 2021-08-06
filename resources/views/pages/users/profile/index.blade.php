@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card mb-3">
          <div class="card-body">

            {{-- run `php artisan storage:link` --}}
            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/user.png') }}" alt="{{ $user->name }}" class="img-fluid rounded mx-auto d-block ac-avatar">

            <div class="mt-3">
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Name</h6>
                  <span>{{ $user->name }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Email</h6>
                  <span>{{ $user->email }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Company</h6>
                  <span>{{ $user->client->name ?? 'n/a' }}</span>
                </li>
              </ul>
            </div>
            @if (Auth::id() === $user->id)
              <div class="text-center mt-3">
                <a href="/profile/{{ $user->id }}/edit" class="btn btn-outline-primary mr-1">
                  <i class="fa fa-pen"></i>
                  Update Profile
                </a>

                <upload-avatar :user-id="{{ $user->id }}" token="{{ $user->api_token }}"></upload-avatar>
              </div>
            @endif
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

        <div class="card mb-3">
          <div class="card-body">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-bookings-tab" data-toggle="tab" href="#nav-bookings" role="tab" aria-controls="nav-bookings" aria-selected="true">Bookings</a>
                <a class="nav-item nav-link" id="nav-activities-tab" data-toggle="tab" href="#nav-activities" role="tab" aria-controls="nav-activities" aria-selected="false">Activities</a>
              </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">

              {{-- user bookings --}}
              <div class="tab-pane fade show active" id="nav-bookings" role="tabpanel" aria-labelledby="nav-bookings-tab">
                <bookings-lists class="mt-4"></bookings-lists>
              </div>

              {{-- user activities --}}
              <div class="tab-pane fade" id="nav-activities" role="tabpanel" aria-labelledby="nav-activities-tab">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Type</th>
                      <th scope="col">Datetime</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- {{dd($user->activities)}} --}}
                    @forelse ($user->activities as $activity)
                      <tr>
                        <td>{{ $activity->type->description }}</td>
                        <td>{{ $activity->created_at }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td col="2">No Activities Available</td>
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

  .ac-avatar {
    max-width: 100%;
    max-height: 320px;
  }
</style>
@endpush
