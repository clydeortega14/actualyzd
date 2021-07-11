<template>
	<div>
		<div v-if="!editMode">
			<a href="#" @click.prevent="edit">{{ sessionStatus }}</a>
		</div>
		<div v-else>
			<div class="input-group">
			  <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon" v-model="status_option">
			    <option v-for="(status, index) in booking_statuses" :key="index"
			    	:value="{id: status.id, name: status.name }">{{ status.name }}</option>
			  </select>
			  <div class="input-group-append">
			    <button class="btn btn-outline-primary" type="button" @click.prevent="update">
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

	import { mapActions } from 'vuex';
	export default {
		name: "BookingStatus",
		props: {
			sessionStatus: String,
			bookingId: Number
		},
		data(){
			return {
				editMode: false,
				booking_statuses: [
					{ id: 1, name: 'Booked'},
					{ id: 2, name: 'Completed'},
					{ id: 3, name: 'No Show'},
					{ id: 4, name: 'Cancelled'},
					{ id: 5, name: 'Reschedule'},
				],
				status_option: null
			}
		},
		methods: {
			...mapActions(["updateStatus"]),
			edit(){
				this.editMode = true;
			},
			update(){
				let payload = {
					id: this.bookingId,
					status: this.status_option.id
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