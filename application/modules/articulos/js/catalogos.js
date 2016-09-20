/*****************************************************************************
* Aplicacion: Sistema de inventarios
* Modulo: Articulos catalogos
* Version: 1.0
* Desarrollado por: Gerardo Del Angel Nuñez
* Correo: soporte@mireino.com
* Twitter: @geradeluxer
******************************************************************************/
// $.fn.modal.Constructor.prototype.enforceFocus = function () {};   
$(document).ready(function(){
    
	var noti = new AppNotificaciones();
	var url = APP.site_url+APP.domain+"/";
	var url_img = APP.site_url;
	var send=true;

	function Manifiestos(datos,i){	
		this.num = ko.observable( i );
		this.id = ko.observable( (datos.id)?datos.id:'' );
		this.title = ko.observable( (datos.title)?datos.title:'' );
		this.category = ko.observable( (datos.category)?datos.category:'' );
		this.type = ko.observable( (datos.type)?datos.type:'' );
		this.date = ko.observable( (datos.registred_on)?datos.registred_on:'' );
	}
	function Editpost_Model(datos){			

		this.title = $(".formEdit #title").val();
		this.price = $(".formEdit #price").val();
		this.category = $(".formEdit #category").val();
		this.titleText = $(".formEdit #title").data("_t");
		this.categoryText = $(".formEdit #category option:selected").text();
		this.oldprice = $(".formEdit #oldprice").val();
		this.video = $(".formEdit #video").val();
		this.stock = $(".formEdit #stock").val();
		this._w = $(".formEdit #_viral").data("_w");

		if($(".editNews").length)
    	this.description =CKEDITOR.instances.description.getData();
		if($(".editItem").length)
		this.description = $(".formEdit #description").val();		
		
		imgArray=[];
    	$(".formEdit #_iP .itemImage  > span.delete").each(function(i){
    		imgArray[i] = $(this).data("file_ref");
    	});
		this.id_imgpost = ko.observableArray(imgArray);

	}

	ViewModel = function(){
		var _self = this,
		noti = new AppNotificaciones();
		_self.proyectos = ko.observableArray([]);
		_self.postEdit_ = ko.observableArray([]);
		_self.notificacion = function(){noti.general.show('error','Notificacion de Error');}
		_self.exportarExcel = function(){actions.exportar.Excel();}

		_self.category = function(){
			var newpost = $("#categoryval").val();
			if(!newpost){
				noti.general.show("error","Inserte una categoria");
				return false;
			}

			$.ajax({
				url:url+"articulos/api/datos/category",
				data:{"name":newpost},
				type:"post",
				datatype:"json",
			}).done(function(res){
				location.reload();
			});
		}
		_self.family = function(){
			var newpost = $("#familyval").val();
			if(!newpost){
				noti.general.show("error","Inserte una familia");
				return false;
			}

			$.ajax({
				url:url+"articulos/api/datos/family",
				data:{"name":newpost},
				type:"post",
				datatype:"json",
				beforeSend:function(error){
					console.log(error);
				},
			}).done(function(res){
				location.reload();
			});
		}
		_self.departament = function(){
			var newpost = $("#departamentval").val();
			if(!newpost){
				noti.general.show("error","Inserte una Departamento");
				return false;
			}

			$.ajax({
				url:url+"articulos/api/datos/departament",
				data:{"name":newpost},
				type:"post",
				datatype:"json",
				beforeSend:function(error){
					console.log(error);
				},
			}).done(function(res){
				location.reload();
			});
		}
		_self.ubication = function(){
			var newpost = $("#ubicationval").val();
			if(!newpost){
				noti.general.show("error","Inserte una Ubicacion");
				return false;
			}

			$.ajax({
				url:url+"articulos/api/datos/ubication",
				data:{"name":newpost},
				type:"post",
				datatype:"json",
				beforeSend:function(error){
					console.log(error);
				},
			}).done(function(res){
				location.reload();
			});
		}				

		_self.searchT = ko.observable("")  ;
		_self.order = {
			
			search:function(data){
				// console.log(_self.searchT());
				_self.ViewPost(1,_self.searchT());
			},
			title:function(data){
				_self.ViewPost(1,"");
			},
			cat:function(data){
				_self.ViewPost(2,"");
			},
			date:function(data){
				_self.ViewPost(3,"");
			},
			type:function(data){
				_self.ViewPost(4,"");
			},			
		}



	};

	var VM = new ViewModel();
	ko.applyBindings(VM,document.getElementById("art_"));

});


