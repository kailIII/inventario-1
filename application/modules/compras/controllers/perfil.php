<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class perfil extends APP_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('path');
		$this->_domain = $this->dx_auth->getUserDomain();
        $CI =& get_instance();

	}

	public function index()
	{
		$dom["domain"]=$this->_domain["domain"];
		$_vista['avatar'] = $this->parser->parse('usuarios/perfil/perfil_avatar',array(), TRUE);
		$_vista['avatar_nuevo'] = $this->parser->parse('usuarios/perfil/perfil_avatar_nuevo',$dom, TRUE);
		$_vista['personales'] = $this->parser->parse('usuarios/perfil/perfil_personales',array(), TRUE);
		$_vista['cuenta'] = $this->parser->parse('usuarios/perfil/perfil_cuenta',array(), TRUE);
		$_vista['extras'] = $this->parser->parse('usuarios/perfil/perfil_extras',array(), TRUE);

		$_data['contenido'] = $this->parser->parse('usuarios/perfil/ini',$_vista, TRUE);

		$this->init($_data);
	}

}

/* End of file perfil.php */
/* Location: ./application/controllers/perfil.php */