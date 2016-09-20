<div id="nuevo-usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-nuevo-usuario-titulo" aria-hidden="true" data-bind="with: folioEditar">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <!-- <h3 class="modal-title" id="modal-nuevo-usuario-titulo" data-bind="text:ventana_titulo"></h3> -->
            </div>

            <div class="modal-body">
                <p>Los campos con <i class="fa fa-asterisk text-danger"></i> son obligatorios.</p>
                
                <ul id="usaurio-datos" class="nav nav-tabs">
                    <li class="active"><a href="#usuario-cuenta" data-toggle="tab"><P></P>Folio </a></li>
                </ul>

                <div id="usuario-datos-contenido" class="tab-content">
                    <!-- DATOS DE LA CUENTA -->
                    <div class="tab-pane fade active in" id="usuario-cuenta">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="serie"><i class="fa fa-asterisk text-danger"></i> Serie</label>
                                <input class="form-control" type="text" id="serie" placeholder="serie ej. L,M,A" data-bind="value:serie">
                            </div>
                            <div class="col-md-6">
                                <label for="subsidiary">Sucursal</label>
                                <select class="form-control" data-bind="options: $root.Subsidiary,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: subsidiary "></select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="start"><i class="fa fa-asterisk text-danger"></i> Siguiente folios</label>
                                <input class="form-control" type="text" id="start" placeholder="Numero de folio inicial" data-bind="value:start">
                            </div>
                        </div>

                    </div>
                    <!-- /DATOS DE LA CUENTA -->
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">CERRAR</button>
                <button class="btn btn-orange" data-bind="click:$root.folio.grabar">GUARDAR</button>
            </div>

        </div>
    </div>
</div>