<template>
	<div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="has_prescription" id="yes" value="1" v-model="selected" :disabled="checkDisabled">
			<label class="form-check-label" for="yes">Yes</label>
		</div>
		<div v-if="hasMedication">
			<div class="form-group">
				<textarea type="text" name="medication" class="form-control" placeholder="Please specify current medications that the client is taking" :readonly="checkDisabled">{{ medication }}</textarea>
			</div>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="has_prescription" id="no" value="0" v-model="selected" :disabled="checkDisabled">
			<label class="form-check-label" for="no">No</label>
		</div>
	</div>
</template>

<script>
	export default {

		data(){

			return {

				selected: '',
				hasMedication: false,
				disabled: false
			}
		},
		created(){
			// this.selected = this.hasPrescription === "1" ? "1" : "0" || this.hasPrescription === '' ? '' : this.hasPrescription;
			this.selected =  this.hasPrescription;
			console.log([this.selected, this.hasPrescription])
		},
		computed: {
			checkRole(){
				return this.userRole === 'psychologist' || this.assignee === this.userId ? false : true
			},
			checkDisabled(){
				return this.disabled = this.readOnly === "" ? false : true;  
			}
		},
		props: {
			hasPrescription: String,
			medication: String,
			userRole: String,
			userId: String,
			assignee: String,
			readOnly: String
		},
		watch: {

			selected(value){
				this.hasMedication = value === "1" || value === true ? true : false;
			}
		}
	}
</script>