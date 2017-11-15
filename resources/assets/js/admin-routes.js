import VueRouter from 'vue-router';

let routes = [
	{
		path: '/admin',
		component: require('./views/admin/Index.vue')
	},
	{
		path: '/admin/post',
		component: require('./views/admin/Post.vue'),
		children: [
			{
				path: '',
				component: require('./views/admin/post/index.vue')
			},
			{
				path: 'create',
				component: require('./views/admin/post/create.vue')
			},
			// {
			// 	path: ':id',
			// 	component: require('./views/admin/post/edit.vue')
			// },
			{
				path: ':id/edit',
				component: require('./views/admin/post/edit.vue')
			}
		]
	},
	{
		path: '/admin/category',
		component: require('./views/admin/Category.vue'),
		children: [
			{
				path: '',
				component: require('./views/admin/category/index.vue')
			},
			{
				path: 'create',
				component: require('./views/admin/category/create.vue')
			},
			// {
			// 	path: ':id',
			// 	component: require('./views/admin/category/show.vue')
			// },
			{
				path: ':id/edit',
				component: require('./views/admin/category/edit.vue')
			}
		]
	}
];

export default  new VueRouter({
	mode: 'history',
    routes,
    linkActiveClass: 'active'
});;