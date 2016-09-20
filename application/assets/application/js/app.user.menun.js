/*****************************************************************************
* Aplicacion: Framework de Desarrollo
* Modulo: Funcionalidad para el menu del usuario.
* Version: 1.0
* Desarrollado por: Javier Peña
* Correo: geradeluxer@gmail.com
* Twitter: @geradeluxer
******************************************************************************/
;(function(){
	var Def = function(){ return constructor.apply(this,arguments); }
	var attr = Def.prototype;
	
	//construct
	function constructor(name){
		console.log('App User Menu');
	}
	
	//define methods
	attr.ir = function(value){
		attr.operacion[value]();
	};

	attr.operacion = {
		logout: function(){
			console.log("Logout");
			window.location.href=APP.site_url+"login/out";
		},
		perfil: function(){
			console.log("Perfillllllllllllllll");
			window.location.href=APP.site_url+"perfil";
		}
	};

	//unleash your class
	window.AppUserMenu = Def;
})();