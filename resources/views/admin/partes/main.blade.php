<!DOCTYPE html>
@extends('admin.plantilla.referencias')
<html>
<head>
	<title>@yield('title','Default') | </title>
</head>
<body>
	@include('admin.plantilla.parciales.navTop')
	<div id="wrapper">
		@include('admin.plantilla.parciales.sidebar')
		<section>
			@yield('content')
		</section>
	</div>
</body>
</html>