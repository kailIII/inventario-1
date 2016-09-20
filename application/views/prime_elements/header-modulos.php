<header>
	<div id="logo">
		<div class="_l_i col-md-12">
            <div class="row">
                <div class="col-sm-12">
                    <a>
                    	<img class="img-responsive" src="{logo}">
                    </a>
                </div>
            </div>
        </div>	
		<div class="_l_t">
			<div class="theme"><a href="<?=base_url($domain)?>">{logo_name}</a></div>
			<div class="descr"><small>{logo_description}</small></div>
		</div>
	</div>
	<nav><?=$opciones?></nav>
	<?//=$social?>
	<div id="userheader">
		<div class="registration">
			<?php //echo isset($registration)?$registration:"";?>
		</div>

		<!-- Modal login -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">              
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="false">Cerrar</button>
		        <h4 class="modal-title" id="myModalLabel">Login</h4>
		      </div>
		      <div class="modal-body">
		          {login}
		      </div>
		    </div>
		  </div>
		</div>

		<?php //echo isset($newuser)?$newuser:"";?>
	</div>

	
</header>
