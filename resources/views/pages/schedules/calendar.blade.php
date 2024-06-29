@extends('layouts.app')


@section('content')

    <div class="container-fluid">

        @include('pages.schedules.header.index')
        

        <div class="row">
            <div class="col-md-12">
                @include('pages.schedules.nav-tabs.nav-item')


                <session-view-calendar user-id="{{ auth()->user()->id }}"></session-view-calendar>
            </div>
        </div>
    </div>

@endsection