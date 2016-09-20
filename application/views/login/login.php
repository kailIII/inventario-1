<div class="verticalcenter">
	<div class="panel panel-orange">
		<div class="panel-body">
			<div class="error"></div>

			<h4 class="text-center" style="margin-bottom: 25px;">Coloque su nombre de usuario y contraseña.</h4>
			<form action="" class="form-horizontal" id="formlogin">
				<div class="form-group">
					<label for="user" class="control-label col-sm-4" style="text-align: left;">Usuario</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="user" name="user" placeholder="Usuario" >
					</div>
				</div>
				<div class="form-group">
					<label for="pass" class="control-label col-sm-4" style="text-align: left;">Contraseña</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" >
					</div>
				</div>
				<div class="clearfix">
					<div class="pull-right"><label><input type="checkbox" value="1" name="remember"> Recordarme</label></div>
				</div>
				<a href="#" class="btn btn-primary btn-block" onclick="login()" >Entar</a>
			</form>
		</div>
		<div class="panel-footer">
			<a href="#" class="btn btn-link btn-block">¿Olvidaste la contraseña?</a>
		</div>
	</div>
 </div>