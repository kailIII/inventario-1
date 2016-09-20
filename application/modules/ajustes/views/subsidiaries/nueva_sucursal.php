<div id="nueva-sucursal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-nueva-sucursal-titulo" aria-hidden="true" data-bind="with: sucursalEditar">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <!-- <h3 class="modal-title" id="modal-nuevo-usuario-titulo" data-bind="text:ventana_titulo"></h3> -->
            </div>

            <div class="modal-body">
                <p>Los campos con <i class="fa fa-asterisk text-danger"></i> son obligatorios.</p>
                
                <ul id="usuario-datos" class="nav nav-tabs">
                    <li class="active"><a href="#usuario-cuenta" data-toggle="tab"><P></P>Sucursal </a></li>
                </ul>

                <div id="usuario-datos-contenido" class="tab-content">
                    <!-- DATOS DE LA CUENTA -->
                    <div class="tab-pane fade active in" id="usuario-cuenta">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name"><i class="fa fa-asterisk text-danger"></i> Nombre</label>
                                <input class="form-control" type="text" id="name" data-bind="value:name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subsidiary"><i class="fa fa-asterisk text-danger"></i> Estado</label>
                                <select class="form-control" data-bind="options:$root.estados,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: state_id, event: { change: $root.selecTown.search } "></select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city"><i class="fa fa-asterisk text-danger"></i> Ciudad</label>
                                <select class="form-control" id="city" data-bind="options: $root.ciudades,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: city"></select>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="colony"><i class="fa fa-asterisk text-danger"></i> Colonia</label>
                                <input class="form-control" type="text" id="colony" data-bind="value:colony">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="street"><i class="fa fa-asterisk text-danger"></i> Calle</label>
                                <input class="form-control" type="text" id="street" data-bind="value:street">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="outside_number"><i class="fa fa-asterisk text-danger"></i> N° exterior</label>
                                <input class="form-control" type="text" id="outside_number" data-bind="value:outside_number">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inside_number"><i class="fa fa-asterisk text-danger"></i> N° interior</label>
                                <input class="form-control" type="text" id="inside_number" data-bind="value:inside_number">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="zip_code"><i class="fa fa-asterisk text-danger"></i> C.P.</label>
                                <input class="form-control" type="text" id="zip_code" data-bind="value:zip_code">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="reference"><i class="fa fa-asterisk text-danger"></i> Referencia</label>
                                <input class="form-control" type="text" id="reference" data-bind="value:reference">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email"><i class="fa fa-asterisk text-danger"></i>E-mail</label>
                                <input class="form-control" type="text" id="email" data-bind="value:email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone"><i class="fa fa-asterisk text-danger"></i>Telefono</label>
                                <input class="form-control" type="text" id="phone" data-bind="value:phone">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contact"><i class="fa fa-asterisk text-danger"></i> Contacto</label>
                                <input class="form-control" type="text" id="contact" data-bind="value:contact">
                            </div>                            
                        </div>

                    </div>
                    <!-- /DATOS DE LA CUENTA -->
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">CERRAR</button>
                <button class="btn btn-orange" data-bind="click:$root.sucursal.grabar">GUARDAR</button>
            </div>

        </div>
    </div>
</div>