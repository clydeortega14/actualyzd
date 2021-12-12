<template>
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

					this.show_reason = true;
				}
			});

			EventBus.$on('select-time', data => {

				if(this.show_reason){

					this.show_reason = false;
					this.$store.commit('setSelectedReasonID', null);
					this.$store.commit('setSelectedReasonName', null);
					this.selected_reason = null;
				}
			})
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

				this.show_textarea = value.id === 5 ? true : false

				this.others_specify = (value.id !== 5 || value.name !== "Others") ? value.name : "";

				this.$store.commit('setSelectedReasonID', value.id);
				this.$store.commit('setSelectedReasonName', value.name);

				EventBus.$emit('select-a-reason', { 'reason': value, 'others_specify': this.others_specify });
			},
			others_specify(value){

				EventBus.$emit('enable-save-button', value)
				
				this.$store.commit('setSelectedReasonName', value)
			}
		}
	}
</script>