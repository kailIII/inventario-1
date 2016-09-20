/*****************************************************************************
* Aplicacion: Nombre del Sistema o Aplicacion
* Modulo: inicio
* Version: 1.0
* Desarrollado por: Gerardo Del Angel Nuñez
* Correo: sistemadeluxer@mireino.com
* Twitter: @sistemadeluxer
******************************************************************************/
// $.fn.modal.Constructor.prototype.enforceFocus = function () {};
var noti = new AppNotificaciones();
var url = APP.site_url+APP.domain+"/";
var url_img = APP.site_url;

/*************************  comentarios  **********************/
$(function(){

	
	function articles_module(datos,i){
		this.num = ko.observable( i );
		this.id = ko.observable( (datos.id)?datos.id:'' );
		this.id_comment = ko.observable( (datos.id_comment)?datos.id_comment:'' );
		this.comment = ko.observable( (datos.comment)?datos.comment:'' );
		this.image = ko.observable( (datos.image)?datos.image:'' );
		this.imagen = ko.observable( (datos.imagen)?datos.imagen:'' );
		this.username = ko.observable( (datos.username)?datos.username:'' );
		this.ar_view__ = ko.observableArray([]);
		mapeo = $.map(datos.response, function(n,i) {
		  return new Response(n,i+1);
		});
		this.ar_view__(mapeo)
		// this.response = (datos.response)?datos.response:new Response(datos.response);
	}
	function Response(datos,i){
		this.num = ko.observable( i );
		this.id = ko.observable( (datos.id)?datos.id:'' );
		this.id_comment = ko.observable( (datos.id_comment)?datos.id_comment:'' );
		this.comment = ko.observable( (datos.comment)?datos.comment:'' );
		this.image = ko.observable( (datos.image)?datos.image:'' );
		this.imagen = ko.observable( (datos.imagen)?datos.imagen:'' );
		this.username = ko.observable( (datos.username)?datos.username:'' );
	}

	ViewModel=function(){
		var _self=this;
		_self.ar_view = ko.observableArray([]);
	 	var  a_=0;

		// setInterval(function(){
		// 	_self.comments.commAll()
		// },5000);

		_self.comments = {
			
			commAll:function(id){
				var _p_ref = $(".content .context #_p_comments #_p-ref > span").text();
				var _cm = $(".content .context #_p_comments #_cm").val();

			    $.ajax({
			        url: url+"inicio/api/datos/comments",
					data:{"_cm":_cm,"_p_ref":_p_ref},
			        type: 'GET',
			        dataType: 'json',
			        success:function(res){
						mapeo = $.map(res, function(n,i) {
						  return new articles_module(n,i+1)
						  });
			        	
						_self.ar_view(mapeo);

			        }
			    });

			},
			com_rtr_a:function(){
				var _cm = $(".content .context #_p_comments #_cm").val();
				var _p_ref = $(".content .context #_p_comments #_p-ref > span").text();

			 		a_++;
				var html='<div class="_w-comm" id="_w-comm_'+String(a_)+'" >'
							+'<div class="put_comm">'
								+'<input id="_cm_" class="form-control"></input>'
							+'</div>'
							+'<div class="btn btn-primary btn-sm post_comm_c" data-bind="click: $root.comments.post_comm_c">cancelar</div>'
							+'<div class="btn btn-success btn-sm post_comm_sub" data-bind="click: $root.comments.post_comm_sub">responder</div>'
						+'</div>';
 				var _this = $(event.target) || $(event.srcElement);
				$(_this).parent().parent().find("._com-rtr-ap").html(html);

				ko.applyBindings(new ViewModel(),document.getElementById("_w-comm_"+String(a_)));

			},
			post_comm_c:function(){

 				var _this = $(event.target) || $(event.srcElement);
				$(_this).parent().remove();
			
			},
			post_comm:function(){
				var _cm = $(".content .context #_p_comments #_cm").val();
				var _p_ref = $(".content .context #_p_comments #_p-ref > span").text();
				$(".content .context #_p_comments #_cm").val("");
				$.ajax({
					url:url+"inicio/api/datos/comments",
					data:{"_cm":_cm,"_p_ref":_p_ref},
					type:"post",
					datatype:"json",
				}).done(function(res){
					if(res.error){
						noti.general.show(res.type,res.msg);
					}else{
						_self.comments.comm(res.datos);
					}
				});
			},

			comm:function(data){
				$.ajax({
					url:url+"inicio/api/datos/conca",
					data:data,
					type:"post",
					datatype:"json",
				}).done(function(res){
					var html='<div class="_com">'
						+'<div class="_com-i">'
			            	+'<a class="thumbnail"><img src="'+res.image+'"></a>'
						+'</div>'
						+'<div class="_com-context">'
							+'<div class="_com-n">'
								+'<div class="conf" title="editar"><a href="javascript:void(0)"><i class="fa fa-pencil"></i></a></div>'
								+'<span>'+res.username+'</span>'
							+'</div>'
							+'<div class="_com-r">'
								+'<span>'+res.comment+'</span>'
							+'</div>'
							+'<div class="_com-rtl">'
								+'<a href="javascript:void(0)">Me gusta</a>'
							+'</div>'
							+'<div class="_com-rtr" id="_com-rtr">'
								+'<a  class="_com-rtr-a" href="javascript:void(0)" data-bind="click: $root.comments.com_rtr_a">Responder</a>'
								+'<div class="_com-rtr-ap" ></div>'
							+'</div>'
							+'<div class="_com-r-ref">'
								+'<span id="_com-r-ref">'+res.id_comment+'</span>'
							+'</div>'
							+'<div class="comments">'
							+'</div>'
						+'</div>'
					+'</div>'
					;
					$(".content .context #_p_comments > .comments").prepend(html);

					ko.applyBindings(new ViewModel(),document.getElementById("_com-rtr"));

				});	

			},
			post_comm_sub:function(){
 				var _this = $(event.target) || $(event.srcElement);
				var mi_this=$(_this).parent();
				var _cm = $(".content .context #_p_comments #_cm_").val();
				var _p_ref = $(".content .context #_p_comments #_p-ref > span").text();
				var _com_r_ref = $(mi_this).parent().parent().parent().find("._com-r-ref > span").text();
				$(".content .context #_p_comments #_cm").val("");

				$.ajax({
					url:url+"inicio/api/datos/comments",
					data:{"_cm":_cm,"_p_ref":_p_ref,"_com_r_ref":_com_r_ref},
					type:"post",
					datatype:"json",
				}).done(function(res){
					if(res.error){
						noti.general.show(res.type,res.msg);
					}else{
						_self.comments.comm_sub(res.datos,mi_this);
					}
				});
			},
			comm_sub:function(data,mi_this){
				$.ajax({
					url:url+"inicio/api/datos/conca",
					data:data,
					type:"post",
					datatype:"json",
					beforeSend: function(error){
					}
				}).done(function(res){
					var html='<div class="_com">'
						+'<div class="_com-i">'
			            	+'<a class="thumbnail"><img src="'+res.image+'"></a>'
						+'</div>'
						+'<div class="_com-context">'
							+'<div class="_com-n">'
								+'<div class="conf" title="editar"><a href="javascript:void(0)"><i class="fa fa-pencil"></i></a></div>'
								+'<span>'+res.username+'</span>'
							+'</div>'
							+'<div class="_com-r">'
								+'<span>'+res.comment+'</span>'
							+'</div>'
							+'<div class="_com-rtl">'
								+'<a href="javascript:void(0)">Me gusta</a>'
							+'</div>'
							+'<div class="_com-r-ref">'
								'<span id="_com-r-ref">'+res.id_comment+'</span>'
							+'</div>'
							+'<div class="comments">'
							+'</div>'
						+'</div>'
					+'</div>'
					;
					$(mi_this).parent().parent().parent().find(".comments").append(html);
					$(mi_this).remove();

				});
			},
		};
		
	
	}
	var VM = new ViewModel();
	var _p_comments = document.getElementById("_p_comments");
	if(_p_comments)
	ko.applyBindings(VM,document.getElementById("_p_comments"));	



	$('.fancybox').fancybox(

		{
		 'type':'iframe',
		 'width': 1200, //or whatever you want
		 'height': 600
		}				
	);


	$('.fancybox-buttons').fancybox({

		openEffect  : 'none',
		closeEffect : 'none',

		prevEffect : 'none',
		nextEffect : 'none',

		closeBtn  : false,

		helpers : {
			title : {
				type : 'inside'
			},
			buttons	: {}
		},

		afterLoad : function() {
			this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
		}
	});

	/* Ampliar imagen */
	var img_view = document.createElement("a");
	img_view.className="fancybox-buttons";
	$(img_view).attr('data-fancybox-group', 'button');

	$("#postSingle article img").each(function()
	{
		var img_rut = $(this).parent().get(0);
		var img_ruta_ = $(this).get(0).outerHTML;
		var href = $(img_ruta_).attr( "src" );
		img_view.href=href;
		img_view.innerHTML=img_ruta_;
		var img = "<a class='fancybox-buttons' data-fancybox-group='button' href='"+href+"'>"
			img +=		"<img alt='' src='"+href+"'></img>"
			img +=	"</a>";
		$(img_rut).find("img").remove();
		$(img_rut).append(img);
	});

})
