<!-- ko with: usuarioEditar -->
<p data-bind="visible:$root.editar">Los campos con <i class="fa fa-asterisk text-danger"></i> son obligatorios.</p>

<div class="form-group">
	<label for="nombre"><i class="fa fa-asterisk text-danger" data-bind="visible:$root.editar"></i> Nombre</label>
	<input class="form-control" type="text" id="nombre" placeholder="Nombre..." data-bind="value:perfil.nombre, enable: $root.editar">
</div>

<div class="row">
	<div class="form-group col-md-6">
		<label for="paterno">Apellido Paterno</label>		
		<input class="form-control" type="text" id="paterno" placeholder="Paterno..." data-bind="value:perfil.paterno, enable: $root.editar">
	</div>
	<div class="form-group col-md-6">
		<label for="materno">Apellido Materno</label>		
		<input class="form-control" type="text" id="materno" placeholder="Materno..." data-bind="value:perfil.materno, enable: $root.editar">
	</div>
</div>
<!-- /ko -->