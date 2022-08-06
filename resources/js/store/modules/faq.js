const state = () => ({


	faqs: [],
	faq_steps: [],
	question: null,
	description: null
})

const getters = {

	getAllFaqs: state => state.faqs,
	getFaqSteps: state => state.faq_steps,
	getQuestion: state => state.question,
	getDesc: state => state.description
}

const actions = {

	allFaqs({commit}){

		return new Promise((resolve, reject) => {

			axios.get('/FAQs/get/faqs').then(response => resolve(response)).catch(error => reject(error));
		});
	},

	async allFaqSteps({ commit }, faq_id){

		const response = await axios.get(`/FAQs/get/faq/steps/${faq_id}`);
		commit('setFaqSteps', response.data);
	}
}

const mutations = {

	setFaqSteps: (state, faq_steps) => (state.faq_steps = faq_steps),
	setFaqs: (state, faqs) => (state.faqs = faqs),
	setQuestion: (state, question) => (state.question = question),
	setDesc: (state, desc) => (state.description = desc)
}


export default {

	stage: state(),
	getters,
	actions,
	mutations
}