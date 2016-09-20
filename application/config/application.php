<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| CONFIGURACIONES BÁSICAS DE LA APLICACION
| Modificar dependiendo de lo que requiera en la aplicacion
|--------------------------------------------------------------------------
*/

//CONFIGURACION BASICA
$config['app_titulo'] = "SISTEMA DE INVENTARIO";
$config['app_descripcion'] = "Control de activos fijos";

//LOGOS DE LA APLICACION
//Deberá tener 2 logos para la aplicacion, el primero es para mostrarse en caso de estar viendo la aplicacion en desktop o tablet,
//el segundo será en caso de verla en telefonos.
//El directorio donde deberá almacenar las imagenes es: application/assets/application/img/
$config['app_logo'] = "SISTEMA DE INVENTARIO";
$config['app_logo_description'] = "Un sitio para compartir...";
$config['app_logo_mobile'] = "<em class='brand-linea-mobile'>DELUXER</em>";
$config['addres'] = array(
		"street"=>"Centro #6523",
		"zip_code"=>"64008",
		"colony"=>"Centro de Monterrey",
		"city"=>"Monterrey",
		"state"=>"Nuevo Leon",
		"country"=>"Mexico",
		"email"=>"sistemadeluxer@mireino.com",
		"telefono"=>"81-2339-3874",
	);

//SI LA APLICACION REQUIERE EL USO DE LOGIN, ESTO HABILITA LOS MODULOS DE LOGIN Y USUARIOS, ADEMAS DE CARGAR LAS LIBRERIAS DE AUTENTICACIÓN
$config['app_use_login'] = true;
//CANTIDAD DE DIAS EN LOS QUE EL PASS CADUCA, ESTO HACE QUE CUADNO UN USUARIO ENTRE SE VALIDAD SI SU PASS HA CADUCADO, EN CASO AFIRMATIVO,
//SE PIDE QUE SE RESETEE EL PASS. DEGE EN 0 PARA QUE NO CADUQUE
$config['app_pass_caduca'] = 0;

/*
|--------------------------------------------------------------------------
| CONFIGURACION FIJA DE LA APLICACION
| No mover, solo por las personas encargadas de la aplicacion.
| Si modifica algo de esto, la aplicación puede quedar inestable
|--------------------------------------------------------------------------
*/

//AVATARES POR DEFAULT
// $config['app_avatares'] = array();
$config['app_avatares'] = array(
	'no_avatar_1.jpg',
	'no_avatar_2.jpg',
	'no_avatar_3.jpg',
	'no_avatar_4.jpg',
	'no_avatar_5.jpg',
	'no_avatar_6.jpg',
	'no_avatar_7.jpg',
	'no_avatar_8.jpg',
);

//PATH DE LOS ASSETS
$config['app_assets_path'] = APPPATH."assets/";

//LIBRERIAS BÁSICAS
//Estas son las librerias básicas para cargar.
//Si quita alguna, posiblemente no funcionen algunas caracteristicas de la aplicacion.
$config['app_js_basico']  = array(
	//path haia jquery
	'libraries/jquery-1.11.2.js',
	// 'libraries/ckeditor-4.5.4/ckeditor.js',
	// 'libraries/jquery.scrollTo.js',

	//path hacia knockout
	'libraries/knockout-3.0.0.js',
	
	//path hacia boostrap
	'libraries/bootstrap-3.3.4-dist/js/bootstrap.min.js',

	//path hacia libreria para manejar fechas
	// 'libraries/moment.min.js',
	// 'libraries/moment.es.js',

	//path hacia libreria para manejar urls
	'libraries/purl.js',
);


/**
 * AVANT
 * Librerias para el tema Avant, el cual es la base
 * de la aplicacion
 */
$config['app_avant']  = array(
	// scripts para el tema avant
	// 'avant/enquire.js',
	// 'avant/jquery.cookie.js',
	// 'avant/jquery.nicescroll.min.js',
	// 'avant/avant.js'
	
	// gallery
	// 'avant/demo-gallery-simple.js',
	// 'avant/plugins/mixitup/jquery.mixitup.min.js',
	// slide
	// 'avant/plugins/slideshow/jquery.slides.js',
	'avant/plugins/bjqs.min.js',

	// 'avant/plugins/slideshow/jquery.slides.min.js'

	//validate inputs
	'avant/plugins/form-parsley/parsley.min.js',
	//form validations colors
	'avant/plugins/formvalidation.js',
	// slider
	// 'avant/jquery-latest.js',
);


//NOTIFICACIONES
//Librerias de notificacion en js.
//Estas se encunetra en la siguiente directorio: application/assets/noty/
$config['app_noty']  = array(
	//path a la libreria principal, no quitar
	'noty/jquery.noty.js',
	//path a diferentes tipos de layouts para las notificaciones, ver los posibles layouts en: application/assets/noty/layouts
	//siempre solo seleccionar una.
	'noty/layouts/topRight.js',
	//path hacia el tema, no quitar
	'noty/themes/default.js'
);

//JS PRINCIPAL
$config['app_js_principal']  = array(
	'application/js/app.notificaciones.js',
	'application/js/app.getscripts.js',
	// 'application/js/app.bindings.js',
	'application/js/app.js',
	// 'application/js/app.modules.js',
	// 'application/js/app.usuarios.js',
	
);
//JS EXTERNAS
$config['app_js_externas']  = array(
	//'http://platform.twitter.com/widgets.js',
);