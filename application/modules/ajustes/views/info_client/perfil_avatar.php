<!-- ko with: usuarioEditar -->
<div class="form-group">
	<img class="img-responsive" data-bind="attr: { src:logo }">
</div>
<div class="form-group">
	<button class="btn btn-default btn-block" data-bind="click: $root.perfil.chavatar">Cambiar logo</button>
	<button class="btn btn-danger btn-block" data-bind="click: $root.perfil.editar">Editar</button>
	<button class="btn btn-warning btn-block" data-bind="click: $root.perfil.grabar">Guardar</button>
</div>
<!-- /ko -->