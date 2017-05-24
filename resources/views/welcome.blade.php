@extends('site.template.main')
@section('title','Home | Clasificados')

@section('content')
	<div class="hidden-xs col-sm-2"></div>
	<div class="col-xs-12 col-sm-9">
		<!-- CATEGORIAS BEGIN -->
		<div class="col-xs-12 contenedor" style="height:370px;overflow:auto;">
			<center><h1>Categorias</h1></center>
			@foreach($categories as $category)
				@if($category->status=='Activo')
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-body">
								<a href="{{ route('publications.listado',$category->name) }}"><img alt="" src="{{asset('img/categories/' . $category->id . '.png')}}" class="img img-responsive img-publicar2" /></a>
							</div>
							<div class="panel-footer t22">
								{{ $category->name }}
							</div>
						</div>
					</div>					
				@endif
			@endforeach
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
	<div class="hidden-xs col-sm-1"></div>
@endsection