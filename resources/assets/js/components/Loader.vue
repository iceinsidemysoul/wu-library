<template>
	<div class="loader-area">
		<div class="page-loader mx-auto my-5"></div>
	</div>
</template>

<style>
	.page-loader {
		border: 16px solid #f3f3f3;
		border-radius: 50%;
		border-top: 16px solid #3498db;
		width: 120px;
		height: 120px;
		-webkit-animation: spin 1s linear infinite;
		animation: spin 1s linear infinite;
	}

	.loader-area {
		min-height: 600px;
	}

	@-webkit-keyframes spin {
	  0% { -webkit-transform: rotate(0deg); }
	  100% { -webkit-transform: rotate(360deg); }
	}

	@keyframes spin {
	  0% { transform: rotate(0deg); }
	  100% { transform: rotate(360deg); }
	}
</style>

<script>
	export default {
		
	}
</script>


