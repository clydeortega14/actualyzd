const state = () => ({

	clients: [],
	services: [],
	booking_by_statuses: [],
	consultation_summaries: [],
	session_type_summaries: [],
	total_main_concerns: [],
	main_concern_summarries: [],
	concerns_lists: [],

})

const getters = {

	allClients: state => state.clients,
	allServices: state => state.services,
	getBookingByStatus: state => state.booking_by_statuses,
	consultationSummaries: state => state.consultation_summaries,
	sessionTypeSummaries: state => state.session_type_summaries,
	totalMainConcerns: state => state.total_main_concerns,
	mainConcernSummarries: state => state.main_concern_summarries,
	concernsLists: state => state.concerns_lists,
}

const actions = {


	async serviceUtilization({ commit }, params){

		const response = await axios.get('/service/utilizations', params);
		commit('setClient', response.data.clients);
		commit('setService', response.data.services);
		commit('setBookingByStatus', response.data.bookings);
		commit('setConsultationSummaries', response.data.consultation_summaries);
		commit('setSessionTypeSummaries', response.data.session_type_summaries);
		commit('setTotalMainConcerns', response.data.total_main_concerns);
		commit('setMainConcernSummarries', response.data.main_concerns_summarries);
		commit('setConcernsLists', response.data.list_of_main_concerns);
	}
}

const mutations = {

	setClient: (state, clients) => (state.clients = clients),
	setService: (state, services) => (state.services = services),
	setBookingByStatus: (state, booking_by_statuses) => (state.booking_by_statuses = booking_by_statuses),
	setConsultationSummaries: (state, consultation_summaries) => (state.consultation_summaries = consultation_summaries),
	setSessionTypeSummaries: (state, session_type_summaries) => (state.session_type_summaries = session_type_summaries),
	setTotalMainConcerns: (state, total_main_concerns) => (state.total_main_concerns = total_main_concerns),
	setMainConcernSummarries: (state, main_concern_summarries) => (state.main_concern_summarries = main_concern_summarries),
	setConcernsLists: (state, concerns_lists) => (state.concerns_lists = concerns_lists),
}

export default {

	state: state(),
	getters,
	actions,
	mutations
}