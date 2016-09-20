<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class muser extends CI_Model {

	public function __construct(){
		parent::__construct();

		$this->load->helper('array');

		$this->load->model('dx_auth/users');
		$this->load->model('dx_auth/user_profile');
		$this->load->model('dx_auth/roles');
        $this->load->helper('path');
	}

/*--------------------------------------------------------------------------------------------------------------------
FUNCIONES PARA LOS ROLES
--------------------------------------------------------------------------------------------------------------------*/
	/**
	 * Obtiene el catalogo de roles
	 * @return array Arreglo con la lista de los roles disponibles.
	 */
	public function get_roles(){
		$_res = $this->roles->get_all();
		if($_res->num_rows()>0){
			foreach ($_res->result_array() as $_row){
				if($_row['id'] != 1)
					$_data[] = $_row;
			}
			return $_data;
		}else{
			return FALSE;
		}
	}

	/**
	 * Setea un rol nuevo
	 * @param 	array 	$_data 		Arreglo con la data recibida desde el frontend
	 * @return 	boolean 			Regresa TRUE cuando ya creo el elemento
	 */
	public function set_roles($_data){
		$_db_user = elements(array(
			'name'
		),$_data);

		$this->roles->create_role($_db_user['name']);

		return TRUE;
	}

	/**
	 * Actualiza un rol ya existente
	 * @param  array 	$_data 		Arreglo con la data recibida desde el frontend
	 * @return boolean 				Regresa TRUE cuando ya creo el elemento
	 */
	public function update_roles($_data){

	}


	/**
	 * Borra un rol ya existente
	 * @param  array 	$_data 		Arreglo con la data recibida desde el frontend
	 * @return boolean 				Regresa TRUE cuando ya creo el elemento
	 */
	public function delete_roles($_data){
		$this->roles->delete_role($_data['id']);
		return TRUE;
	}

/*--------------------------------------------------------------------------------------------------------------------
FUNCIONES PARA LOS USUARIOS
--------------------------------------------------------------------------------------------------------------------*/
	public function delete_item($_data){
		$_user = 0;
		
		if($_data['banned']==0){
			$_user = $this->users->ban_user($_data['id'],'Borrado');
		}else if($_data['banned']==1){
			$_user = $this->users->unban_user($_data['id']);
		}

		if($_user == 1){
			return TRUE;
		}else{
			return FALSE;
		}
	}


	public function update_item($_data){
		//ACTUALIZAMOS LOS DATOS DE EMAIL y ROL
		$_db_user = elements(array(
			'role_id',
			'id_subsidiary',
			'email'
		),$_data);
		$_user = $this->users->set_user($_data['id'], $_db_user);

		//ACTUALIZAMOS EL PERFIL Y DATOS EXTRAS
		$_db_user = elements(array(
			// 'dependencia_id',
			'nombre',
			'paterno',
			'materno',
			'puesto',
			'telefono'
		),$_data['perfil']);
			// if($_data['role_id']==2):
			$_perfil = $this->user_profile->set_profileCli($_data['id'], $_db_user);
			// elseif($_data['role_id']==3):
			// $_perfil = $this->user_profile->set_profile($_data['id'], $_db_user);
			// endif;		

		if($_user == 1 && $_perfil == 1){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	/**
	 * Setea un usuario nuevo
	 * @param array $_data Arreglo con la data recibida desde el frontend
	 */
	public function set_item($_data){
		//REGISTRAMOS AL USUARIO
		// return crypt("casa");
		$_us_data = $_data;
		$_usuario_ = $this->dx_auth->register($_data['username'],$_data['pass'],$_data['domain'],$_data['email'],$_data['role_id'],$_data['id_subsidiary']);
		// return $_usuario_ ;

		//VERIFICAMOS QUE SE HAYA REGISTRADO EL USAURIO, EN CASO DE FALLO, REGRESAMOS FALSE
		if($_usuario_){
			//OBTENEMOS LOS DATOS DEL USUARIO REGISTRADO
			$_usuario = $this->users->get_user_by_username($_us_data['username']);
			$_usuario = $_usuario->row_array();

			//SETEAMOS EL ROL DEL USUARIO
			$_rol = $this->users->set_role($_usuario['id'], $_data['role_id']);

			//SETEAMOS EL PERFIL
			$_db_perfil = elements(array(
				'nombre',
				'paterno',
				'materno',
				'puesto',
				'telefono'
			),$_data['perfil']);

			//SETETAMOS EL AVATAR ALEATORIAMENTE
			// $_db_perfil['imagen'] = avatar_random();
			//ENVIAMOS A LA BD EL PERFIL aún no se guarda en la tabla para los usuarios normales
			// if($_data['role_id']==2):
			$_perfil = $this->user_profile->set_profileCli($_usuario['id'], $_db_perfil);
			
			$user_info=array(
				"id_user" => $_usuario['id'],
				"company" => $_data["company"],
				"description" => $_data["description"],
				"email" => $_data["email"],
				);			
			if($_data['role_id']==2 and $_data['domain']): //logo del usuario, solo se crea si es administrador
			$this->user_profile->set_userInfo($user_info);
			endif;
			// elseif($_data['role_id']==3):
			// $_perfil = $this->user_profile->set_profile($_usuario['id'], $_db_perfil);
			// endif;

			//SETEAMOS VALOR EXTRAS A LA TABLE DE USER_PROFILE_EXTRA
			// esto hay que ver como hacerlo lo mas dinamico posible
			$this->user_profile->set_profileExtra($_usuario['id']);

			
			$dir_logo=set_realpath("application/assets/application/img/logo/logo_".$_usuario['id']); 
			$dir_avatar=set_realpath("application/assets/application/img/avatares/avatar_".$_usuario['id']);  
			$dir_posts=set_realpath("application/assets/application/img/post/post_".$_usuario['id']);  
			
			if(!is_dir($dir_avatar) and ($_data['role_id']==2)){
			    mkdir($dir_posts); //directorio donde se guardan las imagenes de lospost
			    mkdir($dir_avatar);//creamos el directorio de las magenes
			    mkdir($dir_avatar."/perfil");
			    mkdir($dir_logo);//creamos el directorio de las magenes para logos
			}

			return TRUE;
		}else{
			return FALSE;
		}
	}

	/**
	 * Obtiene un usuarios dado con respecto a su ID
	 * @param  int $_id El identificador unico del usuario.
	 * @return array    Arreglo con los datos del usuario buscado.
	 */
	public function get_item($_id){
		$_res = $this->users->get_user_by_id($_id);
		if($_res->num_rows()>0){
			//OBTENEMOS LOS DATOS DEL USUARIO
			$_row = $_res->row_array();

			//OBTENEMOS EL PERFIL DEL USUARIO
			$_profile = $this->user_profile->get_profile($_row['id']);
			if($_profile->num_rows()>0){
				$_profile = $_profile->row_array(); 
				$_profile['avatar'] = avatar($_profile['imagen']);
				// $_profile['imagen250'] = avatar250x250($_profile['imagen']);
			}else{
				$_profile = FALSE;
			}
			//OBTENEMOS EL ROL DEL USUARIO
			$_rol = $this->roles->get_role_by_id($_row['role_id']);
			if($_rol->num_rows()>0){
				$_rol = $_rol->row_array(); 
			}else{
				$_rol = FALSE;
			}


			//CREAMOS LA LISTA CON TODOS LOS DATOS DE LOS USUARIOS
			$_data = array(
				'id' => $_row['id'],
				'role_id' => $_row['role_id'],
				'role_name' => $_rol['name'],
				'username' => $_row['username'],
				'email' => $_row['email'],
				'profile' => $_profile
			);
			return $_data;
		}else{
			return FALSE;
		}
	}


	/**
	 * Obtiene la lista de usuarios, con su perfil
	 * @return array Arreglo con todos los usuarios encontrados
	 */
	public function get_items(){
		$_res = $this->users->get_all();
		if($_res->num_rows()>0){
			foreach ($_res->result_array() as $_row){
				//OBTENEMOS EL PERFIL DEL USUARIO
				$_profile = $this->user_profile->get_profile($_row['id']);
				if($_profile->num_rows()>0){
					$_profile = $_profile->row_array(); 
				}else{
					$_profile = FALSE;
				}

				//OBTENEMOS EL ROL DEL USUARIO
				$_rol = $this->roles->get_role_by_id($_row['role_id']);
				if($_rol->num_rows()>0){
					$_rol = $_rol->row_array(); 
				}else{
					$_rol = FALSE;
				}

				//CREAMOS LA LISTA CON TODOS LOS DATOS DE LOS USUARIOS
				if($_row['role_id'] != 1){
					$_data[] = array(
						'id' => $_row['id'],
						'role_id' => $_row['role_id'],
						'id_subsidiary' => $_row['id_subsidiary'],
						'role_name' => $_rol['name'],
						'username' => $_row['username'],
						'email' => $_row['email'],
						'banned' => $_row['banned'],
						'ban_reason' => $_row['ban_reason'],
						'profile' => $_profile
					);
				}
			}
			return $_data;
		}else{
			return FALSE;
		}
	}


}

/* End of file musuarios.php */
/* Location: ./application/models/usuarios/musuarios.php */