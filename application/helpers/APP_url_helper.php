<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Asset URL
 * Genera la url de un assets dado, utilizando la variable del archivo config/application.php
 * 		app_assets_url
 *
 */
if ( ! function_exists('asset_path'))
{
	function asset_path($_asset){
		$CI =& get_instance();
		$_app_assets_path = $CI->config->item('app_assets_path');
		return $_app_assets_path.$_asset;
	}
}

function urls_amigables_disabled($url) {
      $url = str_replace("-", " ", $url); 
      return $url;
}
function urls_amigables($url) {
 
      // Tranformamos todo a minusculas
      $url = strtolower($url);
 
      //Rememplazamos caracteres especiales latinos
      $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
      $repl = array('a', 'e', 'i', 'o', 'u', 'n');
      $url = str_replace ($find, $repl, $url);
 
      // Añadimos los guiones
      $find = array(' ', '&', '\r\n', '\n', '+');
      $url = str_replace ($find, '-', $url);
 
      // Eliminamos y Reemplazamos otros carácteres especiales
      $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
      $repl = array('', '-', '');
      $url = preg_replace ($find, $repl, $url);
 
      return $url;
}
function substring_between($contents,$start,$end) {
   if (strpos($contents,$start) === false || strpos($contents,$end) === false) {
         return false;
   } else {
      $start_position = strpos($contents,$start)+strlen($start);
      $end_position = strpos($contents,$end);

      $_SESSION["img"][] = substr($contents,$start_position,$end_position-$start_position);

      $contents = substr($contents,$end_position+strlen($end),strlen($contents));
      if($start_position)
      substring_between($contents,$start,$end);
      
      $img = $_SESSION["img"];
      
      return $img;

   } 
}
// if ( ! function_exists('encode_url')){
    function encode_url($string, $key="", $url_safe=TRUE){
        
        if($key==null || $key=="")
        {
            $key="tyz_mydefaulturlencryption";
        }
        $CI =& get_instance();
        $CI->load->library("Encrypt");
        $ret = $CI->encrypt->encode($string, $key);

        if ($url_safe)
        {
            $ret = strtr(
                    $ret,
                    array(
                        '+' => '.',
                        '=' => '-',
                        '/' => '~'
                    )
                );
        }

        return $ret;
    }

// }

if ( ! function_exists('decode_url')){

    function decode_url($string, $key=""){
         if($key==null || $key==""){
            $key="tyz_mydefaulturlencryption";
        }
        $CI =& get_instance();
        $CI->load->library("Encrypt");
        $string = strtr(
                $string,
                array(
                    '.' => '+',
                    '-' => '=',
                    '~' => '/'
                )
            );

        $ret = $CI->encrypt->decode($string, $key);
        return $ret;
    }

}
function pr($obj){
      echo "<pre><font color=red>";
      if(is_object($obj) || is_array($obj)) {
          print_r ($obj);
      } else {
         echo $obj;
      } 
      echo "</font></pre>";
}