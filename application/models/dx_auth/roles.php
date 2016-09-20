<?php

class Roles extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		
		// Other stuff
		$this->_prefix = $this->config->item('DX_table_prefix');
		$this->_table = $this->_prefix.$this->config->item('DX_roles_table');
		$id_user__=$this->dx_auth->getUserDomain();
	}
	
	function get_all()
	{
		$this->db->order_by('id', 'desc');
		//$this->db->where('id_user', $id_user__["id_user"]);
		return $this->db->get($this->_table);
	}
	
	function get_role_by_id($role_id)
	{
		$this->db->where('id', $role_id);
		return $this->db->get($this->_table);
	}
	
	function create_role($name, $parent_id = 0)
	{
		$data = array(
			'name' => $name,
			'parent_id' => $parent_id
		);
            
		$this->db->insert($this->_table, $data);
	}
	
	function delete_role($role_id)
	{
		$this->db->where('id', $role_id);
		$this->db->delete($this->_table);		
	}
}

?>