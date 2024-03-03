<template>
	<div class="mb-3">
		<div v-if="allClients.length > 0">

			<select class="custom-select" v-model="selected_client">
				<option :value="null">All Clients</option>
				<option v-for="client in allClients" :key="client.id" :value="client.id">{{ client.name }}</option>
			</select>
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
				overallActive: true,
				selected_client: null
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
			])
		},
		watch: {

			selected_client(value){
				this.serviceUtilization({
					params: {
						client: value
					}
				});
			}
		}
	}
</script>