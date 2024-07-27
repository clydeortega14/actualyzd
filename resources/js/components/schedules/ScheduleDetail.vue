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

                <div class="modal-body">

                    <div class="btn-group mb-5 btn-block" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success">Complete</button>
                        <button type="button" class="btn btn-danger">Cancel</button>
                        <button type="button" class="btn btn-warning">Reschedule</button>
                        <button type="button" class="btn btn-secondary">No Show</button>
                        <button type="button" class="btn btn-primary">Join Now</button>
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

    export default {
        name: "ScheduleDetail",
        mixins: [DateTime],
        computed: {
            ...mapGetters(["getBooking"]),
        },
        methods: {
            ...mapActions(["showBooking"])
        }
        
    }
</script>