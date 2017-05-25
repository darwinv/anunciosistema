@extends("admin.template.main")

@section('Title','Nivel de seguridad')

@section('content')
<form action="{{route('admin.auth.post.login')}}" type="POST">
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" placeholder="tucorreo@tucorreo.com"></input>
	</div>
	<div class="form-group">
		<label for="password">Contraseña</label>
		<input type="password" class="form-control" placeholder="*********" name="password" id="password"></input>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Ingresar</button>
	</div>
</form>
@endsection