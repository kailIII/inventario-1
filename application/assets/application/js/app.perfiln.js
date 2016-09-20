/*****************************************************************************
* Aplicacion: Framework de Desarrollo
* Modulo: Perfil de Usuario
* Version: 1.0
* Desarrollado por: Javier Peña
* Correo: geradeluxer@gmail.com
* Twitter: @geradeluxer
******************************************************************************/
;(function(){
	var Def = function(){return constructor.apply(this,arguments); }
	var attr = Def.prototype;

	//VARIABLE PROPIAS DE USO INTERNO
	var noti = new AppNotificaciones();

	//VARIABLES OBSERVABLES
	attr.avatares = ko.observableArray();
	attr.editar = ko.observable();

	attr.avatarEditar = ko.observable();
	attr.usuarioEditar = ko.observable();
	attr.passEditar = ko.observable();



	//FUNCIONES DEL VIEWMODEL
	attr.perfil = {
		editar:function(data,e){
			attr.editar(true);
		},
		grabar:function(data,e){
			attr.save.perfil(data);
		},
		avatar:function(data,e){
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

	attr.save = {
		perfil:function(data){
			//AQUI COMBINAMOS LOS OBJETOS DE USAURIO Y PASS, PORQUE AL MANDARLOS SEPARADOS
			//LA VALIDACION NO FUNCIONABA.
			var usuario = ko.toJS(data),
				pass = ko.toJS(attr.passEditar),
				data_send = $.extend({}, usuario, pass);

			$.ajax({
				url: APP.site_url+APP.domain+"/usuarios/api/perfil/",
				type: "POST",
				dataType:"json",
				data: ko.toJS(data_send),
				beforeSend:function(error){
					// console.log(error);
				},
			}).done(function(data,status,xhr){
				// console.log(data);
				if(!data.error){
					attr.editar(false);
					attr.load.perfil();	
				}else{
					noti.general.show(data.type,data.msg);
				}
			});
		},
		avatar_default_nuevo:function(data){
			data.id(attr.avatarEditar().id());
			$.ajax({
				url: APP.site_url+APP.domain+"/usuarios/api/avatar/",
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
		}
	}

	attr.user = {
		editar:function(data,e){
			console.log("Editar Usuario");
			attr.usuarioEditar(data);
			$('#modalNewUser').modal();
		},
		grabar:function(data,e){
			console.log("Grabar Usuario");
			attr.save.usuario(data);
		},
	}

	attr.load = {
		perfil:function(){
			$.ajax({
				url: APP.site_url+APP.domain+"/usuarios/api/perfil/",
				type: "GET",
				dataType:"json"
			}).done(function(data,status,xhr){
				// console.log(data.datos.profile);
				
				if(!data.error){
					var item = data.datos;
					item.perfil = new Perfil(data.datos.profile);
					attr.usuarioEditar(new Usuario(item));
					attr.avatarEditar(new Avatar(data.datos.profile));
				}else{
					noti.general.show(data.type,data.msg);
				}
			});
		},
		avatares:function(){
			$.ajax({
				url: APP.site_url+APP.domain+"/usuarios/api/avatar/default",
				type: "GET",
				dataType:"json"
			}).done(function(data,status,xhr){
				if(!data.error){
					var mapArray = $.map(data.datos, function(item) {
						return new Avatar(item);
					});
					attr.avatares(mapArray);
				}else{
					noti.general.show(data.type,data.msg);
				}
			});
		}
	}

	//CONSTRUCTOR
	function constructor(name){
		_init();
	}
	function _init(){
		//CARGA DE LOS MODELOS, UNA VEZ CARGADO SE INICIALIZA LAS VARIABLES
		var deps = [ 
			APP.base_url+"application/modules/usuarios/js/models.js",
			APP.base_url+"application/modules/usuarios/js/modelo.avatar.js"
        ];
		$.getScripts(deps,function() {
			//INICIALIZAMOS LAS VARIABLES OBSERVABLES
			attr.avatares([]);
			attr.editar(false);

			attr.avatarEditar(new Avatar({}));
			attr.usuarioEditar(new Usuario({}));
			attr.passEditar(new Pass({}));
			

			//CARGAMOS EL PERFIL DE USUARIO
			attr.load.perfil();
			attr.load.avatares();
		});
	}
	var	modPerfil;
	window.AppPerfil = Def;
	modPerfil = new AppPerfil();
	ko.applyBindings(modPerfil,document.getElementById("modPerfil"));	
})();