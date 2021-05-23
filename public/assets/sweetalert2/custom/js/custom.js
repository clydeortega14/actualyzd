class SweetAlert {

	success(message){

		return Swal.fire('Success', message, 'success')
	}


	error(){

		return Swal.fire({

	      icon: 'error',
	      title: 'Oops...',
	      text: 'Interal Server Error!',
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

	confirmDialog2(title) {
		return Swal.fire({
			title: title,
			text: "Confirm to delete",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Confirm'
		});
	}

	cancel(text) {

		return Swal.fire({
	      icon: 'error',
	      title: 'Cancelled',
	      text: text,
	    })
	}
}