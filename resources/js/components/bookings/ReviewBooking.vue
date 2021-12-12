<template>
	<div>
		<ul class="list-group mt-3">
			<li class="list-group-item d-flex justify-content-between align-items-center" v-if="hasAssessment === 1">
				 Firstimer
	    	    <span>{{ checkFirstTimer }}</span>
			</li>
			 <li class="list-group-item d-flex justify-content-between align-items-center" v-if="hasAssessment === 1">
	    	    Intent to self harm
	    	    <span>{{ checkSelfHarm }}</span>
	  	    </li>

	  	    <li class="list-group-item d-flex justify-content-between align-items-center" v-if="hasAssessment === 1">
	    	    Intent to harm other people
	    	    <span>{{ checkHarmOtherPeople }}</span>
	  	    </li>
	  	    <li class="list-group-item d-flex justify-content-between align-items-center">
		  		Counselee / Participants
		  		<ul class="unstyled-list">
		  			<li v-for="(participant, index) in participants" :key="index">
		  				{{ participant.name}}
		  			</li>
		  		</ul>
		  	</li>

		  	<li class="list-group-item d-flex justify-content-between align-items-center" v-if="getSelectedDate !== null">
				Date
				<span>{{ getSelectedDate }}</span>
			</li>

			<li class="list-group-item d-flex justify-content-between align-items-center" v-if="getSelectedTime !== null">
				Time
				<span>{{ getSelectedTime }}</span>
			</li>

			<li class="list-group-item d-flex justify-content-between align-items-center" v-if="getSelectedPsychologist !== null">
				Psychologist
				<span>{{ getSelectedPsychologist }}</span>
			</li>

		</ul>
	</div>
	<!-- <div class="mt-4 container-fluid" v-if="showBookingReview">
		<hr>
		<div class="card">
			<div class="card-header">Review booking schedule details</div>
			<div class="card-body">
				<ul class="list-group">
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<b>Date</b>
						<span>{{ getSelectedDate }}</span>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center" >
						<b>Time</b>
						<span><a href="#">{{ getSelectedTime }}</a></span>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center" >
						<b>Psychologists</b>
						<span><a href="#">{{ getSelectedPsychologist }}</a></span>
					</li>
				</ul>

				<div class="row mt-3">
					<div class="col-md-6">
						<button class="btn btn-primary btn-block" @click.prevent="submiDataAndTime">
							<i class="fa fa-check"></i>
							<span>Submit</span>
						</button>
					</div>
					<div class="col-md-6">
						<a href="#" class="btn btn-secondary btn-block">
							<i class="fa fa-times"></i>
							<span>Cancel</span>
						</a>
					</div>	
				</div>
			</div>
		</div>
	</div> -->
</template>

<script>

	import { mapGetters, mapActions } from 'vuex';
	import SweetAlert from '../../mixins/sweet-alert.js'
	
	export default {
		name: "ReviewBooking",
		mixins: [ SweetAlert ],
		props: {
			hasAssessment: Number,
			isFirsttimer: Number,
			selfHarm: Number,
			harmOtherPeople: Number,
			participants: Array
		},
		computed: {

			...mapGetters([
				"getSelectedDate",
				"getSelectedTime",
				"getSelectedPsychologist",
				"showBookingReview",
				"getSelectedTimeId",
				"getSelectedPsychologistId"
			]),
			checkFirstTimer(){
				return this.isFirsttimer === 1 ? 'Yes' : 'No'
			},
			checkSelfHarm(){
				return this.selfHarm === 1 ? 'Yes' : 'No'
			},
			checkHarmOtherPeople(){
				return this.harmOtherPeople === 1 ? 'Yes' : 'No'
			}
		},
		methods: {

			...mapActions([
				'storeDateTime'
			]),
			submiDataAndTime(){
				this.storeDateTime({

					date: this.getSelectedDate,
					time_id: this.getSelectedTimeId,
					psychologist: this.getSelectedPsychologistId

				}).then(response => {
					
					let data = response.data;

					if(data.success){
						this.success(data.message);
						window.location.href = `${window.location.origin}/bookings/review-details`;
					}else{
						this.error(data.message);
					}

				}).catch(error => {
					console.log(error)
				})
			}
		}
	}
</script>