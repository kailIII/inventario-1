<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?=$descripcion_app?>">
	<meta name="author" content="ARMedica">
	<link type="text/plain" rel="author" href="<?=base_url('humans.txt')?>" />
	
	<title><?=$titulo_app?></title>

	<?=link_tag(base_url(asset_path('application/css/styles_login.min.css')))?>
	<?=link_tag(base_url(asset_path('application/css/app.2.0.login.css')))?>

	<!-- ICONOS PARA DIVERSAS PLATAFORMAS -->
	<?=link_tag(asset_path('application/img/icons/favicon1.ico'), 'shortcut icon', 'image/ico')?>
	<?=link_tag(asset_path('application/img/icons/apple-touch-icon-144x144-precomposed.png'), 'apple-touch-icon-precomposed', 'image/png')?>
	<?=link_tag(asset_path('application/img/icons/apple-touch-icon-114x114-precomposed.png'), 'apple-touch-icon-precomposed', 'image/png')?>
	<?=link_tag(asset_path('application/img/icons/apple-touch-icon-72x72-precomposed.png'), 'apple-touch-icon-precomposed', 'image/png')?>
	<?=link_tag(asset_path('application/img/icons/apple-touch-icon-precomposed.png'), 'apple-touch-icon-precomposed', 'image/png')?>
</head>
<body class="focusedform">