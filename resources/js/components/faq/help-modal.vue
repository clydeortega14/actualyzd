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
		        <faq-search v-on:search-faq="searchFaq"></faq-search>

		        <!-- List of FAQ's Component -->
		        <faq-lists 

		        	v-if="!selected_question"
		        	:selected-question="selected_question"
		        	:faqs="faq_lists"

		        /></faq-lists>


		        <!-- FAQ Steps / Procedures Component-->
		       	<faq-steps 

		       		v-if="selected_question"

		       		@return-back="returnBack"
		       		:faq-question="question"
		       		:faq-desc="description"
		       		:faq-steps="steps"

		       	/></faq-steps>

		        
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

				selected_question: false,
				question: '',
				description: '',
				steps: [],
				faq_lists: []
			}
		},
		created(){


			this.getListFaqs();

			EventBus.$on('selecting-question', (data) => {

				this.selected_question = !this.selected_question;

				this.question = data.title;
				this.description = data.description;
				this.steps = data.steps;
			});
		},
		methods: {

			getListFaqs(){

		        this.$store.dispatch('allFaqs').then(response => {

		          this.faq_lists = response.data

		        }).catch(error => console.log(error))
		     },

			returnBack(){

				this.selected_question = false;
			},
			searchFaq(value){

				axios.get('/FAQs/search/faq', {
					params: {

						search_item: value

					}
				}).then(response => {

					this.faq_lists = response.data

				}).catch(error => {

					console.log(error)
				})
			}
		}
	}
</script>