<div id="modalNewUserClient" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-nuevo-usuario-titulo" aria-hidden="true" data-bind="with: userEditPrime">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title" id="modal-nuevo-usuario-titulo" data-bind="text:ventana_titulo"></h3>
            </div>

            <div class="modal-body">
                <p>Campos con <i class="fa fa-asterisk text-danger"></i> son obligatorios.</p>
                
                <ul id="usaurio-datos" class="nav nav-tabs">
                    <li class="active"><a href="#usuario-cuenta" data-toggle="tab">Datos de la Cuenta</a></li>
                    <!-- <li class=""><a href="#usuario-extras" data-toggle="tab">Datos Extras</a></li> -->
                </ul>

                <div id="usuario-datos-contenido" class="tab-content">
                    <!-- DATOS DE LA CUENTA -->
                    <div class="tab-pane fade active in" id="usuario-cuenta">

                        <div class="row" data-bind="visible: id() == 0">
                            <div class="form-group col-md-6">
                                <label for="usuario"><i class="fa fa-asterisk text-danger"></i> Usuario</label>
                                <input class="form-control" type="text" id="usuario" placeholder="Usuario..." data-bind="value:username">
                                <!-- <span class="help-block"><small>Nombre de usuario que se usará para ingresar al sistema.</small></span> -->
                            </div>
                            <div class="form-group col-md-6">
                                <label for="correo"><i class="fa fa-asterisk text-danger"></i> Correo</label>
                                <input class="form-control" type="text" id="correo" placeholder="Correo..." data-bind="value:email">
                            </div>
                        </div>
                        <div class="row">
                  <!--           <div class="form-group col-md-6">
                                <label for="nombre"><i class="fa fa-asterisk text-danger"></i> Nombre</label>
                                <input class="form-control" type="text" id="nombre" placeholder="Nombre..." data-bind="value:perfil.nombre">
                            </div> -->
                            <div class="form-group col-md-6">
                                <label for="pass"><i class="fa fa-asterisk text-danger"></i> Contraseña</label>
                                <input class="form-control" type="text" id="pass" placeholder="Contraseña..." data-bind="value:pass">
                                <!-- <span class="help-block"><small>Contraseña que se usará para ingresar al sistema.</small></span> -->
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pass"><i class="fa fa-asterisk text-danger"></i> Repetir contraseña</label>
                                <input class="form-control" type="text" id="repass" placeholder="Contraseña..." data-bind="value:repass">
                                <!-- <span class="help-block"><small>Contraseña que se usará para ingresar al sistema.</small></span> -->
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="usuario"><i class="fa fa-asterisk text-danger"></i> Dominio</label>
                                <input class="form-control" type="text" id="domain" data-bind="value:domain">
                                <span class="help-block"><small>http://mireino.com/NombreElejido<span data-bind="value:domain"></span></small></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label><i class="fa fa-asterisk text-danger"></i>Nombre de tu sitio</label>
                                <input class="form-control" type="text" maxlength="30" placeholder="maximo 15 caracteres" data-bind="value:company">
                             <span class="help-block"><small>Cambiar por SISTEMA DELXUER.</small></span>                                
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label"><i class="fa fa-asterisk text-danger"></i>Descripción</label>
                                <input class="form-control" type="text"  maxlength="35" placeholder="maximo 30 caracteres" data-bind="value:description">
                             <span class="help-block"><small>Cambiar por Un sitio para compartir</small></span>                                
                            </div>                        
                        </div>
     <!--                    <div class="form-group">
                            <label for="rol"><i class="fa fa-asterisk text-danger"></i> Rol</label>
                            <select class="form-control" data-bind="options: $root.roles, optionsText: 'name', optionsValue: 'id', value: role_id "></select>
                        </div> -->

                    </div>
                    <!-- /DATOS DE LA CUENTA -->



                    <!-- DATOS EXTRAS -->
  <!--                   <div class="tab-pane fade" id="usuario-extras">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="paterno">Apellido Paterno</label>
                                <input class="form-control" type="text" id="paterno" placeholder="Paterno..." data-bind="value:perfil.paterno">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="materno">Apellido Materno</label>
                                <input class="form-control" type="text" id="materno" placeholder="Materno..." data-bind="value:perfil.materno">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="puesto">Puesto</label>
                                <input class="form-control" type="text" id="puesto" placeholder="Puesto..." data-bind="value:perfil.puesto">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="telefono">Telefono</label>
                                <input class="form-control" type="text" id="telefono" placeholder="Teléfono..." data-bind="value:perfil.telefono">
                            </div>
                        </div>
                    </div> -->
                    <!-- DATOS EXTRAS -->
                </div>
            </div>



            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">CERRAR</button>
                <button class="btn btn-orange" data-bind="click: $root.user.guc">GUARDAR</button>
            </div>

        </div>
    </div>
</div>