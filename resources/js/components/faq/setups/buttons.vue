<template>
	<div class="d-flex justify-content-end">
		<div>
			<button type="submit" class="btn btn-primary mr-2">
				<i class="fa fa-check"></i>
				<span>Submit</span>
			</button>

			<button type="button" class="btn btn-secondary">
				<i class="fa fa-times"></i>
				<span>Cancel</span>
			</button>
		</div>
		
	</div>
</template>


<script>


	import Swal from 'sweetalert2';
	

	export default {

		name: "Buttons",
		methods: {

			submitNewStep(){

				Swal.fire('Success!', 'FAQ Successfully Created!', 'success');
			}
		}
	}
</script>