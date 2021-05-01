<template>
	<div class="row">
		<div :class="checkSelectedDate">
			<FullCalendar :options="calendarOptions" />
		</div>

		<div class="col-md-4" v-if="hasSelectedDate">
			<form @submit.prevent="submitBooking">
				<!--  Session Types Component -->
				<SessionType 
					v-if="showSessionType" 
					v-bind="form.selected" />
				<!-- end session types component -->

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
	</div>
</template>

<script>
	
	import FullCalendar from '@fullcalendar/vue';
	import dayGridPlugin from '@fullcalendar/daygrid';
	import interactionPlugin from '@fullcalendar/interaction';

	import TimeComponent from './TimeComponent';
	import PsychologistComponent from './PsychologistComponent';
	import OnboardingQuestion from './OnboardingQuestion';
	import SessionType from './SessionType';

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

					schedule: null,
					time: null,
					psychologist: null,
					counselee: null,
					choice: [],
					selected: {
						session: null,
						client: null,
						counselee: null
					}

				},
				showSessionType: false,
				hasSelectedDate: false,
				column_size: '',
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
		props: {

			booking: Object,
			user_role: String,
		},
		created(){
			this.getAllSchedules()
		},
		computed: {

			...mapGetters([
				"getSchedules", 
				"getTimeLists", 
				"getAvailable"
			]),
			checkSelectedDate(){
				return this.column_size = this.hasSelectedDate ? 'col-md-8' : 'col-md-12';
			}
		},
		components: {
			FullCalendar,
			TimeComponent,
			PsychologistComponent,
			OnboardingQuestion,
			SessionType
		},
		methods: {

			...mapActions([
				"getAllSchedules", 
				"timeLists", 
				"availablePsychologist",
				"storeBooking"
			]),

			handleEventClick(arg){

				let schedule_id = arg.event.id;
				this.hasSelectedDate = true;
				this.form.schedule = schedule_id;
				this.form.scheduled_date = arg.event.startStr;
				this.time.show = true;
				this.showSessionType = this.user_role === 'superadmin' ? true : false;
				this.timeLists(schedule_id)
			},

			handleDateClick(argument){

				this.time.show = false;
				this.showSessionType = false;
				this.onboarding.show = false;
				this.show_actions = false;
				this.hasSelectedDate = false;
			},
			selectTime(data)
			{
				this.form.time = data;
				// this.psychologist.show = true;
				this.onboarding.show = true;
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

					schedule: this.form.schedule,
					time_id: this.form.time,
					counselee: this.form.counselee,
					session_type_id: this.form.session_type_id,
					choice: this.form.choice
				}

				axios.post('/bookings/book', payload)
					.then(response => {

						let result = response.data;

						if(result.success){

							// clear form
							this.form.schedule = null;
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
							this.hasSelectedDate = false;

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