/*****************************************************************************
* Aplicacion: Sistema de inventarios
* Modulo: Articulos
* Version: 1.0
* Desarrollado por: Gerardo Del Angel Nuñez
* Correo: gerardo.delangel@armedica.com.mx
* Twitter: @geradeluxer
******************************************************************************/
// $.fn.modal.Constructor.prototype.enforceFocus = function () {};   
$(document).ready(function(){
    
	var noti = new AppNotificaciones();
	var url = APP.site_url+APP.domain+"/";
	var url_img = APP.site_url;
	var send=true;

	if($(".editNews").length)
	CKEDITOR.replace( 'description', {
	    language: 'Es',
	    uiColor: '#9AB8F3',
	    height:'500px'
	});		

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

		_self.ViewPost = {
			products:function(order_by,search){
				$.ajax({
					url: url + "articulos/api/consulta/proyectos",
					data: {'order_by':(order_by?order_by:""),"search":(search?search:"")},
					type: 'GET',
					dataType: 'json',
				}).done(function(resultado){
					
					if(!resultado.error){
						mapeo = $.map(resultado, function(n,i) {
						  return new Manifiestos(n,i+1)
						  });
						_self.proyectos(mapeo);
					}else{
						_self.proyectos("");
						// noti.general.show(resultado.type,resultado.msg);
					}
				});
			},
			avatares:function(){

			}
		}		
		_self.postEdit = function(){
			_self.postEdit_ = ko.toJS(new Editpost_Model({}));

			if(!_self.postEdit_.title){
				noti.general.show("error","Es necesario el titulo");
				return false;
			}else if(!_self.postEdit_.category){
				noti.general.show("error","Seleccione una categoria");
				return false;
			}
			$.ajax({
				url:url+"articulos/api/datos/edit",
				data:_self.postEdit_,
				type:"post",
				datatype:"json",
			}).done(function(res){
				noti.general.show(res.type,res.msg);
				if(res.datos){
				    setInterval(function(){ window.location.href=url+_self.postEdit_.categoryText+"/"+res.datos.id_post+"/"+_self.postEdit_.titleText; }, 1000);
				}
				
			});

		}
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


		_self._pyb = function(){$('#msg-pay').modal();}
		_self._py1 = function(){
			$.ajax({
				url:url+"articulos/api/consulta/pay_purchase",
				data:{},
				type:"post",
				datatype:"json",
			}).done(function(res){
				$('#msg-pay').modal('hide');
				location.reload();
			});
		}
		$(document).on("click","#_iP div.itemImage > span.delete",function(){
		    var img=$(this)
		    console.log(img);
		    var file_id = img.data("file_ref");
		    $.ajax({
		        url: url+"articulos/api/datos/delete",
		        type: 'POST',
		        dataType: 'json',
		        data: {file_id: file_id},
		        success:function(res){
		            $(img).parent().parent().remove();
					noti.general.show(res.type,res.msg);
		        }
		    });
		    
		});		
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
		    	var nameImage = url_img+file.name;
		        return $('<div class="row">'
			        		+'<div class="itemImage col-md-4">'
				                +'<div class="img">'
				               		+'<img src="'+url_img+file.name+'">'
				                +'<\/div>' 
		                		+ '<span data-bind="click: delete" class="delete fa fa-times-circle fa-lg" data-file_ref="'+file.file_id+'"><\/span>'
			                +'<\/div>'
			                +'<div class="col-md-8">'
			                		+ '<small><input type="text" value="'+nameImage+'"><label>copiar url para insertar imagen</label><\/small>'
			                +'<\/div>'		                
		                +'<\/div>'
		                );
		    }
		});

		_self.searchT = ko.observable("")  ;
		_self.order = {
			
			search:function(data){
				// console.log(_self.searchT());
				_self.ViewPost.products(1,_self.searchT());
			},
			title:function(data){
				_self.ViewPost.products(1,"");
			},
			cat:function(data){
				_self.ViewPost.products(2,"");
			},
			date:function(data){
				_self.ViewPost.products(3,"");
			},
			type:function(data){
				_self.ViewPost.products(4,"");
			},			
		}



	};

	var VM = new ViewModel();
	ko.applyBindings(VM,document.getElementById("art_"));

});


