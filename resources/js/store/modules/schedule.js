const state = () => ({

	schedules: [],
	time_lists: [],
	time_by_date: []
})

const getters = {

	getSchedules: (state) => state.schedules,
	getTimeLists: state => state.time_lists,
	getTimeByDate: state => state.time_by_date
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
	},
	timeByDate({ commit }, payload){

		return new Promise((resolve, reject) => {

			axios.get('/time-by-date', {
				params: payload
			})
			.then(response => {
				
				resolve(response)
			})
			.catch(error => {
				reject(error)
			})
		})
	}

}
const mutations = {

	commitSchedules: (state, schedules) => (state.schedules = schedules),
	setTimeLists: (state, time_lists) => (state.time_lists = time_lists),
	setTimeByDate: (state, time_by_date) => ( state.time_by_date = time_by_date)
}


export default {
	state: state(),
	getters,
	actions,
	mutations
}