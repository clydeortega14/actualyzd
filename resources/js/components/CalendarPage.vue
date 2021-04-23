<template>
	<div>
		<FullCalendar :options="calendarOptions" />

		<form @submit.prevent="submitBooking">
			<!-- Time Component -->
			<TimeComponent 
				v-if="time.show"
				:time_lists="getTimeLists"
				:selected_date="form.scheduled_date" 
				@select-time="selectTime" />

			<!-- Psychologist -->
			<PsychologistComponent 
				v-if="psychologist.show"
				:psychologist_available="getAvailable"
				@selected-psychologist="selectPyschologist"
			/>


			<!-- Onboarding Questions -->
			<OnboardingQuestion 
				v-if="onboarding.show"
				@onboarding-answers="onboardingAnswers"
			/>

			<div class="form-group" v-if="show_actions">
				<button class="btn btn-primary btn-block mt-3 mb-3">Submit</button>
				<a href="#" class="btn btn-danger btn-block">Cancel</a>
			</div>
		</form>
	</div>
</template>

<script>
	
	import FullCalendar from '@fullcalendar/vue';
	import dayGridPlugin from '@fullcalendar/daygrid';
	import interactionPlugin from '@fullcalendar/interaction';

	import TimeComponent from './TimeComponent';
	import PsychologistComponent from './PsychologistComponent';
	import OnboardingQuestion from './OnboardingQuestion';

	import { mapGetters, mapActions } from 'vuex';

	export default {

		data(){

			return {

				calendarOptions: {

					plugins: [ dayGridPlugin, interactionPlugin ],
					initialView: 'dayGridMonth',
					dateClick: this.handleDateClick,
					eventClick: this.handleEventClick,
					events: {
						url: '/psychologist/schedules',
					}
				},
				form: {

					scheduled_date: null,
					time: null,
					psychologist: null,
					counselee: null,
					session_type_id: null,
					choice: []

				},
				time: {

					show: false,
				},
				psychologist: {

					show: false
				},
				onboarding: {
					show: false
				},
				show_actions: false
			}
		},
		created(){

			this.getAllSchedules()
		},
		computed: {

			...mapGetters([
				"getSchedules", 
				"getTimeLists", 
				"getAvailable"
			])
		},
		components: {
			FullCalendar,
			TimeComponent,
			PsychologistComponent,
			OnboardingQuestion
		},
		methods: {

			...mapActions([
				"getAllSchedules", 
				"timeLists", 
				"availablePsychologist",
				"storeBooking"
			]),

			handleEventClick(arg){

				console.log(arg)
				this.form.scheduled_date = arg.event.startStr;
				let schedule_id = arg.event.id;
				this.time.show = true;
				this.timeLists(schedule_id)
			},

			handleDateClick(argument){

				this.time.show = false;
				this.psychologist.show = false;
				this.onboarding.show = false;
				this.show_actions = false;
			},
			selectTime(data)
			{
				this.form.time = data;
				this.psychologist.show = true;
				this.availablePsychologist(data);
			},
			selectPyschologist(id)
			{
				this.form.psychologist = id;
				this.onboarding.show = true;
			},
			onboardingAnswers(answers)
			{
				this.show_actions = true;
				this.form.choice = answers;
			},
			submitBooking()
			{
				let payload = {

					scheduled_date: this.form.scheduled_date,
					time_id: this.form.time,
					psychologist: this.form.psychologist,
					counselee: this.form.counselee,
					session_type_id: this.form.session_type_id,
					choice: this.form.choice
				}

				axios.post('/bookings/book', payload)
					.then(response => {

						let result = response.data;

						if(result.success){

							// clear form
							this.form.scheduled_date = null;
							this.form.time = null;
							this.form.psychologist = null;
							this.form.counselee = null;
							this.form.session_type_id = null;
							this.form.choice = [];

							// hide some components
							this.time.show = false;
							this.psychologist.show = false;
							this.onboarding.show = false;
							this.show_actions = false;

							alert(result.message);

						}else{

							alert(result.message)
						}
					})
					.catch(error => {
						console.log(error)
					})
			}
		}
	}
</script>