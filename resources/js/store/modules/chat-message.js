const state = () => ({

	messages: []

});

const getters = {

	allMessages: state => state.messages
}

const actions = {

	async getMessages({ commit }, room_id){

		const response = await axios.get(`/api/chat-messages/${room_id}`);

		commit('setMessage', response.data.data)
	},

	newMessage({ context }, payload){

		return new Promise((resolve, reject) => {

			axios.post('/api/chat-message', payload)
				.then(response => {
					resolve(response)
				}).catch(error => {
					console.log(error)
					reject(error)
				})
		});
	}
}

const mutations = {

	setMessage: (state, messages) => (state.messages = messages),
	storeMessage: (state, message) => (state.messages.push(message))
}


export default {

	state: state(),
	getters,
	actions,
	mutations
}