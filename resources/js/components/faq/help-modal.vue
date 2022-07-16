<template>
	<div>
		<div class="modal fade" id="help-modal" tabindex="-1" aria-labelledby="HelpModal" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="HelpModal">Help</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">

		      	<!-- Search FAQ Component -->
		        <faq-search></faq-search>

		        <!-- List of FAQ's Component -->
		        <faq-lists :selected-question="selected_question"

		        	v-on:selecting-question="Questionselected"
		        	v-if="!selected_question"></faq-lists>


		        <!-- FAQ Steps / Procedures Component-->
		       	<faq-steps 

		       		v-if="selected_question"

		       		v-on:return-back="returnBack"></faq-steps>

		        
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</template>


<script>
	

	export default {
		name: "HelpModal",
		data() {

			return {

				selected_question: false
			}
		},
		methods: {

			Questionselected(){

				this.selected_question = !this.selected_question;
			},
			returnBack(){

				this.selected_question = false;
			}
		}
	}
</script>