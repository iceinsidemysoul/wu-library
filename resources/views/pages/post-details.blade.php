@extends ('spa-layouts.app')

@section ('title', 'Walailak University Timeline - Archive ' . (intVal(substr($post->date, 0, 4)) + 543 ) )

@section ('og')
	<meta property="twitter:card" content="article" />
	<meta property="twitter:title" content="{{ $post->title }}" />
	<meta property="twitter:description" content='{{ $post->body }}' />
	<meta property="twitter:image" content="{{ url($post->image)  }}" />

	<meta itemprop="name" content="{{ $post->title }}">
	<meta itemprop="description" content='{{ $post->body }}'>
	<meta itemprop="image" content="{{ url($post->image)  }}">

	<meta property="og:url" content="{{ url('/post/'.$post->id) }}" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="{{ $post->title }}" />
	<meta property="og:description" content="{{ $post->body }}" />
	<meta property="og:image" content="{{ url($post->image)  }}" />
@endsection

@section ('social')


@endsection

@section('content')
		
	<div class="row">
		<div class="col-md-8 offset-2 col-lg-10 offset-lg-1 mt-2 mb-4">
			<h4 class="text-prompt pl-4 mb-5">{{ $post->title }}</h4>
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
									<td class="p-2 facebook-share" back>
										<div class="social-default fb-share-button mb-2" data-href="/post/{{ $post->id }}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="/post/{{ $post->id }}">Share</a></div>
									</td>
									<td class="p-2">
										<!-- Place this tag where you want the share button to render. -->
										<div class="g-plus social-default " data-action="share" data-href="/post/{{ $post->id }}" data-height="30"></div>	
									</td>
									<td class="p-2">
										<a class="twitter-share-button social-default"
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
									<button class="btn btn-sm btn-wu-o m-2 text-white text-taviraj">
										{{ $cate->title }}
									</button>
								@endforeach
							@endif
						</div>
					</div>
					@if (!empty($onThisDay) && count($onThisDay) > 0)
						<div class="card mt-3">
							<div class="card-header text-taviraj">
								ในวันเดียวกันนี้...
							</div>
							<div class="card-block">
								@foreach ($onThisDay as $p)
								<a href="/post/{{ $p->id }}">
									<ul class="list-group">
										<li class="list-group-item justify-content-between">
											{{-- <img src="{{ $p->image }}" alt="" class="img-fluid"> --}}
										    {{ substr($p->title, 0, 20) }}...
										    <span class="badge h6 bg-wu-v badge-pill">
												{{ intVal(substr($p->date, 0, 4)) + 543 }}
										    </span>
										</li>
									</ul>
								</a>
								@endforeach
							</div>
						</div>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="fb-comments" dataHref="/post/{{ $post->id }}" data-width="100%" data-numposts="10"></div>
				</div>
			</div>
			@if (!empty($onThisDay) && count($onThisDay) > 0)
				<div class="row">
					<div class="col-md-12">
						<h4 class="text-center my-5">ในวันเดียวกันนี้...</h4>
						<div class="row">
							@foreach ($onThisDay as $p)
								<div class="col-md-4 col-lg-3 px-5">
									<div class="card post current-year border-0">
								        <a href="/post/{{ $p->id }}">
								            <div class="post-thumbnail">
								                <img class="img-fluid" src="{{ $p->image }}" alt="/" style="border-width: 7px;">
								                <div class="year-thumbnail">
								                    {{ intVal(substr($p->date, 0, 4)) + 543 }}
								                </div>
								            </div>
								            <div class="card-block p-2">
								                <p>
								                	{{-- <span class="cate text-post-categories" v-for="cate in post.categories"> {{ cate.title }} </span> --}}
								                </p>
								                <h6 class="card-title post-title text-center text-sm">
								                	{{ $p->title }}
								            	</h6>
								            </div>
								        </a>
								    </div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection