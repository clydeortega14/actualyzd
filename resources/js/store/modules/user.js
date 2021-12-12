const state = () => ({

	user_id: null,
	user_name: null,
	user_email: null
})

const getters = {

	getUserId: state => state.user_id,
	getUserName: state => state.user_name,
	getUserEmail: state => state.user_email
}

const actions = {

	//
}

const mutations = {

	setUserId: (state, user_id) => (state.user_id = user_id),
	setUserName: (state, user_name) => (state.user_name = user_name),
	setUserEmail: (state, user_email) => (state.user_email = user_email) 
}

export default {

	state: state(),
	getters,
	actions,
	mutations
}