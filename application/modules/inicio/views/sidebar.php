<section id="postSingle">
	<?php foreach($art as $k => $v): ?>
	<article>
		<hgroup><h2><a href="javascript:void(0)" ><?php echo $v["title"]; ?></a></h2></hgroup>
		<p class="date"><?php echo substr($v["create_date"],0,16); ?> <a href="">categoria</a></p>
		<div class="thumb">
			<?php if($v["name"]): ?>
			<img class="img" src="<?=site_url('application/modules/articulos/img/upload/'.$v["name"])?>">
			<?php elseif($v["video"]): ?>
			<div class="video">
				<?php echo html_entity_decode($v["video"]); ?>
			</div>
			<?php endif; ?>
		</div>	
		<p class="extract"><?php echo $v["description"]; ?></p>
		<div class="social">
			<ul>
				<li><a href="#" target="_blank" class="fa fa-facebook-square fa-lg"></a></li>
				<li><a href="#" target="_blank" class="fa fa-twitter-square fa-lg"></a></li>
				<li><a href="#" target="_blank" class="fa fa-google-plus-square fa-lg"></a></li>
				<!-- <li><a href="#" target="_blank" class="fa fa-youtube-square fa-lg"></a></li> -->
				<!-- <li><a href="#" target="_blank" class="fa fa-pinterest-square fa-lg"></a></li> -->
				<li><a href="#" class="fa fa-envelope-square fa-lg"></a></li>
			</ul>
		</div>		
	</article>
	<?php endforeach; ?>
</section>