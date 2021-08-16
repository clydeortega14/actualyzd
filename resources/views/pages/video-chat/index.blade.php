@extends('layouts.app')

@section('custom_styles')
	
	<style>
		
		/* Chat Container  */
		.container {
			max-width: 500 !important;
			margin: auto;
			margin-top: 0;
			font-family: sans-serif;
			letter-spacing: 0.5px;
		}

		/* Chat Header */
		img {
			max-width: 100%;
			border-radius: 50%;
		}
		.chat-header {
			border: 1px solid #ccc;
			width: 100%;
			height: 10%;
			border-bottom: none;
			display: inline-block;
			background-color: #868BF6;
			margin: 0;
		}
		.chat-header-img {
			border-radius: 50%;
			width: 40px;
			margin-left: 3%;
			margin-top: 10px;
			margin-bottom: 10px;
			float: left;
		}
		.chat-header-img .fa {
			color: #fff;
			cursor: pointer;
		}

		.active {
			width: 500px;
			float: left;
			margin-top: 12px;
		}
		.active h4 {
			font-size: 20px;
			margin-left: 10px;
			color: #fff;
		}
		.active h6 {
			font-size: 10px;
			margin-left: 10px;
			line-height: 2px;
			color: #fff;
		}
		.header-icons {
			width: 64px;
			float: right;
			margin-top: 10px;
			margin-right: 3px;
		}
		.header-icons .fa {
			color: #fff;
			cursor: pointer;
			margin: 10px;
		}

	</style>

@endsection

@section('content')

	<div class="container-fluid">

		<h4>Video Chat</h4>

	
		<a href="{{ route('home') }}" class="btn btn-primary mb-3">
			<i class="fa fa-arrow-left"></i>
			<span>Return Back</span>
		</a>

		@include('alerts.message')


		<div class="row">
			
			<div class="col-md-7">
				<video-call :booking="{{ $booking }}"></video-call>
			</div>


			<div class="col-md-5">
				{{-- Chat Header --}}
				<div class="chat-header">
					<div class="chat-header-img">
						<i class="fa fa-home fa-lg mt-2"></i>
					</div>
					{{-- <div class="active">
						<h4>
							<strong>ROOM ID: </strong> 
							<small>{{ $booking->room_id }}</small>
						</h4>
					</div>
					<div class="header-icons">
						<i class="fa fa-video"></i>
					</div> --}}
				</div>

				{{-- Chat Body --}}
				<chat-messages

					:booking="{{ $booking }}" 
					:auth-user="{{ auth()->user() }}">
						
				</chat-messages>

				{{-- Chat footer --}}
				<chat-footer
					:booking="{{ $booking }}" 
					:auth-user="{{ auth()->user() }}">
						
				</chat-footer>
			</div>
		</div>

		
		
	</div>

	
@stop