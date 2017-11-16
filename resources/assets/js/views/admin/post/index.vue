<template>
	
	<div class="row">
		<div class="col-sm-12" style="min-height:700px">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="text-center" colspan="4"  style="color: #ff6a00;"><i class="fa fa-file-text-o"></i> Posts</th>
						</tr>
						<tr class="text-white" style="background: #ff6a00;">
							<th class="text-center">ปี</th>
							<th class="text-center">หัวข้อ</th>
							<th class="text-center">หมวดหมู่</th>
							<th class="text-center">#</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="post in posts">
							<td class="text-center">{{ post.date.substr(0, 4) }}</td>
							<td class="text-center">
								<router-link :to="'/admin/post/' + post.id + '/edit'" class="h6 admin-post-title">
									{{ post.title }}
								</router-link>
							</td>
							<td class="text-center">
								<span v-for="cate in post.categories"> {{ cate.title }} <br></span>
							</td>
							<td class="text-center text-danger"> <i class="fa fa-trash-o"></i> </td>
						</tr>
					</tbody>
				</table>
			</div>
			<nav aria-label="Page navigation example" style="overflow-x:auto">
			  <ul class="pagination">
			    <li class="page-item" v-if="page.prev_page_url">
			      <a class="page-link" href="#" aria-label="Previous" @click.prevent="prevPage">
			        <span aria-hidden="true">&laquo;</span>
			      </a>
			    </li>
			    <li class="page-item" v-for="i in page.last_page">
			    	<a class="page-link" href="#" @click.prevent="goToPage(i)">{{ i }}</a>
			    </li>
			    <li class="page-item" v-if="page.next_page_url">
			      <a class="page-link" href="#" aria-label="Next" @click.prevent="nextPage">
			        <span aria-hidden="true">&raquo;</span>
			      </a>
			    </li>
			  </ul>
			</nav>
		</div>
	</div>

</template>


<script>

	export default {
		data () {
			return {
				posts: '',
				page: '',
			};
		},
		beforeCreate () {
			this.$parent.menu = 'create';
			axios.get('/admin/posts')
				.then( response => {
					this.page = response.data;
					this.posts = response.data.data;
				})
				.catch( error => {
					console.log(error);
				});
		},
		methods: {
			goToPage: function (page) {
				axios.get('/admin/posts?page=' + page)
					.then( response => {
						this.page = response.data;
						this.posts = response.data.data;
						console.log(response.data.data);
					})
					.catch( error => {
						console.log(error);
					});
			},
			nextPage: function () {
				let next = this.page.next_page_url;
				axios.get(next)
					.then( response => {
						this.page = response.data;
						this.posts = response.data.data;
					})
					.catch( error => {
						console.log(error);						
					});
			},
			prevPage: function () {
				let prev = this.page.prev_page_url;
				axios.get(prev)
					.then( response => {
						this.page = response.data;
						this.posts = response.data.data;
					})
					.catch( error => {
						console.log(error);
					});
			}

		}
	}

</script>
