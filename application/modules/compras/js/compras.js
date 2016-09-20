/*****************************************************************************
* Aplicacion: Sistema de inventario
* Modulo: Compras
* Version: 1.0
* Desarrollado por: Gerardo Del Angel Nuñez
* Correo: soporte@mireino.com
* Twitter: @geradeluxer
******************************************************************************/
;(function(){
	var Def = function(){ return constructor.apply(this,arguments); }
	var attr = Def.prototype;
	if(APP.domain)
	var url = APP.site_url+APP.domain+"/";
	else
	var url = APP.site_url+APP.domain;

	//VARIABLE PROPIAS DE USO INTERNO
	var noti = new AppNotificaciones();

	//VARIABLES OBSERVABLES
	attr.dependencias = ko.observableArray();
	attr.usuarios = ko.observableArray();
	attr.roles = ko.observableArray();

	attr.usuarioEditar = ko.observable();
	attr.rolEditar = ko.observable();
	attr.passEditar = ko.observable();

	//FUNCIONES DEL VIEWMODEL
	attr.user = {
		nuevo:function(data,e){
			attr.usuarioEditar(new Usuario({}));
			$('#nuevo-usuario').modal();
		},
		editar:function(data,e){
			attr.usuarioEditar(data);
			$('#nuevo-usuario').modal();
		},
		grabar:function(data,e){
			attr.save.usuario(data);
		},
		borrar:function(data,e){
			var user = ko.toJS(data),
				botones = {
					si_callback:function($noty){ 
						attr.delete.usuario(data);
						$noty.close();
					}
				};
			noti.confirmacion.show('¿Desea borrar el usuario <b>'+user.perfil.nombre_completo+'</b>?',botones);
		},
	}

	//FUNCIONES PARA INTERACTUAR CON API REST
	attr.load = {
		usuarios:function(){
			$.ajax({
				url: url+"compras/api/proveedor/provider",
				type: "GET",
				dataType:"json",
			beforeSend:function(XMLHttpRequest) {
			},				
			}).done(function(data,status,xhr){
				if(data.datos){
					var mapArray = $.map(data.datos, function(item) {
						return new Usuario(item);
					});
					attr.usuarios(mapArray);
				}
				
			});
		},
	};
	attr.save = {
		usuario:function(data){
			console.log(ko.toJS(data));
			$.ajax({
				url:url+"compras/api/proveedor/provider",
				type: "POST",
				dataType: "json",
				data: ko.toJS(data),
				beforeSend:function(error){
					console.log(error);
				}
			}).done(function(data,status,xhr){
				if(!data.error){
					noti.general.show(data.type,data.msg);	
					$('#nuevo-usuario').modal('hide');
					attr.usuarioEditar(new Usuario({}));
					attr.load.usuarios();
				}else{
					noti.general.show(data.type,data.msg);	
				}
			})
		}
	}
	attr.delete = {
		usuario:function(data){
			$.ajax({
				url:url+"usuarios/api/usuarios/",
				type: "DELETE",
				dataType: "json",
				data: ko.toJS(data),
			}).done(function(data,status,xhr){
				if(!data.error){
					attr.load.usuarios();
				}else{
					noti.general.show(data.type,data.msg);
				}
			});
		}
	};

	//CONSTRUCTOR
	function constructor(name){
		_init();
	}
	
	function _init(){
		//CARGA DEL MODELO, UNA VEZ CARGADO SE INICIALIZA LAS VARIABLES
		$.getScript(APP.base_url+"application/modules/compras/js/modelo.usuario.js").done(function(script,status,xhr) {
			//INICIALIZAMOS LAS VARIABLES OBSERVABLES
			attr.usuarios([]);
			attr.usuarioEditar(new Usuario({}));

			// CARGAMOS LOS USUARIOS
			attr.load.usuarios();
		});
	}

	//unleash your class
	var	modUsuarios;
	window.AppUsuarios = Def;
	modUsuarios = new AppUsuarios();
	ko.applyBindings(modUsuarios,document.getElementById("providermodule"));

})();