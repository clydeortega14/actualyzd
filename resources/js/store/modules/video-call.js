const state = () => ({

	other_users: []
})

const getters = {

	getOtherUsers: state => state.other_users
}

const actions = {

	//
}

const mutations = {

	allUsers: (state, users) => (state.other_users = users),
	setOtherUsers: (state, user) => (state.other_users.push(user)),
	userLeave: (state, user) => {

		const index = state.other_users.indexOf(user);

		if(index > -1){
			console.log('found and leave')
			return state.other_users.splice(index, 1);
		}
	},
}


export default {

	state: state(),
	getters,
	actions,
	mutations
}