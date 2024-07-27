<template>
    <div>
        <FullCalendar :options='calendarOptions'/>


        <div>
            <ScheduleDetail ref="modal" />
        </div>
    </div>
</template>


<script>

    import FullCalendar from '@fullcalendar/vue'
    import ScheduleDetail from './ScheduleDetail';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import interactionPlugin from '@fullcalendar/interaction'
    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "SessionCalendar",
        created(){
            this.RequestScheduledSessions({user_id: this.userId});
        },
        props: {
            userId: String
        },
        components: {
            FullCalendar,
            ScheduleDetail
        },
        computed: {
            ...mapGetters([
                "getScheduledSessions"
            ]),
            calendarOptions(){

                return {
                    plugins: [timeGridPlugin, interactionPlugin],
                    initialView: 'timeGridWeek',
                    events: this.getScheduledSessions,
                    eventClick : this.handleEventClick
                }
            }
        },
        methods: {
            ...mapActions(["RequestScheduledSessions", "showBooking"]),
            handleEventClick(arg){

                this.showBooking(arg.event.id)
                
                let element = this.$refs.modal.$el;
                
                $(element).modal("show")
            }
        }
    }

</script>