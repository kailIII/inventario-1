<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class majustes extends CI_Model {

	public function __construct(){
		parent::__construct();
      
      $this->load->helper('array');
      $this->load->helper('path');
		
	}
	public function savePagefb($_datos){
		$datenow = date("Y-m-d h:i:s");
		$data = array(
      "facebook"=>$_datos["facebook"],
      "twitter"=>$_datos["twitter"],
      "google"=>$_datos["google"],
			"youtube"=>$_datos["youtube"],
			"updated_by"=>$_datos["id_user"],
			"updated_on"=>$datenow,
			);
    $this->db->where('id_user',$_datos["id_user"]);
		$res = $this->db->update("app_user_profile_extra",$data);

		return $res;
	}
   public function getInfo($id_user){
      $this->db->where('id_user',isset($id_user["id_user"])?$id_user["id_user"]:"");
      $res = $this->db->get("app_user_info");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $row['logo'] = logo($row['logo']);
            $data = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
   public function get_img_logo($id_user)
    {

        $this->db->select('id as _Pimg');
        $this->db->select('name');
        $this->db->where('id_user',$id_user);
        $this->db->order_by('id desc');
        // $this->db->limit("10");
        $consulta = $this->db->get("app_img_logo");

        if ($consulta->num_rows() > 0){
            foreach ($consulta->result_array() as $row){
                $data[] = $row;
            }
            return $data;
        }else{
            return array();
        }       

    }    
   public function getLogo($id_user){
      $this->db->where('id_user',$id_user);
      $res = $this->db->get("app_img_logo");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){

            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
   public function updateInfo($_data,$user_id){
      
      $_db_user = elements(array(
         'company',
         'description',
         'street',
         'zip_code',
         'colony',
         'city',
         'state',
         'country'
      ),$_data);

      $this->db->where('id_user', $user_id);
      return $this->db->update("app_user_info", $_db_user);
   }   
   public function insert_img($name){
      $data = array( 'name' => $name,'id_user'=>$this->id_user["id"]);
      $this->db->insert('app_img_logo', $data);
      return $this->db->insert_id();
   }
   public function delete_file($_ref){
      $file = $this->get_file($_ref);

      if (!$this->db->where('id', $_ref)->delete('app_img_logo'))
      return FALSE;

      @unlink(FCPATH.'application/assets/application/img/logo/logo_'.$this->id_user["id"].'/'.$file->name);  
      return TRUE;
   } 
   public function get_file($file_id){
      return $this->db->select("name")
            ->from('app_img_logo')
            ->where('id', $file_id)
            ->get()
            ->row();
   }
   public function update_avatar($_data,$id_user)
   {
      $_db = array(
         'logo'=>$_data["logo"]
         );
      $this->db->where('id_user', $id_user);
      return $this->db->update("app_user_info", $_db);

   }
    public function saveFolio($_datos){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "serie"=>$_datos["serie"],
         "start"=>$_datos["start"],
         "subsidiary"=>$_datos["subsidiary"],
         "registred_by"=>$_datos["id_user"],
         "registred_on"=>$datenow,
         );
      $res = $this->db->insert("app_stock_series",$data);

      return $res;
   }
   public function getFolio($id_user){
      $this->db->select("id");
      $this->db->select("serie");
      $this->db->select("start");
      $this->db->select("current");
      $this->db->select("subsidiary");
      $this->db->select("status");
      $this->db->where("id_user",(isset($id_user["id_user"])?$id_user["id_user"]:0));
      $res = $this->db->get("app_stock_series");

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
      $this->db->select("subs.id");
      $this->db->select("subs.name");
      $this->db->select("subs.state");
      $this->db->select("subs.city");
      $this->db->select("subs.colony");
      $this->db->select("subs.street");
      $this->db->select("subs.outside_number");
      $this->db->select("subs.inside_number");
      $this->db->select("subs.zip_code");
      $this->db->select("subs.reference");
      $this->db->select("subs.email");
      $this->db->select("subs.phone");
      $this->db->select("subs.contact");
      $this->db->select("rs.name as state_name");
      $this->db->select("rt.name as city_name");
      $this->db->from("app_subsidiaries as subs");
      $this->db->join("app_region_state as rs","rs.id=subs.state","left");
      $this->db->join("app_region_town as rt","rt.id=subs.city","left");
      $this->db->where("id_user",(isset($id_user["id_user"])?$id_user["id_user"]:0));
      $this->db->order_by('subs.id desc');
      $res = $this->db->get();

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
    public function saveSubsidiary($_datos){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "id_user"=>$_datos["id_user"],
         "name"=>$_datos["name"],
         "state"=>$_datos["state_id"],
         "city"=>$_datos["city"],
         "colony"=>$_datos["colony"],
         "street"=>$_datos["street"],
         "outside_number"=>$_datos["outside_number"],
         "inside_number"=>$_datos["inside_number"],
         "zip_code"=>$_datos["zip_code"],
         "reference"=>$_datos["reference"],
         "email"=>$_datos["email"],
         "phone"=>$_datos["phone"],
         "contact"=>$_datos["contact"],
         "registred_by"=>$_datos["id_user"],
         "registred_on"=>$datenow,
         );
      $res = $this->db->insert("app_subsidiaries",$data);

      return $res;
   }
   public function updateSubsidiary($_data){
      $datenow = date("Y-m-d h:i:s");
      
      $_db_user = array(
         "name"=>$_data["name"],
         "state"=>$_data["state_id"],
         "city"=>$_data["city"],
         "colony"=>$_data["colony"],
         "street"=>$_data["street"],
         "outside_number"=>$_data["outside_number"],
         "inside_number"=>$_data["inside_number"],
         "zip_code"=>$_data["zip_code"],
         "reference"=>$_data["reference"],
         "email"=>$_data["email"],
         "phone"=>$_data["phone"],
         "contact"=>$_data["contact"],
         "updated_by"=>$_data["id_user"],
         "updated_on"=>$datenow,
         );

      $this->db->where('id', $_data["id"]);
      $this->db->where('id_user', $_data["id_user_parent"]);
      return $this->db->update("app_subsidiaries", $_db_user);
   } 
   public function deleteSubsidiary($_data)
   {
    $this->db->where("id",$_data["id"]);
    $this->db->where('id_user', $_data["id_user_parent"]);
    $this->db->delete("app_subsidiaries");


   }
   public function getState(){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where("country",1);
      $res = $this->db->get("app_region_state");

      if ($res->num_rows() > 0){
         foreach ($res->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
   public function getTown($state){
      $this->db->select("id");
      $this->db->select("name");
      $this->db->where("state",$state);
      $res = $this->db->get("app_region_town");

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