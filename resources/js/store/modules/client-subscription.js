const state = () => ({

	subscriptions: [],
	package_id: null,
	package_name: null,
	package_services: []
})

const getters = {
	getSubscriptions: state => state.subscriptions,
	getPackageId: state => state.package_id,
	getPackageName: state => state.package_name,
	getPackageServices: state => state.package_services

}

const actions = {
	async getSubscriptionsData({commit}, data){

		const response = await axios.post(`/api/client/subscriptions`, data);
		commit('setSubscriptions', response.data.data);
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
	setSubscriptions: (state, subscriptions) => (state.subscriptions = subscriptions),
	setPackageId: (state, package_id) => (state.package_id = package_id),
	setPackageName: (state, package_name) => (state.package_name = package_name),
	setPackageServices: (state, package_services) => (state.package_services = package_services)
}

export default {

	state: state(),
	getters,
	actions,
	mutations
}