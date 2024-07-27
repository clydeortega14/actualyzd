<template>
    <div>
        <div class="btn-group mb-5" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-outline-primary" @click.prevent="actionClicked('complete', 2)">Complete</button>
            <button type="button" class="btn btn-outline-primary" @click.prevent="actionClicked('cancel', 4)">Cancel</button>
            <button type="button" class="btn btn-outline-primary" @click.prevent="actionClicked('reschedule', 5)">Reschedule</button>
            <button type="button" class="btn btn-outline-primary" @click.prevent="actionClicked('no-show', 3)">No Show</button>
            <!-- <button type="button" class="btn btn-primary">Join Now</button> -->
        </div>
    </div>
</template>


<script>

import { mapActions } from "vuex";
import Swal from "sweetalert2"

export default {
    name: "Actions",
    data() {
        return {
            action: ""
        }
    },
    props: {
        bookingid: Number,
        status: Number
    },
    methods: {
        ...mapActions([
            "updateStatus"
        ]),
        actionClicked(action, status){

            this.action = action;

            switch(this.action){

                case 'cancel':
                    window.location.href = `${window.location.origin}/bookings/cancel/${this.bookingid}`;
                    
                    break;
                case 'reschedule':
                    
                    window.location.href= `${window.location.origin}/bookings/reschedule/${this.bookingid}`
                    break;
                case 'complete':

                    window.location.href = `${window.location.origin}/progress-reports/create-for-booking/${this.bookingid}`
                    break;

                case 'no-show':

                    // update booking status to no show
                    this.updateStatus({
                        id: this.bookingid,
                        status: status
                    })
                    .then(response => {
                        if(response.data.success){
                            Swal.fire('Success!', response.data.message, 'success');
                            location.reload();
                        }
                    })
                    .catch(error => {
                        Swal.error('Oops!', error.message, 'error');
                    })

                    break;
                default: 
            }
            
        }
    }
}
</script>