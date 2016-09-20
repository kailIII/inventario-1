<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $titulo_app; ?></title>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="<?php echo $author_app; ?>" />
        <meta name="description" content="<?php echo $descripcion_app; ?>" />
        <meta name="og:url" content="<?php echo 'http://mireino.com/'.$author_app; ?>"/>
        <meta property="og:image" content="<?php echo $logo_app;?>"/>
        <meta name="twitter:description" content="<?php echo $descripcion_app; ?>">
        <meta name="twitter:image" content="<?php echo $logo_app;?>">
        <meta property="article:tag" content="mireino">
        <meta property="article:tag" content="post mireino">
        <meta property="article:tag" content="articulos mireino">
        <meta property="article:tag" content="GeraDeluxer">
        <meta property="article:tag" content="deluxer">
        <meta property="article:tag" content="Sistema deluxer">
        <meta property="article:tag" content="inventario deluxer">
        <meta property="article:tag" content="Control de activos fijos">
        <meta property="og:site_name" content="Gerardo Del Angel Nuñez"/>
        <link type="text/plain" rel="author" href="<?php echo base_url('humans.txt')?>" />
        <link rel="shortcut icon" href="<?php echo $favicon; ?>" type="image/x-icon" />
        <!--<link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>-->
    
    <!-- Css exclusivos del modulo -->
    <?=$css_modulo?>
    <!-- Css generales -->
    <?=link_tag(base_url(asset_path('application/css/styles.css')))?>
    <?=link_tag(base_url(asset_path('application/css/sidebar.css')))?>
    <?=link_tag(base_url(asset_path('application/css/responsive.css')))?>
    <?=link_tag(base_url(asset_path('application/css/stylebootstrap.css')))?>
    <?=link_tag(base_url(asset_path('libraries/bootstrap-3.3.4-dist/css/bootstrap.css')))?>
    <?=link_tag(base_url(asset_path('fonts/font-awesome/css/font-awesome.min.css')))?>

    
	</head>
	<body>
