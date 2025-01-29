<template>
    <div>
        <div class="row justify-content-between align-items-center">
            <div class="col-sm-8">
                <div class="input-group mb-3" v-if="!show_create_psychologist_form">
                    <input type="text" class="form-control" placeholder="Search Psychologist" aria-label="Search Psychologist" aria-describedby="search-psychologist">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="search-psychologist">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <button type="button" v-if="!show_create_psychologist_form" class="btn btn-primary mb-3 d-flex align-items-center float-right" @click="clickedCreateNewPsychologist">
                    New Psychologist
                </button>
            </div>
        </div>
        
        <div class="table-responsive" v-if="!show_create_psychologist_form">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
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
                                    <span>{{  psych.name }} <small>
                                        <span class="badge" :class="psych.is_active ? 'badge-success' : 'badge-danger'">
                                            {{ psych.is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </small><br />
                                        <small class="mb-0 text-gray-100">{{ psych.email }}</small>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>{{ wholeDate(psych.created_at)+' '+wholeTime(psych.created_at) }}</td>
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

        <!-- CREATE NEW PSYCHOLOGIST COMPONENT UI -->
        <div v-if="show_create_psychologist_form">
            <CreatePsychologistForm />
        </div>
    </div>
</template>


<script>

import URLS from "../../constants/url";
import SweetAlert from "../../mixins/sweet-alert";
import { mapGetters, mapActions } from "vuex";
import datetime from "../../mixins/datetime";
import CreatePsychologistForm from "./CreatePsychologistForm.vue";
export default {
    name: "PsychListContent",
    data(){
        return {
            URLS,
            show_create_psychologist_form: false
        }
    },
    mounted()
    {
        EventBus.$on('clicked-cancel-create-psychologist', () => {
            this.show_create_psychologist_form = false;
        });

        EventBus.$on('on-succesfull-psychologist-creation', (data) => {
            this.show_create_psychologist_form = false;
            this.getPsychLists();
            this.success(data.message)
        })
    },
    components: {
        CreatePsychologistForm
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
        clickedCreateNewPsychologist(){
            this.show_create_psychologist_form = true;
        },
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