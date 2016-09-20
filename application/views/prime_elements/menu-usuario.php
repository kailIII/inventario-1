<li>
	<a href="">
		<small>{nombre}</small>
		<!--<img class="img-responsive" src="{imagen_perfil}" alt="{nombre}" />-->
	</a>
	<ul>	
		<li>
			<a href="<?=site_url($domain.'/usuarios/perfil')?>"><span><i class="fa fa-pencil"></i></span> Mi Perfil</a>
		</li>
		<li><a href="<?=site_url('login/out')?>"><span><i class="fa fa-power-off"></i></span> Salir</a></li>
	</ul>
</li>
