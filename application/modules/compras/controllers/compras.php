<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class compras extends APP_Controller  {

	public function __construct(){
		parent::__construct();
		
	}
	public function index()
	{
		$_vista['tabla'] = $this->parser->parse('us/usuarios_tabla', array(), TRUE);
		$_vista['modal-nuevo-usuario'] = $this->parser->parse('us/usuario_nuevo', array(), TRUE);
		$_vista['modal-nuevo-rol'] = $this->parser->parse('us/rol_nuevo', array(), TRUE);
		$_vista['modal-nuevo-pass'] = $this->parser->parse('us/pass_nuevo', array(), TRUE);

		$_data['contenido'] = $this->parser->parse('us/ini',$_vista, TRUE);
		
		$this->init($_data);
	}
	public function proveedores()
	{
		$_vista['tabla'] = $this->parser->parse('us/usuarios_tabla', array(), TRUE);
		$_vista['modal-nuevo-usuario'] = $this->parser->parse('us/usuario_nuevo', array(), TRUE);

		$_data['contenido'] = $this->parser->parse('us/ini',$_vista, TRUE);
		
		$this->init($_data);
	}	
	public function mia()
	{
		$_vista['tabla'] = $this->parser->parse('us/usuarios_tabla', array(), TRUE);
		$_vista['modal-nuevo-usuario'] = $this->parser->parse('us/usuario_nuevo', array(), TRUE);
		$_vista['modal-nuevo-rol'] = $this->parser->parse('us/rol_nuevo', array(), TRUE);
		$_vista['modal-nuevo-pass'] = $this->parser->parse('us/pass_nuevo', array(), TRUE);

		$_data['contenido'] = $this->parser->parse('us/ini',$_vista, TRUE);
		
		$this->init($_data);
	}	
}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */