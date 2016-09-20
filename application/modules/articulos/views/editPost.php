<div class="editNews">
	<div class="col-md-12">
		<div class="panel panel-sky">
		  <div class="panel-heading">
			<h4>
				<ul class="nav nav-tabs">
	              <li class="active"><a href="#news1" data-toggle="tab">Editar</a></li>
	            </ul>
	        </h4>
		  	<div class="options"></div>
		  </div>
		  <div class="panel-body">
		  	<div class="tab-content">
	  			<div class="tab-pane active" id="news1">
					<form name="formEdit" class="formEdit row-border" data-validate="parsley" id="validate-form">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div id="_viral" data-_w="<?php echo $ide; ?>"></div>
									<input type="text" class="form-control parsley-validated" id="title" data-_t="<?php echo urls_amigables($title); ?>"  value="<?php echo htmlspecialchars($title); ?>" placeholder="Tema del articulo"required="required">
								</div>
							</div>
						</div>		
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
				                    <select class="form-control" id="category" name="category">
				                            <option value="">Seleccione una categoria</option>
											<?php foreach($catList as $key => $val): ?>
												<?php if($val["id"]==$id_category): ?>
				                            <option value="<?php echo $val['id']; ?>" selected><?php echo urls_amigables($val["name"]); ?></option>
												<?php else: ?>
				                            <option value="<?php echo $val['id']; ?>" ><?php echo urls_amigables($val["name"]); ?></option>
												<?php endif; ?>
				                        	<?php endforeach; ?>
				                    </select>
					            </div>
							</div>					
						</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<textarea class="form-control" name="video" id="video" placeholder="[Insesrtar video embed Iframe]: se mostrará como principal en el post."><?php echo $video; ?></textarea>
							</div>
						</div>					
					</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<textarea cols="40" rows="3" id="description" class="form-control" tabindex="3" style="visibility: hidden; display: none;"><?php echo $description; ?></textarea>
								</div>
							</div>					
						</div>					
						<div class="row">
							<div class="col-md-6 form-group">
								<div id="_iP" class="col-md-12" >
									<?php foreach($img as $k => $v): ?>
									<div class="row">
										<div class="itemImage col-md-4">
											<div class="img">
												<img class="img" src="<?=$url."/".$v;?>">
											</div>
											<span class="delete fa fa-times-circle fa-lg" data-file_ref="<?php echo $k; ?>"></span>
										</div>
										<div class="col-md-8">
		                				<small><input type="text" value="<?php echo $url."/".$v; ?>"><label>copiar url para insertar imagen</label></small>
										</div>
									</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</form>
					<div class="row">
						<div class="col-md-5">
							<form action="<?php echo site_url($domain.'/postear/api/datos/UploadFile/'); ?>"  accept-charset="utf-8" role="form" id="uploadImg" method="POST" enctype="multipart/form-data" >
								<div class="row">
									<div class="col-md-2">
										<span class="fa fa-camera fa-2x fileinput-button ">
									    	<input type="file" name="file" value="" id="file" tabindex="1" class="ui-button-text" multiple="1">
									    </span>
								    </div>
									<div class="postEdit col-md-3" >
										<div class="btn btn-brown" data-bind="click: postEdit">Guardar</div>
									</div>
								</div>
							</form>
						</div>
					</div>
	  			</div>
		  	</div>
		  </div>
		</div>
	</div>
</div>