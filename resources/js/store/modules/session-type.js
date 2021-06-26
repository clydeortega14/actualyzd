const state = () => ({

	session_types: [],
})

const getters = {
	allSessionTypes: state => state.session_types
}

const actions = {

	async getSessionTypes({ commit }){

		const response = await axios.get('/session-types');
		commit('setSessionTypes', response.data)
	}
}

const mutations = {
	setSessionTypes: (state, session_types) => (state.session_types = session_types)
}

export default {
	state: state(),
	getters,
	actions,
	mutations
}