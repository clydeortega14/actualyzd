const state = () => ({

	clients: [],
	services: [],
	booking_by_statuses: [],
	total_firsttimers: 0,
	total_repeaters: 0,
	consultation_summaries: [],
	session_type_summaries: [],
	total_main_concerns: [],
	main_concern_summarries: [],
	concerns_lists: [],
	main_concerns_by_date: []

})

const getters = {

	allClients: state => state.clients,
	allServices: state => state.services,
	getBookingByStatus: state => state.booking_by_statuses,
	totalFirstTimers: state => state.total_firsttimers,
	totalRepeaters: state => state.total_repeaters,
	consultationSummaries: state => state.consultation_summaries,
	sessionTypeSummaries: state => state.session_type_summaries,
	totalMainConcerns: state => state.total_main_concerns,
	mainConcernSummarries: state => state.main_concern_summarries,
	concernsLists: state => state.concerns_lists,
	mainConcernsByDate: state => state.main_concerns_by_date,
}

const actions = {

	async serviceUtilization({ commit }, params){

		const response = await axios.get('/service/utilizations', params);
		commit('setClient', response.data.clients);
		commit('setService', response.data.services);
		commit('setBookingByStatus', response.data.bookings);
		commit('setTotalFirstTimers', response.data.users_experience['first_timers']);
		commit('totalRepeaters', response.data.users_experience['repeaters']);
		commit('setConsultationSummaries', response.data.consultation_summaries);
		commit('setSessionTypeSummaries', response.data.session_type_summaries);
		commit('setTotalMainConcerns', response.data.total_main_concerns);
		commit('setMainConcernSummarries', response.data.main_concerns_summarries);
		commit('setConcernsLists', response.data.list_of_main_concerns);
		commit('setMainConcernsByDate', response.data.main_concerns_by_date);
	}
}

const mutations = {

	setClient: (state, clients) => (state.clients = clients),
	setService: (state, services) => (state.services = services),
	setBookingByStatus: (state, booking_by_statuses) => (state.booking_by_statuses = booking_by_statuses),
	setTotalFirstTimers: (state, total_firsttimers) => (state.total_firsttimers = total_firsttimers),
	totalRepeaters: (state, total_repeaters) => (state.total_repeaters = total_repeaters),
	setConsultationSummaries: (state, consultation_summaries) => (state.consultation_summaries = consultation_summaries),
	setSessionTypeSummaries: (state, session_type_summaries) => (state.session_type_summaries = session_type_summaries),
	setTotalMainConcerns: (state, total_main_concerns) => (state.total_main_concerns = total_main_concerns),
	setMainConcernSummarries: (state, main_concern_summarries) => (state.main_concern_summarries = main_concern_summarries),
	setConcernsLists: (state, concerns_lists) => (state.concerns_lists = concerns_lists),
	setMainConcernsByDate: (state, main_concerns_by_date) => (state.main_concerns_by_date = main_concerns_by_date)
}

export default {

	state: state(),
	getters,
	actions,
	mutations
}