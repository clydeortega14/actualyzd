<template>
    <div>
        <div class="btn-group mb-5" role="group" aria-label="Basic example">
            <button type="submit" v-if="sessionStatusName == 'Pending' && userRoles.includes('psychologist')" class="btn btn-outline-primary" @click.prevent="actionClicked('accept', 1)">Accept</button>
            <button type="button" v-if="(sessionStatusName == 'Booked' || sessionStatusName === 'Rescheduled') && (userRoles.includes('psychologist') || userRoles.includes('superadmin'))" class="btn btn-outline-primary" @click.prevent="actionClicked('complete', 2)">Complete</button>
            <button type="button" v-if="(sessionStatusName == 'Booked' || sessionStatusName === 'Rescheduled') && (userRoles.includes('psychologist') || userRoles.includes('superadmin') || userRoles.includes('member'))" class="btn btn-outline-primary" @click.prevent="actionClicked('cancel', 4)">Cancel</button>
            <button type="button" v-if="(sessionStatusName == 'Booked') && (userRoles.includes('psychologist') || userRoles.includes('superadmin'))" class="btn btn-outline-primary" @click.prevent="actionClicked('reschedule', 5)">Reschedule</button>
            <button type="button" v-if="(sessionStatusName == 'Booked' || sessionStatusName === 'Rescheduled') && (userRoles.includes('psycholgist') || userRoles.includes('superadmin'))" class="btn btn-outline-primary" @click.prevent="actionClicked('no-show', 3)">No Show</button>
            <!-- <button type="button" class="btn btn-primary">Join Now</button> -->
        </div>
    </div>
</template>


<script>

import { mapActions } from "vuex";
import Swal from "sweetalert2"
import UserRoles from "../../mixins/user-roles";

export default {
    name: "Actions",
    data() {
        return {
            action: ""
        }
    },
    mixins: [UserRoles],
    props: {
        bookingid: Number,
        status: Number,
        sessionStatusName: String,
        sessionTypeName: String,
        userRoles: Array
    },
    methods: {
        ...mapActions([
            "updateStatus"
        ]),
        updateNewStatus(actionStatus){
            
            this.updateStatus({
                id: this.bookingid,
                status: actionStatus,
                sessionType: this.sessionTypeName
            })
            .then(response => {

                console.log(response)

                if(response.data.success){
                    Swal.fire('Success!', response.data.message, 'success');
                    // location.reload();
                }
            })
            .catch(error => {
                Swal.error('Oops!', error.message, 'error');
            });
        },
        actionClicked(action, actionStatusId){
            
            this.action = action;

            switch(this.action){

                case 'cancel':
                    window.location.href = `${window.location.origin}/bookings/cancel/${this.bookingid}`;
                    
                    break;
                case 'reschedule':
                    
                    window.location.href= `${window.location.origin}/bookings/reschedule/${this.bookingid}`
                    break;

                case 'complete':

                    // check the session type first if it is individual session,
                    if(this.sessionTypeName === 'Individual Session') {

                        // then redirect the user to progress reports
                        window.location.href = `${window.location.origin}/progress-reports/create-for-booking/${this.bookingid}`;
                        break;
                    }
                    
                    // else, session must be completed directly.
                    this.updateNewStatus(actionStatusId);
                    break;
                    
                case 'no-show':

                    // update booking status to no show
                    this.updateNewStatus(actionStatusId);
                    break;

                case 'accept':

                    this.updateNewStatus(actionStatusId);
                    break;

                default: 
            }
            
        }
    }
}
</script>