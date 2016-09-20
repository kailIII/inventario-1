<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mcatalogos extends CI_Model {

	public function __construct(){
		parent::__construct();
        $this->id_user = $this->dx_auth->getUserDomain();
		
	}
	
   public function getCategory($id_user,$category){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
      if($category)
      $this->db->where('name',$category);
      $res = $this->db->get("app_articles_category");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
   public function getItemsCategory($id_user,$id_category){

      $this->db->select('my.id');
      $this->db->select('my.title');
      $this->db->select('cat.id as id_category');
      $this->db->select('cat.name as category');
      $this->db->select('GROUP_CONCAT(img.name SEPARATOR ",")  as name',false);
      $this->db->select('GROUP_CONCAT(img.id SEPARATOR ",")  as id_img',false);
      $this->db->select('my.type');
      $this->db->select('my.registred_by');
      $this->db->from('mypost as my');
      $this->db->join('img_post as img', "img.id_post=my.id",'right');
      $this->db->join('app_articles_category as cat', "cat.id=my.category",'right');
      if($id_category)
      $this->db->where('my.category',$id_category);
      $this->db->where('my.id_user',$id_user);
      $this->db->group_by("my.id");
      $this->db->order_by('my.id desc');
      $consulta = $this->db->get();
      
      if ($consulta->num_rows() > 0){
         foreach ($consulta->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }

   }
   public function saveCategory($_datos){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "id_user"=>$_datos["id_user"],
         "name"=>$_datos["name"],
         "registred_by"=>$_datos["id_user"],
         "registred_on"=>$datenow,
         );
      $res = $this->db->insert("app_articles_category",$data);

      return $res;
   }
   public function getFamily($id_user,$family){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
      if($family)
      $this->db->where('name',$family);
      $res = $this->db->get("app_articles_family");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }

   public function saveFamily($_datos){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "id_user"=>$_datos["id_user"],
         "name"=>$_datos["name"],
         "registred_by"=>$_datos["id_user"],
         "registred_on"=>$datenow,
         );
      $res = $this->db->insert("app_articles_family",$data);

      return $res;
   }
   public function getDepartament($id_user,$family){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
      if($family)
      $this->db->where('name',$family);
      $res = $this->db->get("app_articles_departament");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }   
   public function saveDepartament($_datos){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "id_user"=>$_datos["id_user"],
         "name"=>$_datos["name"],
         "registred_by"=>$_datos["id_user"],
         "registred_on"=>$datenow,
         );
      $res = $this->db->insert("app_articles_departament",$data);

      return $res;
   }
   public function getUbication($id_user,$ubication){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
      $res = $this->db->get("app_articles_cost_center");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
   public function saveUbication($_datos){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "id_user"=>$_datos["id_user"],
         "name"=>$_datos["name"],
         "registred_by"=>$_datos["id_user"],
         "registred_on"=>$datenow,
         );
      $res = $this->db->insert("app_articles_cost_center",$data);

      return $res;
   }
   public function getBrand($id_user,$brand){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
      $res = $this->db->get("app_articles_brand");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
   public function saveBrand($_datos){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "id_user"=>$_datos["id_user"],
         "name"=>$_datos["name"],
         "registred_by"=>$_datos["id_user"],
         "registred_on"=>$datenow,
         );
      $res = $this->db->insert("app_articles_brand",$data);

      return $res;
   }

}