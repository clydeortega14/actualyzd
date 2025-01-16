<template>
    <div>
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item" v-for="tab in tabs" :key="tab.id">
                <a class="nav-link" :class="activeTab === tab.id ? 'active' : '' " href="#" @click.prevent="$emit('tab-click', tab.id, tab.unique_name)">{{ tab.name }}</a>
            </li>
        </ul>
    </div>
</template>


<script>

export default {
    name: "PsychNavTabs",
    data() {
        return {
            // active_tab: 1,
        }
    },
    props: {
        tabs: Array,
        activeTab: Number
    },
    methods: {
        clickTab(tab_id){
            this.active_tab = tab_id;
        }
    }
}
</script>