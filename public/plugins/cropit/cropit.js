/**
 * JavaScript: Cropit
 */

$(document).ready(function(){
		
	var rutaP=$("#img-portada").data("rP");	
	$('.image-editor').cropit({
		exportZoom: 0.75,
		imageBackground: true,
		imageBackgroundBorderWidth: 25,
		smallImage: 'reject',
		maxZoom: 2,
		freeMove: false,
		//imageSrc: 'galeria/img/fondos/portada.png',
		onImageError: function(e) {
            if (e.code === 1) {
                $('.error-msg').text("Por favor selecciona una imagen que tenga un minimo de " + ($('.cropit-image-preview').outerWidth()-250) + "px de ancho * " + ($('.cropit-image-preview').outerHeight()-100) + "px de alto.");
                $('.error-msg').css("display","block");
                $('.cropit-image-preview').addClass("has-error");      
                $(".image-editor").cropit("imageSrc", 'iconpagina.png');             
            }
        }	
	});
		
	$("#cambiar-foto").click(function(){
		$('.error-msg').css("display","none");
        $('.cropit-image-preview').removeClass("has-error");
		$('.cropit-image-input').click();
	});	
	
	$("#cerrar").click(function(){
		$('.error-msg').css("display","none");
         $('.cropit-image-preview').removeClass("has-error");
	});
	$(".modal").mouseleave(function(){
		$('.error-msg').css("display","none");
        $('.cropit-image-preview').removeClass("has-error");
	});
	$('#save-foto').click(function() {
		var imageData = $('.image-editor').cropit('export');
		var numero=$(this).data("nro");
		if(numero === undefined){
			var count = 1;
			$('.foto').each(function(i, obj) {
				if($(this).children("img").attr("id") === undefined){
					$(this).css("background","transparent");
					$(this).children("img").attr("src",imageData);
					$(this).children("img").attr("id",count);
					$(this).children("i").removeClass('hidden');
					$("#arrastrar").addClass("hidden");
					return false;
				}
				count++;
			});
		}else{
			$("#" + numero).css("background","transparent");
			$("#"+numero).parent().css("background","transparent");		
			$(".foto").children("img#" + numero).attr("src",imageData);
			$("#"+numero).next().removeClass('hidden');
			$(this).removeData("nro");
		
		}
		if($("#imagenes").val()===""){
			$("#imagenes").val(imageData);
		}else{
			$("#imagenes").val($("#imagenes").val() + "CUSTOM-SEPARATOR-IVAN" + imageData);
		}
	});
	$("div#imagenes-publicaciones").on("click", ".foto", function(e) {
		if($(e.target).is('i')){
			var index = $(this);
			$(this).children("img").removeAttr('src');
			$(this).children("img").removeAttr("id");
            $(this).children("i").addClass('hidden');
            $(this).css("background","");
			$('.foto').each(function(i, obj){
				if($(this).children("img").attr("src") === undefined && $(this).next().children("img").attr("src") !== undefined){
					$(this).children("img").attr("src",$(this).next().children("img").attr("src"));
					$(this).css("background","transparent");
					$(this).children("img").attr("id",i+1);
					$(this).children("i").removeClass('hidden');
					$(this).next().children("img").removeAttr("src");
					$(this).next().children("img").removeAttr("id");
		            $(this).next().children("i").addClass('hidden');
		            $(this).next().css("background","");
				}
			});
        }else{
			$("#cropper").modal("show");
        	var numero = $(this).children("img").attr("id");
			if(numero !== undefined){
				$("#save-foto").data("nro",numero);
			}
			$('.cropit-image-input').click();
        }		
	});	
});