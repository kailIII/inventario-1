<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mpostear extends CI_Model {

	public function __construct(){
		parent::__construct();
      $this->id_user = $this->dx_auth->getUserDomain();

	}
	public function savemypost($_datos){
		$datenow = date("Y-m-d h:i:s");
		$data = array(
			"id_user"=>$_datos["id_user"],
			"title"=>$_datos["title"],
			"description"=>htmlentities($_datos["description"]),
			"category"=>$_datos["category"],
			"registred_by"=>$_datos["id_user"],
			"registred_on"=>$datenow,
			);
      $res = $this->db->insert("mypost",$data);

      $id_post = $this->db->insert_id();

      foreach ($_datos["id_imgpost"] as $k => $v) {
          $data=array("id_post"=>$id_post);
          $this->db->where("id",decode_url($v));
   		 $this->db->update("img_post",$data);
      }

      return $data;

	}
   public function saveevent($_datos){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "id_user"=>$_datos["id_user"],
         "brandwather"=>$_datos["brand"],
         "id_imgpost"=>$_datos["id_imgpost"],
         "video"=>$_datos["video"],
         "urll"=>$_datos["urll"],
         "registred_by"=>$_datos["id_user"],
         "registred_on"=>$datenow,
         );
      $this->db->insert("events",$data);
   }
   // se agrega al catalogo
    public function saveProvider($provider,$id_user,$id_user_parent){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "id_user"=>$id_user_parent,
         "name"=>$provider,
         "registred_by"=>$id_user,
         "registred_on"=>$datenow,
         );
      $this->db->insert("app_providers",$data);
      $res = $this->db->insert_id();
      return $res;
   }
   // se agrega al catalogo
    public function saveBrand($brand,$id_user,$id_user_parent){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "id_user"=>$id_user_parent,
         "name"=>$brand,
         "registred_by"=>$id_user,
         "registred_on"=>$datenow,
         );
      $this->db->insert("app_articles_brand",$data);
      $res = $this->db->insert_id();
      return $res;
   }
   // se agrega al catalogo
    public function saveFamily($family,$id_user,$id_user_parent){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "id_user"=>$id_user_parent,
         "name"=>$family,
         "registred_by"=>$id_user,
         "registred_on"=>$datenow,
         );
      $this->db->insert("app_articles_family",$data);
      $res = $this->db->insert_id();
      return $res;
   }
   // se agrega al catalogo
    public function saveCostCenter($ubication,$id_user,$id_user_parent){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "id_user"=>$id_user_parent,
         "name"=>$ubication,
         "registred_by"=>$id_user,
         "registred_on"=>$datenow,
         );
      $this->db->insert("app_articles_cost_center",$data);
      $res = $this->db->insert_id();
      return $res;
   }
   public function savemyitem($_datos){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "id_user"=>$_datos["id_user_prime"],
         "title"=>$_datos["title"],
         "folio"=>$_datos["folio"],
         "description"=>(isset($_datos["description"])?htmlentities($_datos["description"]):""),
         "price"=>(isset($_datos["price"])? $_datos["price"] : ""),
         "oldprice"=>(isset($_datos["oldprice"])? $_datos["oldprice"] : ""),
         "stock"=>(isset($_datos["stock"])?$_datos["stock"]:""),
         "video"=>(isset($_datos["video"]) ? strip_tags($_datos["video"],'<iframe>') : ""),
         "type"=>(isset($_datos["type"])?$_datos["type"]:""),
         "serie"=>(isset($_datos["serie"])?$_datos["serie"]:""),
         "barcode"=>(isset($_datos["barcode"])?$_datos["barcode"]:""),
         "invoice"=>(isset($_datos["invoice"])?$_datos["invoice"]:""),
         "brand"=>(isset($_datos["brand_id"])?$_datos["brand_id"]:""),
         "type_of_currence"=>(isset($_datos["TypeOfCurrence_id"])?$_datos["TypeOfCurrence_id"]:""),
         "provider"=>(isset($_datos["Provider_id"])?$_datos["Provider_id"]:""),
         "class"=>(isset($_datos["Class_id"])?$_datos["Class_id"]:""),
         "use"=>(isset($_datos["Use_id"])?$_datos["Use_id"]:""),
         "level_obsolescence"=>(isset($_datos["Level_obsolescence_id"])?$_datos["Level_obsolescence_id"]:""),
         "physical_state"=>(isset($_datos["Physical_state_id"])?$_datos["Physical_state_id"]:""),
         "departament"=>(isset($_datos["Departament_id"])?$_datos["Departament_id"]:""),
         "ubication"=>(isset($_datos["Ubication_id"])?$_datos["Ubication_id"]:""),
         "family"=>(isset($_datos["Family_id"])?$_datos["Family_id"]:""),
         "frecuency"=>(isset($_datos["frecuencyMonth"])?$_datos["frecuencyMonth"]:""),
         "status"=>1,
         "id_user_assign"=>(isset($_datos["User_id"])?$_datos["User_id"]:""),
         "registred_by"=>(isset($_datos["id_user"])?$_datos["id_user"]:""),
         "registred_on"=>$datenow,
         );
      $res = $this->db->insert("mypost",$data);

      $id_post = $this->db->insert_id();

      if(isset($_datos["id_imgpost"]))
      foreach ($_datos["id_imgpost"] as $k => $v) {
          $dataInsert=array("id_post"=>$id_post);
          $this->db->where("id",decode_url($v));
          $this->db->update("img_post",$dataInsert);
      }      
      if($res)
      {
          $data=array("current"=>$_datos["folio_current"]+1);
          $this->db->where("id",$_datos["folio_id"]);
          $this->db->update("app_stock_series",$data);
      }

      return $res;

   }   
   public function insert_img($name){
      $data = array( 'name' => $name);
      $this->db->insert('img_post', $data);
      return $this->db->insert_id();
   }
   public function delete_file($file_id){
      $file = $this->get_file($file_id);

      if (!$this->db->where('id', $file_id)->delete('img_post'))
      return FALSE;

      @unlink(FCPATH.'application/assets/application/img/post/post_'.$this->id_user["id"].'/'.$file->name);  
      return TRUE;
   } 
   public function get_file($file_id){
      return $this->db->select("name")
            ->from('img_post')
            ->where('id', $file_id)
            ->get()
            ->row();
   }  
   public function checkMyPost($id){
      
      $this->db->select('id');
      $this->db->where('id',$id);
      $consulta = $this->db->get("mypost");
      
      if ($consulta->num_rows() > 0){
         return $consulta->row();
      }else{
         return array();
      }     
   }   
   public function getBrand($id_user){
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
   public function getTypeFixedAssets($id_user){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
      $res = $this->db->get("app_articles_typefixedassets");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
   public function getTypeOfCurrence($id_user){
      $this->db->select("id");
      $this->db->select("currency");
      $this->db->where('id_user',$id_user);
      $res = $this->db->get("app_type_of_currency");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
   public function getProvider($id_user){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
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
   public function getSubsidiary($id_user){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
      $res = $this->db->get("app_subsidiaries");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }   
   public function getClass($id_user){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
      $res = $this->db->get("app_articles_class");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }

   public function getUse($id_user){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
      $res = $this->db->get("app_articles_use");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
   public function getLevel_obsolescence($id_user){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
      $res = $this->db->get("app_articles_level_obsolescence");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
   public function getPhysical_state($id_user){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
      $res = $this->db->get("app_articles_physical_state");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
   public function getDepartament($id_user){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
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
   public function getCostCenter($id_user){
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
   public function getSubCostCenter($id_user){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
      $res = $this->db->get("app_articles_cost_center_sub");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
   public function getFamily($id_user){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where('id_user',$id_user);
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
   public function getUsers($id_user){
      $this->db->select("id");
      $this->db->select("username");
      $this->db->where('id_user',$id_user);
      $res = $this->db->get("app_users_client");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
   public function getFolio($id_user){
      $this->db->select("id");
      $this->db->select("serie");
      $this->db->select("current");
      $this->db->where('id_user',$id_user);
      $res = $this->db->get("app_stock_series");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data = $row;
         }
         return $data;
      }else{
         return array();
      }
   } 

}