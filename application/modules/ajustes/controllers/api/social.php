<?php defined('BASEPATH') OR exit('No direct script access allowed');

class social extends REST_Controller
{

    public function __construct(){
         parent::__construct();
        if(!$this->input->is_ajax_request()){
            show_404("",true);
        }
        $this->load->model('majustes');
        $this->load->model('dx_auth/menus');
        $this->id_user = $this->dx_auth->getUserDomain();
    }

    public function index_post(){

    }
    // public function obtener_get(){
    //     $_datos=$this->minicio->getmypost();
    //     $this->response($_datos,200);
    // }
    public function netsocial_get(){
        $_result = $this->menus->get_social();

        if($_result){
            $_res = format_response($_result, 'success','Datos cargados');
        }else{
            $_res = format_response(FALSE, 'error','Operación Fallida.',TRUE);
        }

        $this->response($_res,200);

    }
    public function netsocial_post(){
        $_datos = $this->input->post();
        if(!$_datos["facebook"]){
            $_res = format_response(FALSE, 'error','Proporcione un nombre.',TRUE);
            $this->response($_res,200);        
        }
        $_datos["id_user"] = $this->dx_auth->get_user_id();
        $_result=$this->majustes->savePagefb($_datos);
        if($_result){
            $_res = format_response($_result, 'success','Registros guardados');
        }else{
            $_res = format_response(FALSE, 'error','Operación Fallida.',TRUE);
        }        
        $this->response($_res,200);        
    }
        
}