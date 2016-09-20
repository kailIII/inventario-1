<ul id="usuarios-menu" class="nav nav-tabs">
    <li class="active"><a href="#usuarios-tabla" data-toggle="tab">Proveedores</a></li>
</ul>


<div id="usuarios-contenido" class="tab-content">
    <!-- USUARIOS -->
    <div class="tab-pane fade in active" id="usuarios-tabla">
        <div class="clearfix">
            <br>
            <button class="btn btn-success pull-right" data-bind="click:user.nuevo"><i class="fa fa-plus"></i> Agregar proveedor</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Municipio</th>
                    <th>E-mail</th>
                    <th></th>
                </tr> 
            </thead>
            <tbody data-bind="foreach:usuarios">
                
                <tr data-bind="css:{error:banned()==1}">
                    <td data-bind="text:id"></td>
                    <td data-bind="text:name"></td>
                    <td data-bind="text:city"></td>
                    <td data-bind="html:email"></td>
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

</div>
