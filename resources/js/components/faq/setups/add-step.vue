<template>
	<div>
		<div class="modal fade" id="add-step" tabindex="-1" aria-labelledby="FAQSteps" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="FAQSteps">FAQ Steps / Procedure</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">


		        <div class="form-group">
		          <label>Step Description</label>
		          <textarea type="hidden" name="step_desc"  v-model="step_description" class="form-control" required></textarea>
		        </div>
		        <div class="form-group">
		          <label>Link To Description</label>
		          <input type="text" name="link_to_desc" v-model="link"  class="form-control">
		        </div>

		        <div class="form-group">
		          <label>Upload Image</label>
		          <input type="file" name="upload_image" class="form-control-file">
		        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary" @click="submitStep">Submit</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</template>

<script>
	

	export default {

		name: "AddStep",
		data(){

			return {
				step_description: '',
				link: ''
			}
		},

		created(){
			EventBus.$on('edit-step', (data) => {

				$('#add-step').modal('show');

				this.step_description = data.description;
				this.link = data.link;
			})
		},
		methods: {

			submitStep(){

				EventBus.$emit('submit-step', {
					description: this.step_description,
					link: this.link
				});

				this.step_description = '';
				this.link = '';

				$('#add-step').modal('hide');
			}
		}
	}
</script>