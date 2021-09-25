<?php

Config::set('app.url', config('app.url') . ':' . $_SERVER['SERVER_PORT']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<base href="{{config('app.url')}}">
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{$title}}</title>
	<meta name="keywords" content="<?= $seo['keyword'] ?>" />
	<meta name="description" content="<?= $seo['desc'] ?>" />
	<meta property="og:title" content="<?= $title ?>" />
	<meta property="og:description" content="<?= $seo['desc'] ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="<?= $title ?>" />
	<meta property="og:url" content="<?= request()->url() ?>" />
	<meta property="og:image" content="<?= config('app.url') . '/' . $seo['thumbnail'] ?>" />
	<meta name="twitter:card" content="<?= $information['title'] ?>" />
	<meta name="twitter:site" content="<?= request()->url() ?>" />
	<meta name="twitter:title" content="<?= $title ?>" />
	<meta name="twitter:description" content="<?= $seo['desc'] ?>" />
	<meta name="twitter:image" content="<?= config('app.url') . '/' . $seo['thumbnail'] ?>" />
	<link rel="canonical" href="<?= request()->url() ?>" />
	<meta name="copyright" content="<?= $information['title'] ?>" />
	<meta name="author" content="<?= $information['title'] ?>" />
	<meta name="GENERATOR" content="<?= $information['title'] ?>" />
	<meta name="DC.title" content="<?= $information['title'] ?>" />
	<meta name="DC.identifier" content="<?= request()->url() ?>" />
	<meta name="DC.description" content="<?= $information['desc'] ?>" />
	<meta name="DC.subject" content="<?= $information['keyword'] ?>" />
	<meta name="DC.language" scheme="ISO639-1" content="vi" />
	<meta name="viewport" content="width=device-width minimum-scale=1.0 maximum-scale=1.0 user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="shortcut icon" href="<?= config('app.url') . '/' . $information['logo'] ?>">
	@include('ui.template.layout.style')
	@include('ui.template.layout.script')
</head>

<body>

	@include('ui.template.layout.header')
	<!-- cache_sidebar() -->
	@yield('content')
	<!-- cache_footer() -->
	@include('ui.template.layout.footer')

</body>

</html>