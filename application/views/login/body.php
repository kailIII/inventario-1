<div class="verticalcenter">
	<a class="login-brand" href="">
		<?=$logo_app?>
	</a>

	<div class="panel panel-primary">
		<div class="panel-body">

			<?php if ($error != ''): ?>
				<div class="alert alert-dismissable alert-danger">
					<strong>Error!</strong> <?=$error?>
					<button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-times"></i></button>
				</div>
			<?php endif; ?>

			<h4 class="text-center" style="margin-bottom: 25px;">Coloque su nombre de usuario y contraseña.</h4>
			<form action="<?=$action?>" method="POST" class="form-horizontal">
				<div class="form-group">
					<label for="user" class="control-label col-sm-4" style="text-align: left;">Usuario</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="user" name="user" placeholder="Usuario">
					</div>
				</div>
				<div class="form-group">
					<label for="pass" class="control-label col-sm-4" style="text-align: left;">Contraseña</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
					</div>
				</div>
				<div class="clearfix">
					<div class="pull-right"><label><input type="checkbox" value="1" name="remember"> Recordarme</label></div>
				</div>
				<button type="submit" value="entrar" name="entrar" class="btn btn-primary btn-block">Entrar</button>
			</form>
		</div>
		<div class="panel-footer">
			<a href="#" class="btn btn-link btn-block">¿Olvidaste la contraseña?</a>
		</div>
	</div>
 </div>
