<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajustes extends APP_Controller {

	private $id_user;

	public function __construct(){
		
		parent::__construct();
        
        $this->load->model('majustes');
		$this->load->model('dx_auth/menus');
        // $this->load->helper("APP_url");
		$this->_domain = $this->dx_auth->getUserDomain();

		$this->module = $this->dx_auth->get_domain();
		if(!$this->module){
       		$this->module = $this->uri->segments;
			list($this->module, $this->category,$this->id_post,$this->title) = array_pad($this->module, 5, NULL);
		}
		
	}

	public function index(){
		$dom["domain"]=$this->_domain["domain"];
		$_vista['avatar'] = $this->parser->parse('ajustes/info_client/perfil_avatar',array(), TRUE);
		$_vista['avatar_nuevo'] = $this->parser->parse('ajustes/info_client/perfil_avatar_nuevo',$dom, TRUE);
		$_vista['personales'] = $this->parser->parse('ajustes/info_client/perfil_personales',array(), TRUE);

		$_vista__['profile_l'] = $this->parser->parse('ajustes/info_client/ini',$_vista, TRUE);
		$_data['contenido'] = $this->parser->parse('ajustes/ini',$_vista__, TRUE);

		$this->init($_data);
      
	}
	public function social(){
		// $netsoc["socialNetwork"] = $this->menus->get_social();

		$vistas['pageSocial'] = $this->parser->parse('social',array(),TRUE);
		$_data['contenido'] = $this->parser->parse('ini',$vistas, TRUE);
		$this->init($_data);		
	}
		
	public function folios()
	{
		$_vista['tabla'] = $this->parser->parse('folio/folios_tabla', array(), TRUE);
		$_vista['modal-nuevo-usuario'] = $this->parser->parse('folio/nuevo_folio', array(), TRUE);
		$_vista__['folio'] = $this->parser->parse('ajustes/folio/ini',$_vista, TRUE);

		$_data['contenido'] = $this->parser->parse('ajustes/ini',$_vista__, TRUE);
		
		$this->init($_data);
	}
	public function sucursales()
	{
		$_vista['tabla'] = $this->parser->parse('subsidiaries/sucursales_tabla', array(), TRUE);
		$_vista['modal-nueva-sucursal'] = $this->parser->parse('subsidiaries/nueva_sucursal', array(), TRUE);
		$_vista__['subsidiaries'] = $this->parser->parse('ajustes/subsidiaries/ini',$_vista, TRUE);

		$_data['contenido'] = $this->parser->parse('ajustes/ini',$_vista__, TRUE);
		
		$this->init($_data);
	}	
		
}