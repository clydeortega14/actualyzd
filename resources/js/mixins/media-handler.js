export default {

	methods: {

		getPermissions(){

			navigator.mediaDevices.getUserMedia =
	        navigator.mediaDevices.getUserMedia ||
	        navigator.webkitGetUserMedia ||
	        navigator.mozGetUserMedia;

			return new Promise((resolve, reject) => {
				navigator.mediaDevices.getUserMedia({ video: false, audio: true })
				.then((stream) => {
					resolve(stream)
				})
				.catch(error => {
					throw new Error(`Unable to fetch stream ${error }`)
				})
			})
		}
	}
}