@extends ('spa-layouts.app')

@section('content')
		
		<div class="row">
			<div class="col-md-8 offset-2 col-lg-10 offset-lg-1 my-4">
				<router-view></router-view>
				<h4 class="text-prompt pl-4 my-5">{{ $post->title }}</h4>
				<div class="row" style="min-height:400px">
					<div class="col-md-8">
						<div class="mx-auto text-center" style="max-width: 350px;">
							<img src="{{ $post->image }}" alt="" class="img-fluid post-image">
						</div>
						<article class="my-4 post-body">
							{{ $post->body }}
						</article>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-sm-12 p-1 share-plugin">
								<table>
									<tr>
										<td class="p-2">
											<div class="fb-share-button mb-2" data-href="/post/{{ $post->id }}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="/post/{{ $post->id }}">Share</a></div>
										</td>
										<td class="p-2">
											<!-- Place this tag where you want the share button to render. -->
											<div class="g-plus" data-action="share" data-href="/post/{{ $post->id }}" data-height="30"></div>	
										</td>
										<td class="p-2">
											<a class="twitter-share-button"
											  href="/post/{{ $post->id }}"
											  data-size="large">
											Tweet</a>
										</td>
									</tr>
								</table>
							</div>
						</div>
						
						<div class="card mt-2">
							<div class="card-header text-taviraj">
								หัวข้อที่เกี่ยวข้อง
							</div>
							<div class="card-block">
								@if (count($post->categories) > 0)
									@foreach ($post->categories as $cate)
										<button class="btn btn-sm btn-success m-2 text-white text-taviraj">
											{{ $cate->title }}
										</button>
									@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8">
						<div class="fb-comments" dataHref="/post/{{ $post->id }}" data-width="100%" data-numposts="10"></div>
					</div>
				</div>
			</div>
	  </div>
@endsection