<template>
	<div class="mb-3">
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6">
						<select class="custom-select">
							<option> > Select Session Type </option>
							<option>Individual</option>
							<option>Group</option>
							<option>Webinar</option>
						</select>
					</div>
					<div class="col-md-6">
						<select class="custom-select">
							<option> > Select Psychologist </option>
							
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<input type="text" name="search" class="form-control" placeholder="Search...">
			</div>
		</div>
	</div>
</template>


<script>
	
	export default {
		name: "FilSearchComponent"
	}
</script>