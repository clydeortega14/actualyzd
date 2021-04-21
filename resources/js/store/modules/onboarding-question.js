const state = () => ({

	questions: []
})


const getters = {

	allQuestions: state => state.questions
}

const actions = {

	async getQuestions({ commit })
	{
		const response = await axios.get('/onboarding-questions');
		commit('setQuestions', response.data)
	}
}

const mutations = {

	setQuestions: (state, questions) => (state.questions = questions)

}


export default {

	state: state(),
	getters,
	actions,
	mutations
}