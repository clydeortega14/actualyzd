<template>
    <div>
        <div class="mt-3 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Subscription</th>
                        <th>Session Type</th>
                        <th>No. of bookings</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(booking_history, index) in getBookingHistory" :key="index">
                        <td>{{ booking_history.start_sched }}</td>
                        <td>{{ booking_history.subscription }}</td>
                        <td>{{ booking_history.session_type }}</td>
                        <td>{{ booking_history.total_booking }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

    import {mapGetters, mapActions} from "vuex";
    import DateTime from '../../mixins/datetime.js';

    export default {
        name: "BookingHistory",
        data() {
            return {
                heading: "",

            }
        },
        mixins: [DateTime],
        props: {
            clientid: Number
        },
        created(){
            this.showBookingHistory({
                ClientID: this.clientid
            });
        },
        computed: {
            ...mapGetters(["getBookingHistory"])
        },
        methods: {
            ...mapActions([
                "showBookingHistory"
            ])
        }
    }
</script>