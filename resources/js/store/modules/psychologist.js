const state = () => ({

	psychologists: []
})

const getters = {

	getAvailable: state => state.psychologists
}

const actions = {

	async availablePsychologist({ commit }, time)
	{
		const response = await axios.get(`/psychologist/available/${time}`);
		commit('setPsychologist', response.data)
	}
}

const mutations = {

	setPsychologist: (state, psychologists) => (state.psychologists = psychologists)
}


export default {

	state: state(),
	getters,
	actions,
	mutations
}
