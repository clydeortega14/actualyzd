const state = () => ({

	schedules: [],
	time_lists: [],
})

const getters = {

	getSchedules: (state) => state.schedules,

	getTimeLists: state => state.time_lists
}
const actions = {

	async getAllSchedules({ commit })
	{
		const response = await axios.get('/psychologist/schedules');
	},
	async timeLists({ commit }, schedule_id)
	{
		const response = await axios.get(`/time-by-schedule/${schedule_id}`);
		commit('setTimeLists', response.data);
	}

}
const mutations = {

	commitSchedules: (state, schedules) => (state.schedules = schedules),
	setTimeLists: (state, time_lists) => (state.time_lists = time_lists)
}


export default {
	state: state(),
	getters,
	actions,
	mutations
}