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

	setOtherUsers: (state, user) => (state.other_users.push(user))
}


export default {

	state: state(),
	getters,
	actions,
	mutations
}