<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title','Clasificados IC')</title>
	<script href="{{asset('plugins/jquery/js/jquery.min.js')"></script>
	<script href="{{asset('plugins/bootstrap/js/bootstrap.js')"></script>
	<link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.css'}}"
</head>
<body>
@include('page.template.partials.nav')
<section>
	@yield("content")
</section>
</body>
</html>
