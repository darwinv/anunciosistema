@extends('site.template.main')
@section('title','Home | Clasificados')

@section('content')
	<div class="hidden-xs col-sm-2"></div>
<div class="row container-fluid">
	<div class="col-xs-12">
							<ul class="nav navbar-nav">
									<li><a href="#"><i class="fa fa-home"></i></a>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Proyectos de Vivienda</a>
										<ul class="dropdown-menu">
												<li><a href="#">Link</a></li>
												<li><a href="#">Link</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Anuncios en arriendo</a>
										<ul class="dropdown-menu">
												<li><a href="#">Link</a></li>
												<li><a href="#">Link</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Anuncios en Venta</a>
										<ul class="dropdown-menu">
												<li><a href="#">Link</a></li>
												<li><a href="#">Link</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Buscar Por</a>
										<ul class="dropdown-menu">
												<li><a href="#">Link</a></li>
												<li><a href="#">Link</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Servicio al Cliente</a>
										<ul class="dropdown-menu">
												<li><a href="#">Link</a></li>
												<li><a href="#">Link</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Mi cuenta</a>
										<ul class="dropdown-menu">
												<li><a href="#">Link</a></li>
												<li><a href="#">Link</a></li>
										</ul>
									</li>
							</ul>
			 </div>
</div>
<div class="container-fluid text-center">


	<div class="col-xs-12 col-sm-12 ">
		<!-- CATEGORIAS BEGIN -->
		<div class="col-xs-12 contenedor" style="height:370px;overflow:auto;">
			<center><h1>Realiza tu búsqueda aquí</h1></center>
			<div class="container">
		<div class="row">
			 <div class="col-lg-12">
				<div class="button-group">
							<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> <span class="caret"></span></button>
				<ul class="dropdown-menu">
						<li><a href="#" class="small" data-value="option1" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 1</a></li>
						<li><a href="#" class="small" data-value="option2" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 2</a></li>
						<li><a href="#" class="small" data-value="option3" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 3</a></li>
						<li><a href="#" class="small" data-value="option4" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 4</a></li>
						<li><a href="#" class="small" data-value="option5" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 5</a></li>
						<li><a href="#" class="small" data-value="option6" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 6</a></li>
				</ul>
				</div>
			</div>
		</div>
</div>
		</div>
		<!-- CATEGORIAS END -->
		<div class="col-xs-12">
			<br>
		</div>
		<!-- ULTIMAS PUBLICACIONES BEGIN -->
		<div class="col-xs-12 contenedor" style="height:500px;overflow:auto;">
			<center><h1>Ultimas publicaciones</h1></center>
			@foreach($publications as $publication)
				@if($publication->status=='Activo')
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-body">
								<a href="{{ route('publications.show',$publication->id) }}"><img alt="" src="{{asset('img/publications/' . $publication->images->first()->name . '.' . $publication->images->first()->extention)}}" class="img img-responsive img-publicar2" /></a>
							</div>
							<div class="panel-footer t14">
								<span class="red t20 right-align">Bs. {{ $publication->price }}</span><br>
								{{ $publication->title }}<br>
								<a href="{{ route('users.show',$publication->user->id) }}">{{ $publication->user->seudonimo }}</a><br>
								{{ $publication->user->estado()->first()->name }}<br>
								<span class="t12">
									<i class="fa fa-eye"></i> 34 / <i class="fa fa-thumbs-up"></i> 50 Me gusta
								</span>
							</div>
						</div>
					</div>
				@endif
			@endforeach
		</div>
		<!-- ULTIMAS PUBLICACIONES END -->
		<div class="col-xs-12">
			<br><br><br><br>
		</div>
		</div>
	</div>
	<div class="hidden-xs col-sm-1"></div>
@endsection
