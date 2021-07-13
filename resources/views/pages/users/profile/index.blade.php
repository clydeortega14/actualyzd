@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card mb-3">
          <div class="card-body">

            {{-- run `php artisan storage:link` --}}
            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/user.png') }}" alt="{{ $user->name }}" class="img-fluid rounded mx-auto d-block ac-avatar">
            <div class="text-center mt-3">
              <h5>{{ $user->name }} <br>
                <small>{{ $user->email }}</small>
              </h5>

              @if (Auth::id() === $user->id)
                <a href="/profile/{{ $user->id }}/edit" class="btn btn-outline-primary mr-1">
                  <i class="fa fa-pen"></i>
                  Update Profile
                </a>

                <upload-avatar :user-id="{{ $user->id }}" token="{{ $user->api_token }}"></upload-avatar>
              @endif

            </div>
            {{-- divider --}}
            <div class="my-4 ac-divider"></div>

            {{-- user activities --}}
            <div class="card-body">
              <h5 class="card-title">Activities</h5>
              <div class="d-sm-flex">
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

        {{-- user bookings --}}
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Bookings</h5>
            <div class="d-sm-flex">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Client</th>
                    <th scope="col">Session start</th>
                    <th scope="col">Session end</th>
                    <th scope="col">Time start</th>
                    <th scope="col">Time end</th>
                    <th scope="col">Conselee</th>
                    <th scope="col">Booked by</th>
                    <th scope="col">Session type</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($user->bookings as $booking)
                    <tr>
                      <td>{{ $booking->toClient->name }}</td>
                      <td>{{ $booking->toSchedule->start }}</td>
                      <td>{{ $booking->toSchedule->end }}</td>
                      <td>{{ $booking->time->from }}</td>
                      <td>{{ $booking->time->to }}</td>
                      <td>{{ $booking->toCounselee === null ? '' : $booking->toCounselee->name }}</td>
                      <td>{{ $booking->bookedBy->name }}</td>
                      <td>{{ $booking->sessionType->name }}</td>
                      <td>
                        <span class="{{ $booking->toStatus->class }}">{{ $booking->toStatus->name }}</span>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td col="9">No Bookings Available</td>
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
