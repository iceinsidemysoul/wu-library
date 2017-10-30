@extends ('spa-layouts.app')

@section('content')
		
		<div class="row">
			<router-view></router-view>
			<div class="col-md-10 offset-md-2 my-4">
				<h1>Walailak Library</h1>
				<div class="row">
					@foreach (range(0,11) as $i)
						<div class="col-md-3 px-2">
							@include ('spa-layouts.post')
						</div>
						<div class="col-md-3 px-2">
							@include ('spa-layouts.post')
						</div>
					@endforeach
				</div>
			</div>
		</div>

@endsection