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
import chat_messages from './modules/chat-message.js';
import video_call from './modules/video-call.js';
import reasons_lists from './modules/reasons-lists.js';
import user from './modules/user.js';
import faq from './modules/faq.js';
import client_subscription from './modules/client-subscription.js';

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
		session_types,
		chat_messages,
		video_call,
		reasons_lists,
		user,
		faq,
		client_subscription
	}
})