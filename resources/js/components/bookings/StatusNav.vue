<template>
	<div>
		<ul class="nav nav-tabs mb-3">
				
		  	<li class="nav-item" v-for="status in allBookingStatuses" :key="status.id">
		    	<a class="nav-link" href="#" @click.prevent="filterByStatus(status.id)">
		    	{{ status.name }}
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
		created(){
			this.getBookingStatuses();
		},
		computed: {
			...mapGetters(["allBookingStatuses"])
		},
		methods: {
			...mapActions(["getBookingStatuses"]),
			filterByStatus(id){
				this.$emit('filter-by-status', id);
			}
		}
	}
</script>