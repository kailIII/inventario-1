/*****************************************************************************
* Aplicacion: Framework de Desarrollo
* Modulo: Usuarios
* Version: 1.0
* Desarrollado por: 
* Correo: 
* Twitter: 
******************************************************************************/
;(function(){
	var Def = function(){  return constructor.apply(this,arguments); }
	var attr = Def.prototype;
	//VARIABLE PROPIAS DE USO INTERNO
	var noti = new AppNotificaciones();

	//VARIABLES OBSERVABLES
	// attr.menus = ko.observableArray();
	// attr.usuarios = ko.observableArray();
	// attr.roles = ko.observableArray();

	attr.userEditPrime = ko.observable();
	// attr.rolEditar = ko.observable();
	// attr.passEditar = ko.observable();
    
	//FUNCIONES DEL VIEWMODEL
	attr.user = {
		u:function(data,e){
			attr.userEditPrime(new Usuario({}));
			$('#modalNewUser').modal();
			
		},
		uc:function(data,e){
			attr.userEditPrime(new Usuario({}));
			$('#modalNewUserClient').modal();
		},		
		gu:function(data,e){
			attr.save.u(data);
		},
		guc:function(data,e){
			attr.save.uc(data);
		},		
	}

	login = function (){
		var user = $('#user').val();
		var pass = $('#password').val();
		$.ajax({
			url:APP.site_url + "login/in",
			data:{'user':user,'pass':pass},
			type:'POST',
			dataType:'json'
		}).done(function(result){
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
		// usuarios:function(){
		// 	$.ajax({
		// 		url: APP.site_url+"api/usuarios/",
		// 		type: "GET",
		// 		dataType:"json"
		// 	}).done(function(data,status,xhr){
		// 		var mapArray = $.map(data.datos, function(item) {
		// 			item.perfil = new Perfil(item.profile);
		// 			return new Usuario(item);
		// 		});
		// 		// attr.usuarios(mapArray);
				
		// 	});
		// },
		// roles:function(){
		// 	$.ajax({
		// 		url: APP.site_url + "api/usuarios_roles/",
		// 		type: "GET",
		// 		dataType: "json"
		// 	}).done(function(data,status,xhr){
		// 		console.log("roles donde estan");
		// 		var mapArray = $.map(data.datos, function(item){
		// 			return new Rol(item);
		// 		});
		// 		attr.roles(mapArray);

		// 	});
		// }

		// menus:function(){
			
		// 	function menu(){
		// 		$.ajax({
		// 			url: APP.site_url+"api/menu/",
		// 			type: "GET",
		// 			dataType:"json",
		// 			beforeSend:function(XMLHttpRequest){
		// 				// console.log(XMLHttpRequest);
		// 			}
		// 		}).done(function(data,status,xhr){
		// 			var a=0;
		// 			$(data.datos).each(function(){
		// 				// $('header nav ul li .menu').text(data.datos[a].name);
		// 				var menu = "<li><a href='#'><i class='fa fa-info-circle'></i>"+data.datos[a].name+"</a></li>";
		// 				// $('header nav .menu').append(menu);
		// 				a++;
		// 			});
		// 		});
		// 	}
		// }
		// menu();	
	// }		
	};	
		// console.log(APP.site_url+APP.domain + "/usuarios/api/usuarios/");

	attr.save = {
		u:function(data){
			$.ajax({
				url:APP.site_url+APP.domain + "/usuarios/api/usuarios/",
				// url:APP.site_url + "api/usuarios/",
				type: "POST",
				dataType: "json",
				data: ko.toJS(data),
				beforeSend: function(error){
					console.log(error);
				}
			}).done(function(data,status,xhr){
				console.log(data);
				if(!data.error){
					noti.general.show(data.type,data.msg);	
					$('#modalNewUser').modal('hide');
					attr.userEditPrime(new Usuario({}));
					// attr.load.usuarios();
					location.href=APP.site_url;

				}else{
					noti.general.show(data.type,data.msg);	
				}
			})
		},
		uc:function(data){
			$.ajax({
				url:APP.site_url+ "usuarios/api/usuarios_cliente/",
				type: "POST",
				dataType: "json",
				data: ko.toJS(data),
			beforeSend: function(error){
				console.log(error);
				}				
			}).done(function(data,status,xhr){
				if(!data.error){
					noti.general.show(data.type,data.msg);	
					$('#modalNewUserClient').modal('hide');
					attr.userEditPrime(new Usuario({}));
					// attr.load.usuarios();
					// location.href=APP.site_url;

				}else{
					noti.general.show(data.type,data.msg);	
				}
			})
		},
	}
	//CONSTRUCTOR
	function constructor(name){
 		_init();
	}
	
	function _init(){
		//CARGA DEL MODELO, UNA VEZ CARGADO SE INICIALIZA LAS VARIABLES
		$.getScript(APP.base_url+"application/modules/usuarios/js/modelo.usuario.js").done(function(script,status,xhr) {
			//INICIALIZAMOS LAS VARIABLES OBSERVABLES
			// attr.menus([]);
			// attr.usuarios([]);
			// attr.roles([]);
			attr.userEditPrime(new Usuario({}));
			// attr.rolEditar(new Rol({}));
			// attr.passEditar(new Pass({}));

			//CARGAMOS LOS USUARIOS
			// attr.load.menus();
			// attr.load.roles();
			// attr.load.usuarios();
		});
	}

	//unleash your class
	// window.AppModules = Def;
	// var modModules = new AppModules();
	// ko.applyBindings(modModules,document.getElementById("userheader"));
})();


