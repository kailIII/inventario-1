<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class APP_Menus{

	private $CI;

	public function __construct(){
		$this->CI =& get_instance();
		// $this->load->model('dx_auth/menus');
        	//$this->id_user_and_domain = $this->CI->dx_auth->getUserDomain();
			$this->CI->load->model("dx_auth/permissions");
			$this->permissions = $this->CI->permissions->get_permission_data($this->CI->dx_auth->get_role_id());
			//$this->CI->permissions->set_permission_value($this->CI->dx_auth->get_role_id(),1,"usuarios");
			//print_r($this->permissions);
			//foreach ($this->permissions as $key => $value) {
			//$this->CI->permissions->set_permission_value($this->CI->dx_auth->get_role_id(),1,$value);
			//}
			// echo "<br>";
		// print_r($this->id_user_and_domain);

	}

	/**
	 * Genera el menú del usuario, el del header en la esquina derecha.
	 * @return string El html generado con las opciones del usuario.
	 */
	public function get_user_menu(){
		if ($this->CI->dx_auth->is_logged_in()){
			//obtenemos el perfil del usuario
			$this->CI->load->library("dx_auth");
			// $this->CI->load->model("dx_auth/users");
			$this->CI->load->model("dx_auth/user_profile");
			$username = $this->CI->dx_auth->get_username();
			$_perfil = $this->CI->user_profile->get_profile($this->CI->dx_auth->get_user_id());
			$_perfil = $_perfil->row_array();
	
			//creamos el menu:
			$_usuario['nombre'] = $username;
			$_usuario['domain'] = $this->CI->dx_auth->get_domain();
			// $_usuario['domain'] = $this->id_user_and_domain["domain"];

			// $_usuario['rol'] = $this->CI->dx_auth->get_role_name();
			//obtenemos el avatar de 50x50
			$_usuario['imagen_perfil'] = avatar($_perfil['imagen']);
			return $this->CI->parser->parse('prime_elements/menu-usuario',$_usuario,TRUE);
		}
	}

	/**
	 * Genera el menú del administrador, son las opciones se muestran
	 * cuando entra un Superadmin o Administrador.
	 * @return [type] [description]
	 */
	public function get_admin_menu(){
		if ($this->CI->config->item('app_use_login')){
			$this->CI->load->library("dx_auth");
			if($this->CI->dx_auth->is_admin() || $this->CI->dx_auth->is_superadmin()){
				return $this->CI->parser->parse('prime_elements/menu-admin',array(),TRUE);
			}
			return '';
		} 
	}

	/**
	 * Obtiene los "li" del sidebar. Implementacion para la version 2.0
	 * @return string Lista de "li" del sidebar
	 */
	public function get_menu($modules,$_html="",$onlyParent=false,$_domain=""){
	if(!is_string($_html))
		$_html = "";
		$_html_ = "";
		if($onlyParent):
		$_SESSION["modules"] = $modules;

		if (!$this->CI->dx_auth->is_logged_in())
		$_html .=$this->CI->parser->parse('login/log_in',array(), TRUE);
		$_html .=$this->get_user_menu();
		endif;
	 
	 	ksort($_SESSION["modules"],SORT_STRING);

		foreach ($modules as $kmod=> $modname):
			 //echo $modname["name"];
			 //$this->CI->permissions->set_permission_value($this->CI->dx_auth->get_role_id(),$kmod,$modname["url"]);
			 //echo "<br>";
			if(!in_array($modname["url"],$this->permissions) and $this->CI->dx_auth->is_logged_in())
		 	continue;

			$is_parent=(substr_count($modname["url"],"/")===0);
			$url = site_url($_domain."/".$modname["url"]);
			
			if($onlyParent and !$is_parent)
		 	continue;

			if($modname["name"]=="inicio" || $modname["name"]=="perfil")
			continue;

			if($is_parent)
			$_html .= "<li><a href='$url'><span><i class='icon fa $modname[icon] fa-2x'></i></span>".ucfirst($modname['name'])."</a>";
			//if($is_parent)
			//$_html .= "<li><a href='$url'>".ucfirst($modname['name'])."</a>";
			
			if(!$onlyParent and !$is_parent)
			$_html .= "<li><a href='$url'>$modname[name]</a>";

			if($children = $this->_li($modname) and ($html_2 = $this->get_menu($children,"","",$_domain))){
			
				if(!$is_parent)
				$_html .= "  <i class='fa fa-caret-down fa-lg'></i>";
				$_html .= $html_2;

			}
			
			$_html .="</li>";

		endforeach;
		
		
		if($onlyParent):
			$menu = "class='menu'";
		else:
			$menu = ""; 
		endif;
		
			$_html_ .="<ul $menu>";
			$_html_ .= $_html;
			$_html_ .="</ul>";
		
		return $_html_;
	}

	private function _li($modname){
		
		$childres = array();
		$searchMod=$modname["url"]."/";

		$modLimit = substr_count($searchMod,"/");

		foreach ($_SESSION["modules"] as $v){

			if(!(strpos($v["url"],$searchMod)===0 and substr_count($v["url"],"/")===$modLimit))
			continue;
			$childres[] = $v;

		}
	 	
	 	ksort($childres,SORT_STRING);

		return $childres;
	
	}



}


