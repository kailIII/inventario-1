/*****************************************************************************
* Aplicacion: Nombre del Sistema o Aplicacion
* Modulo: postear
* Version: 1.0
* Desarrollado por: Gerardo Del Angel Nuñez
* Correo: gerardo.delangel@armedica.com.mx
* Twitter: @geradeluxer
******************************************************************************/
$(document).ready(function(){
	
	var noti = new AppNotificaciones();
	var url = APP.site_url+APP.domain+"/";
	var url_img = APP.site_url;
	var send=true;
	
	var Def = function(){return constructor.apply(this,arguments); }
	var attr = Def.prototype;

	$('.ayuda').tooltip();

	function Createpost_Model(data){
		this.title = ko.observable( (data.title)?data.title:"" );
		this.price = ko.observable( (data.price)?data.price:"" );
		this.invoice = ko.observable( (data.invoice)?data.invoice:"" );
		this.description = ko.observable( (data.description)?data.description:"" );
		this.serie = ko.observable( (data.serie)?data.serie:"" );
		this.barcode = ko.observable( (data.barcode)?data.barcode:"" );
		this.folio = ko.observable( (data.folio)?data.folio:0 );
		this.folio_id = ko.observable( (data.folio_id)?data.folio_id:"" );
		this.folio_current = ko.observable( (data.folio_current)?data.folio_current:"" );
		
		this.brand_id = ko.observable( (data.brand_id)?data.brand_id:0 );
		this.Brand = ko.observable( (data.Brand)?data.Brand:"" );
		this.newBrand = ko.observable( (data.newBrand)?data.newBrand:"" );
		this.TypeFixedAssets_id = ko.observable( (data.TypeFixedAssets_id)?data.TypeFixedAssets_id:0 );
		this.TypeOfCurrence_id = ko.observable( (data.TypeOfCurrence_id)?data.TypeOfCurrence_id:0 );
		this.Provider_id = ko.observable( (data.Provider_id)?data.Provider_id:0 );
		this.Provider = ko.observable( (data.Provider)?data.Provider:"" );
		this.newProvider = ko.observable( (data.newProvider)?data.newProvider:0 );
		this.Subsidiary_id = ko.observable( (data.Subsidiary_id)?data.Subsidiary_id:0 );
		this.User_id = ko.observable( (data.User_id)?data.User_id:0 );
		this.Class_id = ko.observable( (data.Class_id)?data.Class_id:0 );
		this.Use_id = ko.observable( (data.Use_id)?data.Use_id:0 );
		this.Level_obsolescence_id = ko.observable( (data.Level_obsolescence_id)?data.Level_obsolescence_id:0 );
		this.Physical_state_id = ko.observable( (data.Physical_state_id)?data.Physical_state_id:0 );
		this.Departament_id = ko.observable( (data.Departament_id)?data.Departament_id:0 );
		this.Ubication_id = ko.observable( (data.Ubication_id)?data.Ubication_id:0 );
		this.newUbication = ko.observable( (data.newUbication)?data.newUbication:0 );
		this.Ubication = ko.observable( (data.Ubication)?data.Ubication:"" );
		this.Family_id = ko.observable( (data.Family_id)?data.Family_id:0 );
		this.newFamily = ko.observable( (data.newFamily)?data.newFamily:0 );
		this.Family = ko.observable( (data.Family)?data.Family:"" );
		this.frecuencyMonth = ko.observable( (data.frecuencyMonth)?data.frecuencyMonth:"" );
		
		//this.price = $(".formPost #price").val("dd");
		//this.category = $(".formPost #category").val();
		//this.titleText = $(".formPost #title").data("_t");
		//this.categoryText = $(".formPost #category option:selected").text();
		//this.oldprice = $(".formPost #oldprice").val();
		//this.video = $(".formPost #video").val();
		//this.stock = $(".formPost #stock").val();
		//this._w = $(".formPost #_viral").data("_w");

		imgArray=[];
    	$(".formPost #_iP .itemImage  > span.delete").each(function(i){
    		imgArray[i] = $(this).data("file_ref");
    	});
		//this.id_imgpost = ko.observableArray(imgArray);

	}
	function Selections(data){
		this.id = ko.observable( (data.id)?data.id:0 );
		this.name = ko.observable( (data.name)?data.name:0 );
		this.currency = ko.observable( (data.currency)?data.currency:0 );
		this.username = ko.observable( (data.username)?data.username:0 );
	}	
	Createpost_VM = function(datos){
		var _self = this,
		noti = new AppNotificaciones();
		_self.notificacion = function(){noti.general.show('error','Notificacion de Error');}
		_self.exportarExcel = function(){actions.exportar.Excel();}
		_self.products = ko.observable(new Createpost_Model({}));	
		_self.brands = ko.observableArray();
		_self.TypeFixedAssets = ko.observableArray();
		_self.TypeOfCurrence = ko.observableArray();
		_self.Provider = ko.observableArray();
		_self.Class = ko.observableArray();
		_self.Use = ko.observableArray();
		_self.Level_obsolescence = ko.observableArray();
		_self.Physical_state = ko.observableArray();
		_self.Departament = ko.observableArray();
		_self.CostCenter = ko.observableArray();
		_self.SubCostCenter = ko.observableArray();
		_self.Family = ko.observableArray();
		_self.Users = ko.observableArray();
		_self.Subsidiary = ko.observableArray();
		
		_self.mipost = {
			
			i_:function(data){
				$.ajax({
					url:url+"postear/postype",
					data:{"val":"_i"},
					type:"GET",
		        	cache: false, 
		        	async: false,				
					// datatype:"json",			
				}).done(function(res){
					$(".content .panel .panel-body .tab-content").html(res);
				});
				_self.s.upimg();
				ko.applyBindings(new Createpost_VM(),document.getElementById("o1"));
			},
			n_:function(data){
				$.ajax({
					url:url+"postear/postype",
					data:{"val":"_n"},
					type:"GET",
		        	cache: false, 
		        	async: false,			
				}).done(function(res){
					$(".content .panel .panel-body .tab-content").html(res);
					CKEDITOR.replace('description');
				});

				_self.s.upimg();
				ko.applyBindings(new Createpost_VM(),document.getElementById("o1"));
			},
			
			}
		//FUNCIONES PARA INTERACTUAR CON API REST
		_self.load = {
			productGet:function(){
				$.ajax({
					url: url+"postear/api/datos/product",
					type: "GET",
					dataType: "json",
					beforeSend: function(error){
						//console.log(error);
					},
				}).done(function(data,status,xhr){
					var map1 = $.map(data.datos.brands, function(item){
						return new Selections(item);
					});
					_self.brands(map1);

					var map2 = $.map(data.datos.TypeFixedAssets, function(item){
						return new Selections(item);
					});
					_self.TypeFixedAssets(map2);

					var map3 = $.map(data.datos.TypeOfCurrence, function(item){
						return new Selections(item);
					});
					_self.TypeOfCurrence(map3);

					var map4 = $.map(data.datos.Provider, function(item){
						return new Selections(item);
					});
					_self.Provider(map4);

					var map5 = $.map(data.datos.Class, function(item){
						return new Selections(item);
					});
					_self.Class(map5);

					var map6 = $.map(data.datos.Use, function(item){
						return new Selections(item);
					});
					_self.Use(map6);

					var map7 = $.map(data.datos.Level_obsolescence, function(item){
						return new Selections(item);
					});
					_self.Level_obsolescence(map7);

					var map8 = $.map(data.datos.Physical_state, function(item){
						return new Selections(item);
					});
					_self.Physical_state(map8);

					var map9 = $.map(data.datos.Departament, function(item){
						return new Selections(item);
					});
					_self.Departament(map9);

					var map10 = $.map(data.datos.CostCenter, function(item){
						return new Selections(item);
					});
					_self.CostCenter(map10);

					var map11 = $.map(data.datos.Family, function(item){
						return new Selections(item);
					});
					_self.Family(map11);

					var map12 = $.map(data.datos.Users, function(item){
						return new Selections(item);
					});
					_self.Users(map12);
					
					var map13 = $.map(data.datos.Subsidiary, function(item){
						return new Selections(item);
					});
					_self.Subsidiary(map13);

					var map14 = $.map(data.datos.SubCostCenter, function(item){
						return new Selections(item);
					});
					_self.SubCostCenter(map14);


					var folio = data.datos.Folio.serie + data.datos.Folio.current
					_self.products().folio(folio);
					_self.products().folio_id(data.datos.Folio.id);
					_self.products().folio_current(data.datos.Folio.current);

				});
			}
		};		
		_self.s = {

			_post:function(data){
				//var postCreate = new Createpost_Model({});
				data = ko.toJS(data);
				console.log(data.products);
				_self.nameImage=ko.observable("casa");
				
				$(".formPost").parsley( 'validate' );

				if(!data.products.title){
					noti.general.show("error","Es necesario el titulo");
					///send=true;
					return false;
				// }else if(!img_post.length){
					// noti.general.show("error","Agregue una imagen");
					// send=true;
					// return false;
				//}else if(!data.products.brand_id){
				//	noti.general.show("error","Seleccione una categoria");
					///send=true;
				//	return false;
				}
				
				///if(send) //evitar registrar mas de un artuculo al darle click al boton publicar
				///send=false;
				///else
				///return false;
				
				$.ajax({
					url:url+"postear/api/datos/items",
					data:{"products":data.products},
					type:"post",
					datatype:"json",
					beforeSend: function(error){
						console.log(error);
					}
				}).done(function(res){
					if(res.datos){
						noti.general.show(res.type,res.msg);
					    // setInterval(function(){ window.location.href=url+categoryText+"/"+_w+"/"+titleText; }, 1000);
					    //setInterval(function(){ location.reload(); }, 1000);
					    window.location.href=url;
					}
					
				});				
			},
			_delete:function(data){
 				var img = $(event.target) || $(event.srcElement);
			    var file_id = img.data("file_ref");
			    $.ajax({
			        url: url+"postear/api/datos/delete",
			        type: 'POST',
			        dataType: 'json',
			        data: {file_id: file_id},
			        success:function(res){
			            $(img).parent().parent().remove();
						noti.general.show(res.type,res.msg);
			        }
			    });
			},
			upimg:function(data){

			},

		}
	_self.load.productGet();
	//_self.postCreate = ko.toJS(new Createpost_Model({}));
	_self.products(new Createpost_Model({}));

	}
	$('#uploadImg').fileUploadUI({
		url:url+"postear/api/datos/UploadFile",
        method: 'POST',		    
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
	    	// this.nameImage=ko.observable();
	    	// this.nameImage(nameImage);
        	return $('<div class="row" id="upimg" >'
	        		+'<div class="itemImage col-md-4" >'
		                +'<div class="img">'
		               		+'<img src="'+url_img+file.name+'">'
		                +'<\/div>' 
                		+ '<span class="delete fa fa-times-circle fa-lg" data-file_ref="'+file.file_id+'" data-bind="click: $root.s._delete"><\/span>'
	                +'<\/div>'
	                +'<div class="in_ col-md-8">'
                		// + '<small><input type="text" data-bind="value: nameImage"><label>copiar url para insertar imagen</label><\/small>'
                		+ '<small><input type="text" value="'+nameImage+'"><label>copiar url para insertar imagen</label><\/small>'
	                +'<\/div>'		                
                +'<\/div>'
                );

	    },
		onComplete:function (event, files, index, xhr, handler, callBack) {
	    	// this.nameImage("casa");
			ko.applyBindings(new Createpost_VM(),document.getElementById("upimg"));
			

        },				    

	});
				//_self.postCreate = ko.toJS(new Createpost_Model({}));	
	//brands(new Brands_({}));

	var VM = new Createpost_VM();
	ko.applyBindings(VM,document.getElementById("cp_"));

});