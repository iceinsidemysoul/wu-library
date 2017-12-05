<template>
	
	<div>
		<div class="row mt-4" v-if="!loaded">
			<div class="col-sm-12">
				<Loader></Loader>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-sm-4">
				<div class="card">
					<div class="card-header text-center text-white bg-wu-o">
						<i class="fa fa-smile-o" style="font-size:10rem;"></i>
					</div>
					<div class="card-block text-center">
						<p class="h5">{{ surveys.good }} คน บอกว่าชอบเว็บไซต์นี้</p>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card">
					<div class="card-header text-center text-white bg-warning">
						<i class="fa fa-meh-o" style="font-size:10rem;"></i>
					</div>
					<div class="card-block text-center">
						<p class="h5">{{ surveys.none }} คน รู้สึกเฉยๆ</p>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card">
					<div class="card-header text-center text-white bg-wu-v">
						<i class="fa fa-frown-o" style="font-size:10rem;"></i>
					</div>
					<div class="card-block text-center">
						<p class="h5">{{ surveys.bad }} คน พบปัญหาหรือไม่ชอบเว็บไซต์นี้</p>
					</div>
				</div>
			</div>
		</div>
		<div class="table-responsive mt-5">
			<table class="table">
				<thead>
					<tr class="bg-wu-v text-white">
						<th colspan="4" class="h3 text-center">ความเห็นของผู้ใช้</th>
					</tr>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">ความรู้สึก</th>
						<th class="text-center">ความเห็น</th>
						<th class="text-center">E-mail</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(comment, i) in surveys.comments">
						<td class="text-center">{{ i+1 }}</td>
						<td class="text-center h2"><i :class="comment.satisfaction | feelingToIcon"></i></td>
						<td class="text-center">{{ comment.comment }}</td>
						<td class="text-center">{{ comment.email }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	
	

</template>


<script>
	import Loader from '../../components/Loader.vue';
	export default {
		components: {
			Loader
		},
		data () {
			return {
				loaded: false,
				surveys: ''
			};
		},
		beforeCreate () {
			axios.get('/admin/surveys')
				.then( response => {
					this.surveys = response.data;
					this.loaded = true;
				})
				.catch( error => {
					alert(error);
				});
		},
		filters: {
			// if good, smiles
			feelingToIcon: function (feeling) {
				if (feeling == 'good') {
					return 'fa fa-smile-o text-wu-o';
				} else if (feeling == 'none') {
					return 'fa fa-meh-o text-warning';
				} else if (feeling == 'bad') {
					return 'fa fa-frown-o text-wu-v';
				}
			}
		},
		mounted() {
			
		},
		methods: {
			
		}
	}

</script>
