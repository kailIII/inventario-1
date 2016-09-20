function Usuario(data){
	// this.id = ko.observable( (data.id)?data.id:0 );
	this.name = ko.observable( (data.name)?data.name:1);
	this.description = ko.observable( (data.description)?data.description:2);
	this.street = ko.observable( (data.street)?data.street:3);
	this.zip_code = ko.observable( (data.zip_code)?data.zip_code:4);
	this.colonia = ko.observable( (data.colonia)?data.colonia:5);
	this.city = ko.observable((data.city)?data.city:6);
	this.state = ko.observable( (data.state)?data.state:7);
	this.country = ko.observable( (data.country)?data.country:8);
}

// function Avatar(data){
// 	this.id = ko.observable( (data.user_id)?data.user_id:0 );
// 	// this._Pimg = ko.observable( (data._Pimg)?data._Pimg:0 );
// 	this.logo = ko.observable( (data.logo)?data.logo:'' );
// 	this.Avatar = ko.observable( (data.avatar)?data.avatar:'' );
// 	// this.imagen250 = ko.observable( (data.imagen250)?data.imagen250:'' );
// }