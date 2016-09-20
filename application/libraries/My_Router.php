<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Router extends CI_Router {
 
    function MY_Router()
    {
        parent::CI_Router();
    }
 
    function _validate_request($segments)
    {

        // Comprueba que el controlador no existe
        if (!file_exists(APPPATH.'controllers/'.$segments[0].EXT))
        {
            $segments = array("paginas", "cargar", $segments[0]);
 
        }
        // return parent::_validate_request($segments);
    }
}