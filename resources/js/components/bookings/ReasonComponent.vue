<template>
	
	<div>
		<div class="mt-3" v-if="show_reason">

			<h5 class="card-title mb-3 border-bottom">Reason</h5>

			<div class="custom-control custom-radio mb-3 ml-3" v-for="(reason, index) in allReasons" :key="index">
				<input type="radio" class="custom-control-input" 
					:id="`reason-${reason.id}`"
					:value="{ id: reason.id, name: reason.option_name }"
					v-model="selected_reason">

				<label class="custom-control-label" :for="`reason-${reason.id}`">{{ reason.option_name }}</label>
			</div>

			<div class="ml-3 mb-3" v-if="show_textarea">
				<textarea class="form-control" placeholder="Please state reason" v-model="others_specify"></textarea>
			</div>
		</div>
		<div v-if="allReasons.length <= 0">
			<p class="text-danger text-center p-4">List of reasons not provided, please contact system administrator!</p>
		</div>
	</div>
</template>

<script>
	
	import { mapGetters, mapActions } from 'vuex';


	export default {

		name: "ReasonComponent",
		data(){

			return {

				selected_reason: null,
				show_reason: false,
				show_textarea: false,
				others_specify: "",
			}
		},
		mounted(){

			EventBus.$on('select-psychologist', data => {

				if(!_.isNil(data)){

					if(this.allReasons.length > 0){
						this.show_reason = true;
						this.show_textarea = true;
					}

					
				}
			});

			EventBus.$on('select-time', data => {

				if(this.show_reason){

					this.show_reason = false;
					this.$store.commit('setSelectedReasonID', null);
					this.$store.commit('setSelectedReasonName', null);
					this.selected_reason = null;
				}
			});

			EventBus.$on('on-rescheduled-success', data => {
				this.show_reason = false;
				this.selected_reason = null;
			});
		},
		created(){

			this.getReasons();
		},
		computed: {

			...mapGetters(["allReasons"])
		},
		methods: {

			...mapActions(["getReasons"])
		},
		watch: {

			selected_reason(value){

				if(!_.isNil(value)){
					let check_value_name = value.name === "Others" || value.name === "others"

					this.show_textarea = check_value_name ? true : false

					this.others_specify = !check_value_name ? value.name : "";

					this.$store.commit('setSelectedReasonID', value.id);
					
					this.$store.commit('setSelectedReasonName', value.name);

					EventBus.$emit('select-a-reason', { 'reason': value, 'others_specify': this.others_specify });

				}
				
				
			},
			others_specify(value){

				EventBus.$emit('enable-save-button', value)
				
				this.$store.commit('setSelectedReasonName', value)
			}
		}
	}
</script>