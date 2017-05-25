@extends("admin.template.main")

@section('Title','Nivel de seguridad')

@section('content')
<!-- Este bloque se utilizara cuando instalemos el helper form
{!! Form::open(['route'=>'admin.auth.get.login','method'=>'POST']) !!}
	<div class="form-group">
		{!! Form::label('email','Correo electronico') !!}
		{!! Form::email('email',null,['class'=>'form-control','placeholder'=>'tucorreo@tuservidor.com']) !!}		
	</div>
	<div class="form-group">
		{!! Form::label('password','Contraseña') !!}
		{!! Form::password('password',['class'=>'form-control','placeholder'=>'*********']) !!}
	</div>
{!! Form::close() !!}
-->

<form>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" placeholder="tucorreo@tucorreo.com"></input>
	</div>
	<div class="form-group">
		<label for="password">Contraseña</label>
		<input type="password" placeholder="*********"></input>
	</div>
</form>
@endsection