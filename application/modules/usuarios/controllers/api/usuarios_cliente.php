<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usuarios_cliente extends REST_Controller {

	public function __construct(){
		parent::__construct();
        if(!$this->input->is_ajax_request()){
            show_404("",true);
        }
		$this->load->library('form_validation');
		$this->load->model('usuarios/mpass');
		$this->load->model('usuarios/muser');


		$this->form_validation->set_message('min_length', 'La contraseña debe de tener minimo 8 caracteres.');
		$this->form_validation->set_message('matches', 'Las contraseñas no coincide.');
		$this->form_validation->set_message('required', 'El campo %s es obligatorio.');
		$this->form_validation->set_message('strong', 'La contraseña debe de contener mayusculas, minusculas, números y caracteres especiales.');
		$this->form_validation->set_message('unica', 'La contraseña no debe de ser igual a las últimas 5 usadas.');
		$this->form_validation->set_message('disponible', 'El nombre de usuario no esta disponible, favor de elegir otro nombre.');
		$this->form_validation->set_message('emailDisponible', 'Este correo ya se encuentra registrado, favor de elegir otro.');
		$this->form_validation->set_message('domainDisponible', 'Este dominio ya se encuentra registrado, favor de elegir otro.');
	}


	public function cambiar_pass_post()
	{
		$_data = $this->input->post(NULL,TRUE);

		$this->form_validation->set_rules('pass','Contraseña','trim|xss_clean|required|matches[repass]|min_length[8]|callback_strong|callback_unica');
		$this->form_validation->set_rules('repass', 'Repetir Nueva Contraseña', 'trim|xss_clean');
		
		if ($this->form_validation->run()){
			$this->mpass->reset_pass($_data['pass'],$_data['id']);
			$_res = format_response(TRUE, 'success','Contraseña cambiada.');
		}else{
			$_res = format_response(FALSE, 'error',validation_errors(),TRUE);
		}
		$this->response($_res,200);	
	}


	/**
	 * Deshabilita un usuario dado, esto solo es logico.
	 * @return json 	Formato de respuesta estandar
	 */
	public function index_delete(){
		$_data = $this->delete(NULL,TRUE);

		if(is_numeric($_data['id']) && $_data['id']>0){
			$this->muser->delete_item($_data);
			$_res = format_response(TRUE,'success','Usuario deshabilitado.');
		}else{
			$_res = format_response(FALSE,'error','Se requiere de un id valido.',TRUE);
		}
		$this->response($_res,200);	
	}



	/**
	 * Obtiene la informacion de los usuarios, si se manda un id solo la de ese usuario
	 * @return json 	Formato de respuesta estandar
	 */
	public function index_get(){
		$_id = $this->input->get('id',TRUE);

		if($_id && is_numeric($_id)){
			$_data = $this->muser->get_item($_id);
		}else{
			$_data = $this->muser->get_items();	
		}

		if($_data){
			$_res = format_response($_data);
		}else{
			$_res = format_response(FALSE, 'error', 'Usuarios no encontrados.',TRUE);
		}
		$this->response($_res,200);
	}




	/**
	 * Da de alta un nuevo usuario o modifica uno existenete
	 * @return json 	Formato de respuesta estandar
	 */
	public function index_post(){
		$_data = $this->input->post(NULL,TRUE);

		//VALIDAMOS SI ESTAMOS MODIFICADO O CREANDO UNO NUEVO
		//SI EL ID=0 ES NUEVO, EN CASO CONTRARIO ES MODIFICACION

		if($_data['id'] == 0){
			//CREAMOS UN USUARIO NUEVO
			$this->form_validation->set_rules('username','Nombre de Usuario','required|callback_disponible|trim|xss_clean');
			//$this->form_validation->set_rules('pass','Contraseña','trim|xss_clean|required|matches[repass]|min_length[8]|callback_strong|callback_unica');
			$this->form_validation->set_rules('pass','Contraseña','trim|xss_clean|required|matches[repass]|min_length[8]|callback_unica');
			$this->form_validation->set_rules('repass','Contraseña','trim|xss_clean|callback_unica');
			$this->form_validation->set_rules('domain','Dominio','required|callback_domainDisponible|trim|xss_clean');
			$this->form_validation->set_rules('email','Correo','required|valid_email|callback_emailDisponible|trim|xss_clean');
			$_data["role_id"] = 2;

			if ($this->form_validation->run()){
				$_db = $this->muser->set_item($_data);
				 //$this->response($_db,200);
				$_res = format_response(TRUE, 'success','Usuario registrado.');
			}else{
				$_res = format_response(FALSE, 'error',validation_errors(),TRUE);
			}
		}else{
			//MODIFICAMOS USUARIO EXISTENTE			
			$this->form_validation->set_rules('perfil[nombre]','Nombre','required|trim|xss_clean');
			$this->form_validation->set_rules('email','Correo','required|valid_email|trim|xss_clean');
			$this->form_validation->set_rules('role_id','Rol','required|trim|xss_clean');
			if ($this->form_validation->run()){
				$_db = $this->muser->update_item($_data);
				$_res = format_response(TRUE, 'success','Usuario modificado.');
			}else{
				$_res = format_response(FALSE, 'error',validation_errors(),TRUE);
			}
		}
		$this->response($_res,200);
	}




	//ESTAS FUNCIONES SON PARA LA VALIDACION DE LA CONTRASEÑA. SON CALLBACKS USADOS POR LA LIBRERIA FORM_VALIDAION
	public function strong($str){
		if($this->mpass->strong_password($str)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function unica($str){
		if(!$this->mpass->ultima_password($str)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function disponible($str){
		return $this->mpass->usuario_disponible($str);
	}

	public function emailDisponible($str){
		return $this->mpass->email_disponible($str);
	}
	public function domainDisponible($str){
		return $this->mpass->domain_disponible($str);
	}
//-----------------------------------------------------------------------------------------------------------

}

/* End of file usuarios.php */
/* Location: ./application/controllers/api/usuarios.php */