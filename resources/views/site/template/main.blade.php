<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
        <link rel="stylesheet" href="{{asset('css/estilos-rapidos.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

        <link rel="stylesheet" href="{{asset('css/CSSScript.css')}}">
		@yield('css')
<!--        <script src="{{asset('plugins/jquery/js/jquery-3.1.1.min.js')}}"></script>-->
		<script src="{{asset('plugins/jquery/js/jquery.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/fincaraiz.js')}}"></script>
		@yield('js')
        <title>@yield('title','Clasificados')</title>
    </head>
    <body>
		@if(Auth::user())
			@include("site.template.partials.nav-user")
		@else
			@include("site.template.partials.nav")
		@endif
        <div class="container-fluid">
			<div class="hidden-xs col-sm-4"></div>
			<div class="col-xs-12 col-sm-6">
				@include('flash::message')
				@if(count($errors)>0)
					<div class="alert alert-danger">
						<ul>
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			</div>
			<div class="hidden-xs col-sm-2"></div>
            <div class="col-xs-12">
                @yield('content')
            </div>
        </div>
        <div class="container-fluid">
            @include('site.template.partials.footer')
        </div>
		@yield('modales')
    </body>
</html>
