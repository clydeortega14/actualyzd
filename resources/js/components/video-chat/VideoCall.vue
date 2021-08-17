<template>
	<div>
		<div class="card mb-3 h-100 py-4">
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<div class="card" style="width:18 rem;">
							<ul class="list-group list-group-flush">
								<li class="list-group-item" v-for="(other_user, index) in getOtherUsers" :key="index">
									<div class="row justify-content-center align-items-center">
										<img src="/images/user.png" width="150" height="150">
									</div>
									<div class="row mt-3 justify-content-center align-items-center">
										( {{ other_user.name }} )
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-8">
						<div class="row justify-content-center align-items-center">
							<img src="/images/user.png" width="275" height="275">
						</div>
						<div class="row justify-content-center align-items-center mt-3">
							<p class="card-text">( {{ authUser.name }} )</p>
						</div>
						<div class="row justify-content-center mt-4">
							<div class="btn-group" role="group" aria-label="Call Actions">
								<button class="btn btn-primary">Mute</button>
								<button class="btn btn-info">Show Camera</button>
								<button class="btn btn-danger">Leave Call</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

	import MediaHandler from '../../mixins/media-handler.js'
	import { mapGetters } from 'vuex';
	
	export default {
		name: "VideoCall",
		mixins: [ MediaHandler ],
		data(){
			return {

				hasMedia: false,
				otherUserId: null
			}
		},
		computed: {

			...mapGetters(["getOtherUsers"])
		},
		props: {
			booking: Object,
			authUser: Object
		},
		mounted(){

			// get media handler permissions, video, audio
			this.getPermissions();

			Echo.join(`video-call.${this.booking.room_id}`)
			.here((users) => {
				this.$store.commit('allUsers', users)
			})
			.joining((user) => {

				const index = this.getOtherUsers.findIndex(other_user => other_user.id === this.authUser.id);
				if(index === -1){
					this.$store.commit('setOtherUsers', user)
				}
			})
			.leaving((user) => {
				const index = this.getOtherUsers.indexOf(user);
				if(index >= -1){
					return this.getOtherUsers.splice(index, 1);
				}
			})
			.listen('VideoCallEvent', (e) => {
				const index = this.getOtherUsers.findIndex(other_user => other_user.id === e.id);
				if(index === -1){
					this.$store.commit('setOtherUsers', e)
				}
			});
		},

		created(){
			this.getVideoCall();
		},
		methods: {

			getVideoCall(){

				axios.get(`/broadcast/call/${this.booking.room_id}`)
					.then(response => {
						//
					}).catch(err => console.log(error))
			}
		}

	}
</script>