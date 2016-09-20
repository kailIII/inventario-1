<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mroles extends CI_Model {

	public function __construct(){
		parent::__construct();

		$this->_prefix = $this->config->item('DX_table_prefix');
		$this->_table = $this->_prefix.$this->config->item('DX_users_table');
	}


	public function get_roles_dependientes($_rol_id){
		$this->db->where('role_id',$_rol_id);
		$_res = $this->db->get($this->_table);

		if($_res->num_rows()>0){
			return $_res->num_rows();
		}else{
			return FALSE;
		}
	}



}

/* End of file mroles.php */
/* Location: ./application/models/usuarios/mroles.php */