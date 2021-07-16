<template>
	<div>
		<div v-if="!editMode">
			<div v-if="sessionStatus === 'Booked' ">
				<a href="#" @click.prevent="edit">{{ sessionStatus }}</a>
			</div>

			<div v-else>
				<b>{{ sessionStatus }}</b>
			</div>
		</div>
		<div v-else>
			<div class="input-group">
			  <select class="custom-select" name="status" id="inputGroupSelect04" aria-label="Example select with button addon" v-model="status_option">
			  	<option selected disabled :value="null">Choose Status</option>
			    <option v-for="(status, index) in getActions" 
			    	:key="index"
			    	:value="status.id">{{ status.name }}</option>
			  </select>
			  <div class="input-group-append">
			    <button class="btn btn-outline-primary" type="submit">
			    	<i class="fa fa-check"></i>
			    </button>
			    <button class="btn btn-outline-secondary" type="button" @click.prevent="cancel">
			    	<i class="fa fa-times"></i>
			    </button>
			  </div>
			</div>
		</div>
	</div>
</template>

<script>

	import { mapGetters, mapActions } from 'vuex';
	
	export default {
		name: "BookingStatus",
		props: {
			sessionStatus: String,
			bookingId: Number,
			bookingStatus: Number
		},
		computed: {
			...mapGetters(["getActions"])
		},
		created(){
			this.getBookingStatuses()
		},
		data(){
			return {
				editMode: false,
				status_option: null
			}
		},
		methods: {
			...mapActions(["updateStatus", "getBookingStatuses"]),
			edit(){
				this.editMode = true;
				this.status_option = this.bookingStatus === 1 ? null : this.bookingStatus;
			},
			update(){
				let payload = {
					id: this.bookingId,
					status: this.status_option
				}
				this.updateStatus(payload).then(res => {
					if(res.status){

						location.reload();
					}
				}).catch(error => {
					console.log(error)
				})
			},
			cancel(){
				this.editMode = false;
			}
		}
	}
</script>