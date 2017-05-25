<nav class="navbar navbar-inverse navbar-static-top" role="navigation ">
	<div class="container">
		<div class="navbar-header ">
			<button type="button" class=" navbar-toggle collapsed"
				data-toggle="collapse" data-target="#menuP">
				<span class="sr-only">Mostrar / Ocultar</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a href="{{ route('siteHome') }}" class="navbar-brand"> <img style=""
				class=" marT5 marB5 marL5" src="{{asset('img/logo-header.png')}}"
				width="120px;" height="50px">
			</a>
		</div>
		<div class="collapse navbar-collapse " id="menuP">
			<div class="navbar-form navbar-left">
				<div class="pad15">
					<form class="navbar-form navbar-left" role="search" action="{{ route('publications.listado') }}">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Buscar" style="margin-left: -10px; border-left: trasparent;width:300px; border-bottom-left-radius: 0px;">
							<button type="submit" class="btn-header2 btn-default-header2"><span class="glyphicon glyphicon-search"></span></button>
						</div>
					</form>								
				</div>
			</div>
			<ul class="nav navbar-nav navbar-right t16">
				<li class="marT10 hidden-xs hidden-sm">
					<div class="borderS  point eti-blanco "
						style=" height: 40px; width: 40px; border-radius: 7px;">
						<a href="">
							<img id="fotoperfilm" src="{{asset('img/users/' . Auth::user()->getPicture())}}" class="img img-responsive center-block" style="max-height: 100%; border-radius: 7px; cursor: pointer;background:white;" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Actualiza tu foto de perfil">							
						</a>
					</div>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle marT10 pointer" data-toggle="dropdown" role="button" aria-expanded="false">
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu blanco" role="menu">
						<li><a href="resumen">Mi Cuenta</a></li>
						<li><a href="{{ route('users.show',Auth::user()->id) }} ">Mi Perfil</a></li>
						<li><a href="{{ route('auth.get.logout') }}">Salir</a></li>
					</ul>
				</li>
				<li>
					<div class="vertical-line "
						style="height: 25px; margin-top: 15px;"></div>
				</li>
				<li><a href=" {{ route('publications.create') }} " data-toggle="" data-target="" class="marT10"> Publicar</a>
				</li>
				<li>
					<div class="vertical-line "
						style="height: 25px; margin-top: 15px;"></div>
				</li>
				<li id="notificacion" data-id="" class="dropdown"><a data-toggle="dropdown" role="button" class="dropdown-toggle marT10 pointer" aria-expanded="false"
					style=""></span><i class="fa fa-bell"></i>  </a>
					<ul class="dropdown-menu blanco alertas" role="menu">
						<li id="" class="noti-hover " style="cursor: pointer;">
							<a class="" style="overflow: hidden;">
								<div style="display: inline-block;   ">
									<div style="padding-bottom: 5px;"><img src="" width="50px" height="50px"></div>
								</div>
								<div style="display:inline-block;    width: 145px; " >
									<div class="marL10" >						
										<b ></b>
									
										<br>
										<span class="grisC t12"></span>							
									</div>									
								</div>
								
								<div style="display: inline-block;  ">
									<div class="marL10"><p><span class="grisC opacity t10"></span></p></div>
								</div>
							</a>
						</li>				
				</ul>
				</li>							
				<li><a href="favoritos" data-toggle="" data-target="" class="marT10"><i
						class="fa fa-heart"></i> </a></li>
						<li><a data-toggle="modal" data-target="#contacto" class="marT10 pointer"><i
						class="fa fa-envelope"></i> </a></li>
				<li class="hidden"><a data-toggle="modal" data-target="#ayuda" class="marT10 pointer"><i
						class="fa fa-question-circle"></i> </a></li>
			</ul>
		</div>
	</div>
</nav>