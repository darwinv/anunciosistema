@extends('site.template.main')
@section('title','Home | Clasificados')

@section('content')
	<div class="hidden-xs col-sm-2"></div>
<div class="container-fluid">
	<div class="col-xs-12">
							<ul class="nav navbar-nav">
									<li><a href="#"><i class="fa fa-home"></i></a>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Proyectos de Vivienda</a>
										<ul class="dropdown-menu">
												<li><a href="#">Link</a></li>
												<li><a href="#">Link</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Anuncios en arriendo</a>
										<ul class="dropdown-menu">
												<li><a href="#">Link</a></li>
												<li><a href="#">Link</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Anuncios en Venta</a>
										<ul class="dropdown-menu">
												<li><a href="#">Link</a></li>
												<li><a href="#">Link</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Buscar Por</a>
										<ul class="dropdown-menu">
												<li><a href="#">Link</a></li>
												<li><a href="#">Link</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Servicio al Cliente</a>
										<ul class="dropdown-menu">
												<li><a href="#">Link</a></li>
												<li><a href="#">Link</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Mi cuenta</a>
										<ul class="dropdown-menu">
												<li><a href="#">Link</a></li>
												<li><a href="#">Link</a></li>
										</ul>
									</li>
							</ul>
			 </div>
</div>
<div class="container-fluid text-center">


	<div class="col-xs-12 col-sm-12 ">
		<!-- CATEGORIAS BEGIN -->
		
		<div class="col-xs-12" >
			<div id="DivHomeSearch" class="DivHomeSearch">
            <!--search contenedor-->
                <div class="container">
                    <div class="clear"></div>
                    <div class="col-xs-12 searchbox">
                        <h1 class="text-center TitleBusqueda h1">Realiza tu búsqueda aquí</h1>
                        <!--tabs-->  
                        <div class="navbar-form">
                            <div class="form-group">
                              <div id="divContainerCategories" class="form-control w140" style="padding:0px 0px !important;">
                                <div class="dropdown-check-list" style="padding:0px 6px !important;">          
                                    <span class="anchor" style="padding:11px 0px !important;" onclick="DisplayOptions(this);">¿Qué buscas?</span>
                                    <div id="ddlCategories" binding="Category1Id" class="drop" style="margin: 2px -7px 6px -7px !important;">
                                        <ul id="ddlCategoriesVivienda" class="items">
                                            <li style="font-weight:bold" catheader="true" class="li">
                                                <label for="">Vivienda</label>
                                            </li>
                                                                               
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory8" value="8" type="checkbox">
                                                        <label>Apartamento</label>
                                                    </li>
                                                                                   
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory22" value="22" type="checkbox">
                                                        <label>Apartaestudio</label>
                                                    </li>
                                                                                   
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory20" value="20" type="checkbox">
                                                        <label>Cabaña</label>
                                                    </li>
                                                                                   
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory9" value="9" type="checkbox">
                                                        <label>Casa</label>
                                                    </li>
                                                                                   
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory21" value="21" type="checkbox">
                                                        <label>Casa Campestre</label>
                                                    </li>
                                                                                   
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory23" value="23" type="checkbox">
                                                        <label>Casa Lote</label>
                                                    </li>
                                                                                   
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory7" value="7" type="checkbox">
                                                        <label>Finca</label>
                                                    </li>
                                                                                   
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory10" value="10" type="checkbox">
                                                        <label>Habitación</label>
                                                    </li>
                                                                                   
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory2" value="2" type="checkbox">
                                                        <label>Lote</label>
                                                    </li>
                                                                                   
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory24" value="24" type="checkbox">
                                                        <label>Parqueadero</label>
                                                    </li>
                                                                          
                                        </ul>
				                        <ul id="ddlCategoriesComerciales" class="items">
                                            <li style="font-weight:bold" catheader="true" class="li">
                                                <label for="">Oficinas, locales y bodegas</label>
                                            </li>
                                                                               
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory5" value="5" type="checkbox">
                                                        <label>Bodega</label>
                                                    </li>
                                                                                   
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory18" value="18" type="checkbox">
                                                        <label>Consultorio</label>
                                                    </li>
                                                                                   
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory19" value="19" type="checkbox">
                                                        <label>Edificio</label>
                                                    </li>
                                                                                   
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory3" value="3" type="checkbox">
                                                        <label>Local</label>
                                                    </li>
                                                                                   
                                                    
                                                    <li li-selected="False" class="li" onclick="SelectCategoryItem(this);">
                                                        <input id="chkCategory4" value="4" type="checkbox">
                                                        <label>Oficina</label>
                                                    </li>
                                                   
                                        </ul>                
                                    </div>             
                                </div>
                              </div>       
                            </div>     
                            <div class="form-group">
                                <div id="divContainerTransaction" class="form-control w190" style="padding:0px 0px !important;">
                                    <div class="dropdown-check-list" style="padding:0px 6px !important;"> 
                                        <span class="anchor" style="padding:11px 0px !important;" onclick="DisplayOptions(this);">Venta</span>
                                        <div class="drop_offer" style="margin: 2px -7px 6px -7px !important;">
                                            <ul id="ddlTransactionType" binding="TransactionId" class="items offer">
                                                
                                                    
                                                        <li value="1" onclick="SelectTransactionItem(this, true);" li-selected="True" class="li liSelected">Venta</li>
                                                    
                                                    
                                                        <li value="2" onclick="SelectTransactionItem(this, true);" li-selected="False" class="li">Arriendo</li>
                                                    
                                                    
                                                        <li value="3" onclick="SelectTransactionItem(this, true);" li-selected="False" class="li">Alquiler Vacacional</li>
                                                                  
                                            </ul>
                                        </div>
                                    </div>
                              </div>
                            </div>
                            <div class="form-group">
                                <div class="contentSearch">             
                                    <div class="search-text">
                                        <div id="divContainerTxtWord" style="position:relative;">
                                            <input type="hidden" id="HidLocationIds">
                                            <input type="hidden" id="HidLocationName">
                                            <input type="hidden" id="HidLocationNameFull">
                                            <input type="hidden" id="HidLocationNameTex">                           
                                            <input id="txtWord" onkeypress="searchKeyPress(event);" name="search_term" class="form-control" onblur="onblurTxtWord();" onclick="this.select();" type="text" placeholder="¿Dónde?">
                                            <div id="divResultsLocation" style="display:none;" class="contenedor_texto_busqueda">
                                                <div id="divResultsLocationDepartment">
                                                    <div class="titulos_zona_busqueda">Departamento</div>
                                                </div>
                                                <div id="divResultsLocationCity">
                                                    <div class="titulos_zona_busqueda">Ciudad</div>
                                                </div>
                                                <div id="divResultsLocationsector">
                                                    <div class="titulos_zona_busqueda">Zona</div>
                                                </div>
                                                <div id="divResultsLocationNeighborhood">
                                                    <div class="titulos_zona_busqueda">Barrio</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>     
                            </div>
                            <div class="form-group">
                                <button id="btnSearchAdvert" type="button" class="btn-search" onclick="javascript:btnSearchAdvert_onClick()"><i class="fa fa-search"></i>Buscar</button>    
                            </div>
                            <!--checkbox oculto -->
                            <div class="hidden-xs" style="display:none !important;">
                                <div class="checkbox">
                                    <input id="chkProyectosViviendaNueva" type="checkbox">
                                    <label for="chkProyectosViviendaNueva">Buscó proyectos de vivienda nueva</label>
                                </div>
                            </div>                                
                        </div>      
                        <!--Checkbox-->
                        <div class="visible-xs">
                            <div class="checkbox">
                                <input id="chkProyectosNuevos" type="checkbox" onclick="ProyectosNuevosCheck(this);">
                                <label for="chkProyectosNuevos">Mostrar proyectos nuevos</label>
                            </div>
                        </div>
                        <div id="search-code" class="search-code">
                            <input id="txtCode" type="text" class="form-control" placeholder="Buscar por código de inmueble" onkeypress="javascript:txtCode_onKeyUp(event);" onclick="this.select();">
                            <a id="boton_buscar_codigo" href="javascript:btnSearchAdvertCode_onClick()"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    
                    <div class="clear"></div>
                </div>
  </div></div>


		<!-- CATEGORIAS END -->
		<div class="col-xs-12">
			<br>
		</div>
		<!-- ULTIMAS PUBLICACIONES BEGIN -->
		<div class="col-xs-12 ">
			<center><h1>Ultimas publicaciones</h1></center>
			@foreach($publications as $publication)
				@if($publication->status=='Activo')
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-body">
								<a href="{{ route('publications.show',$publication->id) }}"><img alt="" src="{{asset('img/publications/' . $publication->images->first()->name . '.' . $publication->images->first()->extention)}}" class="img img-responsive img-publicar2" /></a>
							</div>
							<div class="panel-footer t14">
								<span class="red t20 right-align">Bs. {{ $publication->price }}</span><br>
								{{ $publication->title }}<br>
								<a href="{{ route('users.show',$publication->user->id) }}">{{ $publication->user->seudonimo }}</a><br>
								{{ $publication->user->estado()->first()->name }}<br>
								<span class="t12">
									<i class="fa fa-eye"></i> 34 / <i class="fa fa-thumbs-up"></i> 50 Me gusta
								</span>
							</div>
						</div>
					</div>
				@endif
			@endforeach
		</div>
		<!-- ULTIMAS PUBLICACIONES END -->
		<div class="col-xs-12 content-home">
            <div class="left news">                
                <div class="sm-box box" style="height: 440px;clear:both">
                    <h2 class="box-title h2-news">Especiales de Alquiler de pisos y casas</h2>
                    <div class="box-content left link-news_2">
                        <h3 class="normal h3-news">                              
                            <a href="#" href="/mi_casa_ya_nuevo_programa_de_vivienda_para_la_clase_media-noticia-483.aspx" title="Ver Requisitos y Proyectos que aplican a Mi Casa Ya">MI Casa Ya, programa de vivienda </a>
                        </h3>                                 
                        <span class="span">
                        Conoce todos los requisitos e información importante sobre los nuevos programas para vivienda hasta los 93 millones <a href="#" href="/mi_casa_ya_nuevo_programa_de_vivienda_para_la_clase_media-noticia-483.aspx" title="Ver Requisitos Mi Casa Ya">Mi Casa Ya-Cuota Inicial</a>  y para viviendas hasta los 231 millones <a href="#" href="/en_que_consiste_el_nuevo_programa_mi_casa_ya_subsidio_tasa_de_interes-noticia-591.aspx" title="Ver Requisitos Mi Casa Ya Subsidio a la Tasa de Interés">Mi Casa Ya-Subsidio a la Tasa de Interés.</a>  
                        Estos programas otorgan subsidios a la cuota inicial y la tasa de interés. Utilice nuestra <a href="#" href="/encuentre_proyectos_de_mi_casa_ya_en_este_portal-noticia-543.aspx" title="Ver Requisitos Mi Casa Ya Subsidio a la Tasa de Interés">guía</a> para encontrar proyectos que aplican a los programas Mi Casa Ya en nuestro portal o acceda directamente a nuestro listado de <a href="#" href="/proyectos-vivienda-nueva/?ad=30|1|||||||||||||||||||||MCY|||||1|||1||random_17%20asc||2||-1" title="Ver Requisitos Mi Casa Ya Subsidio a la Tasa de Interés">proyectos mi casa ya.</a>
                        </span>                
                    </div>
                    <div class="box-content left link-news_2">
                        <h3 class="normal h3-news">
                            <a href="#" href="/inmuebles-comerciales.aspx" title="Ver Especial Inmuebles Comerciales">Las mejores ofertas en inmuebles comerciales</a>
                        </h3>    
                        <span class="span">
                            Descubra las más diversas alternativas de inmuebles comerciales como oficinas, locales y 
                            consultorios en nuestro <a href="#" href="/inmuebles-comerciales.aspx" title="Ver Especial Inmuebles Comerciales">especial virtual</a>. Donde podrá encontrar información de precios, 
                            áreas y otras características de los inmuebles.
                        </span>                            
                    </div>
                    <div class="box-content left link-news_2">
                        <h3 class="normal h3-news">
                            <a href="#" href="/como_comprar_vivienda_de_interes_social_-noticia-263.aspx" title="Ver noticia Viviendas de Interés Social" target="_blank">¿Cómo comprar Vivienda
                                de Interés Social?</a></h3>
                        <span class="span">Acceder a un subsidio de vivienda es posible, gracias a los aportes
                            del Gobierno Nacional y de las Cajas de Compensación Familiar, que son las entidades
                            encargadas de otorgar por una sola vez al beneficiario, una suma de dinero, que
                            se constituye en un complemento del ahorro y de los recursos para adquirir, construir
                            en sitio propio o mejorar una vivienda.
                            <br>
                            Para consultar los proyectos de Vivienda Interés Social ingrese al <a href="#" href="/proyectos__viviendas-interes-social.aspx" title="Ver Proyectos de Vivienda de Interés Social" target="_blank">
                                especial de proyectos VIS</a>, de nuestro portal Alquilerdepisosycasas.com. </span>
                    </div>
                </div>
            </div>
            <div class="left news"> 
                <div id="homeNews" class="home-news">
                                        
                    <div class="news-box">
                        <h2 class="box-title">
                        Noticias inmobiliarias</h2> 
                        
                                <div class="box-content left link-news" itemscope="" itemtype="https://schema.org/NewsArticle" style="width:290px;">
                                    <figure itemprop="image" itemscope="" itemtype="https://schema.org/ImageObject" style="margin:0px;">
                                        <img class="left" src="{{asset('img/news/casa.jpg')}}" width="150" height="112" itemprop="url">
                                        <meta itemprop="width" content="150">
                                        <meta itemprop="height" content="112">
                                    </figure>
                                    <h3 class="normal h3-news" itemprop="headline"><a href="#" href="/manzana-verde-la-mejor-forma-de-vivir-en-un-ambiente-natural-noticia-741.aspx" itemprop="mainEntityOfPage">Manzana Verde la mejor forma de vivir en un ambiente natural </a></h3>
                                    <span class="span" itemprop="description">Manzana Verde Apartamentos de 9 pisos, sistema sismo resistente, terraza, gimnasio, zona social e infantil. La mejor inversión para su familia en cedritos.</span>               
                                    <!--informacion articulo-->
                                    <meta itemprop="author" content="Alquilerdepisosycasas.com">
                                    <div itemprop="publisher" itemscope="" itemtype="https://schema.org/Organization">
                                        <meta itemprop="name" content="Alquilerdepisosycasas.com">
                                        <div itemprop="logo" itemscope="" itemtype="https://schema.org/ImageObject">
                                            <meta itemprop="url" content="/App_Theme/images/mailing/23_12_16_0_508.png">
                                        </div>
                                    </div>
                                    <meta itemprop="datePublished" content="5/5/2017 7:36:23 PM">
                                    <meta itemprop="dateModified" content="5/12/2017 1:48:50 PM">                    
                                </div>
                            
                                <div class="box-content left link-news" itemscope="" itemtype="https://schema.org/NewsArticle" style="width:290px;border-right:none">
                                    <figure itemprop="image" itemscope="" itemtype="https://schema.org/ImageObject" style="margin:0px;">
                                        <img class="left" src="{{asset('img/news/casa.jpg')}}" width="150" height="112" itemprop="url">
                                        <meta itemprop="width" content="150">
                                        <meta itemprop="height" content="112">
                                    </figure>
                                    <h3 class="normal h3-news" itemprop="headline"><a href="#" href="/mtreinta-el-mejor-proyecto-para-invertir-en-ibague-noticia-736.aspx" itemprop="mainEntityOfPage">M-treinta, el mejor proyecto para invertir en Ibagué </a></h3>
                                    <span class="span" itemprop="description">En uno de los mejores sectores de Ibagué, se construye M-treinta, una torre de 26 pisos con vivienda y locales comerciales que se constituye en una gran oportunidad de inversión.</span>               
                                    <!--informacion articulo-->
                                    <meta itemprop="author" content="Alquilerdepisosycasas.com">
                                    <div itemprop="publisher" itemscope="" itemtype="https://schema.org/Organization">
                                        <meta itemprop="name" content="Alquilerdepisosycasas.com">
                                        <div itemprop="logo" itemscope="" itemtype="https://schema.org/ImageObject">
                                            <meta itemprop="url" content="/App_Theme/images/mailing/23_12_16_0_508.png">
                                        </div>
                                    </div>
                                    <meta itemprop="datePublished" content="4/11/2017 6:03:50 PM">
                                    <meta itemprop="dateModified" content="5/25/2017 8:46:06 PM">                    
                                </div>
                            
                    </div>
                    </div>
                </div>
        </div>
        <br><br>
		</div>
	</div>
	<div class="hidden-xs col-sm-1"></div>
@endsection
