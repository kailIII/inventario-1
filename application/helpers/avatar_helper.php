<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('avatar'))
{
	function avatar($_avatar)
	{
		$CI =& get_instance();
		if(file_exists('application/assets/application/img/avatares/avatar_'.$CI->dx_auth->get_user_id().'/perfil/'.$_avatar)){
			return base_url('application/assets/application/img/avatares/avatar_'.$CI->dx_auth->get_user_id().'/perfil/'.$_avatar);
		}else{
			return false;
		}
	}
}
if ( ! function_exists('logo'))
{
	function logo($_logo,$id_user="")
	{
		$CI =& get_instance();
	
		if(!$id_user)
		$id_user=$CI->dx_auth->get_user_id();

		if(file_exists('application/assets/application/img/logo/logo_'.$id_user."/".$_logo)){
			return base_url('application/assets/application/img/logo/logo_'.$id_user."/".$_logo);
		}else{
			return false;
		}
	}
}

if ( ! function_exists('avatar_random'))
{
	function avatar_random()
	{
		$CI =& get_instance();
		$_avatares = $CI->config->item('app_avatares');
		$_clave_avatar = array_rand($_avatares, 1);

		// return $_avatares[$_clave_avatar];
		return array();
	}
}