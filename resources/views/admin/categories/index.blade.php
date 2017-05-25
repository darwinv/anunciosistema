@extends('admin.template.main')
@section('title','Administración de Categorias')

@section('panel')
	@include('admin.template.partials.menu')
@endsection

@section('content')
	@if(count($categories)>0)
		<center><h1>Listado de Categorias</h1></center>
		<hr>
		<div>
			<a href="{{route('admin.categories.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-file"></i> Agregar</button></a>
		</div>		
		<table class="table">		
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Estatus</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
					<tr>
						<td>{{$category->id}}</td>
						<td>{{$category->name}}</td>
						<td>{{$category->status}}</td>
						<td>
							@if($category->status=="Activo")
								<a href="#" class="btn btn-sm btn-warning">{{$category->status}}</a>
							@else
								<a href="#" class="btn btn-sm btn-danger">{{$category->status}}</a>
							@endif
						</td>
						<td>						
							<a href="{{route('admin.categories.edit',$category->id)}}" class="btn btn-warning"></a>
							&nbsp;
							<a href="{{route('admin.categories.destroy',$category->id)}}" class="btn btn-danger"></a> 
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{!! $categories->render() !!}
	@else
		<h1>No hay categorias registradas</h1>
		<hr>
		<div>
			<a href="{{route('admin.categories.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-file"></i> Agregar</button></a>
		</div>		
	@endif
@endsection