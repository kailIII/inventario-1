<?php
class User_Profile extends CI_Model 
{
	function __construct()
	{
		parent::__construct();

		$this->_prefix = $this->config->item('DX_table_prefix');		
		$this->_table = $this->_prefix.$this->config->item('DX_user_profile_table');
		$this->_table_info = $this->_prefix.$this->config->item('DX_user_info');
	}
	
	function create_profile($user_id)
	{
		$this->db->set('user_id', $user_id);
		return $this->db->insert($this->_table);
	}

	//function create_info($user_id)
	//{
	//	$this->db->set('id_user', $user_id);
	//	return $this->db->insert($this->_table_info);
	//}

	function get_profile_field($user_id, $fields)
	{
		$this->db->select($fields);
		$this->db->where('user_id', $user_id);
		return $this->db->get($this->_table);
	}

	function get_profile($user_id)
	{
		$this->db->where('user_id', $user_id);
		return $this->db->get($this->_table);
	}

	function set_profileCli($user_id, $data)
	{
		$this->db->where('user_id', $user_id);
		return $this->db->update($this->_table, $data);
		// echo $this->db->last_query();
	}
	function set_userInfo($user_info)
	{
		$datenow = date("Y-m-d h:i:s");
		$data = array(
			"id_user"=>$user_info["id_user"],
			"company"=>$user_info["company"],
			"description"=>$user_info["description"],
			"email"=>$user_info["email"],
			"registred_by"=>$user_info["id_user"],
			"registred_on"=>$datenow,
			);		
		return $this->db->insert('app_user_info', $data);
		// echo $this->db->last_query();
	}
	function set_profileExtra($user_id)
	{
		$datenow = date("Y-m-d h:i:s");
		$data = array(
			"id_user"=>$user_id,
			"registred_by"=>$user_id,
			"registred_on"=>$datenow,
			);		
		return $this->db->insert('app_user_profile_extra', $data);
	}
	// function set_profile($user_id, $data)
	// {
	// 	$this->db->where('user_id', $user_id);
	// 	return $this->db->update("app_user_profile", $data);
	// 	// echo $this->db->last_query();
	// }
	function delete_profile($user_id)
	{
		$this->db->where('user_id', $user_id);
		return $this->db->delete($this->_table);
	}
}

?>