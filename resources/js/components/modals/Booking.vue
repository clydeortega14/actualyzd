<template>
	<div>
		<transition name="modal">
			<div class="modal-mask">
				<div class="modal-wrapper">
					<div class="modal-container">
						<div class="modal-header">
							<slot name="header">
								Header
							</slot>	
						</div>
					</div>
				</div>
			</div>
		</transition>
	</div>
</template>

<script>
	

	export default {

		name: "TimeSchedule"
	}
</script>