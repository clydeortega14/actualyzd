<template>
	<div class="mb-3">
		<h5 class="card-title mb-3 border-bottom">Select Time</h5>

		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-outline-primary mb-2 ml-2 btn-block" :class="{ 'btn-primary' : getSelectedTimeId === time.time_id}" v-for="(time, index) in getTimeByDate" :key="index" @click="selectTime({ id: time.time_id, name: `${wholeTime(time.time_from)} - ${wholeTime(time.time_to)}` })">
					{{ `${wholeTime(time.time_from)} - ${wholeTime(time.time_to)}` }}
				</button>
			</div>
		</div>
		
<!-- 
		<div class="custom-control custom-radio mb-3 ml-3" v-for="(time, index) in getTimeByDate" :key="index">
			<input type="radio" class="custom-control-input" 
				:id="`time-${time.id}`" 
				:value="{ id: time.id, name: `${wholeTime(time.from)} - ${wholeTime(time.to)}`}" 
				v-model="selected_time">
			<label class="custom-control-label" :for="`time-${time.id}`">{{ `${wholeTime(time.from)} - ${wholeTime(time.to)}` }}</label>
		</div> -->
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
				selected_time: null,
				btnClass: 'btn-outline-primary'
			}
		},
		computed: {
			...mapGetters(["getTimeByDate", "getSelectedTimeId"])
		},
		methods: {
			...mapActions(["timeByDate"]),
			selectTime(value){

				if(!_.isNil(value)){

					this.selected_time

					this.$store.commit('setSelectedTimeId', value.id);
					this.$store.commit('setSelectedTime', value.name);

					EventBus.$emit('select-time', value);

					
				}
			}
		}
	}
</script>