const state = () => ({

	clients: [],
	client_users: []
});


const getters = {
	getAllClients: state => state.clients,
	allClientUsers: state => state.client_users
}

const actions = {
	async getClients({ commit }){

		const response = await axios.get('/clients-with-users');
		commit('setClients', response.data)
	},
	async getClientUsers({ commit }, id){

		const response = await axios.get(`/client-users/${id}`);
		commit('setClientUsers', response.data);
	}
}

const mutations = {
	setClients: (state, clients) => (state.clients = clients),
	setClientUsers: (state, client_users) => (state.client_users = client_users)
}

export default {

	state: state(),
	getters,
	actions,
	mutations
}