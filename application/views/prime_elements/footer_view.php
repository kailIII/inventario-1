<div class="footer_wrap">
	<div class="elements">
		<div class="item">
			<div class="icon">
				<span class="fa fa-location-arrow fa-4x wow bounceIn" data-wow-delay="0.1s"></span>
			</div>
			<header>
				<h3><a href="javascript:void(0)">Direccion</a></h3>
				<address>
					<small>
						<?php echo !isset($street)? "" : $street.", "; ?>
						<?php echo !isset($colony)? "" : $colony.", "; ?><br>
						<?php echo !isset($city)? "" : $city.", "; ?>
						<?php echo !isset($state)? "" : $state.", "; ?>
						<?php echo !isset($country)? "" : $country; ?>
					</small>
				</address>			
			</header>
		</div>
		<div class="item">
			<div class="icon">
				<span class="fa fa-phone fa-4x wow bounceIn" data-wow-delay="0.1s"></span>
			</div>
			<header>
				<h3><a href="javascript:void(0)">Contacto</a></h3>
				<address>
					<small>
						Correo: <?php echo !isset($email)? "" : $email; ?><br>
						Tel. <?php echo !isset($telefono)? "" : $telefono; ?><br>
					</small>
				</address>			
			</header>
		</div>		
	</div>
</div>
<div class="copyright">
	<div><small>Copyright © 2016-2036</small></div>
	<div><small>Sistema de inventario</small></div>
</div>

