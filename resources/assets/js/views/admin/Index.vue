<template>
	
	<div class="row">
		<div class="col-sm-12">
			<Loader v-if="!loaded"></Loader>
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
			};
		},
		beforeCreated () {

		},
		mounted() {
			
		},
		methods: {
			
		}
	}

</script>
