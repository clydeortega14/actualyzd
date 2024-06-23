<template>
    <div>
        <FullCalendar :options='calendarOptions' />
    </div>
</template>


<script>

    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import interactionPlugin from '@fullcalendar/interaction'

    export default {
        components: {
            FullCalendar
        },
        created(){
            console.log(new Date())
        },
        name: "SessionCalendar",
        data(){
            return {
                calendarOptions: {
                    plugins: [dayGridPlugin, interactionPlugin],
                    initialView: 'dayGridWeek',
                    events: [
                        { title: 'Meeting', start: new Date() }
                    ]
                }
            }
        }
    }

</script>