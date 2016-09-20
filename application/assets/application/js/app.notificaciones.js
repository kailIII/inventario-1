/*****************************************************************************
* Aplicacion: Framework de Desarrollo
* Modulo: Notificaciones, requiere de el plugin noty de jquery: http://needim.github.io/noty/
* Version: 1.0
* Desarrollado por: Gerardo Del Angel
* Correo: gerardosngeln@gmail.com
* Twitter: @GeraDeluxer
******************************************************************************/
;(function(){
	var Def = function(){ return constructor.apply(this,arguments); }
	var attr = Def.prototype;
	
	//list the attributes
	attr.noty_grab = null;

	attr.confirmacion ={
		show:function(msg,botones){
			//VALIDAMOS QUE EL OBJ BOTONES, CONTENGA INFORMACION VALIDA,
			//EN CASO DE QUE NO TOMARÁ VALORES POR DEFAULT
			var obj = {
				si_text:(botones.si_text)?botones.si_text:'Si',
				si_callback:(botones.si_callback)?botones.si_callback : function($noty){ $noty.close(); },

				no_text:(botones.no_text)?botones.no_text:'No',
				no_callback:(botones.no_callback)?botones.no_callback : function($noty){ $noty.close(); },
			};

			noty({
				text: msg,
				type: 'confirm',
				modal: true,
				type: 'error',
				layout: 'topRight',
				buttons: [
					{addClass: 'btn btn-success', text: obj.si_text, onClick: obj.si_callback},
					{addClass: 'btn btn-danger', text: obj.no_text, onClick: obj.no_callback}
				]
			});
		}
	};

	attr.general ={
		show:function(tipo,msg){
			noty({
				text: msg,
				timeout: 3000,
				type: tipo,
				layout: 'topRight'
			});
		}
	};
	attr.car ={
		show:function(tipo,msg){
			noty({
				text: msg,
				timeout: 5000,
				type: tipo,
				layout: 'topRight'
			});
		}
	};
	attr.bloquear = {
		show:function(msg){
			if(!attr.noty_grab)
				attr.noty_grab = noty({
					text: msg,
					type: 'error',
					modal: true,
					closeWith: [],
					layout: 'topRight'
				});
		},
		close:function(){
		if(attr.noty_grab)	{	
			attr.noty_grab.closed=false;
			attr.noty_grab.shown=true;
			attr.noty_grab.close();
			attr.noty_grab = null;}
		}
	};
	



	function constructor(name){

	}
	window.AppNotificaciones = Def;
})();