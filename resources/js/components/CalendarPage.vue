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
					v-bind="form.selected" 
					@session-selected="sessionSelected" 
					@client-selected="clientSelected"
					@counselee-selected="counseleeSelected" />
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
					onboarding_answers: [],
					selected: {
						session: null,
						client: null,
						counselee: null
					},
					is_firstimer: null,

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
				
				if(this.user_role === 'superadmin'){

					this.show_actions = true;

				}else if(this.user_role === 'member'){

					this.onboarding.show = true;
				}
			},
			selectPyschologist(id)
			{
				this.form.psychologist = id;
				this.onboarding.show = true;
			},
			sessionSelected(session_id)
			{
				this.form.selected.session = session_id;
			},
			clientSelected(client_id)
			{
				this.form.selected.client = client_id;
			},
			counseleeSelected(counselee_id){
				this.form.selected.counselee = counselee_id;
			},
			onboardingAnswers(answers)
			{
				this.show_actions = true;
<<<<<<< HEAD
				this.form.choice = answers[0];
				this.form.is_firstimer = answers[1];
=======
				this.form.onboarding_answers = answers;
>>>>>>> origin/jovel
			},
			submitBooking()
			{
				let payload = {

					schedule: this.form.schedule,
					time_id: this.form.time,
					client: this.form.selected.client,
					counselee: this.form.selected.counselee,
					session_type_id: this.form.selected.session,
<<<<<<< HEAD
					choice: this.form.choice,
					is_firstimer: this.form.is_firstimer
=======
					onboarding_answers: this.form.onboarding_answers
>>>>>>> origin/jovel
				}

				axios.post('/bookings/book', payload)
					.then(response => {

						let result = response.data;

						if(result.success){

							// clear form
							this.form.schedule = null;
							this.form.scheduled_date = null;
							this.form.time = null;
							this.form.selected.client = null;
							this.form.selected.counselee = null;
							this.form.selected.session = null;
							this.form.psychologist = null;
<<<<<<< HEAD
							this.form.choice = [];
							this.form.is_firstimer = null;
=======
							this.form.onboarding_answers = [];
>>>>>>> origin/jovel

							// hide some components
							this.time.show = false;
							this.psychologist.show = false;
							this.showSessionType = false;
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