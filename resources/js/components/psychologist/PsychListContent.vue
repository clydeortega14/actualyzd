<template>
    <div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Status</th>
                        <th>Registered At</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="psych in allPsychologists" :key="psych.id">
                        <td>
                            <div class="d-flex">
                                <img src="/images/profile.png" :alt="psych.id" height="48" width="48" class="img-circle mr-2">
                                <div>
                                    <span>{{  psych.name }} <br />
                                        <small class="mb-0 text-gray-100">{{ psych.email }}</small>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge" :class="psych.is_active ? 'badge-success' : 'badge-danger'">
                                {{ psych.is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ diffForHumans(psych.created_at) }}</td>
                        <td>
                            <button
                                @click.prevent="updatePsychStatus(psych.id)"
                                class="btn btn-sm" 
                                :class="psych.is_active ? 'btn-danger' : 'btn-success' "
                            >
                                {{ psych.is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                            <a :href="URLS.BASE+`/profile/${psych.username}`" class="btn btn-sm btn-primary">
                                Profile
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>


<script>

import URLS from "../../constants/url";
import SweetAlert from "../../mixins/sweet-alert";
import { mapGetters, mapActions } from "vuex";
import datetime from "../../mixins/datetime";
export default {
    name: "PsychListContent",
    data(){
        return {
            URLS
        }
    },
    computed: {
        ...mapGetters([
            "allPsychologists"
        ])
    },
    mixins: [datetime, SweetAlert],
    created(){
        this.getPsychLists();
    },
    methods: {
        ...mapActions([
            "getPsychLists",
            "statusUpdate"
        ]),
        updatePsychStatus(id){

            let findPsych = this.allPsychologists.find(psych => psych.id == id);
            let index = this.allPsychologists.findIndex( psych => psych.id == id);

            if(findPsych !== undefined && index > -1){

                this.dialog(
                    'Are you sure?',
                    `You want to ${findPsych.is_active ? ` Deactivate` : ` Activate`} ${findPsych.name}`,
                    'warning',
                    'Cancel',
                    findPsych.is_active ? ' Deactivate' : 'Activate'
                )
                .then((result) =>{
                    if(result.isConfirmed){

                        this.statusUpdate({user_id: findPsych.id})
                        .then(response => this.allPsychologists.splice(index, 1, response.data.data))
                        .catch(error => this.error(error))
                    }
                })
                
            }
        }
    }
}
</script>