<template>
    <div>

        <div class="card">
            <div class="card-header">
                <!-- Navbars -->
                <PsychNavTabs 
                    :tabs="tabs" 
                    :active-tab="current_active_tab"
                    v-on:tab-click="tabClick"
                />
            </div>

            <div class="card-body">
                <!-- Nav Content -->
                <div v-bind:is="activeTabContent" class="tabs"></div>
            </div>
        </div>
    </div>
</template>



<script>
import PsychListContent from './PsychListContent.vue';
import PsychNavTabs from './PsychNavTabs.vue';
import PsychPayoutContent from './PsychPayoutContent.vue';

export default {

    name: "PsychologistComponent",
    data(){
        return {
            header: "Psychologist Component",
            current_active_tab: 1,
            active_tab_content: 'List',
            tabs: [
                {
                    id: 1,
                    unique_name: 'List',
                    name: 'Lists',
                },
                {
                    id: 2,
                    unique_name: 'Payout',
                    name: 'Payout'
                }
            ],
            tab_contents: ['List', 'Payout']
        }
    },
    computed:{
        activeTabContent(){
            return "Psych"+this.active_tab_content+"Content";
        }
    },
    components: {
        PsychNavTabs,
        PsychListContent,
        PsychPayoutContent
    },
    methods: {
        tabClick(tab_id, tab_unique_name){
            this.current_active_tab = tab_id;
            this.active_tab_content = tab_unique_name;
        }
    }
}
</script>