  			<div class="news_ tab-pane active" id="news_">
				<form name="formPost" class="formPost row-border" data-validate="parsley" id="validate-form">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control parsley-validated" name="title" id="title" placeholder="Tema del articulo" required="required">
							</div>
						</div>
					</div>
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
						<div class="col-md-6">
							<div class="form-group">
								<textarea class="form-control" name="video" id="video" placeholder="[Insesrtar video embed Iframe]: se mostrará como principal en el post."></textarea>
							</div>
						</div>					
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<textarea cols="40" rows="3" class="desc" id="description" class="form-control" tabindex="3" style="visibility: hidden; display: none;"></textarea>						
							</div>
						</div>					
					</div>					
					<div class="row">
						<div class="col-md-6 form-group">
							<div id="_iP" class="col-md-12" ></div>
						</div>
					</div>
				</form>
				<div class="row">
					<div class="col-md-5">
						<form action="<?php echo site_url($domain.'/postear/api/datos/UploadFile/'); ?>"  accept-charset="utf-8" role="form" id="uploadImg" method="POST" enctype="multipart/form-data" >
							<div class="row">
								<div class="col-md-2">
									<span class="fa fa-camera fa-2x fileinput-button ">
									<?php if($this->CI->dx_auth->is_logged_in()): ?>
								    	<input type="file" name="file" value="" id="file" tabindex="1" class="ui-button-text" multiple="1">
								    <?php endif; ?>
								    </span>
							    </div>
								<div class="_post col-md-3 pull-right" data-bind="click: $root.s._post" id="o1">
									<div class="btn btn-brown">Publicar</div>
								</div>
							</div>
						</form>
					</div>
				</div>
  			</div>
