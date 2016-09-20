<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class proveedor extends REST_Controller {

	public function __construct(){
		parent::__construct();
        if(!$this->input->is_ajax_request()){
            show_404("",true);
        }
		$this->load->library('form_validation');
		$this->load->model('mcompras');

	}

    public function provider_post(){
        $_datos = $this->post();
        $_datos["id_user"] = $this->dx_auth->get_user_id();
        $_result = $this->mcompras->saveProvider($_datos);
        
        if($_result){
            $_res = format_response($_result, 'success','Proveedor agregado');
        }else{
            $_res = format_response(FALSE, 'error','Operación Fallida.',TRUE);
        }

        $this->response($_res,200);        
    }
    public function provider_get(){
    $id_user__=$this->dx_auth->getUserDomain();
      
      $resultado=$this->mcompras->getProviders($id_user__);

      if($resultado){
            $_res = format_response($resultado, 'success','Datos encontrados');
      }else{
        $_res = format_response(null,'error','No se encontraron datos.',true);
      }
      $this->response($_res);
    }   
}