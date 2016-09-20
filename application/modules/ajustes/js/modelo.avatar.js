function Avatar(data){
	this.id = ko.observable( (data.user_id)?data.user_id:0 );
	this._Pimg = ko.observable( (data._Pimg)?data._Pimg:0 );
	this.logo = ko.observable( (data.logo)?data.logo:'');
	this.avatar = ko.observable( (data.avatar)?data.avatar:'');
}
function infoSubsidiary(data){
	// this.id = ko.observable( (data.id)?data.id:0 );
	this.company = ko.observable( (data.company)?data.company:"");
	this.description = ko.observable( (data.description)?data.description:"");
	this.street = ko.observable( (data.street)?data.street:"");
	this.zip_code = ko.observable( (data.zip_code)?data.zip_code:"");
	this.colony = ko.observable( (data.colony)?data.colony:"");
	this.city = ko.observable((data.city)?data.city:"");
	this.state = ko.observable( (data.state)?data.state:"");
	this.country = ko.observable( (data.country)?data.country:"");
	this.logo = ko.observable( (data.logo)?data.logo:"");

}
function Folio(data){
	this.id = ko.observable( (data.id)?data.id:0 );
	this.serie = ko.observable( (data.serie)?data.serie:'' );
	this.start = ko.observable( (data.start)?data.start:'' );
	this.current = ko.observable( (data.current)?data.current:'' );
	this.domain = ko.observable( (data.domain)?data.domain:'' );
	this.subsidiary = ko.observable( (data.subsidiary)?data.subsidiary:'' );
	this.status = ko.observable( (data.status)?data.status:'' );

	this.banned = ko.observable(    (data.banned)?data.banned:0    );
	this.ban_reason = ko.observable( (data.ban_reason)?data.ban_reason:null);

	this.ventana_banned = ko.computed(function() {
		var str = this.serie
		if(this.banned() == 1){
			str += '<br><span class="label label-important">Deshabilitado</span>';
		}
        return str;
    }, this);	
}
function Sucursal(data){
	this.id = ko.observable( (data.id)?data.id:0 );
	this.name = ko.observable( (data.name)?data.name:'' );
	this.state = ko.observable( (data.state)?data.state:'' );
	this.state_id = ko.observable( (data.state)?data.state:'' );
	this.state_name = ko.observable( (data.state_name)?data.state_name:'' );
	this.city = ko.observable( (data.city)?data.city:'' );
	this.city_name = ko.observable( (data.city_name)?data.city_name:'' );
	this.colony = ko.observable( (data.colony)?data.colony:'' );
	this.street = ko.observable( (data.street)?data.street:'' );
	this.outside_number = ko.observable( (data.outside_number)?data.outside_number:'' );
	this.inside_number = ko.observable( (data.inside_number)?data.inside_number:'' );
	this.zip_code = ko.observable( (data.zip_code)?data.zip_code:'' );
	this.reference = ko.observable( (data.reference)?data.reference:'' );
	this.email = ko.observable( (data.email)?data.email:'' );
	this.phone = ko.observable( (data.phone)?data.phone:'' );
	this.contact = ko.observable( (data.contact)?data.contact:'' );

	this.banned = ko.observable(    (data.banned)?data.banned:0    );
	this.ban_reason = ko.observable( (data.ban_reason)?data.ban_reason:null);

	this.ventana_banned = ko.computed(function() {
		var str = this.serie
		if(this.banned() == 1){
			str += '<br><span class="label label-important">Deshabilitado</span>';
		}
        return str;
    }, this);	
}
function Estado_Ciudad(data){
	this.id = ko.observable( (data.id)?data.id:0 );
	this.name = ko.observable( (data.name)?data.name:'' );
}


