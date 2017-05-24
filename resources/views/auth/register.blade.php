@extends("site.template.main")
@section('title','Crear un nuevo usuario')

@section('content')
	<form action="{{route('auth.post.register')}}" method="POST">
		<div> <!-- Datos de acceso-->
			<h1>Datos de Acceso</h1>
			<div class="form-group">
				<label for="name">Nombre</label>
				<input type="text" class="form-control" name="name" id="name" placeholder="Nombre del usuario" />
			</div>
			<div class="form-group">
				<label for="email">Correo electrónico</label>
				<input type="email" class="form-control" name="email" id="email" placeholder="tucorreo@mail.com" />
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" id="password" placeholder="**********" />
			</div>
		</div>		
		<div> <!-- Botones-->
			<input type="submit" class="btn btn-primary" value="Aceptar"></input>
		</div>
	</form>
@endsection