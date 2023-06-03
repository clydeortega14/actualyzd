<template>
	<div class="list-group">

		<div v-if="allClients.length > 0">
	        <a href="#" class="list-group-item" :class="{ active: overallActive }" @click.prevent="overAll">
	        	<i class="fa fa-users"></i>	
	        	<span class="ml-2">Overall</span>
	        </a>

	        <a href="#" class="list-group-item" :class="{ active: activeId === client.id}"
	        	v-for="client in allClients" :key="client.id"
	        	@click.prevent="toggleClient(client.id)">
	        	<i class="fa fa-user"></i>
	        	<span class="ml-2">{{ client.name }}</span>
	        </a>
        </div>

        <div v-else>
        	No Active Clients
        </div>
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

			this.serviceUtilization();
		},
		computed: {
			...mapGetters(['allClients', 'allServices'])
		},
		methods: {

			...mapActions([
				'serviceUtilization'
			]),
			toggleClient(id){
				this.activeId = id;
				this.overallActive = false;
				this.serviceUtilization({
					params: {
						client: id
					}
				});
			},
			overAll(){

				this.activeId = null;
				this.overallActive = true;
				this.serviceUtilization();
			}
		}
	}
</script>