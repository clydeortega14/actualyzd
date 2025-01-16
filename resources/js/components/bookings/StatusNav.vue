<template>
	<div>
		<ul class="nav nav-tabs mb-3">
				
		  	<li class="nav-item" v-for="status in allBookingStatuses" :key="status.id">
		    	<a class="nav-link" :class="{ active: status.id == selected_tab }" href="#" @click.prevent="filterByStatus(status.id)">
		    	{{ checkName(status.name) }}
		    	<span :class="status.class">{{ status.total }}</span>
		    	</a>
		    	
		  	</li>
		  		
		</ul>
	</div>
</template>

<script>
	
	import { mapGetters, mapActions } from 'vuex';
	export default {
		name: "StatusNav",
		data(){

			return {
				selected_tab: 1
			}
		},
		created(){
			this.getBookingStatuses();
		},
		computed: {
			...mapGetters(["allBookingStatuses"])
		},
		methods: {
			...mapActions(["getBookingStatuses"]),
			filterByStatus(id){
				this.selected_tab = id
				this.$emit('filter-by-status', id);
			},
			checkName(name){
				return (name === 'Booked' || name === 'Pending' || name === 'Rescheduled' ? 'Upcoming' : name)
			}
		}
	}
</script>