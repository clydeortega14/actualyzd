<template>
	<div class="modal fade" id="show-time" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="show-time-label" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="show-time-label">Select time for</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          		<span aria-hidden="true">&times;</span>
		        	</button>
				</div>

				<div class="modal-body">
					<div class="form-group mb-3" v-for="( time_list, index ) in time_lists" :key="index">
						<button class="btn btn-outline-primary btn-block"
							:value="time_list.id" 
							@click="selectATime(time_list.id)">
							{{ time_list.value }}
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	

	export default {

		name: "TimeSchedule",
		data(){

			return {

				time_lists: [],
				selected_time: [],
			}
			
		},
		created(){

			this.time_lists = [

				{ id: 1, value: '7:00 am - 8:00 am'},
				{ id: 2, value: '8:00 am - 9:00 am'},
				{ id: 3, value: '9:00 am - 10:00 am'},


			];
		},
		methods: {

			selectATime(id){
				console.log(id)
			}
		}
	}
</script>