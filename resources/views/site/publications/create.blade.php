@extends('site.template.main')
@section('title','Crear una publicación')
@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/htmledit/ui/trumbowyg.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/cropit/cropit.css') }}">
@endsection
@section('js')
	<script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
	<script src="{{ asset('plugins/htmledit/trumbowyg.min.js') }}"></script>
	<script src="{{ asset('plugins/cropit/jquery.cropit.js') }}"></script>
	<script src="{{ asset('plugins/cropit/cropit.js') }}"></script>
	<script>
		$(document).ready(function(){
			tinymce.init({ 
				selector:'#editor',
				language:'es_MX',
				height: 450,
				statusbar: false,
				menubar: false,
				default_link_target: "_blank",
				plugins: "charmap, hr, lists, preview, searchreplace, table, wordcount, anchor, code, fullpage, image, media, visualblocks, imagetools, fullscreen, link, textcolor",
				toolbar:[
				 'styleselect, formatselect, fontselect, fontsizeselect, undo, charmap, hr, preview, ',
				 ' bold, italic,underline,alignleft, aligncenter, alignright, alignjustify, bullist, numlist, outdent, indent,  link, media, image, visualblocks, forecolor, backcolor'
					]
			});		
		});
	</script>
@endsection
@section('content')
	<div class="hidden-xs col-sm-3"></div>
	<div class="col-xs-12 col-sm-8 contenedor pad10">
		{!! Form::open(['url' => route('publications.create.post'),'method' => 'POST' ]) !!}
			<div class="col-xs-12">
				<center><h1><i class="fa fa-lock"></i> Datos Generales</h1></center>
				<div class="form-group">
					{!! Form::label("title","Titulo") !!}
					{!! Form::text("title",null,["class" => "form-control","placeholder" => "Titulo de la publicación"]) !!}
				</div>
				<div class="form-group">
					{!! Form::label("description","Descripción") !!}
					{!! Form::textarea("description",null,["class" => "form-control editor","placeholder" => "describe aquí tu producto", "id" => "editor"]) !!}
				</div>
				<div class="form-group col-xs-12 col-sm-3">
					{!! Form::label("category_id","Categoria") !!}
					{!! Form::select("category_id",$categories,null,["class" => "form-control","placeholder" => "Seleccione"]) !!}
				</div>				
				<div class="form-group col-xs-12 col-sm-3">
					{!! Form::label("price","Precio") !!}
					{!! Form::number("price","0",["class" => "form-control","placeholder" => "Precio de tu producto"]) !!}
				</div>
				<div class="form-group col-xs-12 col-sm-3">
					{!! Form::label("garantia","Cuenta con garantia") !!}
					{!! Form::select("garantia",["0"=>"No cuenta con garantia","1"=>"1 mes","6 meses","2"=>"1 año","3"=>"mas de 1 año"],null,["class" => "form-control"]) !!}
				</div>
				<div class="form-group col-xs-12 col-sm-3">
					{!! Form::label("condition_id","Condición del producto") !!}
					{!! Form::select("condition_id",[0=>"Nuevo",1=>"Usado",2=>"Servicio",3=>"Mascota"],null,["class" => "form-control"]) !!}
				</div>				
			</div>
			<div class="col-xs-12"><hr></div>
			<div class="col-xs-12 pad15" id="imagenes-publicaciones">
				<center><h1><i class="fa fa-user"></i> Imágenes</h1></center>
				<div class="subir-img-active foto" style="margin-left: 0px;" data-toggle="tooltip" title="Debes subir una foto">
					<img class="img-responsive"/>
					<i style="position: relative; top:-92px; left:84%;" class="fa fa-times red hidden"></i>
				</div>
				<div class="subir-img-active foto " >
					<img class="img-responsive"/>
					<i style="position: relative; top:-92px; left:84%;" class="fa fa-times red hidden"></i>
					</i>
				</div>
				<div class="subir-img-active foto">
					<img class="img-responsive"/>
					<i style="position: relative; top:-92px; left:84%;" class="fa fa-times red hidden"></i>
					</i>
				</div>
				<div class="subir-img-active foto">
					<img class="img-responsive"/>
					<i style="position: relative; top:-92px; left:84%;" class="fa fa-times red hidden"></i>
					</i>
				</div>
				<div class="subir-img-active foto">
					<img class="img-responsive"/>
					<i style="position: relative; top:-92px; left:84%;" class="fa fa-times red hidden"></i>
					</i>
				</div>
				<div class="subir-img-active foto">
					<img class="img-responsive"/>
					<i style="position: relative; top:-92px; left:84%;" class="fa fa-times red hidden"></i>
					</i>
				</div>				
			</div>
			<div class="pull-right">
				{!! Form::hidden("imagenes",null,["id" => "imagenes"]) !!}
				<a href="{{ route('siteHome') }}" class="btn btn-warning">Cancelar</a>
				{!! Form::submit("Aceptar",["class" => "btn btn-primary"]) !!}
				<br><br><br><br>
			</div>
		{!! Form::close() !!}
	</div>
	<div class="hidden-xs col-sm-1"></div>
	@section('modales')
		@include('site.template.modales.m_cropper')
	@endsection
@endsection