import Swal from 'sweetalert2'

export default {

	methods: {

		success(message){

			Swal.fire({
			  position: 'center',
			  icon: 'success',
			  title: message,
			  showConfirmButton: false,
			  timer: 1500
			})
		},
		error(text){
			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: text
			})
		}
	}
}