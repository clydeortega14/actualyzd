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

		/* Chat Body */
		.chat-body {
			padding: 0 0 0 0;
			margin: 0 0 0 0;
		}
		.chat-inbox {
			border: 1px solid #ccc;
			overflow: hidden;
			padding-bottom: 30px;
		}
		.chats {
			padding: 30px 15px 0 25px;
		}
		.msg-page {
			height: 516px;
			overflow-y: auto;
		}
		.received-chats-img {
			display: inline-block;
			width: 20px;
			float: left;
		}
		.received-msg {
			display: inline-block;
			padding: 0 0 0 10px;
			vertical-align: top;
			width: 92%;
		}
		.received-msg-inbox {
			width: 57%;
		}

		.received-msg-inbox p {
			background: #efefef none repeat scroll 0 0;
			border-radius: 10px;
			color: #646464;
			font-size: 14px;
			margin: 0;
			padding: 5px 10px 5px 12px;
			width: 100%;
		}
		.time {
			color: #777;
			display: block;
			font-size: 12px;
			margin: 8px 0 0;
		}
		.outgoing-chats {
			overflow: hidden;
			margin: 26px 20px;
		}
		.outgoing-chats-msg p {
			background: #868BF6 none repeat scroll 0 0;
			color: #fff;
			border-radius: 10px;
			font-size: 14px;
			margin: 0;
			padding: 5px 10px 5px 12px;
			width: 100%;
		}
		.outgoing-chats-msg {
			float: left;
			width: 46%;
			margin-left: 51%;
		}
		.outgoing-chats-img {
			display: inline-block;
			width: 20px;
			float: right;
		}

		/* Chat Footer */
		.msg-bottom {
			position: relative;
			border: 0 1px 1px 1px solid #ccc;
			width: 100%;
			height: 80px;
			border-bottom: none;
			display: inline-block;
			background-color: #868BF6;
		}
		.input-group {
			float: right;
			margin-top: 20px;
			margin-right: 20px;
			outline: none !important;
			border-radius: 20px;
			width: 61% !important;
			background-color: #fff;
		}
		.form-control {
			border: none !important;
			border-radius: 20px !important;
		}
		.input-group-text {
			background-color: transparent !important;
			border: none !important;
		}
		.input-group .fa {
			color: #868BF6;
			float: right;
		}
		.footer-icons {
			float: left;
			margin-top: 0;
			width: 120px !important;
			margin-left: 32px;
			margin-top: 20px;
		}

		.footer-icons .fa {
			color: #fff;
			padding: 5px;
			cursor: pointer;
		}
		.form-control:focus {
			border-color: none !important;
			box-shadow: none !important;
			border-radius: 20px;

		}

	</style>

@endsection

@section('content')
	
	<div class="container">

		<h4>Video Chat</h4>

		<a href="{{ route('home') }}" class="btn btn-primary mb-3">
			<i class="fa fa-arrow-left"></i>
			<span>Return Back</span>
		</a>

		@include('alerts.message')

		{{-- Chat Header --}}
		<div class="chat-header">
			<div class="chat-header-img">
				{{-- <img src="/images/profile.png"> --}}
				<i class="fa fa-home fa-lg mt-2"></i>
			</div>
			<div class="active">
				<h4>
					<strong>ROOM ID: </strong> 
					<small>{{ $booking->room_id }}</small>
				</h4>
				{{-- <h6>2 hours ago...</h6> --}}
			</div>
			<div class="header-icons">
				{{-- <i class="fa fa-phone"></i> --}}
				<i class="fa fa-video"></i>
			</div>
		</div>

		{{-- Chat Body --}}
		<div class="chat-body">
			<div class="chat-inbox">
				<div class="chats">
					<div class="chat-page">
						@foreach($booking->chats as $chat)
							@php
								$isAuth = auth()->user()->id == $chat->created_by;
							@endphp
								<div class="{{ $isAuth ? 'outgoing-chats' : 'received-chats' }}">
									@if(!$isAuth)
										<div class="received-chats-img">
											<img src="/images/profile.png">
										</div>
									@endif
									<div class="{{ $isAuth ? 'outgoing-chats-msg' : 'received-msg' }}">
										<div class="{{ $isAuth ? '' : 'received-msg-inbox'}}">
											<p>{{ $chat->message }}</p>
											<span class="time">{{ date('g:i a', strtotime($chat->created_at)) }} | {{ date('F Y', strtotime($chat->created_at) )  }}</span>
										</div>
									</div>
									@if($isAuth)
										<div class="outgoing-chats-img">
											<img src="/images/user.png">
										</div>
									@endif
								</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>

		{{-- Chat footer --}}
		<div class="msg-bottom">

			<form action="{{ route('video-chat.store') }}" method="POST">
				@csrf
				<input type="hidden" name="booking_id" value="{{ $booking->id }}">
				<div class="input-group">
					<input type="text" name="message" class="form-control" placeholder="write message...">
					<div class="input-group-append">
						<button type="submit" class="input-group-text">
							<i class="fa fa-paper-plane"></i>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	
@stop