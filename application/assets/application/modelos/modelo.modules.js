function Usuario(data){
	this.id = ko.observable( (data.id)?data.id:0 );
	// this.role_id = ko.observable( (data.role_id)?data.role_id:1 );
	// this.role_name = ko.observable( (data.role_name)?data.role_name:'' );
	this.username = ko.observable( (data.username)?data.username:'' );
	this.domain = ko.observable( (data.domain)?data.domain:'' );
	this.password = new Pass({});
	this.pass = this.password.pass;
	this.repass = this.password.repass;	
	this.password = new Pass({});
	this.email = ko.observable( (data.email)?data.email:'' );
	this.banned = ko.observable(    (data.banned)?data.banned:0    );
	this.ban_reason = ko.observable( (data.ban_reason)?data.ban_reason:null);

	this.perfil = (data.perfil)?data.perfil:new Perfil({});


	this.ventana_banned = ko.computed(function() {
		var str = this.perfil.nombre_completo();
		if(this.banned() == 1){
			str += '<br><span class="label label-important">Deshabilitado</span>';
		}
        return str;
    }, this);
	this.ventana_titulo = ko.computed(function() {
		var str = '';
		if(this.id() == 0){
			str = 'Registro de usuarios';
		}else{
			str = 'Modificar Usuario';
		}
        return str;
    }, this);
}
function module(data){
	this.id = ko.observable( (data.id)?data.id:0 );
	this.name = ko.observable( (data.name)?data.name:'' );
	this.module_id = ko.observable( (data.id)?data.id:0 );
	this.role_name = ko.observable( (data.role_name)?data.role_name:'' );
	this.password = new Pass({});
	this.email = ko.observable( (data.email)?data.email:'' );
	this.banned = ko.observable(    (data.banned)?data.banned:0    );
	this.ban_reason = ko.observable( (data.ban_reason)?data.ban_reason:null);

	this.perfil = (data.perfil)?data.perfil:new Perfil({});


	this.ventana_banned = ko.computed(function() {
		var str = this.perfil.nombre_completo();
		if(this.banned() == 1){
			str += '<br><span class="label label-important">Deshabilitado</span>';
		}
        return str;
    }, this);
	this.ventana_titulo = ko.computed(function() {
		var str = '';
		if(this.id() == 0){
			str = 'Usuario Nuevo';
		}else{
			str = 'Modificar Usuario';
		}
        return str;
    }, this);
}
function Pass (data) {
	this.id = ko.observable( (data.id)?data.id:0 );
	this.nombre = ko.observable( (data.nombre)?data.nombre:'' );
	this.actual = ko.observable( (data.actual)?data.actual:'' );
	this.pass = ko.observable( (data.pass)?data.pass:'' );
	this.repass = ko.observable( (data.repass)?data.repass:'' );
}
function Perfil(data){
	this.id = ko.observable( (data.id)?data.id:0 );
	this.dependencia_id = ko.observable( (data.dependencia_id)?data.dependencia_id:0 );
	this.nombre = ko.observable( (data.nombre)?data.nombre:'' );
	this.paterno = ko.observable( (data.paterno)?data.paterno:'' );
	this.materno = ko.observable( (data.materno)?data.materno:'' );
	this.puesto = ko.observable( (data.puesto)?data.puesto:'' );
	this.telefono = ko.observable( (data.telefono)?data.telefono:'' );
	this.imagen = ko.observable( (data.imagen)?data.imagen:'' );
	this.imagen50 = ko.observable((data.imagen50)?data.imagen50:'');
	this.imagen250 = ko.observable((data.imagen250)?data.imagen250:'');


	this.nombre_completo = ko.computed(function() {
		var str = this.nombre() + " " + this.paterno() + " " + this.materno();
        return str;
    }, this);
}

function Rol(data){
	this.id = ko.observable((data.id)?data.id:0);
	this.parent_id = ko.observable((data.parent_id)?data.parent_id:0);
	this.name = ko.observable((data.name)?data.name:'');
}

function Dependencia(data){
	this.id = ko.observable( (data.dependencia_id)?data.dependencia_id:0 );
	this.Abreviacion = ko.observable( (data.Abreviacion)?data.Abreviacion:'' );
	this.Clave = ko.observable( (data.Clave)?data.Clave:'' );
	this.Dependencia = ko.observable( (data.Dependencia)?data.Dependencia:'' );
	this.Direccion = ko.observable( (data.Direccion)?data.Direccion:'' );
	this.Fax = ko.observable( (data.Fax)?data.Fax:'' );
	this.PaginaWeb = ko.observable( (data.PaginaWeb)?data.PaginaWeb:'' );
	this.Telefono = ko.observable( (data.Telefono)?data.Telefono:'' );
}