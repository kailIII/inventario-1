<!-- ko with: socialEdit -->
<section id="social">
	<div class="col-md-13">
		<div id="PageF">
			<div class="row">
				<div class="col-md-13">
					<div class="col-md-6">
						<input type="text" class="form-control page_f" name="page" id="page"  data-bind="value:facebook, enable: $root.editar" placeholder="Nombre de tu página de facebook">
						<span><small>https://www.facebook.com/<label data-bind="text: facebook"></label></small></span>
					</div>
                    <div class="btn-group">
                    <?php if($this->CI->dx_auth->is_logged_in()): ?>
                        <button title="Editar" class="btn btn-orange" type="button" data-bind="click: $root.social.editar"><i class="fa fa-pencil"></i></button>
                        <button title="Guardar" class="fbPage btn btn-success" type="button" data-bind="click: $root.social.grabar, enable: $root.editar"><i class="fa fa-save"></i></button>
                    <?php endif; ?>
                    </div>					
				</div>
			</div>
		</div>
		<div id="PageT">
			<div class="row">
				<div class="col-md-13">
					<div class="col-md-6">
						<input type="text" class="form-control" name="page" id="page"  data-bind="value:twitter, enable: $root.editar" placeholder="Nombre de tu página de twitter">
						<span><small>https://www.twitter.com/<label data-bind="text: twitter"></label></small></span>
					</div>
				</div>
			</div>
		</div>
		<div id="PageG">
			<div class="row">
				<div class="col-md-13">
					<div class="col-md-6">
						<input type="text" class="form-control" name="page" id="page"  data-bind="value:google, enable: $root.editar" placeholder="Nombre de tu página de google">
						<span><small>Google + <label data-bind="text: google"></label></small></span>
					</div>
				</div>
			</div>
		</div>
		<div id="PageY">
			<div class="row">
				<div class="col-md-13">
					<div class="col-md-6">
						<input type="text" class="form-control" name="page" id="page"  data-bind="value:youtube, enable: $root.editar" placeholder="Nombre de tu página de youtube">
						<span><small>Youtube <label data-bind="text: youtube"></label></small></span>
					</div>
				</div>
			</div>
		</div>		
	</div>
</section>
<!-- /ko -->