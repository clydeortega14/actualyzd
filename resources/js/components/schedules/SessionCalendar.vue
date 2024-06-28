<template>
    <div>
        <FullCalendar :options='calendarOptions'/>
    </div>
</template>


<script>

    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import interactionPlugin from '@fullcalendar/interaction'

    export default {
        name: "SessionCalendar",
        data(){
            return {
                
                
            }
        },
        components: {
            FullCalendar
        },
        computed: {
            calendarOptions(){

                return {
                    plugins: [dayGridPlugin, interactionPlugin],
                    initialView: 'dayGridWeek',
                    events: this.getEvents()
                }
            }
        },
        methods: {
            getEvents(){

                let events = [];
    
                // api call for current week schedules

                events = [

                    { title: 'Individual', start: '2024-06-24 09:30', end: '2024-06-24 11:30'},
                    { title: 'Individual', start: '2024-06-24 10:30' },
                    { title: 'Group', start: '2024-06-24 13:00' },
                    { title: 'Invidual', start: '2024-06-25 14:00' },
                    { title: 'Webinar', start: '2024-06-25 16:00' }
                ];

                return events;
            }
        }
    }

</script>