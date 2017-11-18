<template>
	
	<div class="row">
		<div class="col-md-10 offset-md-1" style="min-height:700px">
			<div class="card">
				<div class="card-header text-center">
					<p class="h4 text-wu"><i class="fa fa-edit"></i> Edit Post</p>
				</div>
				<div class="card-block">
					<form @submit.prevent="onSubmit">
						<div class="form-group">
							<label for="title">หัวข้อ <span class="text-danger">* (ไม่เกิน 300 ตัวอักษร)</span></label>
							<input id="title" type="text" class="form-control" v-model="form.title" required autofocus>
						</div>
						<hr>
						<div class="form-group" v-if="!form.image">
							<label for="image">ภาพ <span class="text-danger">*</span></label>
							<input id="image" type="file" class="form-control" @change="onFileChange" required>
						</div>
						<hr v-if="!form.image">
						<div class="form-group" v-if="form.image">
							<label>Preview Image <a class="text-danger" @click.prevent="delUploadedImage"><i class="fa fa-trash"></i></a></label>
							<div class="row">
								<div class="col-sm-4 offset-sm-4">
									<img :src="form.image" alt="" class="img-fluid">
								</div>
							</div>
						</div>
						<hr v-if="form.image">
						<div class="form-group">
							<label for="body">รายละเอียด <span class="text-danger">*</span></label>
							<textarea id="body" cols="30" rows="15" class="form-control" v-model="form.body" required></textarea>
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
		</div>
	</div>

</template>


<script>

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
				post: '',
				categories: []
			};
		},
		beforeCreate () {
			this.$parent.menu = 'edit';
			let id = this.$route.params.id;
			axios.get('/posts/' + id)
				.then( response => {
					this.post = response.data;
					this.form.title = this.post.title;
					this.form.body = this.post.body;
					this.form.image = this.post.image;
					this.form.date = this.post.date;
					for ( let cate of this.post.categories){
						this.form.categories.push(cate.id);
					}
				})
				.catch( error => {
					console.log(error);
				});
			axios.get('/admin/posts/create')
				.then( response => {
					this.categories = response.data;
				})
				.catch( error => {
					console.log(error);
				});

		},
		methods: {
			onSubmit: function () {
				let id = this.$route.params.id;
				axios.patch('/admin/posts/' + id, this.form)
					.then( response => {
						console.log(response.data);
						let leave = confirm('บันทึกสำเร็จ ต้องการกลับหน้าบทความหรือไม่?');
						if (leave){
							this.$root._router.push('/admin/post');
							this.$parent.menu = '';
						}
					})
					.catch( error => {
						console.log(error);
					});
			},
			onFileChange: function(event) {
				let input = event.target;
				if (input.files[0]) {
					let reader = new FileReader();
					reader.onload = (e) => {
						this.form.image = e.target.result;
					}
					reader.readAsDataURL(input.files[0]);
				}
			},
			delUploadedImage: function() {
				let conf = confirm('ต้องการเปลี่ยนรูป?');

				if (conf) {
					this.form.image = '';
				}
			}

		}
	}

</script>
