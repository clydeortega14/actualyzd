<template>
	<div>
		<FullCalendar :options="calendarOptions" />

		<!-- Time Component -->
		<TimeComponent 
			v-if="time.show"
			:time_lists="getTimeLists"
			:selected_date="selected_date" 
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
		/>
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
					events: {
						url: '/psychologist/schedules',
					}
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
				selected_date: ''
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
				"availablePsychologist"
			]),

			handleDateClick(argument){

				this.selected_date = argument.dateStr;

				let foundSched = this.getSchedules.find(schedule => schedule.start === argument.dateStr);

				if(foundSched !== undefined){

					this.time.show = true;
					this.timeLists(foundSched.id);

				}else{

					this.time.show = false;
					this.psychologist.show = false;
				}
			},
			selectTime(data)
			{
				this.psychologist.show = true
				this.availablePsychologist(data)
			},
			selectPyschologist(id)
			{
				console.log(id)
				this.onboarding.show = true;
			}
		}
	}
</script>