class SweetAlert {

	success(message){

		return Swal.fire('Success', message, 'success')
	}


	error(){

		return Swal.fire({

	      icon: 'error',
	      title: 'Oops...',
	      text: 'Something went wrong!',
	    })
	}

	confirmDialog(){

		return	Swal.fire({

		  title: 'Are you sure?',
		  text: "Please confirm",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Confirm'

		})
	}
}