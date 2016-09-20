<div class="col-md-12">
	<div class="panel panel-sky">
	  <div class="panel-heading">
		<h4>
			<ul class="nav nav-tabs" >
              <!--<li class="active"><a href="#events1" data-toggle="tab"><i class="fa fa-ticket"></i></a></li>-->
              <!--<li class="" id="n_" data-bind="click: $root.mipost.n_"><a href="#news_" data-toggle="tab">Noticia</a></li>-->
              <li class="active" id="i_" data-bind="click: $root.mipost.i_"><a href="#items_" data-toggle="tab">Articulo</a></li>
            </ul>
        </h4>
	  	<div class="options"></div>
	  </div>
	  <div class="panel-body">
	  	<div class="tab-content">
			<div class="tab-pane active" id="items_">
				<!--Imagenes de muestra de las publicaiones-->
			</div>
			<?php //echo $news; ?>
			<?php echo $items; ?>
	  	</div>
	  </div>
	</div>
</div>

