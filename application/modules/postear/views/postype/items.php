			<div class="items_ tab-pane active"  id="items_">
				<form class="formPost row-border" data-bind="with: products" data-validate="parsley" id="validate-form" >
					<div class="row">
			            <div class="col-md-4">
							<label>Nombre</label>		
							<input type="text" class="form-control parsley-validated" id="title" data-bind="value: title" required="required">
						</div>
						<div class="col-md-3">
							<label>Factura</label>		
							<input class="form-control" type="text" id="invoice" data-bind="value: invoice">
						</div>
						<div class="col-md-3">
							<label>N° de serie</label>
							<input class="form-control" type="text" id="serie" data-bind="value:serie">
						</div>
						<div class="col-md-2">
							<label>N° de inventario</label>
							<input  disabled="disabled" class="form-control" type="text" id="folio" data-bind="value:folio">
							<input  disabled="disabled" class="form-control" type="hidden" id="folio_id" data-bind="value:folio_id">
							<input disabled="disabled" class="form-control" type="hidden" id="folio_current" data-bind="value:folio_current">
						</div>						
			            <label class="col-md-12"></label>
			            <label class="col-md-12"></label>
						<div class="col-md-7">
							<label>Descripcion</label>		
							<textarea class="form-control" id="description" data-bind="value:description"></textarea>
						</div>
						<div class="col-md-3">
							<label>Codigo de barras</label>
							<input class="form-control" type="text" id="barcode" data-bind="value:barcode">
						</div>						
			            <label class="col-md-12"></label>
			            <label class="col-md-12"></label>
						<div class="col-md-2">
							<label>Costo</label>		
			                <input type="text" class="form-control parsley-validated" id="price" data-bind="value: price" placeholder="$" required="required">
				        </div>
						<div class="col-md-2">
							<label>Moneda</label>
                            <select class="form-control" data-bind="options: $root.TypeOfCurrence, optionsText: 'currency', optionsValue: 'id', value: TypeOfCurrence_id "></select>
			            </div>
			            <label class="col-md-12"></label>
			            <label class="col-md-12"></label>
						<div class="col-md-4">
							<label>Proveedor</label>
                            <select class="form-control" data-bind="options: $root.Provider,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: Provider_id "></select>
                        	<!-- ko if:  !Provider_id() -->
							<label data-bind="visible:newProvider">&nbsp;</label>		
							<input type="text" class="form-control parsley-validated" placeholder="Nuevo proveedor" data-bind="value: Provider, visible:newProvider" required="required">
                        	<!-- /ko -->
						 </div>
						<div class="col-md-1">
							<label>
							</label>
							    <a class="badge badge-primary pull-center">
							        <i class="fa fa-question fa-lg ayuda" data-container="body" data-toggle="tooltip" data-placement="left" title="!Agregar nuevo proveedor!">
									</i>
							    </a>
								&nbsp;
								&nbsp;
								&nbsp;
							<label class="col-md-12">
								<input type="checkbox" name="addProvider" data-bind="checked: newProvider">
							</label>
			            </div>
			            <label class="col-md-12"></label>
			            <label class="col-md-12"></label>	
						<div class="col-md-4">
							<label>Usuario</label>		
                            <select class="form-control" data-bind="options: $root.Users,optionsCaption:'Seleccione una opcion', optionsText: 'username', optionsValue: 'id', value: User_id "></select>
			            </div>
			            <label class="col-md-12"></label>
			            <label class="col-md-12"></label>			            
						<div class="col-md-4">
							<label>Sucursal</label>		
                            <select class="form-control" data-bind="options: $root.Subsidiary,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: Subsidiary_id "></select>
			            </div>			            
						<div class="col-md-3">
							<label>Centro de costo</label>		
                            <select class="form-control" data-bind="options: $root.CostCenter,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: Ubication_id"></select>
                        	<!-- ko if:  !Ubication_id() -->
							<label data-bind="visible:newUbication">&nbsp;</label>		
							<input type="text" class="form-control parsley-validated" placeholder="Nueva Ubicacion" data-bind="value: Ubication, visible:newUbication" required="required">
                        	<!-- /ko -->

			            </div>
						<div class="col-md-1">
							<label>
							</label>
							    <a class="badge badge-primary pull-center">
							        <i class="fa fa-question fa-lg ayuda" data-container="body" data-toggle="tooltip" data-placement="left" title="!Agregar nueva ubicacion!">
									</i>
							    </a>
								&nbsp;
								&nbsp;
								&nbsp;
							<label class="col-md-12">
								<input type="checkbox" name="addUbication" data-bind="checked: newUbication">
							</label>
			            </div>			            
						<div class="col-md-4">
							<label>Sub-centro de costo</label>		
                            <select class="form-control" data-bind="options: $root.SubCostCenter,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: Ubication_id "></select>
                        	<!-- ko if:  !Ubication_id() -->
							<label data-bind="visible:newUbication">&nbsp;</label>		
							<input type="text" class="form-control parsley-validated" placeholder="Nueva Ubicacion" data-bind="value: Ubication, visible:newUbication" required="required">
                        	<!-- /ko -->

			            </div>
			            <label class="col-md-12"></label>
			            <label class="col-md-12"></label>
						<div class="col-md-4">
							<label>Departamento</label>		
                            <select class="form-control" data-bind="options: $root.Departament,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: Departament_id "></select>

			            </div>
			            <label class="col-md-12"></label>
			            <label class="col-md-12"></label>			            
			            <label class="col-md-12">		            
			            	<h2>Categorias</h2>
			            </label>
						<div class="col-md-4">
							<label>Tipo de activo fijo</label>
                            <select class="form-control" data-bind="options: $root.TypeFixedAssets,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: TypeFixedAssets_id "></select>
			            </div>
						<div class="col-md-3">
							<label>Marca</label>
                            <select class="form-control" data-bind="options: $root.brands,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: brand_id "></select>
                        	<!-- ko if:  !brand_id() -->
							<label data-bind="visible:newBrand">&nbsp;</label>
							<input type="text" class="form-control parsley-validated" placeholder="Nueva marca" data-bind="value: Brand, visible:newBrand" required="required">
                        	<!-- /ko -->
			            </div>
						<div class="col-md-1">
							<label>
							</label>
							    <a class="badge badge-primary pull-center">
							        <i class="fa fa-question fa-lg ayuda" data-container="body" data-toggle="tooltip" data-placement="left" title="!Agregar nueva marca!">
									</i>
							    </a>
								&nbsp;
								&nbsp;
								&nbsp;
							<label class="col-md-12">
								<input type="checkbox" name="addBrand" data-bind="checked: newBrand">
							</label>
			            </div>			            
			            <label class="col-md-12"></label>
			            <label class="col-md-12"></label>
						<div class="col-md-4">
							<label>Clase</label>		
                            <select class="form-control" data-bind="options: $root.Class,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: Class_id "></select>
			            </div>
						<div class="col-md-3">
							<label>Uso</label>		
                            <select class="form-control" data-bind="options: $root.Use,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: Use_id "></select>

			            </div>
			            <label class="col-md-12"></label>
			            <label class="col-md-12"></label>			            
						<div class="col-md-4">
							<label>Nivel de obsolescencia</label>
                            <select class="form-control" data-bind="options: $root.Level_obsolescence,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: Level_obsolescence_id "></select>

			            </div>
						<div class="col-md-3">
							<label>Estado fisico</label>		
                            <select class="form-control" data-bind="options: $root.Physical_state,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: Physical_state_id "></select>

			            </div>
			            <label class="col-md-12"></label>
			            <label class="col-md-12"></label>
						<div class="col-md-4">
							<label>Frecuencia de mes</label>		
							<input class="form-control" type="text" id="frecuencyMonth" data-bind="value:frecuencyMonth">
						</div>
						<div class="col-md-3">
							<label>Familia</label>		
                            <select class="form-control" data-bind="options: $root.Family,optionsCaption:'Seleccione una opcion', optionsText: 'name', optionsValue: 'id', value: Family_id "></select>
                        	<!-- ko if:  !Family_id() -->
							<label data-bind="visible:newFamily">&nbsp;</label>
							<input type="text" class="form-control parsley-validated" placeholder="Nueva familia" data-bind="value: Family, visible:newFamily" required="required">
                        	<!-- /ko -->

			            </div>
						<div class="col-md-1">
							<label>
							</label>
							    <a class="badge badge-primary pull-center">
							        <i class="fa fa-question fa-lg ayuda" data-container="body" data-toggle="tooltip" data-placement="left" title="!Agregar nueva familia!">
									</i>
							    </a>
								&nbsp;
								&nbsp;
								&nbsp;
							<label class="col-md-12">
								<input type="checkbox" name="addFamily" data-bind="checked: newFamily">
							</label>
			            </div>	
						<label class="col-md-12"></label>
			    		<label class="col-md-12"></label>						
						<div class="row">
							<div class="col-md-4">
								<div id="_iP" class="col-md-12" ></div>
							</div>
						</div>
					</div>
				</form>
				<label class="col-md-12"></label>
			    <label class="col-md-12"></label>
				<div class="row">
					<div class="col-md-5">				
						<form  accept-charset="utf-8" role="form" id="uploadImg" enctype="multipart/form-data" >
							<div class="row">
								<div class="col-md-2">
									<span class="fa fa-camera fa-2x fileinput-button ">
									<?php if($this->CI->dx_auth->is_logged_in()): ?>
								    	<input type="file" name="file" value="" id="file" tabindex="1" class="ui-button-text" multiple="1">
								    <?php endif; ?>
								    </span>
							    </div>
								<div class="_post col-md-3 pull-right" data-bind="click: $root.s._post" id="o1">
									<div class="btn btn-brown">Guardar</div>
								</div>
							</div>						
						</form>
					</div> 
				</div>
			</div> 
	  