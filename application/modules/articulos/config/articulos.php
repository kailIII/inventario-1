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
$config['js'] = array(

	'js/articulos.js',

	'../../assets/avant/plugins/jQueryFileUpload/jquery.fileupload.js',
	'../../assets/avant/plugins/jQueryFileUpload/jquery.fileupload-ui.js',
	// ckeditor
	// '../../assets/libraries/ckeditor-4.5.4/ckeditor.js',
	'../../assets/libraries/ckeditor/ckeditor.js',

	// gallery
	'../../assets/avant/demo-gallery-simple.js',	
	'../../assets/avant/demo-gallery-simple.js',	
	'../../assets/avant/plugins/mixitup/jquery.mixitup.min.js',	
);
$config['css'] = array(

	'css/principal.css',

	'../../assets/avant/plugins/jQueryFileUpload/jquery.fileupload-ui.css',
	'../../assets/avant/plugins/jQueryFileUpload/jquery.fileupload.css',
);

?>