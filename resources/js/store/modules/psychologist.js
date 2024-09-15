const state = () => ({
    psychologists: [],
});

const getters = {
    allPsychologists: (state) => state.psychologists,
};

const actions = {
    async getPsychologists({ commit }, payload) {
        const response = await axios.get(`/psychologists-by-date-time`, {
            params: payload,
        });

        commit("setPsychologists", response.data);
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
