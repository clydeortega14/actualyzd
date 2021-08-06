<style scoped>
	
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
</style>


<template>
	<div>
		<div class="chat-body">
			<div class="chat-inbox">
				<div class="chats">
					<div class="chat-page">
						<div v-for="(message, index) in allMessages" :key="index" :class="{'outgoing-chats': isAuth(message), 'received-chats': !isAuth(message) }">
							<div class="received-chats-img" v-if="!isAuth(message)">
								<img src="/images/profile.png">
							</div>
						
							<div :class="{'received-msg': !isAuth(message), 'outgoing-chats-msg': isAuth(message) }">
								<div :class="{'received-msg-inbox': !isAuth(message) }">
									<p>{{ message.message }}</p>
									<span class="time">8:22 PM | August 2021</span>
								</div>
							</div>

							<div class="outgoing-chats-img" v-if="isAuth(message)">
								<img src="/images/user.png">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>


<script>

	import { mapGetters, mapActions } from 'vuex';
	
	export default {

		name: "ChatMessages",
		props: {
			booking: Object,
			authUser: Object
		},
		computed: {

			...mapGetters(["allMessages"])
		},
		created(){

			Echo.private('new-message')
	            .listen('NewMessage', (e) => {
	                console.log(e)
	         })

			this.getMessages(this.booking.room_id);
		},
		methods: {

			...mapActions(["getMessages"]),
			isAuth(message){
				return this.authUser.id === message.created_by.id ? true : false;
			}
		}
	}
</script>