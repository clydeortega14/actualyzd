const state = () => ({

	clients: [],
	services: [],
	booking_by_statuses: [],
	consultation_summaries: [],
	session_type_summaries: []

})

const getters = {

	allClients: state => state.clients,
	allServices: state => state.services,
	getBookingByStatus: state => state.booking_by_statuses,
	consultationSummaries: state => state.consultation_summaries,
	sessionTypeSummaries: state => state.session_type_summaries
}

const actions = {


	async serviceUtilization({ commit }, params){

		const response = await axios.get('/service/utilizations', params);
		commit('setClient', response.data.clients);
		commit('setService', response.data.services);
		commit('setBookingByStatus', response.data.bookings);
		commit('setConsultationSummaries', response.data.consultation_summaries);
		commit('setSessionTypeSummaries', response.data.session_type_summaries);
	}
}

const mutations = {

	setClient: (state, clients) => (state.clients = clients),
	setService: (state, services) => (state.services = services),
	setBookingByStatus: (state, booking_by_statuses) => (state.booking_by_statuses = booking_by_statuses),
	setConsultationSummaries: (state, consultation_summaries) => (state.consultation_summaries = consultation_summaries),
	setSessionTypeSummaries: (state, session_type_summaries) => (state.session_type_summaries = session_type_summaries)
}

export default {

	state: state(),
	getters,
	actions,
	mutations
}