function Avatar(data){
	this.id = ko.observable( (data.user_id)?data.user_id:0 );
	this._Pimg = ko.observable( (data._Pimg)?data._Pimg:0 );
	this.imagen = ko.observable( (data.imagen)?data.imagen:'' );
	this.avatar = ko.observable( (data.avatar)?data.avatar:'' );
	// this.imagen250 = ko.observable( (data.imagen250)?data.imagen250:'' );
}