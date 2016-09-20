<div class="col-md-12">
	<div class="panel panel-sky">
	  <div class="panel-heading">
		<h4>
			<ul class="nav nav-tabs">
              <li class="active"><a href="#addArt" data-toggle="tab">Articulo</a></li>
              <li class=""><a href="#news1" data-toggle="tab">Noticia</a></li>
              <li class=""><a href="#articles" data-toggle="tab">Articulos</a></li>
            </ul>
        </h4>
	  	<div class="options"></div>
	  </div>
	  <div class="panel-body">
	  	<div class="tab-content">
  			<div class="tab-pane active" id="addArt">
				<div class="col-md-12">
					<form name="formItem" class="formSidebar formItem row-border" data-validate="parsley" id="validate-form">
						<div class="col-md-6">
							<div class="col-md-13">
					            <div class="col-md-12 form-group">
									<input type="text" class="form-control parsley-validated" id="item" name="item" placeholder="Nombre del articulo" required="required">
								</div>
							</div>
							<div class="col-md-13">
								<div class="col-md-12 form-group">
									<textarea class="form-control" name="descritem" placeholder="Descripcion del articulo"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-12">
								<div class="col-md-9 form-group">
					                <input type="text" name="price" class="form-control parsley-validated" id="price" placeholder="precio" required="required">
						        </div>
					        </div>
							<div class="col-md-12">
								<div class="col-md-9 form-group">
					                <input type="text" name="oldprice" class="form-control" placeholder="precio anterior" >
						        </div>
					        </div>
							<div class="col-md-12">
					            <div class="col-md-7 col-md-offset-2 form-group">
									<input type="text" class="form-control" name="stock" placeholder="existencias">
								</div>
							</div>
						</div>
						<textarea name="description" cols="40" rows="3" id="description" class="form-control" tabindex="3" style="visibility: hidden; display: none;"></textarea>						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
				                    <select class="form-control" id="category" name="category">
				                            <option value="">Seleccione una categoria</option>
											<?php foreach($catList as $key => $val): ?>
				                            <option value="<?php echo $val['id']; ?>"><?php echo $val["name"] ?></option>
				                        	<?php endforeach; ?>
				                    </select>
					            </div>
							</div>					
						</div>
						<div class="row">
							<div class="col-md-12 form-group">
								<div id="imgItems" class="col-md-12" ></div>
							</div>
						</div>
					</form>
				</div>	
				<div class="col-md-8">
					<form action="<?php echo site_url('articulos/api/datos/UploadFile/'); ?>"  accept-charset="utf-8" role="form" id="uploadItem" name="uploadItem" method="POST" enctype="multipart/form-data" >
						<div class="col-md-2">
							<span class="fa fa-camera fa-2x fileinput-button ">
						    	<input type="file" name="file" value="" id="file" tabindex="1" class="ui-button-text" multiple="1">
						    </span>
					    </div>
						<!-- <div class="col-md-2" onclick="postItem('0')"> -->
							<!-- <div class="btn btn-primary">Guardar</div> -->
						<!-- </div>						 -->
						<div class="col-md-3" id="postItem">
							<div class="btn btn-brown">Publicar</div>
						</div>
						<!-- <div class="col-md-12">&nbsp;</div> -->
					</form>
				</div>
  			</div>
  			<div class="tab-pane" id="news1">
				<form name="formNew" class="formSidebar formNew row-border" data-validate="parsley" id="validate-form">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control parsley-validated" name="title" id="title" placeholder="Tema del articulo"required="required">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<textarea class="form-control" name="description" id="description" placeholder="Descripcion del articulo"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<textarea class="form-control" name="video" id="video" placeholder="[Insesrtar video]: vinculo de youtube, vine, etc."></textarea>
							</div>
						</div>					
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
			                    <select class="form-control" id="categoryNew" name="categoryNew">
			                            <option value="">Seleccione una categoria</option>
										<?php foreach($catList as $key => $val): ?>
			                            <option value="<?php echo $val['id']; ?>"><?php echo $val["name"] ?></option>
			                        	<?php endforeach; ?>
			                    </select>
				            </div>
						</div>					
					</div>					
					<div class="row">
						<div class="col-md-6 form-group">
							<div id="imgNews" class="col-md-12" ></div>
						</div>
					</div>
				</form>
				<div class="row">
					<div class="col-md-5">
						<form action="<?php echo site_url('articulos/api/datos/UploadFile/'); ?>"  accept-charset="utf-8" role="form" id="uploadNew" method="POST" enctype="multipart/form-data" >
							<div class="row">
								<div class="col-md-2">
									<span class="fa fa-camera fa-2x fileinput-button ">
								    	<input type="file" name="file" value="" id="file" tabindex="1" class="ui-button-text" multiple="1">
								    </span>
							    </div>
								<div class="postNew col-md-3">
									<div class="btn btn-brown">Publicar</div>
								</div>
							</div>
						</form>
					</div>
				</div>
  			</div>
			<div class="tab-pane" id="articles">
                <div role="grid" class="dataTables_wrapper" id="example_wrapper">
                	<div class="row">
	            		<div class="col-xs-2">
	            			<div id="example_length" class="dataTables_length">
            					<select name="example_length" size="1" aria-controls="example" class="form-control">
            						<option value="10" selected="selected">10</option>
            						<option value="25">25</option>
            						<option value="50">50</option>
            						<option value="100">100</option>
            					</select>
	            			</div>
	            		</div>
	            		<div class="col-xs-8">
							<label>N° por pagina</label>
	            		</div>
            			<div class="col-xs-2">
            				<div class="dataTables_filter" id="example_filter">
            					<label>
            						<input type="text" aria-controls="example" class="form-control" placeholder="Buscar...">
            					</label>
            				</div>
            			</div>
            		</div>
                	<table cellspacing="0" cellpadding="0" border="0" id="example" class="table table-striped table-bordered datatables dataTable" aria-describedby="example_info">
	                    <thead>
	                        <tr role="row">
	                        	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Articulo</th>
	                        	<th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 266px;" aria-label="Browser: activate to sort column ascending">Descripcion</th>
	                        	<th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 230px;" aria-label="Platform(s): activate to sort column ascending">Precio</th>
	                        	<th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 152px;" aria-label="Engine version: activate to sort column ascending">Precio ant.</th>
	                        	<th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 107px;" aria-label="CSS grade: activate to sort column ascending">Existencia</th>
	                        </tr>
	                    </thead>
		                <tbody role="alert" aria-live="polite" aria-relevant="all" data-bind="foreach: $root.proyectos">
	                    <?php foreach($items as $k => $v): ?>
		            		<tr class="gradeA odd">
		                        <td data-bind="text: Abreviacion"><?php echo $v["item"] ?></td>
		                        <td data-bind="text: TituloRegulacion"><?php echo $v["description"] ?></td>
		                        <td data-bind="text: Estatus"><?php echo $v["price"] ?></td>
		                        <td data-bind="text: Mir"><?php echo $v["oldprice"] ?></td>
		                        <td data-bind=""><?php echo $v["stock"] ?></td>
		                    </tr>
		                <?php endforeach; ?>
		                </tbody>
               		</table>
	                <div class="row">
	                	<div class="col-xs-6">
	                		<div class="dataTables_info" id="example_info">Pagina 1 de 1</div>
	                	</div>
	                	<div class="col-xs-6">
	                		<div class="dataTables_paginate paging_bootstrap">
	                			<ol class="pagination">
	                				<li class="prev disabled"><a href="#"><i class="fa fa-long-arrow-left"></i> Previous</a></li>
	                				<li class="active"><a href="#">1</a></li>
	                				<li class="next"><a href="#">Next <i class="fa fa-long-arrow-right"></i></a></li>
	                			</ol>
	                		</div>
	                	</div>
	                </div>
            	</div>
			</div>

	  	</div>
	  </div>
	</div>
</div>