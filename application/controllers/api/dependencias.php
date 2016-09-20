<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dependencias extends REST_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('usuarios/mdependencias');
	}

	public function index_get(){
		$_id_dependencia = $this->input->get('id');
		$_result = $this->mdependencias->get_dependencias($_id_dependencia);
		if($_result){
			$_res = format_response($_result, 'success','Dependencias encontradas.');
		}else{
			$_res = format_response(FALSE, 'error','Operación Fallida.',TRUE);
		}

		$this->response($_res,200);
	}

}