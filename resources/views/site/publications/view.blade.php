@extends('site.template.main')
@section('title',$publication->title)
@section('js')
	<script>
		$(document).ready(function(){
			$(".img-detalle").on('click','a',function(e){
				e.preventDefault();
				$('#image-center').attr("src","./../../" + $(this).data("route"));
				$('.img-detalle').find('img').addClass("opacity");
				$(this).find('img').removeClass("opacity");
			});			
		});
	</script>
@endsection
@section('content')
	<div class="hidden-xs col-sm-1"></div>
	<div class="col-xs-12 col-sm-11 contenedor pad10">
		<div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
			<div class="marB10 marT10 text-center"> 
				<span class="t30 negro titulo-pub">{{ $publication->title }}</span> 
                <br>				
                <span class="t20">-- <i class="fa fa-tag"></i> {{ $publication->getCondition() }} --</span>  
            </div>                        
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
			<div class="contenedor">  
				<div class=" col-xs-12 col-sm-12 col-md-7 col-lg-7 ">   
					<div class="visor-imagenes">
							<div class="col-xs-1"></div>
							{!! $opaco="" !!}
							@foreach($publication->images as $image)
								<div class="col-xs-2 pad5">
									<div class="img-detalle">
										<a href="#" data-route='{{ $image->route }}'><img class="img-responsive {{ $opaco }}" src="{{ asset($image->route) }}"/></a>
									</div>
								</div>
								<?php $opaco="opacity"; ?>
							@endforeach
							<div class="col-xs-1"></div>
							<div class="col-xs-12"></div>
							<div class="hidden-xs col-sm-1 col-md-1 col-lg-2"></div>
							<div class="col-xs-12 col-sm-10 col-md-10 col-lg-8 pad10 center-block">
								<a href='#wows1_1' title='ip6_1'>
									<img id="image-center" src="{{ asset($publication->images->first()->route) }}" alt='' style="width:100%;height:auto;" />
								</a>
							</div>
							<div class="hidden-xs col-sm-1 col-md-1 col-lg-2"></div>							
						</div>
					</div>	
				</div>
				<div class=" col-xs-12 col-sm-12 col-md-5 col-lg-5 ">
					<div class=" mar-detalle-comprar">
						<br>	
						<br>
						<div style="width:90%" class="marL10">
							 <br><br><br>
							 <p class="monto-comprar ">
								<span><b>$COP {{ number_format( $publication->price , 2) }}</b></span>
							</p>
							<p class="items-comprar  " >
								<span>
									 <i class="fa fa-check-square t22 grisC" style="width:30px;"></i> 
									 <span>{{ $publication->created_at }}</span>
								</span>
								<br>
								<span>
									  <i class="fa fa-university t22 grisC" style="width:30px;"></i>
									  <span>
											@if($publication->user->physipshop)
												El vendedor es <span class="negro">Tienda Fisica</span>
											@else
												El vendedor no es <span class="negro">Tienda Fisica</span>
											@endif
									  </span>
								</span>
								<br>
								<span>
									  <i class="fa fa-file-text-o t22 grisC" style="width:30px;"></i>
									  <span>
											@if($publication->user->bill)
												El vendedor entrega <span class="negro">Factura Fiscal</span>
											@else
												El vendedor no entrega <span class="negro">Factura Fiscal</span>
											@endif
									  </span>
								</span>
							</p>
							<br>
							<div class="text-boton-compra ">
								<div class="t16">
									<span class="t30 negro">Datos de Contacto</span> <br>
									<i class="fa fa-user grisC" style="width:30px;"></i> {{ $publication->user->getFullName() }} <br>
									<i class="fa fa-phone grisC" style="width:30px;"></i> {{ $publication->user->phones }}<br>
									<i class="fa fa-envelope grisC" style="width:30px;"></i> {{ $publication->user->email }}<br>
								</div>
								<br class="hidden-lg hidden-md hidden-sm">
								<br class="hidden-lg hidden-md hidden-sm">
								<div style='display: inline;' class='marL10 iconos'>
									<a class='point'>
										<i class='fa fa-heart show-dropdown' ></i> {{ $publication->getLikes() }}
									</a>
								</div>
								<div style="display: inline;" class="marL5 iconos">
									<a class="point">
										<i class="fa fa-facebook-square "></i>
									</a>
								</div>
								<div style="display: inline;" class="marL5 iconos">
									<a class="point"><i class="fa fa-twitter-square ">
										</i>
									</a>
								</div>
							</div>
							<hr style="width:100%" class="marB5">
							<div class="text-center">
								<span class="t14 vin-blue">
									<a class="point">Recomendaciones</a> <br> <a href="terminos">Terminos y condiciones</a> 
								</span>
							</div> 
							<br>
							<span class="t14 vin-blue"></span>
							<br>
							<br>
						</div>
					</div>
				</div>
            </div>
            <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">  
                <div class="marB10 marT10 text-center"> 
                    <span class="t30 negro">Informacion del vendedor</span> 
                    <br> 
                    <span class="t16">-- <i class="fa fa-map-marker"></i> {{ $publication->user->estado->first()->name }} --
					</span>  
                </div>
            </div>
            <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">  
				<div class="contenedor row mar-detalle-comprar " style=" padding:15px;">
					<div class="pull-left  col-xs-12 col-sm-6 col-md-3 col-lg-3 marB10 ">
						<div class="text-center">
							 <a href="#">
									<img src="{{asset('img/users/' . $publication->user->getPicture())}}" width="45%" height="45%"  class="img-thumbnail img-circle sombra-div" >
							 </a>
							 <br>
							 <br>
							 <span class="t16 vin-blue">
									<b><a href="#" class="texto-seudonimo" > {{ $publication->user->seudonimo }}</a></b>
							 </span> 
							 <br> 
							 <span class="t14" >
									{{ $publication->user->role }}
							 </span>   
							 <br>
							 <span class="t12 orange-apdp" >
									<b>{{ $publication->created_at }}</b> vendiendo con nosotros
							 </span>
						</div>
					 </div>
					 <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 marB10">
						 <div class="marR20 marL5 text-justify pad15" >
							 <div class="t16  blueO-apdp"><b>Biografia</b></div> 
							 <br> 
							 <div class="t12 " ><i class="fa fa-quote-left"></i> <span class="grisC">{{ $publication->user->description }}</span> <i class="fa fa-quote-right"></i></div>
						  </div>
					 </div>
			   </div>
           </div>
           <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12  marB10">
               <div class="marB10 marT10 text-center"> 
                     <span class="t30 negro">Descripcion de la publicaci&oacute;n</span> 
                     <br>
                     <span class="t30">-- <i class="fa fa-tags"></i> {{ $publication->category->name }} --</span> 
               </div>
           </div>
           <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12  marB10"> 
               <div class=" contenedor pad20  t16 text-justify mar-detalle-comprar " >                        	
                     <p class=" opacity t14 ">
                      	  Sistema Calderon no asume ninguna responsabilidad por la informaci&oacuten contenida en este anuncio<span class="hidden-md hidden-sm hidden-lg blue "> <a class="point" id="vermas" name="vermas">Ver mas informaci&oacute;n...</a></span> 
                          <span class="hidden-xs" id="parrafo" name="parrafo">, 
                          ya que ha sido suministrada en su totalidad por el usuario aqu&iacute identificado. Sistema Calderon, no es el propietario
                          ni vende los art&iacute;culos aqu&iacute ofrecidos y no participa en ninguna negociaci&oacuten, venta o perfeccionamiento de operaciones, 
                          sino que s&oacutelo se limita a la publicaci&oacuten y/o alojamiento de anuncios de sus usuarios. Sistema Calderon, no asume 
                          responsabilidad por da&ntildeos o perjuicios que pudiere sufrir el usuario o visitante por operaciones sobre anuncios publicados en el sitio.
                          </span>
                         <span class="blue hidden hidden-md hidden-sm hidden-lg"><a class="point" id="ocultar" name="ocultar">Ocultar</a></span>
                      </p>
                      <hr>
                      <br> 
					  <div class="img-descripcion">
							{{ $publication->description }}
					  </div>
               </div>
            </div>
<!-- seccion de preguntas  --------------------------------------------------------------------------------------------------------------->
            <div class=" hidden-xs col-sm-12 col-md-12 col-lg-12  marB10">
               <div class="marB10 marT10 text-center"> 
                   <span class="t30 negro">Preguntas al vendedor</span> 
               </div>
               <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12  marB10">
                   <div class=" contenedor mar-detalle-comprar pad20  t14">                        	
                        <div style="background:#D8DFEA; padding:10px; padding: 20px; border:1px solid #ccc">
                        	<div style="background: #FFF">
                        		<textarea lang="5" class="form-textarea-msj2 preguntas "  placeholder="Indica tu duda o pregunta ... " id="txtPregunta" name="txtPregunta"></textarea>            
                        		<p class="text-right marR10 t10" id="restante" name="restante">240</p>
                        	</div>
							<div style="text-align: left;">
								<button class="btn2 btn-default marT5 marL10" >Limpiar</button> 
								<button class="btn2 btn-primary2 marT5 marL5"></button>
								<span class="marL5 t10 grisC">no uses lenguaje vulgar por que sera supendida tu cuenta.</span>
							</div>
						</div>	
						<br>
						<div class="contenedor" id="preguntas" name="preguntas">
							<div style="background: #FFF; margin-top: -10px; width: 140px;" class="marR20 text-center pull-right"> <span>Ultimas Preguntas</span></div>
							<div class="alert alert-info hidden" style="padding: 4px; margin: 5px; margin-left: 20px; margin-right:10px;">hola</div>
							<p class="t14 marL20 marR20" style="border-bottom: #ccc 1px dashed;">
								<br>
								<i class="fa fa-comment blueO-apdp marL10"></i> <span class="marL5">Pregunta</span>
								<br>
								<i class="fa fa-comments-o marL20 blueC-apdp">
								</i> <span class="marL5 > Respuesta </span> <span class="opacity t12">  Respuesta 2 </span>
								<br>	
								<br>						
							</p>
							<br><br>
						</div>
                    </div>
                </div>
			</div>
			<!-- FIN de seccion de preguntas ------------------------------->
		</div>
	</div>
 @endsection