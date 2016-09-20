<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//CONFIGURACION BASICA DEL MODULO, ESCENCIAL PARA EL MENU PRINCIPAL
$config['icon'] = 'fa-money';
$config['nombre'] = 'ventas';
$config['descripcion'] = 'mis ventas';
$config['version'] = '1.0';


//CONFIGURACION DE PERMISOS PARA EL MODULO, AGREGAR LOS ROLES DE USUARIO DE LOS QUE TIENEN ACCESO A EL MISMO
// $config['permisos'] = array('Super','Administrador');
$config['permisos'] = array('Super','Administrador','uip','Capturista');


//CONFIGURACION DE LIBRERIAS PROPIAS DEL MODULO
//El orden en el que estan declaradas, es el orden en el que serán llamadas.
//el lugar donde se buscarán estas rutas es dentro de cada carpeta del modulo: application/modules/modulo_folder
$config['js'] = array(
	'js/postear.js',

	'../../assets/avant/plugins/form-stepy/jquery.stepy.js',
	'../../assets/avant/plugins/jQueryFileUpload/jquery.fileupload.js',
	'../../assets/avant/plugins/jQueryFileUpload/jquery.fileupload-ui.js',
	// ckeditor
	//'../../assets/libraries/ckeditor-4.5.4/ckeditor.js',
	'../../assets/libraries/ckeditor/ckeditor.js',

);
$config['css'] = array(
	'css/principal.css',

	'../../assets/avant/plugins/jQueryFileUpload/jquery.fileupload-ui.css',
	'../../assets/avant/plugins/jQueryFileUpload/jquery.fileupload.css',	


);