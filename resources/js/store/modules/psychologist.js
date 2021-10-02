const state = () => ({

	psychologists: []
})

const getters = {

	allPsychologists: state => state.psychologists
}

const actions = {

	async getPsychologists({ commit }, payload)
	{
		const response = await axios.get(`/psychologists-by-date-time`, {
			params: payload
		});
		commit('setPsychologists', response.data)
	}
}

const mutations = {

	setPsychologists: (state, psychologists) => (state.psychologists = psychologists)
}


export default {

	state: state(),
	getters,
	actions,
	mutations
}
