<ul id="usuarios-menu" class="nav nav-tabs">
    <li class="active"><a href="#usuarios-tabla" data-toggle="tab">Consecutivo de folios</a></li>
</ul>


<div id="usuarios-contenido" class="tab-content">
    <!-- USUARIOS -->
    <div class="tab-pane fade in active" id="usuarios-tabla">
        <div class="clearfix">
            <br>
            <button class="btn btn-success pull-right" data-bind="click:folio.nuevo"><i class="fa fa-plus"></i> Agregar consecutivo</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Serie</th>
                    <th>Actual</th>
                    <th>Sucursal</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>  
            </thead>
            <tbody data-bind="foreach:folios">
                
                <tr data-bind="css:{error:banned()==1}">
                    <td data-bind="text:id"></td>
                    <td data-bind="text:serie"></td>
                    <td data-bind="html:current"></td>
                    <td data-bind="text:subsidiary"></td>
                    <td data-bind="text:status"></td>
                    <td></td>
                    <td>
                        <div class="btn-group">
                            <button title="Editar" class="btn btn-orange" type="button" data-bind="click:$root.folio.editar"><i class="fa fa-pencil"></i></button>
                            <button title="Deshabilitar" class="btn btn-danger" type="button" data-bind="click:$root.folio.borrar, visible:(banned()==0)"><i class="fa fa-times"></i></button>
                            <button title="Rehabilitar" class="btn btn-success" type="button" data-bind="click:$root.folio.recuperar, visible:( banned()==1)"><i class="fa fa-ok"></i></button>
                            <button title="Cambiar Contraseña" class="btn btn-default" type="button" data-bind="click:$root.folio.pass"><i class="fa fa-reply"></i></button>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
        <div id="id_usuario" class="pagination" ></div>
    </div>
    <!-- /USUARIOS -->

</div>
