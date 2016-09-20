<!-- ko with: usuarioEditar -->
<hr>
<h3>Cuenta</h3>

<div class="row">
	<div class="form-group col-md-6">
		<label for="username">Nombre de Usuario</label>
		<input class="form-control" type="text" id="username" placeholder="Nombre de Usuario..." disabled="disabled" data-bind="value: username">
	</div>
	<div class="form-group col-md-6">
		<label for="email"><i class="fa fa-asterisk text-danger" data-bind="visible:$root.editar"></i> Correo</label>
		<input class="form-control" type="text" id="email" placeholder="Correo..." data-bind="value: email, enable: $root.editar">
	</div>
</div>
<!-- /ko -->

<!-- ko with: passEditar -->
<p data-bind="visible: $root.editar"><small>Si desea cambiar su contraseña, llene los siguientes campos. Estos datos solo son obligatorios si se requiere cambiar la contraseña.</small></p>
<div class="row" data-bind="visible: $root.editar">
	<div class="form-group col-md-6">
		<label for="pass_actual"><i class="fa fa-asterisk text-danger" data-bind="visible:$root.editar"></i> Contraseña Actual</label>
		<input class="form-control" type="password" id="pass_actual" placeholder="Contraseña Actual..." data-bind="value:actual, enable: $root.editar">
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<label for="pass_nueva"><i class="fa fa-asterisk text-danger" data-bind="visible:$root.editar"></i> Contraseña Nueva</label>
			<input class="form-control" type="password" id="pass_nueva" placeholder="Contraseña Nueva..." data-bind="value:pass, enable: $root.editar">
		</div>

		<div class="form-group">
			<label for="pass_re_nueva"><i class="fa fa-asterisk text-danger" data-bind="visible:$root.editar"></i> Confirmar Contraseña Nueva</label>
			<input class="form-control" type="password" id="pass_re_nueva" placeholder="Confirmar Contraseña Nueva..." data-bind="value:repass, enable: $root.editar">
		</div>
	</div>
</div>
<!-- /ko -->