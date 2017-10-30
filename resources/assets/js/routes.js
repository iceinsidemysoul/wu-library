import VueRouter from 'vue-router';

let routes = [
	{
		path: '/',
		component: require('./components/Timeline.vue')
	}
];

export default  new VueRouter({
	mode: 'history',
    routes,
    linkActiveClass: 'active'
});;