<!-- ko with: usuarioEditar -->
<div class="form-group">
	<label><i class="" data-bind="visible:$root.editar"></i>Nombre de la empresa</label>
	<input class="form-control" type="text" maxlength="30" placeholder="maximo 15 caracteres" data-bind="value:company, enable: $root.editar">
</div>
<div class="form-group">
    <label class="control-label">Descripción</label>
    <input class="form-control" type="text"  maxlength="35" placeholder="maximo 30 caracteres" data-bind="value:description, enable: $root.editar">
</div>
<hr>
<h3>Dirección</h3>
<div class="row">
	<div class="form-group col-md-6">
		<label>Calle y número</label>		
		<input class="form-control" type="text" data-bind="value:street, enable: $root.editar">
	</div>
	<div class="form-group col-md-6">
		<label>Código postal</label>		
		<input class="form-control" type="text" data-bind="value:zip_code, enable: $root.editar">
	</div>	
	<div class="form-group col-md-6">
		<label>Colonia</label>		
		<input class="form-control" type="text" data-bind="value:colony, enable: $root.editar">
	</div>
	<div class="form-group col-md-6">
		<label>Ciudad</label>		
		<input class="form-control" type="text" data-bind="value:city, enable: $root.editar">
	</div>
	<div class="form-group col-md-6">
		<label>Estado</label>		
		<input class="form-control" type="text" data-bind="value:state, enable: $root.editar">
	</div>
	<div class="form-group col-md-6">
		<label>País</label>		
		<input class="form-control" type="text" data-bind="value:country, enable: $root.editar">
	</div>	
</div>
<!-- /ko -->