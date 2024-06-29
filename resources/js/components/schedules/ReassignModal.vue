<template>
    <div>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="create-schedule-modal-label">Reassigning Session</h4>
                <hr>
            </div>

            <div class="form-group row mt-3">
                <label for="assignee" class="col-form-label text-md-right col-sm-3">Assignee</label>
                <div class="col-sm-8">
                    <select v-model="assignee" id="assignee" class="form-control">
                        <option disabled selected> - Select Assignee - </option>
                        <option v-for="(assignee, index) in allPsychologists" :value="assignee.id">{{ assignee.name }}</option>
                    </select>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect" @click.prevent="submitSessionReassigning">Submit</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</template>


<script>

    import { mapGetters, mapActions } from 'vuex';
    export default {
        name: "ReassignModal",
        props: {
            date: String,
            time: String,
            userid: String,
            bookingReference: String
        },
        data(){
            return {
                assignee: 'select assignee'
            }
        },
        computed: {
            ...mapGetters(["allPsychologists"])
        },
        created(){
            // get psychologist lists
            this.getPsychologists({
                date: this.date,
                time_id: this.time
            })
        },
        methods: {
            ...mapActions(["getPsychologists", "reassignSession"]),
            submitSessionReassigning(){

                let payload = {
                    date: this.date,
                    time_id: this.time,
                    assignee: this.assignee,
                    booking_reference: this.bookingReference
                }

                this.reassignSession(payload);

                
            }
        }
    }
</script>