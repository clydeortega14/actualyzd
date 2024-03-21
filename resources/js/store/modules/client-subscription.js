const state = () => ({

	subscriptions: []
})

const getters = {
	getSubscriptions: state => state.subscriptions
}

const actions = {
	async getSubscriptionsData({commit}, data){

		const response = await axios.post(`/api/client/subscriptions`, data);
		commit('setSubscriptions', response.data.data);
	}
}

const mutations = {
	setSubscriptions: (state, subscriptions) => (state.subscriptions = subscriptions)
}

export default {

	state: state(),
	getters,
	actions,
	mutations
}