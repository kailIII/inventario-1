function Avatar(data){
	this.id = ko.observable( (data.user_id)?data.user_id:0 );
	this.imagen = ko.observable( (data.imagen)?data.imagen:'' );
	this.imagen50 = ko.observable( (data.imagen50)?data.imagen50:'' );
	this.imagen250 = ko.observable( (data.imagen250)?data.imagen250:'' );
}