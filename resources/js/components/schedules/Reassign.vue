<template>
    <div>
        <!-- Reassign Button -->
        <button type="button" class="btn btn-sm btn-secondary" @click="handleReassign">Reassign</button>

        <!-- Reassign Modal -->
        <ReassignModal v-if="isShowModal"/>
    </div>
</template>

<script>

    import ReassignModal from "../schedules/ReassignModal.vue";
    export default {
        name: "Reassign",
        data(){
            return {
                isShowModal: false
            }
        },
        components: {
            ReassignModal
        },
        methods: {
            handleReassign(){

                this.isShowModal = true;
            }
        }
    }

</script>