<template>
	
	<div class="row">
		<div class="col-md-10 offset-md-1" style="min-height:700px">
			<div class="card">
				<div class="card-header text-center">
					<p class="h4 text-wu"><i class="fa fa-edit"></i> New Post</p>
				</div>
				<div class="card-block">
					<form @submit.prevent="onSubmit">
						<div class="form-group">
							<label for="title">หัวข้อ <span class="text-danger">* (ไม่เกิน 300 ตัวอักษร)</span></label>
							<input id="title" type="text" class="form-control" v-model="form.title" required autofocus>
						</div>
						<hr>
						<div class="form-group">
							<label for="image">ภาพ <span class="text-danger">*</span></label>
							<input id="image" type="file" class="form-control" @change="onFileChange" required>
						</div>
						<hr>
						<div class="form-group">
							<label for="body">รายละเอียด <span class="text-danger">*</span></label>
							<textarea id="body" cols="30" rows="10" class="form-control" v-model="form.body" required></textarea>
						</div>
						<hr>
						<div class="form-group">
							<label for="body">วันที่ <span class="text-danger">*</span></label>
							<input type="date" class="form-control" v-model="form.date">
						</div>
						<hr>
						<div class="form-group">
							<label for="body">หมวดหมู่ <span class="text-danger">* (เลือกได้มากกว่า 1)</span></label>
							<div class="row">
								<div class="col-md-4" v-for="cate in categories">
									<label class="custom-control custom-checkbox">
									  <input type="checkbox" class="custom-control-input" v-model="form.categories" :value="cate.id">
									  <span class="custom-control-indicator"></span>
									  <span class="custom-control-description">{{ cate.title }}</span>
									</label>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-success mx-5">Submit</button>
							<router-link to="/admin/post" class="btn btn-danger">Cancel</router-link>
						</div>
					</form>
				</div>
			</div>
			<div class="row mt-4" v-if="new_posts.length > 0">
				<div class="col-sm-10 offset-sm-1">
					<h3 class="text-center">บทความล่าสุด</h3>
					<div class="table-responsive">
						<table class="table">
							<thead style="background: #ddd;">
								<tr>
									<th>ปี</th>
									<th>หัวข้อ</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="post in new_posts">
									<td>{{ post.date.substr(0, 4) }}</td>
									<td>{{ post.title }}</td>
								</tr>
							</tbody>
						</table>
					</div>					
				</div>
			</div>
		</div>
	</div>

</template>


<script>
	import moment from 'moment';
	export default {
		data () {
			return {
				form: {
					title: '',
					image: '',
					body: '',
					date: '',
					categories: [] 
				},
				new_posts: [],
				categories: ''
			};
		},
		beforeCreate () {
			this.$parent.menu = 'create';
			axios.get('/admin/posts/create')
				.then( response => {
					this.categories = response.data;
					this.form.date = moment().format('YYYY-MM-DD');
				})
				.catch( error => {
					console.log(error);
				});
		},
		methods: {
			onSubmit: function() {
				axios.post('/admin/posts', this.form)
					.then( response => {
						console.log(response.data);
						this.new_posts.push(response.data);
						this.form.title = '';
						this.form.image = '';
						document.querySelector("input#image[type='file']").value = '';
						this.form.body = '';
						this.form.date = moment().format('YYYY-MM-DD');
						this.form.categories = [];
					})
					.catch( error => {
						console.log(error);
					});
			},
			onFileChange: function(event) {
				let input = event.target;
				if (input.files[0]){
					let reader = new FileReader();
					reader.onload = (e) => {
						this.form.image = e.target.result;
					}
					reader.readAsDataURL(input.files[0]);
				}
			}
		}	
	}

</script>
