const state = () => ({

	faq_steps: []
})

const getters = {

	getFaqSteps: state => state.faq_steps
}

const actions = {

	// 
}

const mutations = {

	setFaqSteps: (state, faq_steps) => (state.faq_steps = faq_steps)
}


export default {

	stage: state(),
	getters,
	actions,
	mutations
}