<?php defined('BASEPATH') OR exit('No direct script access allowed');

class datos extends REST_Controller
{

    public function __construct(){
         parent::__construct();
        if(!$this->input->is_ajax_request()){
            show_404("",true);
        }
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->model('minicio');
    }

    public function index_post(){
        $_datos = $this->post();
       $_datos["id_user"] = $this->dx_auth->get_user_id();
        $this->minicio->savemypost($_datos);
    }
    public function obtener_get(){
        $_datos=$this->minicio->getmypost();
        $this->response($_datos,200);
    }

    public function actualiza_post(){
        $data = $this->input->post();
        // $this->musuarios->actualiza($data);
        $this->response(array('result' => 'Actualizado'), 200);
    }
    
}