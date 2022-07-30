const state = () => ({


	faqs: [],
	faq_steps: []
})

const getters = {

	getAllFaqs: state => state.faqs,
	getFaqSteps: state => state.faq_steps
}

const actions = {

	async allFaqs({commit}){

		const response = await axios.get('/FAQs/get/faqs');
		commit('setFaqs', response.data)
		// console.log(response)
	},

	async allFaqSteps({ commit }, faq_id){

		const response = await axios.get(`/FAQs/get/faq/steps/${faq_id}`);
		commit('setFaqSteps', response);
	}
}

const mutations = {

	setFaqSteps: (state, faq_steps) => (state.faq_steps = faq_steps),
	setFaqs: (state, faqs) => (state.faqs = faqs)
}


export default {

	stage: state(),
	getters,
	actions,
	mutations
}