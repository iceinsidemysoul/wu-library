<template>
	
	<div class="row">
		<div class="col-sm-12">
			<div v-if="categories.length < 1">
				<p class="text-center h4">ยังไม่มีบทความ</p>
				<Loader></Loader>
			</div>
			<div class="table-responsive" v-if="categories.length > 0">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="text-center" colspan="4"  style="color: #ff6a00;"><i class="fa fa-file-text-o"></i> categories</th>
						</tr>
						<tr class="text-white" style="background: #ff6a00;">
							<th class="text-center">ชื่อหมวดหมู่</th>
							<th class="text-center">จำนวนบทความ</th>
							<th class="text-center">#</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="category in categories">
							<td class="text-center h6 admin-post-title">
								<!-- <router-link :to='"/admin/category/" + category.id' class="h6 admin-post-title"> -->
									{{ category.title }}
								<!-- </router-link> -->
							</td>
							<td class="text-center"> {{ category.posts_count }} </td>
							<td class="text-center">
								<a href="#" class="text-danger" @click.prevent="">
									<i class="fa fa-trash-o"></i> 
								</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</template>


<script>
	import Loader from '../../../components/Loader.vue';
	export default {
		components: {
			Loader
		},
		data () {
			return {
				categories: ''
			};
		},
		beforeCreate () {
			axios.get('/categories')
				.then( response => {
					this.categories = response.data;
				})
				.catch( error => {
					console.log(error);
				});
		},
		methods: {
			
		}
	}

</script>
