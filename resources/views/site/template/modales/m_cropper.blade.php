<div class="modal fade" id="cropper" tabindex="-1" role="dialog">
	<div class="modal-dialog " >
		<div id="content" class="modal-content">
			<div class="modal-header">
				<button id="cerrar" type="button" class="close " data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title ">
					<img src="{{ asset('img/mascota.png') }}" width="50" height="51"><span
						id="usr-reg-title" class="marL15">Edita la foto de tu producto</span>
				</h3>
			</div>
			<div class="modal-body ">
				<div class="image-editor center-block ">
					<input type="file" class="cropit-image-input">
					<!-- .cropit-image-preview-container is needed for background image to work -->
					<div class="cropit-image-preview-container " style="top:0px; left:100px;">
						<div class="cropit-image-preview " >
							<div class="error-msg" style="display:none;">
							</div>
						</div>
					</div>
					<br>
					<br>
					<div class="image-size-label">Resize image</div>
					<input type="range" class="cropit-image-zoom-input">
					
				</div>
			</div>
			<div class="modal-footer">
				<button id="cambiar-foto" type="button" class="btn btn-default">Cambiar Imagen</button>
				<button id="save-foto" type="button" class="btn btn-primary"
					data-dismiss="modal">Guardar</button>
			</div>
		</div>
	</div>
</div>