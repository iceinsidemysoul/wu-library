@extends ('spa-layouts.app')

@section ('social')

		@include('spa-layouts.social')

@endsection

@section('content')
		
		<router-view></router-view>

@endsection