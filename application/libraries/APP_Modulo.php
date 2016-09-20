<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class APP_Modulo{
	
	private $CI;
	private $MODSPATH;
	
	public function __construct(){
		$this->CI =& get_instance();
		$this->MODSPATH = APPPATH.'modules/';
	}

	public function get_modulo_config($mod){

		$_modpath = $this->MODSPATH.$mod.'/';
		
		if (is_dir($_modpath.'config') && is_file($_modpath.'config/'.$mod.'.php')){

			$this->CI->load->config($mod,TRUE);

			$mod_config = $this->CI->config->item($mod);

			$mod_config['path'] = $_modpath;
			$this->CI->config->set_item($mod,$mod_config);
		}

	}

	public function get_modulos_config($mod,$modulos){

		foreach ($modulos as $_mod){
			
			$_modpath = $this->MODSPATH.$_mod["name"].'/';
			
			if ($_mod["name"] != $mod && is_dir($_modpath.'config') && is_file($_modpath.'config/'.$_mod["name"].'.php')){
			
				$this->CI->load->config($_mod["name"].'/'.$_mod["name"],TRUE);
				$mod_config = $this->CI->config->item($_mod["name"]);
				$mod_config['path'] = $_modpath;
				$this->CI->config->set_item($_mod["name"],$mod_config);
			
			}
		}

	}
	
}
