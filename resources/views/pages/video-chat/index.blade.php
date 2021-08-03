@extends('layouts.app')

@section('custom_styles')
	
	<style>
		
		/* Chat Container  */
		.container {
			max-width: 500 !important;
			margin: auto;
			margin-top: 4%;
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
			background-color: #007bff;
			margin: 0 0 0 0;
		}
		.chat-header-img {
			border-radius: 50%;
			width: 40px;
			margin-left: 3%;
			margin-top: 10px;
			margin-bottom: 10px;
			float: left;
		}
		.active {
			width: 240px;
			float: left;
			margin-top: 10px;
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
			width: 120px;
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
			background: #007bff none repeat scroll 0 0;
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
			background-color: #007bff;
		}
		.input-group {
			float: right;
			margin-top: 13px;
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
			color: #007bff;
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
		{{-- Chat Header --}}
		<div class="chat-header">
			<div class="chat-header-img">
				<img src="/images/profile.png">
			</div>
			<div class="active">
				<h4>Juan Miguel </h4>
				<h6>2 hours ago...</h6>
			</div>
			<div class="header-icons">
				<i class="fa fa-phone"></i>
				<i class="fa fa-video"></i>
			</div>
		</div>

		{{-- Chat Body --}}
		<div class="chat-body">
			<div class="chat-inbox">
				<div class="chats">
					<div class="chat-page">
						<div class="received-chats">
							<div class="received-chats-img">
								<img src="/images/profile.png">
							</div>
							<div class="received-msg">
								<div class="received-msg-inbox">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
									proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
									<span class="time">9:47 PM | August 2021</span>
								</div>
							</div>
						</div>
						<div class="outgoing-chats">
							<div class="outgoing-chats-msg">
								<p>Yes I can see</p>
								<span class="time">9:47 PM | August 2021</span>
								
							</div>
							<div class="outgoing-chats-img">
								<img src="/images/user.png">
							</div>
						</div>
						<div class="received-chats">
							<div class="received-chats-img">
								<img src="/images/profile.png">
							</div>
							<div class="received-msg">
								<div class="received-msg-inbox">
									<p>Hi!! can you give send me some details of the booking?</p>
									<span class="time">9:47 PM | August 2021</span>
								</div>
							</div>
						</div>
						<div class="outgoing-chats">
							<div class="outgoing-chats-msg">
								<p>Yes ofcourse</p>
								<span class="time">9:47 PM | August 2021</span>
								
							</div>
							<div class="outgoing-chats-img">
								<img src="/images/user.png">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{-- Chat footer --}}
		<div class="msg-bottom">
			<div class="footer-icons">
				<i class="fa fa-plus-circle"></i>
				<i class="fa fa-camera"></i>
			</div>

			<div class="input-group">
				<input type="text" class="form-control" placeholder="write message...">
				<div class="input-group-append">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
				</div>
			</div>
		</div>
	</div>

	
@stop