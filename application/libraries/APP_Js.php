<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class APP_Js{

	private $CI ;

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function get_avant(){
		$_avant = $this->CI->config->item('app_avant');
		$_js = "";
		if (is_array($_avant) && count($_avant)>0){
			foreach ($_avant as $value) {
				$_js .= script_tag(base_url(asset_path($value)))."\n";
			}
		}
		return $_js;
	}

	public function get_app(){
		$_basic = $this->CI->config->item('app_js_basico');
		$_js = "";
		if (is_array($_basic) && count($_basic)>0){
			foreach ($_basic as $value) {
				$_js .= script_tag(base_url(asset_path($value)))."\n";
			}
		}
		return $_js;
	}

	public function get_notificaciones(){
		$_noty = $this->CI->config->item('app_noty');
		$_js = "";
		if (is_array($_noty) && count($_noty)>0){
			foreach ($_noty as $value) {
				$_js .= script_tag(base_url(asset_path($value)))."\n";
			}
		}
		return $_js;
	}

	public function get_principal(){
		$_prin = $this->CI->config->item('app_js_principal');
		$_js = "";
		if (is_array($_prin) && count($_prin)>0){
				// print_r($value);
				// echo "<br>";
			foreach ($_prin as $value) {
				//solo cuando este deslogueado debe aparecer el boton de Registrate y publica tus articulos
				if ($this->CI->dx_auth->is_logged_in()){
					// if($value == "application/js/app.modules.js")
						// continue;
				}

				$_js .= script_tag(base_url(asset_path($value)))."\n";
			}
		}
		return $_js;
	}

	public function get_externas(){
		$_prin = $this->CI->config->item('app_js_externas');
		$_js = "";
		if (is_array($_prin) && count($_prin)>0){
				// print_r($value);
				// echo "<br>";
			foreach ($_prin as $value) {
				//solo cuando este deslogueado debe aparecer el boton de Registrate y publica tus articulos
				if ($this->CI->dx_auth->is_logged_in()){
					// if($value == "application/js/app.modules.js")
						// continue;
				}

				$_js .= script_tag($value)."\n";
			}
		}
		return $_js;
	}	


	public function get_modulo($_modulo,$_obj_global){
		$_js = "";
		
		if($_modulo=="catalogos"){
			$_js .= script_tag(base_url('application/modules/articulos/js/'.$_modulo.'.js'))."\n";
		}elseif($_modulo=="perfil"){
		// if(!in_array($_modulo, $this->CI->config->item('app_modulo'))){
			// print_r(base_url('application/assets/application/js/app.'.$_modulo.'.js'));
			$_js .= script_tag(base_url('application/modules/usuarios/js/app.'.$_modulo.'.js'))."\n";
			$_js .= script_tag(base_url('application/assets/avant/plugins/jQueryFileUpload/jquery.fileupload.js'))."\n";
			$_js .= script_tag(base_url('application/assets/avant/plugins/jQueryFileUpload/jquery.fileupload-ui.js'))."\n";
		
		}else{
			$_mod = $this->CI->config->item('js',$_modulo);
			 
			if($_obj_global['modulo']['uri'][2] != 'index' and count($_obj_global['modulo']['uri'])==1){
				$_mod[] = 'js/'.$_obj_global['modulo']['uri'][2].'.js';
			}else{
				// $_mod[] = 'js/'.$_obj_global['modulo']['uri'][1].'.js';
			}
			//ITERAMOS SOBRE EL ARREGLO JS Y CREAMOS LAS RESPECTIVAS ETIQUETAS SCRIPT
			if (is_array($_mod) && count($_mod)>0){
				foreach ($_mod as $value) {
					$_js .= script_tag(base_url('application/modules/'.$_modulo.'/'.$value))."\n";
				}
			}
		}
		return $_js;
	}
	
}
