@extends("site.template.main")
@section('title',$user->name . ' ' . $user->surname)

@section('content')
	<div class="hidden-xs col-sm-3"></div>
	<div class="col-xs-12 col-sm-8 contenedor pad10">
		<div class="col-xs-12">
			<div class="col-xs-6 col-sm-4 pad10">
				<div class="panel panel-default">
					<div class="panel-body">
						<a href="http://sistemacalderon.aba.ae" target="_blank"><img alt="" src="{{asset('img/sistemacalderon.jpg')}}" class="img img-responsive img-publicar2" /></a>
					</div>
					<div class="panel-footer t16">
						<a href="http://sistemacalderon.aba.ae" target="_blank"> Sistemacalderon</a>
					</div>
				</div>			
			</div>
			<div class="hidden-xs col-xs-4"></div>
			<div class="col-xs-6 col-sm-4 pad10">
				<div class="panel panel-default">
					<div class="panel-body">
						<a href="#"><img alt="" src="{{asset('img/users/' . Auth::user()->getPicture())}}" class="img img-responsive img-publicar2" /></a>
					</div>
					<div class="panel-footer t16">
						<a href="#">Cambiar la foto</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12">
			<center><h1>Mi Perfil</h1></center>
			<hr>
		</div>
		{!! Form::open(['url' => route('users.update',$user->id),'method' => 'PUT' ]) !!}
			<div class="col-xs-12">
				<center><h1><i class="fa fa-lock"></i> Datos de acceso</h1></center>			
				<div class="form-group">
					{!! Form::label("seudonimo","Seudonimo") !!}
					{!! Form::text("seudonimo",$user->seudonimo,["class" => "form-control","placeholder" => "Seudonimo"]) !!}
				</div>
				<div class="form-group">
					{!! Form::label("email","Correo electrónico") !!}
					{!! Form::email("email",$user->email,["class" => "form-control","placeholder" => "tucorreo@mail.com"]) !!}
				</div>
				<a href="#" class="btn btn-primary">Cambiar la clave</a>
			</div>
			<div class="col-xs-12">
				<center><h1><i class="fa fa-user"></i> Datos Personales</h1></center>
				<div class="form-group">
					{!! Form::label("name","Nombre(s)") !!}
					{!! Form::text("name",$user->name,["class"=>"form-control","placeholder"=>"Nombres"]) !!}
				</div>
				<div class="form-group">
					{!! Form::label("surname","Apellido(s)") !!}
					{!! Form::text("surname",$user->surname,["class"=>"form-control","placeholder"=>"Apellidos"]) !!}
				</div>
				<div class="form-group col-xs-12 col-sm-6">
					{!! Form::label("type","Eres persona o empresa") !!}
					{!! Form::select("type",["Persona" => "Persona","Empresa" => "Empresa"],$user->type,["class"=>"form-control","placeholder"=>"Persona o empresa"]) !!}
				</div>				
				<div class="form-group col-xs-12 col-sm-6">
					{!! Form::label("sex","Género") !!}
					{!! Form::select("sex",["Masculino" => "Hombre", "Femenino" => "Mujer", "Empresa" => "Empresa"],$user->sex,["class"=>"form-control","placeholder"=>"Genero"]) !!}
				</div>
				<div class="form-group col-xs-12 col-sm-6">
					{!! Form::label("dateofbith","Fecha de Nacimiento") !!}
					{!! Form::date("dateofbith",$user->dateofbith,["class" => "form-control"]) !!}
				</div>
				<div class="form-group col-xs-12 col-sm-6">
					{!! Form::label("estado_id","Ubicación") !!}
					{!! Form::select("estado_id",$estados,$user->estados_id,["class" => "form-control"]) !!}
				</div>
				<div class="form-group col-xs-12 col-md-4">
					{!! Form::label('phones','Teléfonos') !!}
					{!! Form::text('phones',$user->phones,["class" => "form-control", "placeholder" => "Teléfonos"]) !!}
				</div>
				<div class="form-group col-xs-12 col-md-4">
					{!! Form::label('physipshop','¿Tienda Física?') !!}
					{!! Form::select('physipshop',["1" => "Si", "0" => "No"], $user->physipshop,["class" => "form-control", "placeholder" => "¿Eres tienda Física?"]) !!}
				</div>
				<div class="form-group col-xs-12 col-md-4">
					{!! Form::label('bill','¿Entregas Factura?') !!}
					{!! Form::select('bill', ["1" => "Si", "0" => "No"], $user->bill,["class" => "form-control", "placeholder" => "¿Entregas Factura?"]) !!}
				</div>
				<div class="form-group col-xs-12">
					{!! Form::label('description','Cuentanos algo de ti') !!}
					{!! Form::textarea('description',$user->description,['class'=>'form-control','placeholder'=>'Opcional']) !!}
				</div>				
			</div>
			<div class="pull-right">
				<a href="{{ route('siteHome') }}" class="btn btn-warning">Cancelar</a>
				{!! Form::submit("Actualizar",["class" => "btn btn-primary"]) !!}
				<br><br><br><br>
			</div>
		{!! Form::close() !!}
	</div>
	<div class="hidden-xs col-sm-1"></div>
@endsection