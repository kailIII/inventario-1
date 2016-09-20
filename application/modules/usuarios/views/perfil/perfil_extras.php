<!-- ko with: usuarioEditar -->
<hr>
<h3>Extras</h3>

<div class="row">
	<div class="form-group col-md-6">
		<label for="puesto">Puesto</label>
		<input class="form-control" type="text" id="puesto" placeholder="Puesto..." data-bind="value:perfil.puesto, enable: $root.editar">
	</div>
	<div class="form-group col-md-6">
		<label for="telefono">Teléfono</label>
		<input class="form-control" type="text" id="telefono" placeholder="Teléfono..." data-bind="value:perfil.telefono, enable: $root.editar">
	</div>
</div>
<!-- /ko -->