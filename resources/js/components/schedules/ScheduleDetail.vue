<template>
    <div class="modal fade" id="show-time" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="show-time-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="show-time-label">Schedule Detail</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          		<span aria-hidden="true">&times;</span>
		        	</button>
				</div>

                <div class="modal-body"v-if="getBooking.to_status !== undefined">
                    
                    <div class="row justify-content-between">
                        <div class="col-md-8">
                            <ScheduleAction 
                                :bookingid="getBooking.id" 
                                :status="getBooking.status"
                                :session-status-name="getBooking.to_status.name"
                                :session-type-name="getBooking.session_type.name"
                            />
                        </div>
                        <div class="col-md-4">
                            <span :class="getBooking.to_status.class" class="ml-auto pull-right float-right">
                                {{ getBooking.to_status.name }}
                            </span>
                        </div>
                    </div>
                    

                    <div class="border-bottom mb-3" v-if="getBooking.to_status.name === 'Booked' || getBooking.to_status.name === 'Rescheduled'">
                        <a :href="jitsiUrl + getBooking.link_to_session" class="btn btn-sm btn-success mb-3" target="_blank">
                            Join Now
                        </a>
                    </div>

                    <div class="border-bottom mb-3">
                        <b>DateTime</b>
                        <p>
                            {{ getBooking.to_schedule !== undefined && getBooking.time !== undefined ?  
                                dateAndTimeFormat(getBooking.to_schedule.start, getBooking.time.from, getBooking.time.to) : 
                                '' 
                                }}
                        </p>
                    </div>

                    <div class="border-bottom mb-3">
                        <b>Type of session</b>
                        <p>
                            {{ getBooking.session_type !== undefined ?  getBooking.session_type.name : '' }}
                        </p>
                    </div>

                    <div class="border-bottom mb-3">
                        <b>Participants</b>
                        <div v-if="getBooking.participants !== undefined">
                            <ul class="list-unstyled ml-3">
                                <li v-for="participant in getBooking.participants" :key="participant.id">
                                    {{  participant.name  }}
                                    <!-- <span class="badge badge-success">Member</span> -->
                                    <a href="#" class="ml-2">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import { mapGetters, mapActions } from "vuex";
    import DateTime from "../../mixins/datetime";
    import ScheduleAction from "./Actions.vue"

    export default {
        name: "ScheduleDetail",
        mixins: [DateTime],
        components: {
            ScheduleAction
        },
        computed: {
            ...mapGetters(["getBooking"]),
            baseUrl(){
                return window.location.origin;
            },
            jitsiUrl(){

                console.log(process.env.MIX_JITSI_URL)
                return process.env.MIX_JITSI_URL;
            }
        },
        methods: {
            ...mapActions(["showBooking"])
        }
        
    }
</script>