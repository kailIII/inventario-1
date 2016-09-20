<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class APP_Css{

	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function get_modulo($_modulo){
		//VALIDAMOS SI EL MODULO QUE SE DESEA ACCEDER SON DE LA APLICACION
		//O SON LOS QUE YA ESTAN POR DEFAULT INTEGRADOS.
		// if(!in_array($_modulo, $this->CI->config->item('app_modulos'))){
			// return FALSE;
		// }
		$_css = "";
		if($_modulo=="perfil"){
			$_css .= link_tag(base_url('application/modules/usuarios/css/app.'.$_modulo.'.css'))."\n";
			$_css .= link_tag(base_url('application/assets/avant/plugins/jQueryFileUpload/jquery.fileupload-ui.css'))."\n";
			$_css .= link_tag(base_url('application/assets/avant/plugins/jQueryFileUpload/jquery.fileupload.css'))."\n";
		}

		$_mod = $this->CI->config->item('css',$_modulo);
		if (is_array($_mod) && count($_mod)>0){
			foreach ($_mod as $value) {
				$_css .= link_tag(base_url('application/modules/'.$_modulo.'/'.$value))."\n";
			}
		}
		return $_css;
	}

}

/* End of file APP_Css.php */