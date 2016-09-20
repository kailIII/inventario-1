<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends APP_Controller {

	public function __construct(){
		parent::__construct();

	}

	public function index()
	{
 		// $_id_usuario = $this->dx_auth->get_user_id();
		// echo  $_id_usuario;
		$this->init('');
		// redirect($this->_modulos[0], 'location');
		// $this->load->view('prime/head');
		// $this->load->view('prime/header');
		// $this->load->view('prime/content');
		// $this->load->view('prime/footer');
		
	}
}
