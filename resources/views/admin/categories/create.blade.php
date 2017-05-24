@extends("admin.template.main")

@section("title","Categorias - Agregar")

@section("content")
	<h1>Agregar una nueva Categoria</h1>
	<hr>
	<form action="{{route('admin.categories.store')}}" method="POST">
		<div class="form-group">
			<label for="txt-name">Nombre de la nueva categoria</label>
			<input type="text" name="txt-name" id="txt-name" class="form-control" placeholder="Nombre" />
			<hr>
			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Crear</button>
		</div>
		
	</form>
@endsection