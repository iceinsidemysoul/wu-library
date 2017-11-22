@extends ('spa-layouts.app')

@section ('title', 'Walailak University Timeline - Archives')

@section ('og')
	<meta property="twitter:card" content="article" />
	<meta property="twitter:title" content="Walailak University Timeline - Archives" />
	<meta property="twitter:description" content='พ.ศ.2533 ศ.ดร.วิจิตร ศรีสอ้าน ได้ชี้แจงว่า"...หากจะให้ได้มหาวิทยาลัยที่ดีที่สุดต้องใจเย็น ๆ และมหาวิทยาลัยที่นครศรีธรรมราชจะเป็นมหาวิทยาลัยที่สมบูรณ์แบบแนวใหม่ที่สุด..."' />
	<meta property="twitter:image" content="http://172.104.165.212/storage/images/upload/1511170140-1134-forum.jpeg" />

	<meta itemprop="name" content="Walailak University Timeline - Archives">
	<meta itemprop="description" content='พ.ศ.2533 ศ.ดร.วิจิตร ศรีสอ้าน ได้ชี้แจงว่า"...หากจะให้ได้มหาวิทยาลัยที่ดีที่สุดต้องใจเย็น ๆ และมหาวิทยาลัยที่นครศรีธรรมราชจะเป็นมหาวิทยาลัยที่สมบูรณ์แบบแนวใหม่ที่สุด..."'>
	<meta itemprop="image" content="http://172.104.165.212/storage/images/upload/1511170140-1134-forum.jpeg">

	<meta property="og:url" content="{{ url('') }}" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Walailak University Timeline - Archives" />
	<meta property="og:description" content='พ.ศ.2533 ศ.ดร.วิจิตร ศรีสอ้าน ได้ชี้แจงว่า"...หากจะให้ได้มหาวิทยาลัยที่ดีที่สุดต้องใจเย็น ๆ และมหาวิทยาลัยที่นครศรีธรรมราชจะเป็นมหาวิทยาลัยที่สมบูรณ์แบบแนวใหม่ที่สุด..."' />
	<meta property="og:image" content="http://172.104.165.212/storage/images/upload/1511170140-1134-forum.jpeg" />

@endsection

@section ('social')

		@include('spa-layouts.social')

@endsection

@section('content')
		
		<router-view></router-view>

@endsection
