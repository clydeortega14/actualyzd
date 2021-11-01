const state = () => ({

	reasons: [],
	selected_reason_id: null,
	selected_reason_name: null,
})

const getters = {

	allReasons: state => state.reasons,
	getSelectedReasonID: state => state.selected_reason_id,
	getSelectedReasonName: state => state.selected_reason_name
}

const actions = {

	async getReasons({ commit }){

		const response = await axios.get('/api/get-reasons-lists');

		commit('setReasons', response.data)
	}
}

const mutations = {

	setReasons: (state, reasons) => (state.reasons = reasons),
	setSelectedReasonID: (state, selected_reason_id) => (state.selected_reason_id = selected_reason_id),
	setSelectedReasonName: (state, selected_reason_name) => (state.selected_reason_name = selected_reason_name)
}

export default {

	state: state(),
	getters,
	actions,
	mutations
}