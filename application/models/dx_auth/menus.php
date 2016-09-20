<?php

class menus extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->_user = $this->dx_auth->getUserDomain();
        // $this->_user = $this->getIdUserDomain();
		$this->_prefix = $this->config->item('DX_table_prefix');
		$this->_table = $this->_prefix.$this->config->item('DX_modules_table');	
		// $this->_roles_table = $this->_prefix.$this->config->item('DX_roles_table');
	}
	
	// General function
	
	function get_menu()
	{
		$this->db->select('name');
		$this->db->select('url');
		$this->db->select('icon');
		$this->db->where('status',1);

		if(!$this->dx_auth->is_logged_in())
		$this->db->where('needlogin',0);

		$this->db->order_by('order', 'asc');
		$_res = $this->db->get("app_modules");
		// $_res = $this->db->get($this->_table);
		
		if($_res->num_rows()>0){
			foreach ($_res->result_array() as $_row){
					$_data[] = $_row;
					// $menuSession["menu_session"][] = $_row["name"];
			}
			//session para el menu, se usa en el getIdUserDomain
			// $this->session->set_userdata($menuSession);
			// $modulos=$this->session->userdata('menu_session');

			return $_data;
		}else{
			return array(
						0=>array(
							"name"=>"inicio",
							"url"=>"inicio",
							"icon"=>"fa-home",
							)
						);
		}		
	}
	
	function get_sidebar($id)
	{
		
		$this->db->select('my.id');
		$this->db->select('my.title');
		$this->db->select('my.description');
		// $this->db->select('my.item');
		$this->db->select('my.price');
		$this->db->select('my.oldprice');
		$this->db->select('my.video');
		$this->db->select('cat.id as id_category');
		$this->db->select('cat.name as category');
		$this->db->select('GROUP_CONCAT(img.name SEPARATOR ",")  as name',false);
		$this->db->select('my.registred_on');
		$this->db->from('mypost as my');
		$this->db->join('img_post as img', "img.id_post=my.id",'right');
		$this->db->join('app_articles_category as cat', "cat.id=my.category",'right');
		if($id)
		$this->db->where('my.id',$id);
		$this->db->where('my.id_user',$this->_user["id"]);
		$this->db->group_by("my.id");
		$this->db->order_by('my.id desc');
		$this->db->limit("10");
		$consulta = $this->db->get();
		// echo$this->db->last_query();
		
		if ($consulta->num_rows() > 0){
			foreach ($consulta->result_array() as $row){
				$data[] = $row;
			}
			return $data;
		}else{
			return array();
		}		

	}
	function get_img_perfil($id)
	{

		$this->db->select('id as _Pimg');
		$this->db->select('name');
		$this->db->where('id_user',$this->_user["id"]);
		$this->db->order_by('id desc');
		// $this->db->limit("10");
		$consulta = $this->db->get("img_profile");

		if ($consulta->num_rows() > 0){
			foreach ($consulta->result_array() as $row){
				$row["_Pimg"]=$row["_Pimg"];
				
				$data[] = $row;
			}
			return $data;
		}else{
			return array();
		}		

	}

	function get_social()
	{
		
		$this->db->select('facebook');
		$this->db->select('twitter');
		$this->db->select('google');
		$this->db->select('youtube');
		$this->db->where('id_user',$this->_user["id"]);
		$this->db->order_by('id', 'desc');
		$_res = $this->db->get("app_user_profile_extra");
		if ($_res->num_rows() > 0){
			foreach ($_res->result_array() as $row){
				$data = $row;
			}
			return $data;
		}else{
			return $data=array("facebook"=>"SistemaDeluxer");
		}		

	}
	public function getInfo($id_user)
	{
		$this->db->where('id_user',$id_user);
		$res = $this->db->get("app_user_info");

		if ($res->num_rows() > 0){
		 foreach ($res->result_array() as $row){
		    $row['logo_'] = logo($row['logo'],$id_user);
		    $data = $row;
		 }
		 return $data;
		}else{
		 return array();
		}
   }	

}

?>