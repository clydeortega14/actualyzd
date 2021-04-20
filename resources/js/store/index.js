import Vue from 'vue';
import Vuex from 'vuex';
import schedule from './modules/schedule.js';

Vue.use(Vuex)

export default new Vuex.Store({

	modules: {
		schedule
	}
})