<template>
	<div class="list-group">
        <a href="#" class="list-group-item list-group-item-action" :class="{ active: overallActive }" @click.prevent="overAll">Overall</a>

        <a href="#" class="list-group-item list-group-item-action" :class="{ active: activeId === client.id}"
        	v-for="client in allClients" :key="client.id"
        	@click.prevent="toggleClient(client.id)">{{ client.name }}
        </a>
    </div>
</template>

<script>
	
	import { mapGetters, mapActions } from 'vuex';

	export default {
		name: "ClientList",
		data(){
			return {

				activeId: null,
				isActive: false,
				overallActive: true
			}
		},
		created(){

			this.getClients();
		},
		computed: {
			...mapGetters(['allClients', 'allServices'])
		},
		methods: {

			...mapActions([
				'getClients',
				'clientServices',
				'getServices'
			]),
			toggleClient(id){
				this.activeId = id;
				this.overallActive = false;
				this.clientServices(id);
			},
			overAll(){

				this.activeId = null;
				this.overallActive = true;
				this.getServices();
			}
		}
	}
</script>