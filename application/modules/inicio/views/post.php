<section id="postSingle">
	<script src="http://platform.twitter.com/widgets.js" type="text/javascript"> </script>
	<?php foreach($art as $k => $v): ?>
	<?php if($v["price"]): ?>
	<article class="item">
	<?php if($v["showIconEdit"]): ?>
		<div class="conf" title="eliminar" data-dismiss="modal" data-toggle="modal" data-target="#dele">
			<i class="fa fa-times fa-2x"></i>
		</div>
		<div class="conf" title="editar">
			<a href="<?php echo site_url($domain).'/articulos/editar/'.$v['id'].'/'.urls_amigables($v['title']);; ?>">
				<i class="fa fa-edit fa-2x"></i>
			</a>
		</div>
	<?php endif; ?>
        <div class="itemThumb">
		<?php foreach($v["name"] as $k1 => $v1): ?>
			<div class='thumb'>	            
                <img src="<?php echo $v1 ?>">
            </div>
		<?php endforeach; ?>
        </div>		
        <h3><a href="javascript:;"><?php echo $v["title"]; ?></a></h3>
		<div class="date"><?php echo substr($v["registred_on"],0,16); ?> <a href="<?php echo site_url("$domain/$v[category]"); ?>"><?php echo $v["category"]; ?></a></div>
        <div class="itemData">
            <div class="itemPrice">
                <?php if($v["oldprice"]): ?>
                <div class="_price">Precio</div>
                <div class="price">
                	<span class="oldPrice"><span class="sign">MXN $</span><?php echo number_format($v["price"],2,",",""); ?></span>
                </div>
                <div class="_oldPrice">Precio anterior</div>
                <div class="oldPrice">
                	<span class="sign">MXN $</span><?php echo $v["oldprice"]; ?></p>
                </div>
                <?php else: ?>
                <div class="_price">Precio</div>
                <div class="price"><span class="currency before">MXN $</span><?php echo number_format($v["price"],2,".",","); ?></div>
                <?php endif; ?>
            </div>
            <div class="itemAction">
                <a class="addCar" href="javascript:;">
                    <span class="iconCar fa fa-shopping-cart"><span class="iconText"></span> Agregar al carrito</span>
                </a>
            </div>
        </div>		
		<div class="description"><?php echo $v["description"]; ?></div>
		<div class="social">	
			<ul>
				<li>
				<a  href="http://www.facebook.com/sharer.php?u=<?php echo $_url_f; ?>" class="fa fa-facebook-square fa-lg" target="_blank"></a>
				</li>
				<li><a href="http://twitter.com/share" target="_blank" class="fa fa-twitter-square fa-lg"></a></li>
				<li><a href="https://plus.google.com/share?url=<?php echo $_url_f; ?>" class="fa fa-google-plus-square fa-lg" target="_blank"></a></li>
				<li><a href="#" class="fa fa-envelope-square fa-lg"></a></li>
			</ul>
		</div>		
	</article>
	<?php else: ?>		
	<article class="news">
		<?php if($v["showIconEdit"]): ?>
		<div class="conf" title="eliminar" data-dismiss="modal" data-toggle="modal" data-target="#dele"><i class="fa fa-times fa-2x"></i></div>
		<div class="conf" title="editar"><a href="<?php echo site_url($domain).'/articulos/editar/'.$v['id'].'/'.urls_amigables($v['title']); ?>"><i class="fa fa-edit fa-2x"></i></a></div>
		<?php endif; ?>
		<hgroup><h2><a href="javascript:void(0)" ><?php echo $v["title"]; ?></a></h2></hgroup>
		<p class="date"><?php echo substr($v["registred_on"],0,16); ?> <a href=""><?php echo $v["category"]; ?></a></p>	
		<div class="extract"><?php echo $v["description"]; ?></div>
		<div class="social">
			<ul>
				<li>
				<a  href="http://www.facebook.com/sharer.php?u=<?php echo $_url_f; ?>" class="fa fa-facebook-square fa-lg" target="_blank"></a>
				</li>
				<li><a href="http://twitter.com/share" target="_blank" class="fa fa-twitter-square fa-lg"></a></li>
				<li><a href="https://plus.google.com/share?url=<?php echo $_url_f; ?>" class="fa fa-google-plus-square fa-lg" target="_blank"></a></li>
				<li><a href="#" class="fa fa-envelope-square fa-lg"></a></li>
			</ul>
		</div>		
	</article>
	<?php endif; ?>		
	<?php endforeach; ?>

</section>
<section id="_p_comments">
	<div class="_w-comm">
		<div class="txt-l">Comentarios</div>
		<div class="put_comm">
			<textarea id="_cm" class="form-control"></textarea>
		</div>
		<?php if($log_open): ?>
		<div class="btn btn-success btn-sm post_comm post_c" data-bind="click: comments.post_comm">comentar</div>
		<?php else: ?>
		<div class="btn btn-success btn-sm post_c" data-toggle="modal" data-target="#myModal">comentar</div>
		<?php endif ?>
		<div id="_p-ref"><span><?php echo $id_post; ?></span></div>
	</div>
	<div class="comments" data-bind="with: comments.commAll">
		<div class="_com" data-bind="foreach: $root.ar_view">
			<div class="_com-i">
            	<a class="thumbnail"><img data-bind="attr {src: image}"></a>
			</div>
			<div class="_com-context" >
				<div class="_com-n">
					<div class="conf" title="editar"><a href="javascript:void(0)"><i class="fa fa-pencil"></i></a></div>
					<span data-bind="text: username"></span>
				</div>
				<div class="_com-r">
					<span data-bind="text: comment"></span>
				</div>
				<div class="_com-rtl">
					<a href="javascript:void(0)">Me gusta</a>
				</div>					
				<div class="_com-rtr">
					<?php if($log_open): ?>
					<a class="_com-rtr-a" href="javascript:void(0)" data-bind="click: $root.comments.com_rtr_a">Responder</a>
					<?php else: ?>
					<a href="#" title="Entrar" data-toggle="modal" data-target="#myModal">Responder</a>
					<?php endif ?>
				</div>
				<div class="_com-r-ref">
					<span id="_com-r-ref" data-bind="text: id_comment"></span>
				</div>					
				<div class="comments" data-bind="foreach: ar_view__">
					<div class="_com">
						<div class="conf" title="editar"><a href="javascript:void(0)"><i class="fa fa-pencil"></i></a></div>
						<div class="_com-i">
		                	<a class="thumbnail"><img data-bind="attr {src: image}"></a>
						</div>
						<div class="_com-context">
							<div class="_com-n">
								<span data-bind="text: username"></span>
							</div>
							<div class="_com-r">
								<span data-bind="text: comment"></span>
							</div>
							<div class="_com-rtl">
								<a href="javascript:void(0)">Me gusta</a>
							</div>									
						</div>
					</div>
				</div>			
				<div class="_com-rtr">
					<div class="_com-rtr-ap"></div>
				</div>
			</div>
		</div>
	</div>
</section>

<div id="fb-root">
	<div class="fb-comments" data-href="<?php echo $_url_f; ?>" data-numposts="5"></div>
</div>

<div class="modal fade"  id="dele"  tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modalfinal-mai">
    <div class="modal-content">              
      <div class="modal-header">
       <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="false">X</button>-->
        <h4 class="modal-title" id="myModalLabel">Eliminar post</h4>
        <h6 class="modal-title" id="myModalLabel"><span>Se eliminarar permanentemente</span></h6>
      </div>
      <div class="modal-body">                   
        <h3>Esta seguro que desea eliminar este post.</h3>
      </div>
       <div class="modal-footer">        
         <!-- <button class="btn btn-default" class="btn btn-orange" data-dismiss="modal" aria-hidden="true">CERRAR</button> -->
        <a href="javascript:void(0)" class="btn btn-orange" data-dismiss="modal" data-hidden="true">Cancelar</a>
        <a href="<?php echo site_url($domain).'/articulos/delete/'.$id_post.'/'.urls_amigables($title); ?>" class="btn btn-danger" data-toggle="modal">Aceptar</a>               
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div> 