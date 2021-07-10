<style scoped>
	.assignee {
		font-size: 15px;
	}
</style>
<template>
	<div>
	 <div class="row mb-4">
            <div class="col-md-12">
                  	<div class="assignee" v-if="!choose_assignee">
                        Assignee: <a href="#" @click.prevent="choose_assignee = true">{{ checkAssignee }}</a>
                  	</div>
	                <div class="form-group row" v-else>
	                      <div class="col-md-8">
	                            <div class="input-group mb-3">
	                                  <select name="assignee" id="" class="form-control" v-model="selected">
	                                        <option value="" disabled>Choose Assignee</option>
	                                        <option v-for="option in allAssignees" :value="{id:option.id, name: option.name }" :key="option.id" :selected="selected">{{ option.name }}</option>
	                                  </select>
	                                  <div class="input-group-append">
	                                        <button class="btn btn-primary" type="button" id="button-addon2" @click.prevent="assigned">
	                                              <i class="fa fa-check"></i>
	                                        </button>
	                                        <button class="btn btn-secondary" type="button" id="cancel-assignee" @click.prevent="choose_assignee = false">
	                                              <i class="fa fa-times"></i>
	                                        </button>
	                                  </div>
	                            </div>
	                      </div>
	                </div>
            </div>
      </div>
	</div>
</template>

<script>
	import { mapGetters, mapActions } from 'vuex';

	export default {
		data(){
			return {
				choose_assignee: false,
				selected: '',
				options: []
			}
		},
		created(){
			this.getAssignees();
			this.selected = this.reportAssignee;
		},
		props: ["reportId", "reportAssignee"],
		computed: {

			...mapGetters(["allAssignees"]),
			checkAssignee()
			{
				return this.selected = this.selected === "" ? 'No Assignee' : this.selected;
			}
		},
		methods: {
			...mapActions(["getAssignees", "assignReport"]),
			assigned(){			
				this.assignReport({
					id: this.reportId,
					assignee: this.selected.id
				}).then(response => {
					if(response.data.success){
						this.choose_assignee = false;
						this.selected = this.selected.name;
					}
				}).catch(error => {
					console.log(error)
				})
			},

		}
	}
</script>