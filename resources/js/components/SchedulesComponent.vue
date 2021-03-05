<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <FullCalendar :options="calendarOptions"/>

                        <CreateSchedule ref="dialog" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import FullCalendar from '@fullcalendar/vue';
    import daygridPlugin from '@fullcalendar/daygrid';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import interactionPlugin from '@fullcalendar/interaction';
    import listPlugin from '@fullcalendar/list';
    import CreateSchedule from '../components/modals/CreateSchedule';

    export default {

        data(){
            return {
                calendarOptions: {

                    plugins: [daygridPlugin, timeGridPlugin, interactionPlugin, listPlugin],
                    initialView: 'dayGridMonth',
                    events: [
                        {title: 'event1', date: '2021-03-05'}
                    ],
                    editable: true,
                    selectable: true,
                    selectMirror: true,
                    dayMaxEvents: true,
                    weekends: true,
                    select: this.select,
                    eventClick: this.eventClick,
                }
                
            }
        },
        components: {
            FullCalendar,
            CreateSchedule
        },
        methods: {
            eventClick(arg){
                console.log(arg)
            },
            select(){
                this.$ref.dialog.open()
            }
        },
        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>
