const state = () => ({

	booking: {}

});

const getters = {

	getBooking: state => state.booking
}

const actions = {

	storeBooking(payload)
	{
		return new Promise((resolve, reject) => {

			axios.post('/bookings/book', payload)
				.then(response => {

					console.log(response)
					resolve(response)
				})
				.catch(error => {

					console.log(error);
					reject(error)
				})

		});
		// const book_now = await axios.post('/bookings/book', payload);
	},
	updateStatus({context}, payload){
		
		return new Promise((resolve, reject) => {
			axios.post(`/bookings/update-status/${payload.id}`, payload)
				.then(response => {
					resolve(response);
				}).catch(error => {
					reject(error)
				})
		});
	}
}

const mutations = {

	setBooking: (state, booking) => (state.booking = booking)
}


export default {

	state: state(),
	getters,
	actions,
	mutations
}