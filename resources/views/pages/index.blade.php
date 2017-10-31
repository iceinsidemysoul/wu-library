@extends ('spa-layouts.app')

@section('content')
		
		<div class="row">
			<router-view></router-view>
			<div class="col-md-10 offset-md-2 col-lg-11 offset-lg-1 my-4">
				<!-- below will be header -->
				<p style="margin-left: -3%; margin-bottom: 2%;"> <span class="h3">WU Library</span> <span class="text-muted h5 ml-3">Timeline</span></p>
				<div class="row">
					@foreach (range(0,11) as $i)
						<div class=" col-xl-2 col-xs-6 col-sm-4 col-lg-3 px-3 my-4">
							@include ('spa-layouts.post')
						</div>
						<div class="col-xl-2 col-xs-6 col-sm-4 col-lg-3 px-3 my-4">
							@include ('spa-layouts.post')
						</div>
					@endforeach
				</div>
			</div>
		</div>

@endsection