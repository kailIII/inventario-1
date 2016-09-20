<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usuarios_roles extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->input->is_ajax_request()){
            show_404("",true);
        }
		$this->load->library('form_validation');
		$this->load->model('usuarios/musuarios');
		$this->load->model('usuarios/mroles');
	}

	/**
	 * Borra un rol del los usuarios.
	 * @return json 	Formato de respuesta estandar
	 */
	public function index_delete(){
		$_data = $this->delete(NULL,FALSE);

		//VALIDAMOS SI EXISTEN USUARIOS CON ESE ROL A BORRAR
		//ESTO PARA MANTENER LA INTEGRIDAD EN LA BD DE USUARIOS
		$_num_users_dependientes = $this->mroles->get_roles_dependientes($_data['id']);	
		if ($_num_users_dependientes===FALSE){
			//SI NO EXISTE NINGUN USUARIO CON ESTE ROL, PROCEDEMOS A BORRARLO			
			$this->musuarios->delete_roles($_data);
			$_res = format_response(TRUE, 'success','Rol eliminado');
		}else{
			//REGRESAMOS UN ERROR, YA QUE EXISTEN USUARIOS CON ESE ROL
			$_res = format_response(FALSE, 'error','No se puede borrar este rol, ya que existen '.$_num_users_dependientes.' usuarios asignados a él.',TRUE);
		}
		$this->response($_res,200);
	}


	/**
	 * Obtiene la informacion de un rol especifico.
	 * @return json 	Formato de respuesta estandar
	 */
	public function index_get(){
		$_data = $this->musuarios->get_roles();
		if ($_data){
			$_res = format_response($_data);
		}else{
			$_res = format_response(FALSE, 'error', 'Roles no encontrados.',TRUE);
		}
		$this->response($_res,200);
	}



	/**
	 * Da de alta un rol.
	 * @return json 	Formato de respuesta estandar
	 */
	public function index_post(){
		$_data = $this->input->post(NULL,TRUE);
		$this->form_validation->set_rules('name','Nombre del Rol','required|trim|xss_clean');
		if ($this->form_validation->run()){
			//CREA UN ROL NUEVO
			$_db = $this->musuarios->set_roles($_data);
			$_res = format_response(TRUE, 'success','Rol dado de alta.');
		}else{
			$_res = format_response(FALSE, 'error',validation_errors(),TRUE);
		}
		$this->response($_res,200);
	}


}

/* End of file usuarios_roles.php */
/* Location: ./application/controllers/api/usuarios_roles.php */