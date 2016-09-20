<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mperfil extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('array');
		$this->load->model('dx_auth/user_profile');
		$this->load->model('dx_auth/users');
      	$this->id_user = $this->dx_auth->getUserDomain();
      	
	}


	public function update_item($_perfil,$_pass_actual,$_pass_nuevo,$_mail)
	{
		//ACTUALIZAMOS EL PERFIL
		$_db_user = elements(array(
			'nombre',
			'paterno',
			'materno',
			'puesto',
			'telefono'
		),$_perfil);

		$this->user_profile->set_profileCli($_perfil['id'], $_db_user);
		//ACTUALIZAMOS EL PASSWORD EN CASO DE QUE HAYA
		if($_pass_actual!='')
		$res=$this->dx_auth->change_password($_pass_actual,$_pass_nuevo);
		// return $res;
		//ACTUALIZAMOS EL CORREO
		$this->users->set_user($_perfil['id'], array('email'=>$_mail));
		
		$this->users->set_userInfo(array('email'=>$_mail,'telefono'=>$_perfil['telefono']));

		return TRUE;
	}

	public function update_avatar($_data)
	{
		$_db = elements(array(
			'imagen'
		),$_data);

		return $this->user_profile->set_profileCli($_data['id'], $_db);
	}
   public function insert_img($name){
      $data = array( 'name' => $name,'id_user'=>$this->id_user["id"]);
      $this->db->insert('img_profile', $data);
      return $this->db->insert_id();
   }
   public function delete_file($_ref){
      $file = $this->get_file($_ref);

      if (!$this->db->where('id', $_ref)->delete('img_profile'))
      return FALSE;

      @unlink(FCPATH.'application/assets/application/img/avatares/avatar_'.$this->id_user["id"].'/perfil/'.$file->name);  
      return TRUE;
   } 
   public function get_file($file_id){
      return $this->db->select("name")
            ->from('img_profile')
            ->where('id', $file_id)
            ->get()
            ->row();
   }

}

/* End of file mperfil.php */
/* Location: ./application/models/usuarios/mperfil.php */