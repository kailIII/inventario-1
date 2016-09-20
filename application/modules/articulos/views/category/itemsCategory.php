<section id="category">
	<div class="col-md-13">
		<form name="formCategory" id="formCategory">
			<div class="row">
				<div class="col-md-13">
					<div class="col-md-4 col-md-offset-6 form-group">
						<input type="text" class="form-control" name="name" id="name" placeholder="Categoria">
					</div>
					<div class="col-md-offset-8 form-group">
						<div class="category btn btn-brown">Agregar</div>
					</div>
				</div>
			</div>
		</form>
	</div>
<?php foreach($itemsCat as $k => $v): ?>
	<div class="cat_">
		<div class="imgCats">
			<img class="imgCats" src="<?=$v['name'];?>">
			<p class="titulo"><?php echo $v["title"]; ?></p>
		</div>
		<div class="info">
			<a class="link" href="<?=site_url("$domain/")."/".urls_amigables($v['category'])."/$v[id]/".urls_amigables($v['title'])?>"><?php echo substr($v["title"],0,16)."..."; ?></a>
		</div>
	</div>
<?php endforeach; ?>


</section>