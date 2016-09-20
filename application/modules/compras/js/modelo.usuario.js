function Usuario(data){
	this.id = ko.observable( (data.id)?data.id:0 );
	this.name = ko.observable( (data.name)?data.name:'' );
	this.city = ko.observable( (data.city)?data.city:'' );
	this.role_id = ko.observable( (data.role_id)?data.role_id:'' );
	this.role_name = ko.observable( (data.role_name)?data.role_name:'' );
	this.username = ko.observable( (data.username)?data.username:'' );
	this.domain = ko.observable( (data.domain)?data.domain:'' );
	this.company = ko.observable( (data.company)?data.company:'' );
	this.description = ko.observable( (data.description)?data.description:'' );	
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
			str = 'Usuario Nuevo';
		}else{
			str = 'Modificar Usuario';
		}
        return str;
    }, this);
}
function Pass(data) {
	this.id = ko.observable( (data.id)?data.id:0 );
	this.nombre = ko.observable( (data.nombre)?data.nombre:'' );
	this.actual = ko.observable( (data.actual)?data.actual:'' );
	this.pass = ko.observable( (data.pass)?data.pass:'' );
	this.repass = ko.observable( (data.repass)?data.repass:'' );
}
function Perfil(data){
	this.id = ko.observable( (data.user_id)?data.user_id:0 );
	// this.dependencia_id = ko.observable( (data.dependencia_id)?data.dependencia_id:0 );
	this.nombre = ko.observable( (data.nombre)?data.nombre:'' );
	this.paterno = ko.observable( (data.paterno)?data.paterno:'' );
	this.materno = ko.observable( (data.materno)?data.materno:'' );
	this.puesto = ko.observable( (data.puesto)?data.puesto:'' );
	this.telefono = ko.observable( (data.telefono)?data.telefono:'' );
	this.imagen = ko.observable( (data.imagen)?data.imagen:'' );
	this.avatar = ko.observable((data.avatar)?data.avatar:'');
	// this.imagen250 = ko.observable((data.imagen250)?data.imagen250:'');


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

function Social(data){
	this.id = ko.observable((data.id)?data.id:0);
	this.facebook = ko.observable((data.facebook)?data.facebook:"");
	this.twitter = ko.observable((data.twitter)?data.twitter:"");
	this.google = ko.observable((data.google)?data.google:"");
	this.youtube = ko.observable((data.youtube)?data.youtube:"");
}