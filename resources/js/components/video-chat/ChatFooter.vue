<style scoped>
	
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

<template>
	
	<div class="msg-bottom">
		<form @submit.prevent="storeNewMessage">
			<!-- <input type="hidden" name="booking_id" v-model="booking.id"> -->
			<div class="input-group">
				<input type="text" v-model="new_message" class="form-control" placeholder="write message...">
				<div class="input-group-append">
					<button type="submit" class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</button>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
	
	import { mapActions } from 'vuex';

	export default {
		name: "ChatFooter",
		data() {

			return {
				new_message: ''
			}
		},
		props: {
			booking: Object,
			authUser: Object
		},
		methods: {

			...mapActions(["newMessage"]),
			storeNewMessage(){

				this.newMessage({

					booking_id: this.booking.id,
					message: this.new_message,
					created_by: this.authUser.id

				}).then(response => {

					const data = response.data;

					if(!data.error){

						// push new data to messages array
						this.$store.commit('storeMessage', data.data)
						// set new message to empty
						this.new_message = '';
					}
				})
			}
		}
	}
</script>