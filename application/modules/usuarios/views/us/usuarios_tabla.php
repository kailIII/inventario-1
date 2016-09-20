<ul id="usuarios-menu" class="nav nav-tabs">
    <li class="active"><a href="#usuarios-tabla" data-toggle="tab">Usuarios</a></li>
    <li class=""><a href="#roles-tabla" data-toggle="tab">Roles</a></li>
</ul>


<div id="usuarios-contenido" class="tab-content">
    <!-- USUARIOS -->
    <div class="tab-pane fade in active" id="usuarios-tabla">
        <div class="clearfix">
            <br>
            <button class="btn btn-success pull-right" data-bind="click:user.nuevo"><i class="fa fa-plus"></i> Agregar Usuario</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>E-mail</th>
                    <th></th>
                </tr> 
            </thead>
            <tbody data-bind="foreach:usuarios">
                
                <tr data-bind="css:{error:banned()==1}">
                    <td data-bind="html:ventana_banned"></td>
                    <td data-bind="text:username"></td>
                    <td data-bind="text:role_name"></td>
                    <td data-bind="text:email"></td>
                    <td>
                        <div class="btn-group">
                            <button title="Editar" class="btn btn-orange" type="button" data-bind="click:$root.user.editar"><i class="fa fa-pencil"></i></button>
                            <button title="Deshabilitar" class="btn btn-danger" type="button" data-bind="click:$root.user.borrar, visible:(username()!='root' && banned()==0)"><i class="fa fa-times"></i></button>
                            <button title="Rehabilitar" class="btn btn-success" type="button" data-bind="click:$root.user.recuperar, visible:(username()!='root' && banned()==1)"><i class="fa fa-ok"></i></button>
                            <button title="Cambiar Contraseña" class="btn btn-default" type="button" data-bind="click:$root.user.pass"><i class="fa fa-reply"></i></button>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
        <div id="id_usuario" class="pagination" ></div>
    </div>
    <!-- /USUARIOS -->


    <!-- ROLES -->
    <div class="tab-pane fade" id="roles-tabla">
        <div class="clearfix">
            <br>
            <button class="btn btn-success pull-right" data-bind="click:rol.nuevo"><i class="fa fa-plus"></i> Agregar Rol</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Rol</th>
                    <th></th>
                </tr> 
            </thead>
            <tbody data-bind="foreach:roles">
                <tr>
                    <td data-bind="text:name"></td>
                    <td>
                        <div class="btn-group" data-bind="visible:name()!='Administrador' ">
                            <button title="Eliminar" class="btn btn-danger" type="button" data-bind="click:$root.rol.borrar"><i class="fa fa-times"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /ROLES -->
</div>
