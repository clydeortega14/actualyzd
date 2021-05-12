import Vue from 'vue';
import Vuex from 'vuex';
import schedule from './modules/schedule.js';
import psychologist from './modules/psychologist.js';
import onboarding_questions from './modules/onboarding-question.js';
import booking from './modules/booking.js';
import service_utilization from './modules/service-utilization.js';

Vue.use(Vuex)

export default new Vuex.Store({

	modules: {
		schedule,
		psychologist,
		onboarding_questions,
		booking,
		service_utilization
	}
})