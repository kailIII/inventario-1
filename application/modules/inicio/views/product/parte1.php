<div class="panel panel-primary">
    <div class="panel-heading">PRODUCTO
        <div class="pull-right"><i class="fa fa-check-square"></i></div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-6">
        <button class="btn btn-danger btn-block" data-bind="click: $root.articles.editar">Editar</button>
        <button class="btn btn-warning btn-block" data-bind="click: $root.articles.grabar">Guardar</button>
    </div>
</div>
<div class="row">
    <div class="span" style="margin:5px;">
        <table class="table table-bordered">
            <tbody >
                <tr >                    
                    <td class="col-md-5 col-md-offset-2" >
                        <strong id="title">Nombre</strong>
                        <input type="text" class="form-control" id="title" data-bind="value: title, enable: $root.editar">
                    </td>
                    <td class="col-md-5" colspan="2"  >
                        <strong id="pregunta">N° de inventario</strong>
                        <input type="text" class="form-control" id="folio" data-bind="value: folio, enable: $root.editar">
                    </td>
                </tr>                            
                <tr >                    
                    <td class="col-md-5">
                        <strong id="description">Descripcion</strong>
                        <textarea id="description" class="form-control autosize"  data-bind="value: description, enable: $root.editar"></textarea>
                    </td>
                    <td class="col-md-6">
                        <strong id="pregunta">N° de serie</strong>
                        <input type="text" class="form-control" id="folio" data-bind="value: serie, enable: $root.editar">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

   
<div class="row">
    <div class="col-md-5 form-group">
        <label>Proveedor</label>        
        <select class="form-control" data-bind="options: $root.Provider, optionsText: 'name', optionsValue: 'id', value: Provider_id, enable: $root.editar "></select>         
    </div>
    <div class="col-md-3 form-group">
        <label>Usuario</label>        
        <select class="form-control" data-bind="options: $root.Users, optionsText: 'username', optionsValue: 'id', value: id_user_assign, enable: $root.editar "></select>         
    </div>    
</div>
<div class="row">
    <div class="col-md-5 form-group">
        <label>Valor de la adquisicion</label>
        <input type="text" class="form-control" id="price" data-bind="value: price, enable: $root.editar ">    
    </div>
    <div class="col-md-3 form-group">
        <label>Moneda</label>
        <select class="form-control" data-bind="options: $root.TypeOfCurrence, optionsText: 'currency', optionsValue: 'id', value: TypeOfCurrence_id, enable: $root.editar "></select>       
    </div>
</div>