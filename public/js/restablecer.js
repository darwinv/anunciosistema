$(document ).ready(function() {
/* Validador de Formulario de recuperar contrase�a */	
$('#rec-clave-submit').click(function(){ 
		$("#restablecer-password").data('formValidation').validate();
});


$('#recover-password').formValidation({
		locale: 'es_ES',
		excluded: ':disabled',
		framework : 'bootstrap',
		icon : {
			valid : 'glyphicon glyphicon-ok',
			invalid : 'glyphicon glyphicon-remove',
			validating : 'glyphicon glyphicon-refresh'
		},
		addOns: { i18n: {} },
		err: { container: 'tooltip' },
		fields : {			
			rec_usuario : {validators : {
				notEmpty : {},
				blank: {}}}
		}
	}).on('success.field.fv', function(e, data) {
        if (data.fv.getInvalidFields().length > 0) {    // There is invalid field
            data.fv.disableSubmitButtons(true);
        }
    }).on('err.form.fv', function(e,data) {
    	//$(".dropdown-toggle").dropdown('toggle');
    }).on('success.form.fv', function(e) {
		e.preventDefault();
		//var url=$(this).data("url");
		//var sendurl="&url="+url;
		var form = $(e.target);
		var fv = form.data('formValidation');
		var method = "&method=recover";
		$.ajax({
			url: form.attr('action'), // la URL para la peticion
           data: form.serialize() + method, // la informacion a enviar
            type: 'POST', // especifica si será una peticion POST o GET
            dataType: 'json', // el tipo de informacion que se espera de respuesta            
            success: function (data) {            	
            	// codigo a ejecutar si la peticion es satisfactoria;
            	// codigo a ejecutar si la peticion es satisfactoria;
            	// console.log(data);
	            if (data.result === 'error'){
	            	for (var field in data.fields) {
	        			fv
	                    // Show the custom message
	                    .updateMessage(field, 'blank', data.fields[field])
	                    // Set the field as invalid
	                    .updateStatus(field, 'INVALID', 'blank');
	        			setTimeout(function(){
	        				$("#"+field).focus();	       			
	        			}, 10);
	            	}
	            	$(".dropdown-toggle").dropdown('toggle');
	            	
	            } else if(data.result==="Actualice") {
					elId=data.id;
	            	$("#actualizar").modal('show');
	            } else{
	            	swal({
						title: "Excelente", 
						text: "Sigue las instrucciones que aparecen en el correo.",
						imageUrl: "galeria/img/logos/bill-ok.png",
						timer: 2000, 
						showConfirmButton: true
						}, function(){
							location.reload();
										
						});
                } 
          	},// codigo a ejecutar si la peticion falla;
            error: function (xhr, status) {
            	SweetError(status);
            }
        });
	});	
	
		
	$('#restablecer-password').formValidation({
		locale: 'es_ES',
		excluded: ':disabled',
		framework : 'bootstrap',
		icon : {
			valid : 'glyphicon glyphicon-ok',
			invalid : 'glyphicon glyphicon-remove',
			validating : 'glyphicon glyphicon-refresh'
		},
		addOns: { i18n: {} },
		err: { container: 'tooltip' },
		fields : {			
			rec_clave : {validators : {
				notEmpty : {},
				stringLength : {min:6,max : 64}}},
			rec_clave2 : {validators : {
				identical: {field: 'rec_clave'}}}
		}
	}).on('success.field.fv', function(e, data) {
        if (data.fv.getInvalidFields().length > 0) {    // There is invalid field
            data.fv.disableSubmitButtons(true);
        }
    }).on('err.form.fv', function(e,data) {
    	//$(".dropdown-toggle").dropdown('toggle');
    }).on('success.form.fv', function(e) {
		e.preventDefault();
		var user=$(this).data("user");
		var senduser="&usuario="+user;
		var form = $(e.target);
		var fv = form.data('formValidation');
		var method = "&method=restablecer";
		$.ajax({
			url: form.attr('action'), // la URL para la peticion
           data: form.serialize() + method + senduser, // la informacion a enviar
            type: 'POST', // especifica si será una peticion POST o GET
            dataType: 'json', // el tipo de informacion que se espera de respuesta            
            success: function (data) {            	
            	// codigo a ejecutar si la peticion es satisfactoria;
            	// codigo a ejecutar si la peticion es satisfactoria;
            	// console.log(data);
	            if (data.result === 'error'){
	            	for (var field in data.fields) {
	        			fv
	                    // Show the custom message
	                    .updateMessage(field, 'blank', data.fields[field])
	                    // Set the field as invalid
	                    .updateStatus(field, 'INVALID', 'blank');
	        			setTimeout(function(){
	        				$("#"+field).focus();	       			
	        			}, 10);
	            	}
	            	
	            }  else{
	            	swal({
						title: "Exito", 
						text: "Se actualizo correctamente.",
						imageUrl: "galeria/img/logos/bill-ok.png",
						timer: 2000, 
						showConfirmButton: true
						}, function(){
							window.location.href = "index";
										
						});
                } 
          	},// codigo a ejecutar si la peticion falla;
            error: function (xhr, status) {
            	SweetError(status);
            }
        });
	});	
});
