@extends("site.template.main")
@section('title','Crear un nuevo usuario')

@section('content')
	<div class="hidden-xs col-sm-3"></div>
	<div class="col-xs-12 col-sm-8 contenedor pad10">
		{!! Form::open(['url' => route('auth.post.register'),'method' => 'POST' ]) !!}
			<div class="col-xs-12">
				<center><h1><i class="fa fa-lock"></i> Datos de acceso</h1></center>			
				<div class="form-group">
					{!! Form::label("seudonimo","Seudonimo") !!}
					{!! Form::text("seudonimo",null,["class" => "form-control","placeholder" => "Seudonimo"]) !!}
				</div>
				<div class="form-group">
					{!! Form::label("email","Correo electrónico") !!}
					{!! Form::email("email",null,["class" => "form-control","placeholder" => "tucorreo@mail.com"]) !!}
				</div>								
				<div class="form-group">
					{!! Form::label("password","Password") !!}
					{!! Form::password("password",["class" => "form-control","placeholder" => "***********"]) !!}
				</div>
				<div class="form-group">
					{!! Form::label("password2","Repita el Password") !!}
					{!! Form::password("password2",["class" => "form-control","placeholder" => "***********"]) !!}
				</div>
			</div>
			<div class="col-xs-12">
				<center><h1><i class="fa fa-user"></i> Datos Personales</h1></center>
				<div class="form-group">
					{!! Form::label("name","Nombre(s)") !!}
					{!! Form::text("name",null,["class"=>"form-control","placeholder"=>"Nombres"]) !!}
				</div>
				<div class="form-group">
					{!! Form::label("surname","Apellido(s)") !!}
					{!! Form::text("surname",null,["class"=>"form-control","placeholder"=>"Apellidos"]) !!}
				</div>
				<div class="form-group col-xs-12 col-sm-6">
					{!! Form::label("type","Eres persona o empresa") !!}
					{!! Form::select("type",["persona" => "Persona","empresa" => "Empresa"],null,["class"=>"form-control","placeholder"=>"Persona o empresa"]) !!}
				</div>				
				<div class="form-group col-xs-12 col-sm-6">
					{!! Form::label("sex","Género") !!}
					{!! Form::select("sex",["masculino" => "Hombre", "femenino" => "Mujer", "empresa" => "Empresa"],null,["class"=>"form-control","placeholder"=>"Genero"]) !!}
				</div>
				<div class="form-group col-xs-12 col-sm-6">
					{!! Form::label("dateofbith","Fecha de Nacimiento") !!}
					{!! Form::date("dateofbith",null,["class" => "form-control"]) !!}
				</div>
				<div class="form-group col-xs-12 col-sm-6">
					{!! Form::label("estado_id","Ubicación") !!}
					{!! Form::select("estado_id",$estados,null,["class" => "form-control","placeholder" => "Selecciona"]) !!}
				</div>
				<div class="form-group col-xs-12 col-md-4">
					{!! Form::label('phones','Teléfonos') !!}
					{!! Form::text('phones',null,["class" => "form-control", "placeholder" => "Teléfonos"]) !!}
				</div>
				<div class="form-group col-xs-12 col-md-4">
					{!! Form::label('physipshop','¿Tienda Física?') !!}
					{!! Form::select('physipshop',["1" => "Si", "0" => "No"], null,["class" => "form-control", "placeholder" => "¿Eres tienda Física?"]) !!}
				</div>
				<div class="form-group col-xs-12 col-md-4">
					{!! Form::label('bill','¿Entregas Factura?') !!}
					{!! Form::select('bill', ["1" => "Si", "0" => "No"], null,["class" => "form-control", "placeholder" => "¿Entregas Factura?"]) !!}
				</div>
				<div class="form-group col-xs-12">
					{!! Form::label('description','Cuentanos algo de ti') !!}
					{!! Form::textarea('description',null,['class'=>'form-control','placeholder'=>'Opcional']) !!}
				</div>
			</div>
			<div class="pull-right">
				<a href="{{ route('siteHome') }}" class="btn btn-warning">Cancelar</a>
				{!! Form::submit("Aceptar",["class" => "btn btn-primary"]) !!}
				<br><br><br><br>
			</div>
		{!! Form::close() !!}
	</div>
	<div class="hidden-xs col-sm-1"></div>
@endsection