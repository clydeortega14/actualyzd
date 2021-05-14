const state = () => ({

	clients: [],
	services: [],
	booking_by_statuses: []

})

const getters = {

	allClients: state => state.clients,
	allServices: state => state.services,
	getBookingByStatus: state => state.booking_by_statuses
}

const actions = {


	async serviceUtilization({ commit }, params){

		const response = await axios.get('/service/utilizations', params);
		commit('setClient', response.data.clients);
		commit('setService', response.data.services);
		commit('setBookingByStatus', response.data.bookings);
	}
}

const mutations = {

	setClient: (state, clients) => (state.clients = clients),
	setService: (state, services) => (state.services = services),
	setBookingByStatus: (state, booking_by_statuses) => (state.booking_by_statuses = booking_by_statuses)
}

export default {

	state: state(),
	getters,
	actions,
	mutations
}