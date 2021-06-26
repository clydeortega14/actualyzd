import Vue from 'vue';
import Vuex from 'vuex';
import schedule from './modules/schedule.js';
import psychologist from './modules/psychologist.js';
import onboarding_questions from './modules/onboarding-question.js';
import booking from './modules/booking.js';
import service_utilization from './modules/service-utilization.js';
import progress_report from './modules/progress-report.js';
import client from './modules/client.js';
import session_types from './modules/session-type.js';

Vue.use(Vuex)

export default new Vuex.Store({

	modules: {
		schedule,
		psychologist,
		onboarding_questions,
		booking,
		service_utilization,
		progress_report,
		client,
		session_types
	}
})