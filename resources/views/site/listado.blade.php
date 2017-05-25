@extends('site.template.main')

@section('title','Listado de publicaciones')

@section('content')
	<div class="container">
		<div class="row">			
			 <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12' style="display:none">
                  <div class='alert alert-warning2  text-left' role='alert'   >
                      <img src="galeria/img/logos/bill-error.png" width="120px" height="120px;" class="pull-left" style="margin-top:-10px;"/>
                       <div class="t16 marL20 marB5 ">No se encontraron resultados de tu busqueda.</div>
                       <span class="t12 marL30 grisO">
							<i class="fa fa-caret-right marR10"></i> Verifica la ortografia en cada palabra.
                       </span>
                       <br>
					   <span class="t12 marL30 grisO">	
							<i class="fa fa-caret-right marR10"></i> Utiliza palabras m&aacute;s estandares.
					   </span>	
					   <br>
					   <span class="t12 marL30 grisO">	
							<i class="fa fa-caret-right marR10"></i> utiliza categorias m&aacute;s especificas para mejorar la busqueda.
					   </span>	
					   <br>	
					   <span class="t12 marL30 grisO">	
							<i class="fa fa-caret-right marR10"></i> No se hallaron publicaciones relacionadas a tu selecci&oacute;n.
					   </span>	
                  </div>  
                  <br>
                  <div class="anchoC center-block">
                       	<br>
                       	<br>
                        Categorias
                        <br>
                        <br>
                  </div>                   
            </div>
			<!-- Filtros -->
			<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 resultados" > <!-- ocultar cuando no hay resultados -->
				<div class="marL5 marT5 marB5  contenedor">
					<div class="marL10">
						<div id="categorias">
							<br>
							<h5 class="negro"><b>Categorias</b></h5>
							<hr class="marR5">
						</div>
						<ul class="nav marR5 t11  marT10 marB20 ">
							<li class='marB10 t11'>
								<div  class='h-gris'>
									<div style='padding:2px; '>
										<a class='grisO' href='#'>
											<span class='blue-vin'>TODOS (10)
										</a>
									</div>
								</div>
							</li>
							@foreach($categories as $category)
								<li class='marB10 t11'>
									<div  class='h-gris'>
										<div style='padding:2px; '>
											<a class='grisO' href='#'>
												<span class='blue-vin'>{{ $category->name }} (10)
											</a>
										</div>
									</div>
								</li>
							@endforeach
						</ul>
						
						<div id="ubicacion">
							<h5 class="negro" ><b>Ubicación</b></h5>
							<hr class="marR5">
						</div>
						<ul class="nav marR5 marT10 marB20 t11  ">
							<li class='marB10 t11'>
								<div  class='h-gris'>
									<div style='padding:2px; '>
										<a class='grisO' href='#'>
											<span class='blue-vin'>TODOS (10)
										</a>
									</div>
								</div>
							</li>
							@foreach($estados as $estado)
								<li class='marB10 t11'>
									<div  class='h-gris'>
										<div style='padding:2px; '>
											<a class='grisO' href='#'>
												<span class='blue-vin'>{{ $estado->name }} (5)
											</a>
										</div>
									</div>
								</li>
							@endforeach
						</ul>
						
						<div id="condicion">								
							<h5 class="negro" ><b>Condición</b></h5>
							<hr class="marR5">						
						</div>
						<ul class="nav marR5 marT10 marB20 t11">
							<li class='marB10 t11'>
								<div  class='h-gris'>
									<div style='padding:2px; '>
										<a class='grisO' href='#'>
											<span class='blue-vin'>TODOS (10)
										</a>
									</div>
								</div>
							</li>
							<li class='marB10 t11'>
								<div  class='h-gris'>
									<div style='padding:2px; '>
										<a class='grisO' href='#'>
											<span class='blue-vin'>Nuevo (2)
										</a>
									</div>
								</div>
							</li>
							<li class='marB10 t11'>
								<div  class='h-gris'>
									<div style='padding:2px; '>
										<a class='grisO' href='#'>
											<span class='blue-vin'>Usados (4)
										</a>
									</div>
								</div>
							</li>
							<li class='marB10 t11'>
								<div  class='h-gris'>
									<div style='padding:2px; '>
										<a class='grisO' href='#'>
											<span class='blue-vin'>Servicio (2)
										</a>
									</div>
								</div>
							</li>
							<li class='marB10 t11'>
								<div  class='h-gris'>
									<div style='padding:2px; '>
										<a class='grisO' href='#'>
											<span class='blue-vin'>Mascotas (2)
										</a>
									</div>
								</div>
							</li>
						</ul>
						<br>
					</div>
				</div>
			</div>
			<!-- Listado -->
			<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 resultados" > <!-- ocultar si no hay resultados -->
				<div class="mar5 contenedor row">
					<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 text-left vin-blue ">
						<!-- mostrar la busqueda o donde esta segun lo q selecciono y almaceno en la variable de busqueda 2 y contar seria la cantidad de resultados obtenidos segun la busqueda -->
						<div class="marL20 t14"><p style="margin-top:15px;"> 
							<span class="grisC"> 1 - 20  de </span>100
							<span class="grisC">100</span>
							<span class="marR5 grisC"> resultados</span>
							<a href="index.php" style="color:#000" class="marL5">Inicio </a> 
							<i class="fa fa-caret-right negro marR5 marL5"></i>
							Computación en Táchira <i class='fa fa-caret-right negro marR5 marL5'></i>
							<span class='f-condicion t10' style='padding:4px;'>laCondicion</span>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 ">
						<div class=" marR20" style="margin-top:10px;" id="orden">
							<select id="filtro"  class="form-control  input-sm " style="width:auto;"  >
								<option value='id_desc' selected>Mas Recientes</option>
							    <option value='id_asc' selected>Menos Recientes</option>
								<option value='monto_desc' selected>Mayor Precio</option>							
								<option value='monto_asc' selected>Menor Precio</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<hr class="marL10 marR10">
						<br>
					</div>
							
					<div id="ajaxContainer" border="3" >
						<!-- Listado filas -->
						@foreach($publications as $publication)
							<div class=' col-xs-12 col-sm-6 col-md-2 col-lg-2'>
								<div class='marco-foto-conf  point marL20  ' style='height:130px; width: 130px;'  >
									<div style='position:absolute; left:40px; top:10px; ' class='f-condicion'> {{ $publication->getCondition() }} </div>
									<a href="{{ route('publications.show',$publication->id) }}"><img src=' {{ asset($publication->images->first()->route) }} ' class='img img-responsive center-block img-apdp imagen' style='width:100%;height:100%;'>
								</div>
							</div>
							<div class=' col-xs-12 col-sm-6 col-md-7 col-lg-7'>
								<div class='t16 marL10 marT5'>
									<span class=' t15'>
										<a class='negro' href='detalle.php' class='grisO'><b> {{ $publication->title }}</b></a>
									</span>
									<br>
									<span class=' vin-blue t14'>
										<a href='{{ route('users.show',$publication->user->id) }}' class=''><b> {{ $publication->user->seudonimo }}</b></a>
									</span>
									<br>
									<span class='t14 grisO '> {{ $publication->user->getFullName() }} </span>
									<br>
									<span class='t12 grisO '>
										<i class='glyphicon glyphicon-time t14  opacity'></i> {{ $publication->created_at }}
									</span>
									<br>
									<span class='t11 grisO'> 
										<span> 
											<i class='fa fa-eye negro opacity'></i>
										</span>
										<span class='marL5'>{{ $publication->getViews() }} </span>
										<i class='fa fa-heart negro marL5 opacity'></i>
										<span class=' point h-under marL5'>
											{{ $publication->getLikes() }} Me gusta
										</span>
										<i class='fa fa-share-alt negro marL15 opacity hidden'></i>
										<span class=' point h-under marL5 hidden'>
											100 Veces compartido
										</span> 
									</span>
								</div>
							</div>
							<div class=' col-xs-12 col-sm-12 col-md-3 col-lg-3 text-right'>
								<div class='marR20'>
									<span class='red t20'>
										Bs. <b> {{ $publication->price }}</b>
									</span >
									<br>
									<span class=' t12'> {{ $publication->user->estado()->first()->name }} </span>
									<br>
									<span class='vin-blue t16'>
										<a href='{{ route("publications.show",$publication->id) }}' style='text-decoration:underline;'>Ver Mas</a>
									</span >
								</div>
							</div>
							<div class="col-xs-12"></div>
						@endforeach
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-2'>
							<br>
						</div>
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-10'>
							<hr class='marR10'><br>
						</div>
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 '>
							<center>
								{!! $publications->render() !!}
							</center>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection