<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mpass extends CI_Model {

	public function __construct(){
		parent::__construct();

		$this->load->model('dx_auth/users');

		$this->_prefix = $this->config->item('DX_table_prefix');
		$this->_table = $this->_prefix.$this->config->item('DX_password_table');	
		
	}
	public function reset_pass($pass, $id_user = false){
		if (!$id_user){
			$id_user = $this->dx_auth->get_user_id();
		}
		//cambiamos el pass en la tabla de user
		$pass = crypt($this->dx_auth->_encode($pass));
		$this->users->change_password($id_user, $pass);

		//insertamos el nuevo pass en la tabla password
		$this->db->insert($this->_table, array('id_user'=>$id_user,'password'=>$pass));

		return TRUE;
	}
	public function same_pass($old_pass, $id_user = false){

		if ($query = $this->users->get_user_by_id($this->session->userdata('DX_user_id')) AND $query->num_rows() > 0)
		{
			// Get current logged in user
			$row = $query->row();
			$pass = $this->dx_auth->_encode($old_pass);
			if (crypt($pass, $row->password) === $row->password)
			return true;
			else
			return false;
			
		}else{

			return false;
		}

	}

	public function calcular_dif_dias($id_usuario = false){
		if(!$id_usuario){
			$id_usuario = $this->dx_auth->get_user_id();
		}

		$fecha_bd =  $this->users->get_user_field($id_usuario,'modified_pass');
		$fecha_bd = $fecha_bd->row_array();
		$now = time();
		$your_date = strtotime($fecha_bd['modified_pass']);
		$datediff = $now - $your_date;
		return floor($datediff/(60*60*24));
	}


	/**
	 * Compara el password para ver si ya fue usado.
	 * 
	 * @param  string 	$password 		Password nuevo para ser usado.
	 * @param  int 		$id_usuario 	Identificador unico del usaurio.
	 * @return boolean 					TRUE si ya existe una clave igual, FALSE si no existe.
	 */
	public function ultima_password($password,$id_usuario = false){
		if(!$id_usuario){
			$id_usuario = $this->dx_auth->get_user_id();
		}
		$nva_password = $this->dx_auth->_encode($password);
		$ban = false;

		$this->db->select('password');
		$this->db->where('id_user',$id_usuario);
		$this->db->order_by('id_pass','desc');
		$this->db->limit(5);
		$_result = $this->db->get($this->_table);

		if($_result->num_rows()>0){
			foreach($_result->result_array() as $row){
				if (crypt($nva_password, $row['password']) === $row['password']){
					$ban = true;
					break;
				}
			}
		}
		return $ban;
	}


	/**
	 * Verifica la fortaleza del password.
	 * 
	 * @param  string 	$password 	Password nuevo para ser usado.
	 * @return boolean				TRUE si es lo suficientemente fuerte, FALSE si no lo es.           
	 */
	public function strong_password($password){
		if ( preg_match("/^.*(?=.*[_])|(?=.*\W)(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/",$password) ) {
			return TRUE;
		} else {
			return FALSE;
		}
	}



	/**
	 * Verifica si el nombre de usuario esta disponible para poder usarse.
	 * 
	 * @param  string 	$usuario 	Nombre de usuario a ser verificado
	 * @return boolean          	TRUE si el nombre de usuario esta libre, FALSE en caso contrario.
	 */
	public function usuario_disponible($usuario){
		$_res = $this->users->check_username($usuario);
		if($_res->num_rows()>0){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	public function email_disponible($email){
		$_res = $this->users->check_email($email);
		if($_res->num_rows()>0){
			return FALSE;
		}else{
			return TRUE;
		}
	}	 
	public function domain_disponible($domain){
		$_res = $this->users->check_domain($domain);
		if($_res->num_rows()>0){
			return FALSE;
		}else{
			return TRUE;
		}
	}


}

/* End of file mpass.php */
/* Location: ./application/models/mpass.php */