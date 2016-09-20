/*****************************************************************************
* Aplicacion: Framework de Desarrollo
* Modulo: Usuarios
* Version: 1.0
* Desarrollado por: 
* Correo: 
* Twitter: 
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
	attr.Subsidiary = ko.observableArray();

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
		recuperar:function(data,e){
			attr.delete.usuario(data);
		},
		pass:function (data,e) {
			var pass_user = {
				id: data.id(),
				nombre:data.perfil.nombre_completo(),
				pass:'',
				repass:''
			};
			attr.passEditar(new Pass(pass_user));
			$("#modal-nuevo-pass").modal();
		},
		pass_grabar:function(data,e){
			attr.save.pass(data);
		}
	}

	attr.rol = {
		borrar:function(data,e){
			var rol = ko.toJS(data),
				botones = {
					si_callback:function($noty){ 
						attr.delete.rol(data);
						$noty.close();
					}
				};
			noti.confirmacion.show('¿Desea borrar el rol <b>'+rol.name+'</b>?',botones);
		},
		nuevo:function(data,e){
			attr.rolEditar(new Rol({}));
			$('#modal-nuevo-rol').modal();
		},
		grabar:function(data,e){
			attr.save.rol(data);
		}
	}

	//FUNCIONES PARA INTERACTUAR CON API REST
	attr.load = {
		// dependencias:function(){
		// 	$.ajax({
		// 		url: APP.site_url+"api/dependencias/",
		// 		type: "GET",
		// 		dataType:"json"
		// 	}).done(function(data,status,xhr){
		// 		var mapArray = $.map(data.datos, function(item) {
		// 			return new Dependencia(item);
		// 		});
		// 		attr.dependencias(mapArray);
		// 	});
		// },
		usuarios:function(){
			$.ajax({
				url: url+"usuarios/api/usuarios/",
				type: "GET",
				dataType:"json",
			beforeSend:function(XMLHttpRequest) {
				 console.log(XMLHttpRequest);
			},				
			}).done(function(data,status,xhr){
				var mapArray = $.map(data.datos, function(item) {
					item.perfil = new Perfil(item.profile);
					return new Usuario(item);
				});
				attr.usuarios(mapArray);
				
			});
		},
		roles:function(){
			$.ajax({
				url: url+"usuarios/api/usuarios_roles/",
				type: "GET",
				dataType: "json"
			}).done(function(data,status,xhr){
				var mapArray = $.map(data.datos, function(item){

					return new Rol(item);
				});
				// al={"id":1,"name":"gera","parent_id":5};
				// console.log(alArray);
				// attr.roles(al);
				attr.roles(mapArray);

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
					return new Selections(item);
				});
				attr.Subsidiary(mapArray);
				
			});
		},
	};
	attr.save = {
		pass:function(data){
			$.ajax({
				url:url+"usuarios/api/usuarios/cambiar_pass",
				type: "POST",
				dataType: "json",
				data: ko.toJS(data)
			}).done(function(data,status,xhr){
				if(!data.error){
					$('#modal-nuevo-pass').modal('hide');
					attr.passEditar(new Pass({}));
					attr.load.usuarios();
				}else{
					noti.general.show(data.type,data.msg);
				}
			});
		},
		usuario:function(data){
			$.ajax({
				url:url+"usuarios/api/usuarios/",
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
		},
		rol:function(data){
			$.ajax({
				url:url+"usuarios/api/usuarios_roles/",
				type: "POST",
				dataType: "json",
				data: ko.toJS(data)
			}).done(function(data,status,xhr){
				if(!data.error){
					$('#modal-nuevo-rol').modal('hide');
					attr.rolEditar(new Rol({}));
					attr.load.roles();
				}else{
					noti.general.show(data.type,data.msg);
				}
			});
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
		},
		rol:function(data){
			$.ajax({
				url:url+"usuarios/api/usuarios_roles/",
				type: "DELETE",
				dataType: "json",
				data: ko.toJS(data),
			}).done(function(data,status,xhr){
				if(!data.error){
					attr.load.roles();
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
		$.getScript(APP.base_url+"application/modules/usuarios/js/modelo.usuario.js").done(function(script,status,xhr) {
			//INICIALIZAMOS LAS VARIABLES OBSERVABLES
			attr.dependencias([]);
			attr.usuarios([]);
			attr.roles([]);
			attr.usuarioEditar(new Usuario({}));
			attr.rolEditar(new Rol({}));
			attr.passEditar(new Pass({}));

			// CARGAMOS LOS USUARIOS
			attr.load.roles();
			attr.load.usuarios();
			attr.load.sucursales();
		});
	}

	//unleash your class
	var	modUsuarios;
	window.AppUsuarios = Def;
	modUsuarios = new AppUsuarios();
	ko.applyBindings(modUsuarios,document.getElementById("usermodule"));

})();