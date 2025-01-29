import axios from "axios";

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

    storePsychologist({ context }, params){

        const form_data = new FormData();
        form_data.append('role_name', params.role_name);
        form_data.append('firstname', params.firstname);
        form_data.append('lastname', params.lastname);
        form_data.append('email', params.email);
        form_data.append('password', params.password);
        form_data.append('password_confirmation', params.password_confirmation);

        params.resume.forEach((r, index) => {
            form_data.append('resume[]', r, r.name);
        });
        
        const config = {
            url: 'api/store/psychologist',
            method: 'POST',
            data: form_data,
            headers: {
                'Content-Type': 'multipart/form-data'
            }
            
        }
        return new Promise((resolve, reject) => {
            axios(config)
                .then( ( response) => {
                    resolve(response)
                })
                .catch(( error ) => {
                    reject(error)
                });
        })
    },

    async getPsychLists({ commit })
    {
        const response = await axios.get('/api/psychologists/lists');
        commit("setPsychologists", response.data);
    },

    statusUpdate({ context }, payload) {
        return new Promise((resolve, reject) => {
            axios
                .post("/api/psychologist/update/status", payload)
                .then((response) => {
                    resolve(response)
                })
                .catch((error) => {
                    reject(error)
                })
        })
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
