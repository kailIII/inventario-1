// $.fn.modal.Constructor.prototype.enforceFocus = function () {};
jQuery(document).ready(function($){
	
	// var noti = new AppNotificaciones();

	//FUNCIONALIDAD PARA EL MENU DE USAURIO
	$(".user-desktop button, .user-phone button").tooltip({container:'body'});
	$(".user-desktop button, .user-phone button").click(function(e){
		var v = $(e.currentTarget).val();
		modUserMenu.ir(v);		
	});

	//verificamos si existe el elemento nueva_pass, lanzamos la ventana modal de reset
	if($('#nueva_pass').length>0){
		$('#nueva_pass').modal({
			backdrop: 'static',
			keyboard: false
		});

		$("#btn_nueva_pass").click(function(event){
			var action = $("#form_nueva_pass").attr("action"), obj = $("#form_nueva_pass").serializeArray();
			$.ajax({
				url: action,
				type: 'POST',
				dataType: 'json',
				data: obj
			}).done(function(data,status,xhr){
				if(data.error){
					$("#error_nueva_pass .alert-body").empty();
					$("#error_nueva_pass .alert-body").append(data.msg);
					$("#error_nueva_pass").show();
				}else{
					$("#error_nueva_pass").hide();
					$("#form_nueva_pass").hide();
					$("#nueva_pass .modal-footer").hide();

					$("#success_nueva_pass .alert-body").append(data.msg);
					$("#success_nueva_pass").show();

					window.setTimeout(function() {
						$('#nueva_pass').modal('hide');
					}, 3000);
				}
			});
		});
	}
	//animacion del menu fija
	$("header nav > ul li").not("header nav > ul li:nth-child(1)").mouseover(function(){
		$(this).css("background","#FF8A00");
		//$(this).find("span").css("top","0px");
	})
	.mouseout(function(){
		$(this).css("background","inherit");
		//$(this).find("span").css("top","-80px");
	})

	//slider del aside
	/* $('aside > .asideContent > #slider').bjqs({
	         
		width : 700,
		height : 300,
		 
		// animation values
		animtype : 'fade', // accepts 'fade' or 'slide'
		animduration : 500, // how fast the animation are
		animspeed : 4000, // the delay between each slide
		automatic : true, // automatic
		// control and marker configuration
		showcontrols : true, // show next and prev controls
		centercontrols : true, // center controls verically
		nexttext : '<i class="fa fa-chevron-circle-right fa-5x"></i>', // Text for 'next' button (can use HTML)
		prevtext : '<i class="fa fa-chevron-circle-left fa-5x"></i>', // Text for 'previous' button (can use HTML)
		showmarkers : true, // Show individual slide markers
		centermarkers : true, // Center markers horizontally
		// interaction values
		keyboardnav : true, // enable keyboard navigation
		hoverpause : true, // pause the slider on hover
		// presentational options
		usecaptions : true, // show captions for images using the image title tag
		responsive : true, // enable responsive capabilities (beta)
		randomstart : true,
			
	});	*/

});

;(function(){

	RegisterViewModel=function(){
		var _self = this;
		var noti = new AppNotificaciones();
		var url = APP.site_url+APP.domain+"/";
		_self.userEditPrime = ko.observable();

		//FUNCIONES DEL VIEWMODEL
		_self.user = {
			u:function(data,e){
				_self.userEditPrime(new Usuario({}));
				$('#modalNewUser').modal();
			},
			uc:function(data,e){
				_self.userEditPrime(new Usuario({}));
				$('#modalNewUserClient').modal();
			},		
			gu:function(data,e){
				_self.save.u(data);
			},
			guc:function(data,e){
				_self.save.uc(data);
			},		
		}

		$('#myModal').on('shown.bs.modal', function () {
		    $('#user').focus();
		})
		$("#user,#password").keypress(function(event) {
		    if (event.which == 13) {
		        event.preventDefault();
		        login();
		    }
		});
					
		login = function (){
			var user = $('#user').val();
			var pass = $('#password').val();
			console.log(APP.site_url + "login/in");
			$.ajax({
				url:APP.site_url + "login/in",
				data:{'user':user,'pass':pass},
				type:'POST',
				dataType:'json',
				beforeSend:function(error){
					console.log(error);
				},
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
		_self.load = {

		};	

		_self.save = {
			u:function(data){
				console.log(ko.toJS(data));
				$.ajax({
					url:url + "/usuarios/api/usuarios/",
					type: "POST",
					dataType: "json",
					data: ko.toJS(data),
				}).done(function(data,status,xhr){
					if(!data.error){
						noti.general.show(data.type,data.msg);	
						$('#modalNewUser').modal('hide');
						_self.userEditPrime(new Usuario({}));
						// _self.load.usuarios();
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
				}).done(function(data,status,xhr){
					if(!data.error){
						noti.general.show(data.type,data.msg);	
						$('#modalNewUserClient').modal('hide');
						_self.userEditPrime(new Usuario({}));
						// _self.load.usuarios();
						// location.href=APP.site_url;

					}else{
						noti.general.show(data.type,data.msg);	
					}
				})
			},
		}

		function _init(){

			$.getScript(APP.base_url+"application/modules/usuarios/js/modelo.usuario.js").done(function(script,status,xhr) {
				
				//INICIALIZAMOS LAS VARIABLES OBSERVABLES
				_self.userEditPrime(new Usuario({}));
				//CARGAMOS LOS USUARIOS
				// _self.load.usuarios();

			});
		}

		_init();

	}

	function articles_module(datos,i){
	}

	function Createpost_Model(data,i){
		
		this.num = ko.observable( i );
		this.id = ko.observable( (data.id)?data.id:'' );
		this.id_user = ko.observable( (data.id_user)?data.id_user:'' );
		//this.title = ko.observable( (data.title)?data.title:'' );
		//this.description = ko.observable( (data.description)?data.description:'' );
		this.price = ko.observable( (data.price)?data.price:0 );
		this.brand = ko.observable( (data.brand)?data.brand:'' );
		
		this.status = ko.observable( (data.status)?data.status:0 );
		this.status_id = ko.observable( (data.status_id)?data.status_id:'' );
		this.registred_on = ko.observable( (data.registred_on)?data.registred_on:'' );
		this.url_title = ko.observable( (data.url_title)?data.url_title:'' );
		this.url_cat = ko.observable( (data.url_cat)?data.url_cat:'' );

		this.title = ko.observable( (data.title)?data.title:"" );
		this.adquisition = ko.observable( (data.adquisition)?data.adquisition:"" );
		this.invoice = ko.observable( (data.invoice)?data.invoice:"" );
		this.description = ko.observable( (data.description)?data.description:"" );
		this.folio = ko.observable( (data.folio)?data.folio:"" );
		this.serie = ko.observable( (data.serie)?data.serie:"" );
		
		this.brand_id = ko.observable( (data.brand_id)?data.brand_id:"" );
		this.TypeFixedAssets_id = ko.observable( (data.TypeFixedAssets_id)?data.TypeFixedAssets_id:"" );
		this.TypeOfCurrence_id = ko.observable( (data.TypeOfCurrence_id)?data.TypeOfCurrence_id:"" );
		this.Provider_id = ko.observable( (data.Provider_id)?data.Provider_id:"" );
		this.Subsidiary_id = ko.observable( (data.Subsidiary_id)?data.Subsidiary_id:0 );
		this.User_id = ko.observable( (data.User_id)?data.User_id:"" );
		this.id_user_assign = ko.observable( (data.id_user_assign)?data.id_user_assign:"" );
		this.Class_id = ko.observable( (data.Class_id)?data.Class_id:"" );
		this.Use_id = ko.observable( (data.Use_id)?data.Use_id:"" );
		this.Level_obsolescence_id = ko.observable( (data.Level_obsolescence_id)?data.Level_obsolescence_id:"" );
		this.Physical_state_id = ko.observable( (data.Physical_state_id)?data.Physical_state_id:"" );
		this.Departament_id = ko.observable( (data.Departament_id)?data.Departament_id:"" );
		this.Ubication_id = ko.observable( (data.Ubication_id)?data.Ubication_id:"" );
		this.Family_id = ko.observable( (data.Family_id)?data.Family_id:"" );
		this.frecuencyMonth = ko.observable( (data.frecuencyMonth)?data.frecuencyMonth:"" );

		this.comentarios = ko.observable( (data.comentarios)?data.comentarios:'' );	

	}
	function Selections(data){
		this.id = ko.observable( (data.id)?data.id:0 );
		this.name = ko.observable( (data.name)?data.name:0 );
		this.username = ko.observable( (data.username)?data.username:0 );
		this.currency = ko.observable( (data.currency)?data.currency:0 );
	}
	ArticlesViewModel=function(){
		var _self = this;
		var noti = new AppNotificaciones();
		var url = APP.site_url+APP.domain+"/";
		_self.editar = ko.observable();

		_self.ar_view = ko.observableArray([]);
		_self.product_view = ko.observable();
		_self.brands = ko.observableArray();
		_self.TypeFixedAssets = ko.observableArray();
		_self.TypeOfCurrence = ko.observableArray();
		_self.Provider = ko.observableArray();
		_self.Class = ko.observableArray();
		_self.Use = ko.observableArray();
		_self.Level_obsolescence = ko.observableArray();
		_self.Physical_state = ko.observableArray();
		_self.Departament = ko.observableArray();
		_self.Ubication = ko.observableArray();
		_self.Family = ko.observableArray();
		_self.Users = ko.observableArray();
		_self.Subsidiary = ko.observableArray();
		_self.catEstatus = ko.observableArray([{'id':1 ,'nombre': 'Activo'},{'id':2 ,'nombre':'Inactivo'}]);
		_self.noSeleccionado = ko.observable(false); //focus de los comentarios del modal mim
		_self.noSeleccionado2 = ko.observable(false); //focus de los comentarios del modal mai

		_self.load = {

			productGet:function(){
				$.ajax({
					url: url+"postear/api/datos/product",
					type: "GET",
					dataType: "json",
					beforeSend: function(error){
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

					var map10 = $.map(data.datos.Ubication, function(item){
						return new Selections(item);
					});
					_self.Ubication(map10);

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
				});
			}

		};		

		_self.articles = {
			
			editar:function(){
				_self.editar(true);
			},
			grabar:function(data){
				_self.save.product(data);
			},			
			all_art:function(id){
			    $.ajax({
			        url: url+"inicio/api/datos/articles",
			        data: {"m_uri":APP._current},
			        type: 'GET',
			        dataType: 'json',
			        beforeSend: function(error){
			        	console.log(error);
			        },
			        success:function(res){
			        	if(res.datos.art){
							mapeo = $.map(res.datos.art, function(n,i) {
							  return new Createpost_Model(n,i+1);
							  });
				        	
							_self.ar_view(mapeo);
							_self.load.productGet();

					 		_self.noSeleccionado(true);
					 		_self.noSeleccionado2(true);					
			        	}

			        }
			    });

			},
			Detalles:function(data){
				var item = ko.toJS(data);
				_self.product_view(new Createpost_Model(item));
			},	
			addToCart:function(product_id){
				$.ajax({
					url:url+"inicio/api/datos/addcar",
					data:{"_c":product_id,"m_uri":APP._current},
					type:"post",
					datatype:"json",
				}).done(function(res){
					var things = $(res.datos).html();
					noti.car.show("",things);
					if(res.error){
					noti.general.show(res.type,res.msg);
					}
				});

			},
		}

		_self.save = {

			product:function(data){
				var infoClient = ko.toJS(data);
				$.ajax({
					url: url+"inicio/api/datos/item",
					type: "POST",
					dataType:"json",
					data: ko.toJS(infoClient),
					beforeSend:function(error){
					},
				}).done(function(data,status,xhr){
						
					if(!data.error){
						_self.editar(false);
						$('#showarticles').modal('hide');
						_self.load.productGet();
					}else{
						noti.general.show(data.type,data.msg);
					}
				});
			},
		};

		_self.ViewPost = function(order_by,search){
				
			$.ajax({
				url: url + "articulos/api/consulta/proyectos",
				data: {'order_by':(order_by?order_by:""),"search":(search?search:"")},
				type: 'GET',
				dataType: 'json',
				beforeSend:function(error){
				},
			}).done(function(resultado){
				
				if(!resultado.error){
					mapeo = $.map(resultado, function(n,i) {
					  return new Createpost_Model(n,i+1)
					  });
					_self.ar_view(mapeo);
					_self.load.productGet();
				}else{
					_self.ar_view("");
					_self.load.productGet();
					// noti.general.show(resultado.type,resultado.msg);
				}
			});


		}		
		_self.searchT = ko.observable("");
		_self.order = {
			
			search:function(data){
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
	}

	var RVM = new RegisterViewModel();
	var AVM = new ArticlesViewModel();
	var idIndex = document.getElementById("article_list");
	if(idIndex)
	ko.applyBindings(AVM,document.getElementById("article_list"));
	ko.applyBindings(RVM,document.getElementById("userheader"));
	//ko.applyBindings(AVM,document.getElementById("h_"));
		
})();

function calcular(){ //contador de caractres para comentarios del modal

	var cantidad2 = document.getElementById('cantidad2');
	document.getElementById('caracteres2').innerHTML = 400 - cantidad2.value.length;
}

// pagina de facebook

/*(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));*/
