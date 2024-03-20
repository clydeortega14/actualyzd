<template>
	<div>
		
		<services-card> </services-card>

		<div class="row mb-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<ConcernsChart :height="chartHeight"/>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
</template>


<script>
	
	import { mapGetters, mapActions } from 'vuex';
	import ServiceUtilization from '../../mixins/service-utilization.js';
	import ConcernsChart from '../charts/ConcernsChart';
	import ServiceCard from './Services';

	export default {
		name: "Summary",
		data(){

			return {

				chartHeight: 175
			}
		},
		mixins: [ ServiceUtilization ],
		components: {
			ConcernsChart
		},
		created(){
			this.serviceUtilization()
		},
		computed: {

			...mapGetters(['allServices'])
		},
		methods: {

			...mapActions(['serviceUtilization'])
		}
	}
</script>