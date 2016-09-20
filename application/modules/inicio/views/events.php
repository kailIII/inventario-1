<section id="events">
	<div class="articlesEvn">
		<?php foreach($evt as $k => $v): ?>
		<article>
			<div class="thumb">
				<?php if($v["name"]): ?>
				<a target="_blank" href="<?php echo $v['urll']; ?>">
					<img src="<?=site_url('application/modules/postear/img/upload/'.$v["name"])?>">
				</a>
				<?php else: ?>
				<div class="video">
				<?php echo $v["video"]; ?>
				</div>
				<?php endif; ?>
			</div>		
		</article>
		<?php endforeach; ?>

		<article>
		</article>	
	</div>
</section>