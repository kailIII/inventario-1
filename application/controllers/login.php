<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('form_validation');
		$this->_modulos = $this->config->item('app_modulos');
	}

	public function index($_error=''){
		$_data['descripcion_app'] = $this->config->item('app_descripcion');
		$_data['titulo_app'] = $this->config->item('app_titulo');
		$_data['logo_app'] = $this->config->item('app_logo');
		$_data['action'] = site_url('login/in');
		$_data['error'] = $_error;


		$this->load->view('login/head',$_data);
		$this->load->view('login/body',$_data);		
	}
	public function index___para_el_otro_login_desde_menu($_error=''){
		echo json_encode($_error);
	}

	public function in(){
		if (!$this->dx_auth->is_logged_in()){
			$this->form_validation->set_rules('user','Usuario', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pass','Contraseña', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', 'Recordarme', 'integer');			

			if ($this->form_validation->run()){
				if ( $this->dx_auth->login($this->form_validation->set_value('user'), $this->form_validation->set_value('pass'), $this->form_validation->set_value('remember')) ){
					//REDIRECCIONAMOS AL PRIMER MODULO
					redirect(site_url(), 'location');
					//$this->index("inicio");
				}else{
					//NO SE CUMPLE EL LOGIN, USUARIO, PASS MALOS O BANEADO
					if ($this->dx_auth->is_banned()){
						$_error = 'Lo sentimos, este usuario esta deshabilitado. Ponganse en contacto con el Administrador del Sistema.';
					}else{
						$_error = $this->dx_auth->get_auth_error();
					}
					$this->index($_error);

				}
			}else{
				//no se cumplen las reglas de validacion
				$_error = "El usuario y la contraseña son obligatorios.";
				$this->index($_error);
			
			}
		}else{
			//estamos logeados, redireccionamos al primer modulo de la app
			$this->index("inicio");
		}
	}


	public function out(){
		$this->dx_auth->logout();
		redirect(site_url(), 'location');
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */