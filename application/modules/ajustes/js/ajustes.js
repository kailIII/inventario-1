/*****************************************************************************
* Aplicacion: Sistema Deluxer
* Desarrollado por: Gerardo Del Angel Nuñez
* Correo: sistemadeluxer@mireino.com
* Twitter: @sistemadeluxer
******************************************************************************/
$(document).ready(function(){
	
	var noti = new AppNotificaciones();
	var url = APP.site_url;	

	// $('#p_fb #formPage .fbPage').click(function(){
	// 	var page = $("form#formPage #page").val();
		
	// 	if(!page){
	// 		noti.general.show("error","Inserte su nombre de página de facebook");
	// 		return false;
	// 	}

	// 	$.ajax({
	// 		url:url+"ajustes/api/datos/pagefb",
	// 		data:{"page":page},
	// 		type:"post",
	// 		datatype:"json",
	// 	}).done(function(res){
	// 		console.log(res);
	// 		noti.general.show(res.type,res.msg);
	// 		if(res.datos){
	// 		}
	// 	});
	// });


	var Def = function(){return constructor.apply(this,arguments); }
	var attr = Def.prototype;
	if(APP.domain)
	var url = APP.site_url+APP.domain+"/";
	else
	var url = APP.site_url+APP.domain;
	var url_img = APP.site_url;

	//VARIABLE PROPIAS DE USO INTERNO
	var noti = new AppNotificaciones();

	//VARIABLES OBSERVABLES
	attr.avatares = ko.observableArray();
	attr.editar = ko.observable();
	attr.folios = ko.observableArray();
	attr.sucursales = ko.observableArray();
	attr.estados = ko.observableArray();
	attr.ciudades = ko.observableArray();
	
	attr.socialEdit = ko.observable();
	attr.folioEditar = ko.observable();	
	attr.avatarEditar = ko.observable();
	attr.usuarioEditar = ko.observable();
	attr.sucursalEditar = ko.observable();

	//FUNCIONES DEL VIEWMODEL
	attr.perfil = {
		editar:function(data,e){
			attr.editar(true);
		},
		grabar:function(data,e){
			attr.save.perfil(data);
		},
		chavatar:function(data,e){
			$('#modal-nuevo-avatar').modal();
		},
		avatar_nuevo_default:function(data,e){
			attr.save.avatar_default_nuevo(data);
		},
		avatar_nuevo_propio:function(data,e){
			//AQUI VA PARA PODER CAMBIAR EL PERFIL SELECCIONANDOLO
			//DE UN ARCHIVO DE LA PC
		}
	};
	attr.social = {
		editar:function(data,e){
			attr.editar(true);
			$("#social #PageF .page_f").keyup(function(event){
				  if ( event.keyCode == 13 ) {
				     event.preventDefault();
				  }
				$(this).parent().parent().find("span > small > label").html($(this).val())
			});

		},
		grabar:function(data,e){
			attr.save.social(data);
		},
	}
	attr.folio = {
		nuevo:function(data,e){
			attr.folioEditar(new Folio({}));
			$('#nuevo-usuario').modal();
		},
		editar:function(data,e){
			attr.folioEditar(data);
			$('#nuevo-usuario').modal();
		},
		grabar:function(data,e){
			attr.save.folio(data);
		},
		borrar:function(data,e){
			var list = ko.toJS(data),
				botones = {
					si_callback:function($noty){ 
						attr.delete.folio(data);
						$noty.close();
					}
				};
			noti.confirmacion.show('¿Desea borrar el consecutivo <b>'+list.serie+'</b>?',botones);
		}
	}
	attr.sucursal = {
		nuevo:function(){
			attr.sucursalEditar(new Sucursal({}));
			attr.load.ciudades(0); //resetea las ciudades
			$('#nueva-sucursal').modal();
		},
		editar:function(data,e){
			var val=ko.toJS(data);

			attr.sucursalEditar(new Sucursal(val));
			//crea un nuevo option, coloca solo la ciudad correspondinte
			var opt = new Option(val.city_name, val.city);
			$("#city").append(opt);
			opt.setAttribute("selected","selected");
			// Asigna el valor a la ciudad, ya que en la parte de arriba solo lo coloca, pero no le proporciona un "value"
			attr.sucursalEditar().city(val.city);
			
			$('#nueva-sucursal').modal();

		},
		grabar:function(data,e){
			attr.save.sucursal(data);
		},
		borrar:function(data,e){
			var list = ko.toJS(data),
				botones = {
					si_callback:function($noty){ 
						attr.delete.sucursal(data);
						$noty.close();
					}
				};
			noti.confirmacion.show('¿Desea borrar la sucursal <b>'+list.name+'</b>?',botones);
		}
	}
	attr.save = {
		perfil:function(data){
			//AQUI COMBINAMOS LOS OBJETOS DE USAURIO Y PASS, PORQUE AL MANDARLOS SEPARADOS
			//LA VALIDACION NO FUNCIONABA.
			var infoClient = ko.toJS(data);

			$.ajax({
				url: url+"ajustes/api/datos/infoClient",
				type: "POST",
				dataType:"json",
				data: ko.toJS(infoClient),					
			}).done(function(data,status,xhr){
				if(!data.error){
					attr.editar(false);
				}else{
					noti.general.show(data.type,data.msg);
				}
			});
		},
		avatar_default_nuevo:function(data){
			data.id(attr.avatarEditar().id());
			$.ajax({
				url: url+"ajustes/api/datos/logo",
				type: "POST",
				dataType:"json",
				data: ko.toJS(data),
			}).done(function(data,status,xhr){
				if(!data.error){
					attr.editar(false);
					attr.load.perfil();	
				}else{
					noti.general.show(data.type,data.msg);
				}
			});
		},
		social:function (data) {
			$.ajax({
				url:url+"ajustes/api/social/netsocial",
				data:ko.toJS(data),
				type:"post",
				datatype:"json",
				beforeSend:function(error){
				},				
			}).done(function(res){
				noti.general.show(res.type,res.msg);
				if(res.datos){
					attr.editar(false);
				}
			});
		},
		folio:function(data){
			$.ajax({
				url:url+"ajustes/api/datos/folio",
				type: "POST",
				dataType: "json",
				data: ko.toJS(data),
				beforeSend:function(error){
				}
			}).done(function(data,status,xhr){
				if(!data.error){
					noti.general.show(data.type,data.msg);	
					$('#nuevo-usuario').modal('hide');
					attr.folioEditar(new Folio({}));
					attr.load.folios();
				}else{
					noti.general.show(data.type,data.msg);	
				}
			})
		},
		sucursal:function(data){
			$.ajax({
				url:url+"ajustes/api/datos/sucursal",
				type: "POST",
				dataType: "json",
				data: ko.toJS(data),
				beforeSend:function(error){
				}
			}).done(function(data,status,xhr){
				if(!data.error){
					noti.general.show(data.type,data.msg);	
					$('#nueva-sucursal').modal('hide');
					attr.sucursales(new Sucursal({}));
					attr.load.sucursales();
				}else{
					noti.general.show(data.type,data.msg);	
				}
			})
		}

	}

	attr.load = {
		perfil:function(){
			$.ajax({
				url: url+"ajustes/api/datos/infoClient",
				type: "GET",
				dataType:"json",
				beforeSend:function(XMLHttpRequest){
				}
			}).done(function(data,status,xhr){
				if(!data.error){
					var item = data.datos;
					attr.usuarioEditar(new infoSubsidiary(item));
					attr.avatarEditar(new Avatar(data.datos));
				}else{
					 noti.general.show(data.type,data.msg);
				}
			});
		},
		avatares:function(){
			$.ajax({
				url: url+"ajustes/api/datos/logo",
				type: "GET",
				dataType:"json",
			}).done(function(data,status,xhr){
				if(!data.error){
					var mapArray = $.map(data.datos, function(item) {
						return new Avatar(item);
					});
					attr.avatares(mapArray);
				}else{
					// noti.general.show(data.type,data.msg);
				}
			});
		},
		social:function(){
			$.ajax({
				url: url+"ajustes/api/social/netsocial",
				type: "GET",
				dataType:"json",
			}).done(function(data,status,xhr){
				if(!data.error){
					attr.socialEdit(new Social(data.datos));
				}else{
					// noti.general.show(data.type,data.msg);
				}
			});			
		},
		folios:function(){
			$.ajax({
				url: url+"ajustes/api/datos/folio",
				type: "GET",
				dataType:"json",
			beforeSend:function(XMLHttpRequest) {
			},				
			}).done(function(data,status,xhr){
				var mapArray = $.map(data.datos, function(item) {
					return new Folio(item);
				});
				attr.folios(mapArray);
				
			});
		},
		sucursales:function(){
			$.ajax({
				url: url+"ajustes/api/datos/sucursal",
				type: "GET",
				dataType:"json",
			beforeSend:function(XMLHttpRequest) {
			},
			}).done(function(data,status,xhr){
				var mapArray = $.map(data.datos, function(item) {
					return new Sucursal(item);
				});
				attr.sucursales(mapArray);
				
			});
		},
		estados:function(){
			$.ajax({
				url: url+"ajustes/api/datos/state",
				type: "GET",
				dataType:"json",
			beforeSend:function(XMLHttpRequest) {
			},				
			}).done(function(data,status,xhr){
				var mapArray = $.map(data.datos, function(item) {
					return new Estado_Ciudad(item);
				});
				attr.estados(mapArray);
				
			});
		},
		ciudades:function(state_id){
			var data=ko.toJS(state_id?state_id:0);
			
			if($.isNumeric(data.state_id))
			state_id=data.state_id;

			if(!$.isNumeric(state_id))
			state_id=0;

			$.ajax({
				url: url+"ajustes/api/datos/town",
				data:{"state":state_id},
				type: "GET",
				dataType:"json",
			beforeSend:function(XMLHttpRequest) {
			},				
			}).done(function(data,status,xhr){
				var mapArray = $.map(data.datos, function(item) {
					return new Estado_Ciudad(item);
				});
				attr.ciudades(mapArray);

			});
		}
	}
	attr.selecTown = {
		
		search:function(data){
			var state=ko.toJS(data);
			//esto vuelve a colocar los datos en el modal, esto para resetaer ciudad y pueda cambiar cuando se seleccione un estado.
			attr.sucursalEditar(state);

			attr.load.ciudades(state.state_id);
		},
	}	
	attr.delete = {
		folio:function(data){
			$.ajax({
				url:url+"ajustes/api/datos/folio",
				type: "DELETE",
				dataType: "json",
				data: ko.toJS(data),
				beforeSend:function(XMLHttpRequest) {
				},					
			}).done(function(data,status,xhr){
				if(!data.error){
					attr.load.folios();
				}else{
					noti.general.show(data.type,data.msg);
				}
			});
		},
		sucursal:function(data){
			$.ajax({
				url:url+"ajustes/api/datos/sucursal",
				type: "DELETE",
				dataType: "json",
				data: ko.toJS(data),
				beforeSend:function(XMLHttpRequest) {
				},					
			}).done(function(data,status,xhr){
				if(!data.error){
					attr.load.sucursales();
				}else{
					noti.general.show(data.type,data.msg);
				}
			});
		},		
	};	
	$('#uploadImg').fileUploadUI({
	    uploadTable: $('#_iP'),
	    downloadTable: $('#_iP'),
	    buildUploadRow: function (files, index) {
		        return $('<tr><td>image<\/td>' +
		        '<td class     ="file_upload_progress"><div><\/div><\/td>' +
		        '<td class     ="file_upload_cancel">' +
		        '<button class ="ui-state-default ui-corner-all" title="Cancel">' +
		        '<span class   ="ui-icon ui-icon-cancel">Cancel<\/span>' +
		        '<\/button><\/td><\/tr>');
	    },
	    buildDownloadRow: function (file) {
	    	attr.load.avatares();
	    },
	});
	
	$(document).on("click","#_iP span.delete",function(){
	    var img=$(this);
	    var _ref = img.find("i").text();
	    $.ajax({
	        url: url+"ajustes/api/datos/delete",
	        type: 'POST',
	        dataType: 'json',
	        data: {_ref: _ref},
	        success:function(res){
	            $(img).parent().remove();
				noti.general.show(res.type,res.msg);
	        }
	    });
	    
	});
	
	//CONSTRUCTOR
	function constructor(name){
		_init();
	}
	function _init(){
		//CARGA DE LOS MODELOS, UNA VEZ CARGADO SE INICIALIZA LAS VARIABLES
		var deps = [ 
			APP.base_url+"application/modules/ajustes/js/modelo.avatar.js"
        ];
		$.getScripts(deps,function() {
			//INICIALIZAMOS LAS VARIABLES OBSERVABLES
			attr.avatares([]);
			attr.editar(false);

			attr.avatarEditar(new Avatar({}));
			attr.usuarioEditar(new infoSubsidiary({}));
			//CARGAMOS EL PERFIL DE USUARIO
			attr.load.perfil();
			attr.load.avatares();
			attr.load.social();
			attr.load.folios();
			attr.load.sucursales();
			attr.load.estados();
		});
	}
	var	modInfo;
	window.AppInfo = Def;
	modInfo = new AppInfo();
	ko.applyBindings(modInfo,document.getElementById("modTool"));	
});
