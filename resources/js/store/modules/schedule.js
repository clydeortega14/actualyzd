const state = () => ({
    schedules: [],
    time_lists: [],
    time_by_date: [],
    scheduled_sessions: [],
});

const getters = {
    getSchedules: (state) => state.schedules,
    getTimeLists: (state) => state.time_lists,
    getTimeByDate: (state) => state.time_by_date,
    getScheduledSessions: (state) => state.scheduled_sessions,
};
const actions = {
    async getAllSchedules({ commit }) {
        const response = await axios.get("/psychologist/schedules");
    },
    async timeLists({ commit }, schedule_id) {
        const response = await axios.get(`/time-by-schedule/${schedule_id}`);
        commit("setTimeLists", response.data);
    },
    timeByDate({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios
                .get("/time-by-date", {
                    params: payload,
                })
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },
    async RequestScheduledSessions({ commit }, payload) {
        const response = await axios.get("/api/scheduled/sessions", {
            params: payload,
        });
        console.log(response.data);
        commit("setScheduledSessions", response.data);
    },
};
const mutations = {
    commitSchedules: (state, schedules) => (state.schedules = schedules),
    setTimeLists: (state, time_lists) => (state.time_lists = time_lists),
    setTimeByDate: (state, time_by_date) => (state.time_by_date = time_by_date),
    setScheduledSessions: (state, scheduled_sessions) =>
        (state.scheduled_sessions = scheduled_sessions),
};

export default {
    state: state(),
    getters,
    actions,
    mutations,
};
