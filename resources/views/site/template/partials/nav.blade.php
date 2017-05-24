<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header ">
			<button type="button" class=" navbar-toggle collapsed"
				data-toggle="collapse" data-target="#menuP">
				<span class="sr-only">Mostrar / Ocultar</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a href="{{ route('siteHome') }}" class="navbar-brand"> <img style=""
				class="marT5 marB5 marL5" src="{{asset('img/logo-header.png')}}"
				width="120px;" height="50px">
			</a>
		</div>
		<div class="collapse navbar-collapse" id="menuP">
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
			{!! Form::open(['url' => route('auth.post.login'), 'method' => 'POST']) !!}
			<form id="usr-log-form" name="usr-log-form" action="fcn/f_usuarios.php" method="POST">
				<ul class="nav navbar-nav navbar-right t16">
					<li>
						<a class="marT10 alert-reg point" href="{{route('auth.get.register')}}"> Inscribete <span class="glyphicon glyphicon-log-in"></span>
						</a>
					</li>
					<li class="dropdown"><a class="dropdown-toggle marT10 pointer" data-toggle="dropdown" role="button" aria-expanded="false"> 
						Ingresa <span class="glyphicon glyphicon-user"></span>
					</a>
						<ul class="dropdown-menu dropdown-menu-log " role="menu">
							<li style="padding: 12px;">Inicia Sessi&oacute;n</li>
							<li style="padding: 10px;">
							<div class="form-group">
								{!! Form::text('email',null,["class" => "form-input", "placeholder" => "Email o seudonimo"]) !!}
							</div>
							</li>
							<li style="padding: 10px;">
								<div class="form-group">
									{!! Form::password('password',["class" => "form-input", "placeholder" => "************"]) !!}
								</div>
								<p class="text-right t10 marR5 vin-blue">
								<a class="pointer" data-toggle="modal" data-target="#recover">&#191;Olvidaste la Contrase&#241;a?</a></p>
							</li>
							<li style="padding: 10px; margin-top: -20px">
								{!! Form::submit('Ingresar',['class' => 'btn2 btn-primary2 btn-group-justified']) !!}
								<br>
								<button id="fb_log_button" class="btn2 btn-facebook btn-group-justified marT5 t12">Ingresar con Facebook</button>
								<button id="tw_log_button" class="btn2 btn-twitter btn-group-justified marT5 t12">Ingresar con Twitter</button>
							</li>
							<li class="divider"></li>
							<li style="padding: 10px;"><p class="t12 text-center">&#191;Eres
									nuevo en Clasificados.com?</p>
								<button class="btn2 btn-default btn-group-justified " data-toggle="modal" data-target="#actualizar2">Inscribete</button></li>
						</ul></li>
				</ul>
			{!! Form::close() !!}
		</div>
		</div>
</nav>
<script type="text/javascript" src="../js/restablecer.js"></script>