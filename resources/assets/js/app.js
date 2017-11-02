import './bootstrap';
import router from './routes.js';
import Timeline from './components/Timeline.vue';
// import Posts from './components/Posts.vue';

new Vue({
    el: '#app',

    router,
    // components: { Timeline }
});
