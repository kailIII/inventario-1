<div id="modal-nuevo-rol" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-nuevo-rol-titulo" aria-hidden="true" data-bind="with: rolEditar">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title" id="modal-nuevo-rol-titulo">Nuevo Rol</h3>
            </div>

        	<div class="modal-body">
        		<div class="form-group col-md-12">
                    <label for="nombre"><i class="fa fa-asterisk text-danger"></i> Nombre del Rol</label>
                    <input class="form-control" type="text" id="nombre" placeholder="Nombre..." data-bind="value:name">
                </div>
        	</div>

        	<div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">CERRAR</button>
                <button class="btn btn-orange" data-bind="click:$root.rol.grabar">GUARDAR</button>
            </div>

        </div>
    </div>
</div>