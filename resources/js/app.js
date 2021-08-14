/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.prototype.$bus = new Vue();

import store from './store'
import moment from 'moment'

// import modal from 'vue-js-modal';

// Vue.use(modal, { dialog: true, dynamic: true });

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('calendar-page', require('./components/CalendarPage.vue').default);

Vue.component('bookings-calendar', require('./components/bookings/Calendar.vue').default);

Vue.component('booking-status', require('./components/bookings/BookingStatus').default);

Vue.component('bookings-lists', require('./components/bookings/BookingList.vue').default);

Vue.component('schedules-component', require('./components/schedules/Main.vue').default);

// Progress Report Client Medication Component
Vue.component('client-medication', require('./components/progress-reports/ClientMedication.vue').default);

// Report Assignee Vue Component
Vue.component('report-assignee', require('./components/progress-reports/ReportAssignee.vue').default);

//Client Participants Form Component
Vue.component('client-participants', require('./components/bookings/clients/ClientParticipant.vue').default);

// Video Chat Component
Vue.component('chat-component', require('./components/video-chat/ChatComponent.vue').default);

// Chat Messages Components
Vue.component('chat-messages', require('./components/video-chat/ChatMessages.vue').default);

// Chat Footer Component
Vue.component('chat-footer', require('./components/video-chat/ChatFooter').default);

// Video Call
Vue.component('video-call', require('./components/video-chat/VideoCall.vue').default);

/**
 * This components are for dashboard / service utilization
 */
Vue.component('service-utilization', require('./components/service-utilization/ServiceUtilization.vue').default);

Vue.component('client-lists', require('./components/service-utilization/ClientList.vue').default);


Vue.component('upload-avatar', require('./components/profile/UploadAvatar.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
