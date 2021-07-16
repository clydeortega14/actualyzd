const state = () => ({

	booking: {},
	bookings: [],
	booking_statuses: [],
	actions: []

});

const getters = {

	getBooking: state => state.booking,
	allBookings: state => state.bookings,
	allBookingStatuses: state => state.booking_statuses,
	getActions: state => state.actions,
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
	},
	async getAllBookings({ commit }, payload)
	{
		const response = await axios.get(`/bookings/get-all-bookings`, {
			params: payload
		});
		commit('setAllBookings', response.data);
		
	},
	async getBookingStatuses({ commit })
	{
		const response = await axios.get('/bookings/status-summary');
		commit('setBookingStatuses', response.data.by_status_with_total);
		commit('setActions', response.data.actions)
	}
}

const mutations = {

	setBooking: (state, booking) => (state.booking = booking),
	setAllBookings: (state, bookings) => (state.bookings = bookings),
	setBookingStatuses: (state, booking_statuses) => (state.booking_statuses = booking_statuses),
	setActions: (state, actions) => (state.actions = actions),
}


export default {

	state: state(),
	getters,
	actions,
	mutations
}