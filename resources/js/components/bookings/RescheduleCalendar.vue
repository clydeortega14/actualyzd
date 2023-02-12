<template>
	<div>
		<FullCalendar :options="options" />

		<Reschedule ref="rescheduleModal" />
	</div>
</template>


<script>

	import FullCalendar from '@fullcalendar/vue';
	import dayGridPlugin from '@fullcalendar/daygrid';
	import interactionPlugin from '@fullcalendar/interaction';

	import Reschedule from '../modals/Reschedule.vue';

	import { mapGetters, mapActions } from 'vuex';

	import Swal from 'sweetalert2';
	
	export default {
		name: "RescheduleCalendar",
		data(){

			return {

				options: {

					plugins:[dayGridPlugin, interactionPlugin],
					initialView: 'dayGridMonth',
					selectable: true,
					dateClick: this.handleDateClick,
					events: {
						url: '/psychologist/schedules'
					}
				}
			}
		},
		computed:{
			...mapGetters(["getTimeByDate"])
		},
		components: {
			Reschedule
		},
		props: {
			booking: Object,
			user: Object
		},
		mounted(){

			this.$store.commit('setBooking', this.booking);

			this.$store.commit('setUserId', this.user.id);
			this.$store.commit('setUserName', this.user.name);
			this.$store.commit('setUserEmail', this.user.email);
		},
		methods: {
			...mapActions(["timeByDate"]),
			handleDateClick(arg){

				this.timeByDate({
					date: arg.dateStr
				}).then(response => {

					let data = response.data

					if(data.success){

						if(data.data.length > 0){
							let element = this.$refs.rescheduleModal.$el;
							$(element).modal('show')

							this.$store.commit('setSelectedDate', arg.dateStr);
							this.$store.commit('setTimeByDate', data.data);

							
						}else{

							Swal.fire('Oops!', 'Selected date has no schedule please select another date', 'error');
						}
					}

				}).catch(error => {

					Swal.fire('Oops!', error, 'error');
				})
			}
		}
	}

</script>