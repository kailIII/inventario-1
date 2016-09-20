<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//CONFIGURACION BASICA DEL MODULO, ESCENCIAL PARA EL MENU PRINCIPAL
// $config['icon'] = 'fa-home';
// $config['nombre'] = 'inicio';
// $config['descripcion'] = 'inicio deluxer';
// $config['version'] = '1.0';


//CONFIGURACION DE PERMISOS PARA EL MODULO, AGREGAR LOS ROLES DE USUARIO DE LOS QUE TIENEN ACCESO A EL MISMO
$config['permisos'] = array('Super','Administrador','uip','Capturista');
// $config['permisos'] = array('Super','Administrador');


//CONFIGURACION DE LIBRERIAS PROPIAS DEL MODULO
//El orden en el que estan declaradas, es el orden en el que serán llamadas.
//el lugar donde se buscarán estas rutas es dentro de cada carpeta del modulo: application/modules/modulo_folder
$config['js'] = array(
	'js/inicio.js',
	'../../assets/libraries/ckeditor/ckeditor.js',
	'../../assets/application/js/jquery.fancybox.pack.js?v=2.1.5',
	'../../assets/application/js/jquery.fancybox-buttons.js?v=1.0.5',

	
);
$config['css'] = array(
	'css/principal.css',
	'../../assets/application/css/jquery.fancybox.css?v=2.1.5',
	'../../assets/application/css/jquery.fancybox-buttons.css?v=1.0.5',
	
);

?>