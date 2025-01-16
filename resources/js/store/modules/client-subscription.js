const state = () => ({
	id: null,
	client_id: null,
	reference_no: null,
	completion_date: null,
	subscription_status_id: null,
	subscriptions: [],
	package_id: null,
	package_name: null,
	package_services: [],
	bookings: []
})

const getters = {
	getId: state => state.id,
	getClientID: state => state.client_id,
	getReferenceNo: state => state.reference_no,
	getCompletionDate: state => state.completion_date,
	getSubscriptionStatusId: state => state.subscription_status_id,
	getSubscriptions: state => state.subscriptions,
	getPackageId: state => state.package_id,
	getPackageName: state => state.package_name,
	getPackageServices: state => state.package_services,
	getBookings: state => state.bookings

}

const actions = {
	async getSubscriptionsData({commit}, data){

		const response = await axios.post(`/api/client/subscriptions`, data);
		
		
		commit('setSubscriptions', response.data.data);
	},

	async getSubscriptionBookings({ commit }, data){
		const response = await axios.post(`/api/client/subscriptions`, data);
		console.log(response.data.data)
		commit('setBookings', response.data.data.bookings);
	},

	updateClientSubscription({context}, data)
	{
		return new Promise((resolve, reject) => {
			axios
				.post('/api/update/client/subscription', data)
				.then((response) => resolve(response))
				.catch((error) => reject(error))
		});
	}
}

const mutations = {
	setId: (state, id) => (state.id = id),
	setClientID: (state, client_id) => (state.client_id = client_id),
	setReferenceNo: (state, reference_no) => (state.reference_no = reference_no),
	setCompletionDate: ( state, completion_date) => (state.completion_date = completion_date),
	setSubscriptionStatusId: (state, subscription_status_id) => (state.subscription_status_id = subscription_status_id),
	setSubscriptions: (state, subscriptions) => (state.subscriptions = subscriptions),
	setPackageId: (state, package_id) => (state.package_id = package_id),
	setPackageName: (state, package_name) => (state.package_name = package_name),
	setPackageServices: (state, package_services) => (state.package_services = package_services),
	setBookings: (state, bookings) => (state.bookings = bookings)
}

export default {

	state: state(),
	getters,
	actions,
	mutations
}