<template>
	<div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="has_prescription" id="yes" :value="true" v-model="selected">
			<label class="form-check-label" for="yes">Yes</label>
		</div>
		<div v-if="hasMedication">
			<div class="form-group">
				<textarea type="text" name="medication" class="form-control" placeholder="Please specify current medications that the client is taking">{{ medication }}</textarea>
			</div>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="has_prescription" id="no" :value="false" v-model="selected">
			<label class="form-check-label" for="no">No</label>
		</div>
	</div>
</template>

<script>
	export default {

		data(){

			return {

				selected: '',
				hasMedication: false
			}
		},
		created(){
			this.selected = this.hasPrescription === "1" ? true : false || this.hasPrescription === '' ? '' : this.hasPrescription;
		},
		props: {
			hasPrescription: String,
			medication: String
		},
		watch: {

			selected(value){

				this.hasMedication = value;
			}
		}
	}
</script>