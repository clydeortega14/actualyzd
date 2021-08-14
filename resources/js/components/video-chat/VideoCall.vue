<template>
	<div>
		<div class="card mb-3 h-100 py-4">
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<div class="card" style="width:18 rem;">
							<ul class="list-group list-group-flush">
								<li class="list-group-item">
									<div class="row justify-content-center align-items-center">
										<img src="/images/user.png" width="150" height="150">
									</div>
									<div class="row mt-3 justify-content-center align-items-center">
										( Antinio Bandera )
									</div>
								</li>
								<li class="list-group-item">
									<div class="row justify-content-center align-items-center">
										<img src="/images/user.png" width="150" height="150">
									</div>
									<div class="row mt-3 justify-content-center align-items-center">
										( Miguel Cotto )
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-8">
						<div class="row justify-content-center align-items-center">
							<img src="/images/user.png" width="275" height="275">
						</div>
						<div class="row justify-content-center align-items-center mt-3">
							<p class="card-text">( Clyde Ortega )</p>
						</div>
						<div class="row justify-content-center mt-4">
							<div class="btn-group" role="group" aria-label="Call Actions">
								<button class="btn btn-primary">Mute</button>
								<button class="btn btn-info">Show Camera</button>
								<button class="btn btn-danger">Leave Call</button>
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
		name: "VideoCall",
		mounted(){

			console.log('video call component')

			Echo.private('video-call.61174d6b7be18')
				.listen('VideoCallEvent', (e) => {

					console.log(e)
				})
		}
	}
</script>