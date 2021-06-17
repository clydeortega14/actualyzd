const state = () => ({
	assignees: []
}) 

const getters = {
	allAssignees: state => state.assignees
}

const actions = {
	async getAssignees({commit}){
		const response = await axios.get('progress-reports/assignees');
		commit('setAssignees', response.data)
	},

	assignReport({commit}, data){
		return new Promise((resolve, reject) => {

			axios.post(`progress-reports/assign-report/${data.id}`, data)
				.then(response => {
					resolve(response)
				})
				.catch(error => {
					reject(error)
				})

		});
	}
}

const mutations = {
	setAssignees: (state, assignees) => ( state.assignees = assignees )
}

export default {
	state: state(),
	getters,
	actions,
	mutations
}