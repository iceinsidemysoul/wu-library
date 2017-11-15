<template>
	<div class="row">
		<div class="col-md-8 offset-2 col-lg-10 offset-lg-1 my-4">
			<wuHeader></wuHeader>
			<h4 class="display-4">{{ post.title }}</h4>
			<div class="row">
				<div class="col-md-8">
					<div class="w-75 mx-auto">
						<img :src="post.image" alt="" class="img-fluid post-image">
					</div>
					<article class="my-4">
						{{ post.body }}
					</article>
				</div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-sm-12 p-1 share-plugin">
							<table>
								<tr>
									<td class="p-2">
										<div class="fb-share-button mb-2" data-href="http://172.104.165.212" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F172.104.165.212%2F&amp;src=sdkpreparse">Share</a></div>
									</td>
									<td class="p-2">
										<!-- Place this tag where you want the share button to render. -->
										<div class="g-plus" data-action="share" data-height="30"></div>	
									</td>
									<td class="p-2">
										<a class="twitter-share-button"
										  href="https://twitter.com/intent/tweet "
										  data-size="large">
										Tweet</a>
									</td>
								</tr>
							</table>
						</div>
					</div>
					
					<div class="card mt-2">
						<div class="card-header">
							หัวข้อที่เกี่ยวข้อง
						</div>
						<div class="card-block">
							<button class="btn btn-sm btn-success m-2 text-white" v-for="cate in post.categories">{{ cate.title }}</button>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<div class="fb-comments" :dataHref='"https://172.104.165.212/" + post.id' data-width="100%" data-numposts="10"></div>
				</div>
			</div>
		</div>
    </div>
</template>

<style>
	
</style>

<script>
	import wuHeader from '../components/wuHeader.vue';
	export default {
		components: {
			wuHeader
		},
		data() {
			return {
				post: '',
			};
		},
		beforeCreate() {
			let id = this.$route.params.id;
			axios.get('/posts/'+id)
				.then( response => {
					this.post = response.data;
					console.log(this.post);
				})
				.catch( error => {
					console.log(error);
				})
			// axios.get()
		},
		filters: {
			
		}
	}
</script>