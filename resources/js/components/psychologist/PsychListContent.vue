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
                            <button class="btn btn-sm" :class="psych.is_active ? 'btn-danger' : 'btn-success' ">
                                {{ psych.is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                            <button class="btn btn-sm btn-primary">
                                Profile
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>


<script>

import { mapGetters, mapActions } from "vuex";
import datetime from "../../mixins/datetime";
export default {
    name: "PsychListContent",
    computed: {
        ...mapGetters([
            "allPsychologists"
        ])
    },
    mixins: [datetime],
    created(){
        this.getPsychLists();
    },
    methods: {
        ...mapActions([
            "getPsychLists"
        ])
    }
}
</script>