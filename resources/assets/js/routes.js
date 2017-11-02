import VueRouter from 'vue-router';

let routes = [
	{
		path: '/',
		component: require('./views/Index.vue')
	}
];

export default  new VueRouter({
	mode: 'history',
    routes,
    linkActiveClass: 'active'
});;