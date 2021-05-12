const state = () => ({

	clients: [],

	services: [],

})

const getters = {

	allClients: state => state.clients,

	allServices: state => state.services
}

const actions = {

	async getClients({ commit }){

		const response = await axios.get('/service/utilizations');
		commit('setClient', response.data.clients)
	},
	async getServices({ commit }){

		const response = await axios.get('/service/utilizations');
		commit('setService', response.data.services); 
	},
	async clientServices({ commit }, id){
		const response = await axios.get(`/service/utilization/${id}`);
		commit('setService', response.data);
	}
}

const mutations = {

	setClient: (state, clients) => (state.clients = clients),

	setService: (state, services) => (state.services = services)
}

export default {

	state: state(),
	getters,
	actions,
	mutations
}