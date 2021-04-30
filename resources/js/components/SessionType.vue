<template>
	<div class="card mb-3">
		<div class="card-header">
			Session Types
		</div>

		<div class="card-body">
			<div class="form-group">
				<label for="session_type_id">Session Type</label>
				<select class="form-control">
					<option value="individual">Individual</option>
					<option value="group-session">Group Session</option>
					<option value="webinar">Webinar</option>
				</select>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		mounted(){
			console.log('session type')
		}
	}
</script>