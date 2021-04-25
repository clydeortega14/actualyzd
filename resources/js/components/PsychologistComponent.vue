<template>
	<div class="card mb-3 mt-3">
		<div class="card-header">
			Psychologist
		</div>

		<div class="card-body">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" v-for="(psychologist, index) in psychologist_available" :key="index">
		            <div class="card mb-3 text-center"> 
		                <img src="/sb-admin/img/undraw_profile.svg" alt="Psychologist Image" width="80" height="80" class="mx-auto d-block pt-3">
		                <div class="card-body">
		                    <h5 class="card-title">{{ psychologist.name }}</h5>
		                    <div class="form-check">
		                        <input type="radio" name="psychologist" @change="selectPsychologist(psychologist.id)">
		                    </div>
		                </div>
		            </div>
		        </div>
	        </div>
		</div>
	</div>
</template>


<script>
	
	export default {
		
		props: {

			psychologist_available: Array
		},
		methods: {
			selectPsychologist(id)
			{
				this.$emit('selected-psychologist', id);
			}
		}

	}
</script>