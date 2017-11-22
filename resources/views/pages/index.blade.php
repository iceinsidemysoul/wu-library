@extends ('spa-layouts.app')

@section ('title', 'Walailak University Timeline - Archives')

@section ('og')
	<meta property="og:url" content="{{ url('') }}" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Walailak University Timeline - Archives" />
	<meta property="og:description" content="หากจะให้ได้มหาวิทยาลัยที่ดีที่สุดต้องใจเย็น ๆ และมหาวิทยาลัยที่นครศรีธรรมราชจะเป็นมหาวิทยาลัยที่สมบูรณ์แบบแนวใหม่ที่สุด" />
	<meta property="og:image" content="http://172.104.165.212/storage/images/upload/1511170140-1134-forum.jpeg" />

@endsection

@section ('social')

		@include('spa-layouts.social')

@endsection

@section('content')
		
		<router-view></router-view>

@endsection