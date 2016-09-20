<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mcompras extends CI_Model {

	public function __construct(){
		parent::__construct();

		$this->load->helper('array');

		$this->load->model('dx_auth/users');
		$this->load->model('dx_auth/user_profile');
		$this->load->model('dx_auth/roles');
	}

    public function saveProvider($_datos){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "name"=>$_datos["name"],
         "city"=>$_datos["city"],
         "email"=>$_datos["email"],
         "registred_by"=>$_datos["id_user"],
         "registred_on"=>$datenow,
         );
      $res = $this->db->insert("app_providers",$data);

      return $res;
   }
   public function getProviders($_datos){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->select("city");
      $this->db->select("email");
      $this->db->where("id_user",isset($_datos["id_user"])?$_datos["id_user"]:"");
      $res = $this->db->get("app_providers");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }   


}