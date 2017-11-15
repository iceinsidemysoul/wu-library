<template>
	
	<div class="row">
		<div class="col-sm-12">
			<ul class="nav nav-pills nav-fill my-4">
				<router-link to="/admin/post" exact></router-link>
			  <li class="nav-item">
			  	<router-link to="/admin/post" class="nav-link" exact><i class="fa fa-file-text-o"></i> บทความทั้งหมด</router-link>
			  </li>
			  <li class="nav-item">
			    <router-link to="/admin/post/create" class="nav-link"><i class="fa fa-plus"></i> บทความใหม่</router-link>
			  </li>
			  <li class="nav-item">
			  	<router-link to="/admin/post/10/edit" class="nav-link"><i class="fa fa-edit"></i> แก้ไข</router-link>
			  </li>
			  <li class="nav-item">
			  	<router-link to="/admin/post/12/preview" class="nav-link"><i class="fa fa-file-text"></i> ตัวอย่าง</router-link>
			  </li>
			</ul>
			<router-view></router-view>
		</div>
	</div>

</template>


<script>

	export default {
		data () {

		},
		beforeCreated () {

		},
		methods: {

		}
	}

</script>
