<div>
        <strong id="pregunta">1.- Ubicaciones y caracteristicas del producto</strong>
 </div> 
 <div class="panel panel-primary" >
	<div class="panel-heading">Categorias</div>
    <table class="table table-bordered">
    	<tbody>
    		<tr>
    			<td class="col-md-4">
                    <label>Marca</label>
                    <select class="form-control" data-bind="options: $root.brands, optionsText: 'name', optionsValue: 'id', value: brand_id, enable: $root.editar "></select>
                </td>
    			<td class="col-md-4">
                    <label>Tipo de activo fijo</label>
                    <select class="form-control" data-bind="options: $root.TypeFixedAssets, optionsText: 'name', optionsValue: 'id', value: TypeFixedAssets_id, enable: $root.editar "></select>                
                </td>
                <td class="col-md-4">
                </td>
            </tr>
    		<tr>
                <td class="col-md-4">
                    <label>Clase</label>        
                    <select class="form-control" data-bind="options: $root.Class, optionsText: 'name', optionsValue: 'id', value: Class_id, enable: $root.editar "></select>                    
                </td>
                <td class="col-md-4">
                    <label>Uso</label>      
                    <select class="form-control" data-bind="options: $root.Use, optionsText: 'name', optionsValue: 'id', value: Use_id, enable: $root.editar "></select>                
                </td>
                <td class="col-md-4">
                </td>

    		</tr>
    		<tr>
                <td class="col-md-4">
                    <label>Nivel de obsolescencia</label>      
                    <select class="form-control" data-bind="options: $root.Level_obsolescence, optionsText: 'name', optionsValue: 'id', value: Level_obsolescence_id, enable: $root.editar "></select>           
                </td>
                <td class="col-md-4">
                    <label>Estado fisico</label>        
                    <select class="form-control" data-bind="options: $root.Physical_state, optionsText: 'name', optionsValue: 'id', value: Physical_state_id, enable: $root.editar "></select>                    
                </td>
                <td class="col-md-4">
                    <label>Centro de costo</label>      
                    <select class="form-control" data-bind="options: $root.Departament, optionsText: 'name', optionsValue: 'id', value: Departament_id, enable: $root.editar "></select>          
                </td>
    		</tr>
            <tr>
                <td class="col-md-4">
                    <label>Ubicacion</label>        
                    <select class="form-control" data-bind="options: $root.Ubication, optionsText: 'name', optionsValue: 'id', value: Ubication_id, enable: $root.editar "></select>         
                </td>
                <td class="col-md-4">
                    <label>Familia</label>      
                    <select class="form-control" data-bind="options: $root.Family, optionsText: 'name', optionsValue: 'id', value: Family_id, enable: $root.editar "></select>                 
                </td>
                <td class="col-md-4">
                    <label>Frecuencia de mes</label>        
                    <input class="form-control" type="text" id="frecuencyMonth" data-bind="value:frecuencyMonth, enable: $root.editar ">    
                </td>
            </tr>            
    	</tbody>
    </table>
    <hr>
    <div class="row" data-bind="">
        <div class="col-md-3 col-md-offset-3" style="padding-top: 10px; text-align: right">
            <label>Seleccione estatus</label>
        </div>
        <div class="col-md-3">
            <select class="form-control" data-bind="options: $root.catEstatus, optionsText: 'nombre', optionsValue: 'id', value: status"></select>
        </div>
    </div>
<!-- ko if:  status() == 2 -->
    <div class="panel panel-success" >
        <div class="panel-heading">
            Comentarios y observaciones
        </div>
        <div class="panel-body" id="comentarios">
            <textarea id="cantidad2" class="form-control" data-bind="value: comentarios, hasFocus: $root.noSeleccionado2"  onKeyPress="calcular()" onKeyUp="calcular()" maxlength="400"></textarea>
        </div>
        <div class="pull-right">
            <h6><span id="caracteres2">400</span> de 400 caracteres</h6>
        </div>
    </div>    
<!-- /ko -->
</div>