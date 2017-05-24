<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
        <link rel="stylesheet" href="{{asset('css/estilos-rapidos.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

        <script src="{{asset('plugins/jquery/js/jquery-3.1.1.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <title>@yield('title','Admin Panel')</title>
    </head>
    <body>
        <div class="col-xs-12">
            @include("admin.template.partials.nav")
        </div>
        <div class="row container">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                @yield('panel')
            </div>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                @yield('content')
            </div>
        </div>
        <div class="container">
            @include('admin.template.partials.footer')
        </div>
    </body>
</html>