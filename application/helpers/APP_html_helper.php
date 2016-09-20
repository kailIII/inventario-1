<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Script Tag
 * Genera un script tag.
 *
 */
if ( ! function_exists('script_tag')){
	function script_tag($_script){
		return '<script type="text/javascript" src="'.$_script.'"></script>';
	}
}

if ( ! function_exists('dummy_img_placebox')){
	function dummy_img_placebox($_w,$_h = false,$_color = false){
		$_color = ($_color)?$_color:random_color_hex();
		$_h = ($_h)?$_h:$_w;

		return "http://placebox.es/$_w/$_h/$_color/";
	}
}

if ( ! function_exists('random_color_hex')){
	function random_color_hex($max_r = 255, $max_g = 255, $max_b = 255){
	    // ensure that values are in the range between 0 and 255
	    $max_r = max(0, min($max_r, 255));
	    $max_g = max(0, min($max_g, 255));
	    $max_b = max(0, min($max_b, 255));
	   
	    // generate and return the random color
	    return str_pad(dechex(rand(0, $max_r)), 2, '0', STR_PAD_LEFT) .
	           str_pad(dechex(rand(0, $max_g)), 2, '0', STR_PAD_LEFT) .
	           str_pad(dechex(rand(0, $max_b)), 2, '0', STR_PAD_LEFT);
	}
}