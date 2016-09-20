<div id="modal-nuevo-pass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-nuevo-pass-titulo" aria-hidden="true" data-bind="with:passEditar">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title" id="modal-nuevo-pass-titulo" data-bind="text:nombre"></h3>
                <h5>Modificar Contraseña</h5>
            </div>

        	<div class="modal-body">
                <p>Los campos con <i class="fa fa-asterisk text-danger"></i> son obligatorios.</p>
                
        		<div class="form-group">
                    <label for="user_pass"><i class="fa fa-asterisk text-danger"></i> Nueva Contraseña</label>
                    <input class="form-control" type="text" id="user_pass" placeholder="Contraseña..." data-bind="value:pass">
                </div>

                <div class="form-group">
                    <label for="user_repass"><i class="fa fa-asterisk text-danger"></i> Repetir Nueva Contraseña</label>
                    <input class="form-control" type="text" id="user_repass" placeholder="Repetir Nueva Contraseña..." data-bind="value:repass">
                </div>
        	</div>

        	<div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">CERRAR</button>
                <button class="btn btn-orange" data-bind="click:$root.user.pass_grabar">GUARDAR</button>
            </div>



        </div>
    </div>
</div>