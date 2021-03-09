const sweet_alert = new SweetAlert;

class Ajax {

	constructor(){
		$.ajaxSetup({

			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		})
	}

	request(config)
	{
		return $.ajax({

			url: config.url,
			method: config.method,
			data: config.data,
			
		}).fail(error=>{

			sweet_alert.error()

		})
	}

	asyncAwait(config){
		return $.ajax({
			url: config.url,
			method: config.method,
			data: config.data,
			async: config.async
		}).fail(error => console.log(error));
	}
}