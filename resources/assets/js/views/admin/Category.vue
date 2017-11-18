<template>
	
	<div class="row">
		<div class="col-sm-12">
			<router-view></router-view>
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
				loaded: false
			};
		},
		beforeCreate () {

		},
		methods: {
			
		}
	}

</script>
