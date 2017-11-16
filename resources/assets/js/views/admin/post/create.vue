<template>
	
	<div class="row">
		<div class="col-md-10 offset-md-1" style="min-height:700px">
			<div class="card">
				<div class="card-header text-center">
					<p class="display-4 text-wu"><i class="fa fa-edit"></i> New Post</p>
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
									  <input type="checkbox" class="custom-control-input" v-model="form.categories" :value="cate.title">
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
			onFileChange: function(event) {
				let input = event.target;
				if (input.files[0]){
					let reader = new FileReader();
					reader.onload = (e) => {
						this.form.image = e.target.result;
					}
					reader.readDataAsURL(input.files[0]);
				}
			}
		}	
	}

</script>
