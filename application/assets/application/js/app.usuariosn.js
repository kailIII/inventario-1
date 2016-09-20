/*****************************************************************************
* Aplicacion: Framework de Desarrollo
* Modulo: Usuarios
* Version: 1.0
* Desarrollado por: 
* Correo: 
* Twitter: 
******************************************************************************/
;(function(){
	var Def = function(){return constructor.apply(this,arguments); }
	var attr = Def.prototype;

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
			console.log("Nuevo Usuariooooo"); 
			attr.usuarioEditar(new Usuario({}));
			$('#modalNewUser').modal();
		},
		editar:function(data,e){
			console.log("Editar Usuario");
			attr.usuarioEditar(data);
			$('#modal-nuevo-usuario').modal();
		},
		grabar:function(data,e){
			console.log("Grabar Usuario");
			attr.save.usuario(data);
		},
		borrar:function(data,e){
			console.log("Borrar Usuario");
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
			console.log("Recuperar Usuario");
			attr.delete.usuario(data);
		},
		pass:function (data,e) {
			console.log("Cambiar Contraseña");
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
			console.log("Guardar nueva contraseña");
			attr.save.pass(data);
		}
	}

	attr.rol = {
		borrar:function(data,e){
			console.log("Borrar Rol");
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
			console.log("Nuevo Rol");
			attr.rolEditar(new Rol({}));
			$('#modal-nuevo-rol').modal();
		},
		grabar:function(data,e){
			console.log("Grabar Rol");
			attr.save.rol(data);
		}
	}

	//FUNCIONES PARA INTERACTUAR CON API REST
	attr.load = {
		dependencias:function(){
			$.ajax({
				url: APP.site_url+"api/dependencias/",
				type: "GET",
				dataType:"json"
			}).done(function(data,status,xhr){
				var mapArray = $.map(data.datos, function(item) {
					return new Dependencia(item);
				});
				attr.dependencias(mapArray);
			});
		},
		usuarios:function(){
			$.ajax({
				url: APP.site_url+"api/usuarios/",
				type: "GET",
				dataType:"json"
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
				url: APP.site_url + "api/usuarios_roles/",
				type: "GET",
				dataType: "json"
			}).done(function(data,status,xhr){
				var mapArray = $.map(data.datos, function(item){
					return new Rol(item);
				});
				attr.roles(mapArray);

			});
		}
	};
	attr.save = {
		pass:function(data){
			$.ajax({
				url:APP.site_url + "api/usuarios/cambiar_pass",
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
				url:APP.site_url + "api/usuarios/",
				type: "POST",
				dataType: "json",
				data: ko.toJS(data),
			beforeSend:function(XMLHttpRequest) {
				console.log(XMLHttpRequest);

			},
			// complete:function(data,status,xhr){
			}).done(function(data,status,xhr){
					console.log(data.type);
					console.log(data);
				if(!data.error){
					noti.general.show(data.type,data.msg);
					$('#modal-nuevo-usuario').modal('hide');
					attr.usuarioEditar(new Usuario({}));
					attr.load.usuarios();
				}else{
					noti.general.show(data.type,data.msg);	
				}
			// }
			})
		},
		rol:function(data){
			$.ajax({
				url:APP.site_url + "api/usuarios_roles/",
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
				url:APP.site_url + "api/usuarios/",
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
				url:APP.site_url + "api/usuarios_roles/",
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
login = function (){
	var user = $('#user').val();
	var pass = $('#pass').val();

	$.ajax({
		url:APP.site_url + "login/in",
		data:{'user':user,'pass':pass},
		type:'POST',
		dataType:'json'
	}).done(function(result){
		// console.log(result);
		if(result == "inicio"){
			// window.location=APP.site_url+APP.domain;
			window.location=APP.site_url;
			return false;
		}
		var html = "";
		 html +='<div class="alert alert-dismissable alert-danger">';
		 html +='<strong>Error!</strong> '+result;
		 html +='<button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-times"></i></button>';
		 html +='</div>';
		$('div.modal-body > div.verticalcenter > div.panel > div.panel-body > div.error').html(html);
		
	});
}
function addToCart(product_id) {
        botones = {
          si_callback:function($noty){ 
            attr.delete.usuario(data);
            $noty.close();
          }
        };  
    
  var things = $("#cartMenu").html();
  noti.car.show("",things);
}
	//CONSTRUCTOR
	function constructor(name){
		_init();
	}
	function _init(){
		//CARGA DEL MODELO, UNA VEZ CARGADO SE INICIALIZA LAS VARIABLES
		$.getScript(APP.base_url+"application/assets/application/modelos/modelo.usuarios.js").done(function(script,status,xhr) {
			//INICIALIZAMOS LAS VARIABLES OBSERVABLES
			attr.dependencias([]);
			attr.usuarios([]);
			attr.roles([]);
			attr.usuarioEditar(new Usuario({}));
			attr.rolEditar(new Rol({}));
			attr.passEditar(new Pass({}));

			// CARGAMOS LOS USUARIOS
			attr.load.dependencias();
			attr.load.roles();
			attr.load.usuarios();
		});
	}

// console.log(window.AppUsuarios);
	//unleash your class
	window.AppUsuarios = Def;
})();