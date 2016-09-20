<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class APP_Controller extends CI_Controller {

	// private $CI;
	// private $MODULO;
	// private $MODULO_PERMISOS;
	// private $USUARIO_PERMISOS;
	// private $_modulos;
	// private $mod ="";
	
	private $PASS_CADUCA;

	private $MODULO_ERROR;

	public function __construct(){
		parent::__construct();

	 	//obtenemos instancia de CI
		$this->CI =& get_instance();

		//cargamos librerias
		$this->load->library('APP_Modulo');
		$this->load->library('APP_Menus');
		$this->load->library('APP_Js');
		$this->load->library('APP_Css');
		$this->load->model('dx_auth/menus');

		$this->_modulos = $this->menus->get_menu("");
		//dominio para sidebar y menu
		$this->id_user_and_domain = $this->dx_auth->getUserDomain();
		//dominio se usa para que el logotipo te redireccione siempre al usuario logueado o sí no, al de la URL buscado

       	$this->mod = $this->dx_auth->get_domain();
		if(!$this->mod and !$this->dx_auth->is_superadmin()){
			$this->uri->segments = array_slice($this->uri->segments,0,5);
			list($this->mod, $category,$method,) = array_pad($this->uri->segments, 5, NULL);
		}
		//en caso de que no estemos en ambiente de desarrollo, deshabilitamos firephp
		if (ENVIRONMENT!='development') $this->CI->firephp->setEnabled(FALSE);
		//cargamos la configuracion del modulo
		$this->PASS_CADUCA = FALSE;
		$this->MODULO_ERROR = FALSE;
		$this->MODULO = get_class($this);
		$this->app_modulo->get_modulo_config($this->MODULO);
		// $this->_modulos = $this->config->item('app_modulos');
		// EN CASO DE QUE ESTEMOS VIENDO CUALQUIER OTRO MODULO QUE NO SEA LOGIN
		// verificamos si la aplicacion requiere login
		// if ($this->CI->config->item('app_use_login') && $this->MODULO != 'home'){
		if ($this->MODULO != 'home'){

			// revisamos si el usuario esta logeado
			if (!$this->CI->dx_auth->is_logged_in() && $this->MODULO == $this->_modulos[0]["name"]){
				// al cargar la pagina muestra el modulo que se haya configurado por default
				redirect(site_url('login'), 'location');
				//return true;
			}else{
				// print_r($this->_modulos[0]["name"]);
				// SI ESTA LOGEADO, REVISAMOS SI TIENE PERMISOS PARA VER EL MODULO
				// $this->USUARIO_PERMISOS = $this->CI->dx_auth->get_role_name();
				// $this->MODULO_PERMISOS = $this->CI->config->item('permisos',$this->MODULO);
				// if (is_array($this->MODULO_PERMISOS) && (array_search($this->USUARIO_PERMISOS, $this->MODULO_PERMISOS)===FALSE) ){
					// AQUI VALIDADMOS LOS PERMISOS PARA LOS MODULOS
					// ESTOS SON TODOS AQUELLOS QUE ESTAN EN LA CARPETA MODULES
					// $this->CI->app_modulo->get_modulos_config($this->MODULO,$this->_modulos);

					// redirect($this->_modulos[0]["name"], 'location');

				// }else if($this->MODULO==='usuarios' && !$this->CI->dx_auth->is_logged_in()){
					// AQUI VALIDADMOS SI SE ESTA TRATANDO DE ENTRAR AL MODULO DE USUARIOS, YA QUE ESTE NO ENTRA
					// EN LA CAPRTEA MODULES, SE VALIDA POR SEPARADO
					// redirect($this->_modulos[0]["name"], 'location');
				// }
				// else{
					// $this->dx_auth->logout();
					// redirect($this->_modulos[0]["name"], 'location');

				// }

			}
		}else{
			redirect($this->_modulos[0]["name"], 'location');
		}
	
	}

	public function init($_data,$title_post="",$decrip_post="",$logo_post="",$price_post=""){
			//obtenemos el nombre del modulo
			$_modulo = get_class($this);
			//cargamos los config de los demas modulos.
			$this->CI->app_modulo->get_modulos_config($_modulo,$this->_modulos);

			//cargamos el layout
			$this->_load_views($_data,$_modulo,$title_post,$decrip_post,$logo_post,$price_post);
	}


	private function _load_views($_data,$_modulo,$title_post="",$decrip_post="",$logo_post="",$price_post=""){

		// post del sidebar
		$itm["domSidebar"]=$this->id_user_and_domain["domain"];

		$itm["socialNetwork"] = $this->menus->get_social();
		if(!$itm["socialNetwork"]["facebook"])
		$itm["socialNetwork"]["facebook"]="SistemaDeluxer";
        

        $id_user_=$this->id_user_and_domain["id"];
		$data_client = $this->menus->getInfo($id_user_);
		if(!$data_client)
		$data_client=$this->CI->config->item("addres");

		if($title_post and $price_post):
		$_data['titulo_app'] =$title_post." $".number_format($price_post,2,".",",");
		elseif($title_post):
		$_data['titulo_app'] =$title_post;
		else:
		$_header['titulo_app'] = ($this->id_user_and_domain["company"] ? $this->id_user_and_domain["company"] :$this->CI->config->item('app_titulo'));
		endif;

		$_header['author_app'] = ($this->id_user_and_domain["domain"] ? $this->id_user_and_domain["domain"] :"Gerardo Del Angel");
		//print_r(strlen($decrip_post));
		if(strlen($decrip_post)==1)
		$decrip_post="-";		

		if($decrip_post):
		$_data['descripcion_app']=$decrip_post;
		else:
		$_header['descripcion_app'] = ($this->id_user_and_domain["description"] ? $this->id_user_and_domain["description"] :$this->CI->config->item('app_descripcion'));
		endif;
		if($logo_post):
		$_header['logo_app']=$logo_post;
		else:
		$_header['logo_app'] = (($this->id_user_and_domain["domain"] and $this->id_user_and_domain["logo"]) ? $this->id_user_and_domain["logo_"] : site_url("application/assets/application/img/icons/logo_mireino5.jpg"));
		endif;

		$_header['logo'] = (($this->id_user_and_domain["domain"] and $this->id_user_and_domain["logo"]) ? $this->id_user_and_domain["logo_"] : site_url("application/assets/application/img/icons/arsalud-icon.png"));

//pr($this->id_user_and_domain);
		$_header['logo_name'] = (($this->id_user_and_domain["company"] and $this->id_user_and_domain["company"]) ? $this->id_user_and_domain["company"] : $this->CI->config->item('app_titulo'));

		$_header['logo_description'] = ( ($this->id_user_and_domain and $this->id_user_and_domain["description"]) ? $this->id_user_and_domain["description"] : $this->CI->config->item('app_descripcion'));
		
		$_header['logo_mobile'] = $this->CI->config->item('app_logo_mobile');
		$_data['favicon'] = site_url("application/assets/application/img/icons/favicon1.ico");
		
		$_data['logo_footer'] = $this->parser->parse('prime_elements/footer_view',$data_client, TRUE);
		
		$itm["logo__"] = $_header['logo'];
		$itm["postSidebar"] = $this->menus->get_sidebar("");
		
		foreach ($itm["postSidebar"] as $key => &$value) {
			$img=explode(",",$value["name"]);
			$value['category']=urls_amigables($value['category']);
			// $value["name"]=$img[0];
			$value["name"]=site_url('application/assets/application/img/post/post_'.$this->id_user_and_domain["id"].'/'.$img[0]);
			// $value["description"]="";
			$value["description"]=strip_tags(html_entity_decode($value["description"]),"<p>");
		}

		//dominio del logotipo
		if($this->CI->dx_auth->is_logged_in())
		$_header['domain'] = $this->mod;
		else
		$_header['domain'] = $this->mod;

		$_header['opciones'] = $this->CI->app_menus->get_menu($this->_modulos,"",true,$this->mod);
		// $_header['opciones'] = $this->CI->app_menus->get_menu($this->_modulos,"",true,$this->id_user_and_domain["domain"]);
		if(!$this->CI->dx_auth->is_logged_in())
		$_header['log'] = $this->parser->parse('login/log_in',array(), TRUE);
		else
		$_header['log'] = $this->parser->parse('login/logout',array(), TRUE);
		// $_header['log'] = '';

		//creamos los menus de la aplicacion
		// $_header['menu_usuario'] = $this->CI->app_menus->get_user_menu();
		if (!$this->CI->dx_auth->is_logged_in() and !$this->mod){
			$_header['newuser'] = $this->parser->parse('usuarios/us/newuserclient',array(), TRUE);
			$_header['registration'] = $this->parser->parse('usuarios/us/nuevo_cliente',array(), TRUE);
		}else{
			$_header['newuser'] = $this->parser->parse('usuarios/us/nuevo_usuario',array(), TRUE);
			$_header['registration'] = $this->parser->parse('usuarios/us/newuser',array(), TRUE);
			
		}
		$_error ='';
		$_log['action'] = site_url('login/in');
		$_log['error'] = $_error;
		$_header['login'] = $this->parser->parse('login/login',$_log, TRUE);
		$_header['social'] = $this->parser->parse('prime_elements/social',array(),TRUE);
		// $_header['menu_admin'] = $this->CI->app_menus->get_admin_menu();
		$_data['header'] = $this->parser->parse('prime_elements/header-modulos', $_header, TRUE);
		//creamos el sidebar:
		$_data['sidebar'] = $this->parser->parse('prime_elements/sidebar-modulos',$itm, TRUE);


		//datos del modulo actual
		$_data['modulo_nombre'] = ($this->CI->config->item('nombre',$_modulo))?$this->CI->config->item('nombre',$_modulo):ucfirst($_modulo);
		$_data['modulo_controlador'] = $_modulo;
	
		//creamos el objeto global de configuracion de la app
		$_obj_global_app = array(
			"base_url"	=>	base_url(),
			"site_url"	=>	site_url("/"),
			"api_url"	=>	"",
			"domain"	=>	$this->mod,
			"_current"	=>	$this->id_user_and_domain,

			"modulo"	=> array(
					"nombre" 	=> $_modulo,
					"uri"		=> $this->CI->uri->rsegment_array()
			)
		);
		$_data['js_obj_global'] = json_encode($_obj_global_app);


		//creamos las librerias basicas de la aplicación
		$_data['js_app'] = $this->CI->app_js->get_app();
		//creamos las librerias de notificacion
		$_data['js_notificaciones'] = $this->CI->app_js->get_notificaciones();
		//creamos el js del tema avant
		$_data['js_avant'] = $this->CI->app_js->get_avant();
		//creamos el js principal de toda la app
		$_data['js_principal'] = $this->CI->app_js->get_principal();

		//creamos el css de este modulo
		$_data['css_modulo'] = $this->CI->app_css->get_modulo($_modulo);
		//creamos los js propios del modulo		
		$_data['js_modulo'] = $this->CI->app_js->get_modulo($_modulo,$_obj_global_app);
		//creamos los js externas	
		$_data['js_externas'] = $this->CI->app_js->get_externas();

		//verificamos si la pass es caduca, para poder lanzar visualmente la ventana de reseteo de pass
		// if ($this->PASS_CADUCA){
		// 	$_pass_caduca_data['dias'] = $this->CI->config->item('app_pass_caduca');
		// 	$_pass_caduca_data['accion'] = site_url('/usuarios/api/usuario/reset_password');
		// 	$_data['pass_caduca'] = $this->CI->parser->parse('prime_elements/pass_caduca',$_pass_caduca_data, TRUE);
		// }else{
		// 	$_data['pass_caduca'] = '';
		// }
		$this->load->view('prime/head',$_data);
		$this->load->view('prime/header');
		$this->load->view('prime/content');
		$this->load->view('prime/footer');
	}


}
