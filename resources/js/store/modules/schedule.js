const state = () => ({

	schedules: []
})

const getters = {

	getSchedules: (state) => state.schedules
}
const actions = {

	async getAllSchedules({ commit })
	{

		const response = await axios.get('/psychologist/schedules');

		let mappedSchedules = response.data.map(schedule => {

			return {

				id: schedule.id,
				start: schedule.start,
				end: schedule.end,
				display: 'background',
				color: 'green'
			}
		})
	}
}
const mutations = {

	commitSchedules: (state, schedules) => (state.schedules = schedules)
}


export default {
	state: state(),
	getters,
	actions,
	mutations
}