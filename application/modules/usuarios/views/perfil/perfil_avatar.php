<!-- ko with: usuarioEditar -->
<div class="form-group">
	<img class="img-responsive" data-bind="attr: { src:perfil.avatar }">
</div>
<div class="form-group">
	<button class="btn btn-default btn-block" data-bind="click: $root.perfil.chavatar">Cambiar foto</button>
	<button class="btn btn-danger btn-block" data-bind="click: $root.perfil.editar">Editar Perfil</button>
	<button class="btn btn-warning btn-block" data-bind="click: $root.perfil.grabar">Guardar Perfil</button>
</div>
<!-- /ko -->