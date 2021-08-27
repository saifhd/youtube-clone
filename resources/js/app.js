

require('./bootstrap');

window.Vue = require('vue').default;


Vue.component('subscribe', require('./components/Subscribe').default);
Vue.component('channel-uploads', require('./components/ChannelUploads').default);

const app = new Vue({
    el: '#app',
});
