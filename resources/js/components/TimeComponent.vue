<template>
	<div class="card mt-3">
		<div class="card-header">
			<div class="d-flex justify-content-between">
				<span>Pick a time</span>
				<div>
					<input type="date" name="" readonly class="form-control" :value="selected_date">
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" v-for="time in time_lists" :key="time.id">
			    	<div class="form-group">
			    		<input type="radio" name="time" @change="selectTime(time.id)"/>
			    		<label>{{ time.from+' - '+time.to }}</label>
			    	</div>
			    </div>
			</div>
		</div>
	</div>
</template>


<script>
	
	export default {
		props: {

			time_lists: Array,
			selected_date: String
		},
		methods: {

			selectTime(time)
			{
				this.$emit('select-time', time);
			}
		}
	}
</script>