<template>
	<div>
		<div v-if="!editMode">
			<div v-if="sessionStatus === 'Booked' || sessionStatus === 'Rescheduled'">
				<a href="#" @click.prevent="edit">{{ sessionStatus }}</a>
			</div>

			<div v-else>
				<span :class="sessionStatus === 'Cancelled' ? 'text-danger' : ''">{{ sessionStatus }}</span> <br>
				<span v-if="ownBooking.cancelled !== null">{{ ownBooking.cancelled.reason_option_id === 5 ? ownBooking.cancelled.others_specify : ownBooking.cancelled.reason_option.option_name }}</span>
			</div>
		</div>
		<div v-else>
			<div class="input-group">
			  <select class="custom-select" name="status" id="inputGroupSelect04" aria-label="Example select with button addon" v-model="status_option" required>
			  	<option selected disabled :value="null">Choose Status</option>
			    <option v-for="(status, index) in getActions" 
			    	:key="index"
			    	:value="status.id">{{ status.name }}</option>
			  </select>
			  <div class="input-group-append">
			    <button class="btn btn-outline-primary" type="submit" @click.prevent="update">
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

	import Swal from 'sweetalert2';
	import { mapGetters, mapActions } from 'vuex';
	
	export default {
		name: "BookingStatus",
		props: {
			sessionStatus: String,
			bookingId: Number,
			bookingStatus: Number,
			reschedule: Object,
			cancelled: Object,
			ownBooking: Object
		},
		computed: {
			...mapGetters(["getActions", "getBooking"])
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

				// console.log(this.status_option)

				let payload = {
					id: this.bookingId,
					status: this.status_option
				}

				if(this.status_option === 2){

					window.location.href = `${window.location.origin}/progress-reports/create-for-booking/${this.bookingId}`;

				}else if(this.status_option === 4){

					window.location.href = `${window.location.origin}/bookings/cancel/${this.bookingId}`;

				}else if(this.status_option === 5){

					window.location.href = `${window.location.origin}/bookings/reschedule/${this.bookingId}`;

				}else{
					
					this.updateStatus(payload).then(res => {

						if(res.data.success){
							Swal.fire('Success!', res.data.message, 'success');
							location.reload();
						}
					}).catch(error => {
						Swal.fire('Oops!', error.message, 'error');
					})
				}
			},
			cancel(){
				this.editMode = false;
			}
		}
	}
</script>