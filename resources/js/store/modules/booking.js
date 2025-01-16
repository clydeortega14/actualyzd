const state = () => ({
    booking: {},
    bookings: [],
    booking_statuses: [],
    actions: [],
    selected_date: null,
    selected_time: null,
    selected_time_id: null,
    selected_psychologist_id: null,
    selected_psychologist: null,
    show_booking_review: false,
    booking_history: []
});

const getters = {
    getBooking: (state) => state.booking,
    allBookings: (state) => state.bookings,
    allBookingStatuses: (state) => state.booking_statuses,
    getActions: (state) => state.actions,
    getSelectedDate: (state) => state.selected_date,
    getSelectedTime: (state) => state.selected_time,
    getSelectedTimeId: (state) => state.selected_time_id,
    getSelectedPsychologistId: (state) => state.selected_psychologist_id,
    getSelectedPsychologist: (state) => state.selected_psychologist,
    showBookingReview: (state) => state.show_booking_review,
    getBookingHistory: (state) => state.booking_history
};

const actions = {
    storeBooking(payload) {
        return new Promise((resolve, reject) => {
            axios
                .post("/bookings/book", payload)
                .then((response) => {
                    console.log(response);
                    resolve(response);
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        });
    },
    /* Store Date, Time and Psychologist to session */
    storeDateTime({ context }, payload) {
        return new Promise((resolve, reject) => {
            axios
                .post("/bookings/store/date-time", payload)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },
    updateStatus({ context }, payload) {
        return new Promise((resolve, reject) => {
            axios
                .post(`/bookings/update-status/${payload.id}`, payload)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },
    async getAllBookings({ commit }, payload) {
        const response = await axios.get(`/bookings/get-all-bookings`, {
            params: payload,
        });

        commit("setAllBookings", response.data.data);
    },
    async getBookingStatuses({ commit }) {
        const response = await axios.get("/bookings/status-summary");

        let map_status = response.data.merged.map((status) => {
            return {
                class: status.to_status.class,
                id: status.to_status.id,
                name: status.to_status.name,
                total: status.status_count,
            };
        });

        commit("setBookingStatuses", map_status);
        commit("setActions", response.data.actions);
    },
    rescheduleBooking({ context }, payload) {
        return new Promise((resolve, reject) => {
            axios
                .post("/api/booking/reschedule", payload)
                .then((response) => resolve(response))
                .catch((error) => reject(error));
        });
    },

    async showBooking({ commit }, room_id) {
        const response = await axios.get(`/api/show/booking/${room_id}`);
        commit("setBooking", response.data.data);
    },

    async showBookingHistory({ commit }, payload) {
        const response = await axios.get(`/api/booking/history`, {
            params: payload
        });
        if(!response.data.error){
            commit("setBookingHistory", response.data.data);
        }
    }
};

const mutations = {
    setBooking: (state, booking) => (state.booking = booking),
    setAllBookings: (state, bookings) => (state.bookings = bookings),
    setBookingStatuses: (state, booking_statuses) =>
        (state.booking_statuses = booking_statuses),
    setActions: (state, actions) => (state.actions = actions),
    setSelectedDate: (state, date) => (state.selected_date = date),
    setSelectedTime: (state, time) => (state.selected_time = time),
    setSelectedTimeId: (state, selected_time_id) =>
        (state.selected_time_id = selected_time_id),
    setSelectedPsychologistId: (state, selected_psychologist_id) =>
        (state.selected_psychologist_id = selected_psychologist_id),
    setSelectedPsychologist: (state, psychologist) =>
        (state.selected_psychologist = psychologist),
    setShowBookingReview: (state, show_booking_review) =>
        (state.show_booking_review = show_booking_review),
    setBookingHistory: (state, booking_history) => (state.booking_history = booking_history)
};

export default {
    state: state(),
    getters,
    actions,
    mutations,
};
