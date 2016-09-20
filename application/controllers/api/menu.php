<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class menu extends REST_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('dx_auth/menus');
	}

	public function index_get(){
		
		// $_data = $this->menus->get_menu();
		
		// if ($_data){
		// 	$_res = format_response($_data);
		// }else{
		// 	$_res = format_response(FALSE, 'error', 'No hay menus.',TRUE);
		// }
		// $this->response($_res,200);
	}

	
}