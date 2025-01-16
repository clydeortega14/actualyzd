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
		},
		dialog(title, message, icon, cancelButtonText, confirmButtonText)
		{
			return Swal.fire({
				title: title,
				text: message,
				icon: icon,
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				cancelButtonText: cancelButtonText,
				confirmButtonText: confirmButtonText
			});
		}
	}
}