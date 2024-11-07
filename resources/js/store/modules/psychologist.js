const state = () => ({
    psychologists: [],
});

const getters = {
    allPsychologists: (state) => state.psychologists,
};

const actions = {
    async getPsychologists({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios
                .get('/psychologists-by-date-time', {
                    params:payload
                })
                .then((response) => resolve(response))
                .catch((error) => reject(error))
        });
    },

    reassignSession({ context }, payload) {
        return new Promise((resolve, reject) => {
            axios
                .post("/api/reassign/session", payload)
                .then((res) => {
                    resolve(res);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    async getPsychLists({ commit })
    {
        const response = await axios.get('/api/psychologists/lists');
        commit("setPsychologists", response.data);
    }
};

const mutations = {
    setPsychologists: (state, psychologists) =>
        (state.psychologists = psychologists),
};

export default {
    state: state(),
    getters,
    actions,
    mutations,
};
