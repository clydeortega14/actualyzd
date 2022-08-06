<template>
	<div>
		<div class="form-group">
          <input type="text" name="search_faq" 

          	v-model="search_item" class="form-control form-control-lg" placeholder="Search" @keyup="faqSearch">
        </div>
	</div>
</template>


<script>
	
	export default {
		name: "FAQSearch",
		data(){

			return {

				search_item: ''
			}
		},
		methods: {
			faqSearch(){
				this.$emit('search-faq', this.search_item);
			}
		}
	}
</script>