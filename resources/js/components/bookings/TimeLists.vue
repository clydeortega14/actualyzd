<template>
	<div>
		<h5 class="card-title mb-3 border-bottom">Select Time</h5>
		<div class="custom-control custom-radio mb-3 ml-3" v-for="(time, index) in getTimeByDate" :key="index">
			<input type="radio" class="custom-control-input" 
				:id="`time-${time.time_list.id}`" 
				:value="{ id: time.time_list.id, name: `${time.time_list.from} - ${time.time_list.to}`}" 
				v-model="selected_time">
			<label class="custom-control-label" :for="`time-${time.time_list.id}`">{{ `${wholeTime(time.time_list.from)} - ${wholeTime(time.time_list.to)}` }}</label>
		</div>
	</div>
</template>

<script>
	
	import { mapGetters, mapActions } from 'vuex';
	import DateTime from '../../mixins/datetime.js';

	export default {
		name: "TimeLists",
		mixins: [DateTime],
		data(){

			return {
				selected_time: {}
			}
		},
		computed: {
			...mapGetters(["getTimeByDate"])
		},
		methods: {
			...mapActions(["timeByDate"])
		},
		watch:{

			selected_time(value){

				EventBus.$emit('select-time', value);

			}
		}
	}
</script>