<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class catalogos extends APP_Controller {

	public function __construct(){
		parent::__construct();
        
        $this->load->helper("url_helper");
        $this->load->helper('security');        
		$this->load->model('dx_auth/menus');
        $this->load->model('marticulos');
        $this->load->model('mcatalogos');
       
		$this->id_user = $this->dx_auth->getUserDomain();
		$this->_domain = $this->dx_auth->get_domain();
   		$__url = array_slice($this->uri->segments,0,5);
		list($this->_domain1, $this->category,$this->method_,$this->id_post,$this->title) = array_pad($__url, 5, NULL);
		if(!$this->_domain){
			$this->_domain=$this->_domain1;
		}
	}

	public function index(){

		$vistas['galery'] = $this->parser->parse('galery',array(),TRUE);
		$_data['contenido'] = $this->parser->parse('ini',$vistas, TRUE);
		$this->init($_data);
	}	
	public function categorias(){
			$cat["catList"] = $this->categories("","");
        	$cat["domain"] = $this->_domain;
        	$cat["cat_imgs"] = site_url('application/modules/articulos/img/1.8.png');
        	
        	if($this->CI->dx_auth->get_role_id()!=3 and $this->CI->dx_auth->is_logged_in())
			$cat['categoryAdd'] = $this->parser->parse('category/categoryAdd',array(),TRUE);

			$vistas['categories'] = $this->parser->parse('category/category',$cat,TRUE);
			$_data['contenido'] = $this->parser->parse('ini',$vistas, TRUE);
			$this->init($_data);
			
	}
	public function categories($check,$category){
		$_datos = $this->mcatalogos->getCategory($this->id_user["id"],urls_amigables_disabled($category));
        
        if($check and $_datos):
			$check2 = $this->_domain.urls_amigables($_datos[0]["name"]);
			if(decode_url($check)==$check2)
			return $_datos[0]["id"];
			else
			return false;
		else:
			return $_datos;
		endif;		
	}	
	public function getItemsCategory($check,$id_category){
		$_datos = $this->mcatalogos->getItemsCategory($this->id_user["id"],$id_category);
       
       if($check and $_datos):
			$check2 = $this->_domain.urls_amigables($_datos[0]["category"]);
			if(decode_url($check)==$check2)
			return $_datos;
			else
			return false;
		else:
			return $_datos;
		endif;

	}
	public function familia(){
			$family["familyList"] = $this->families("","");
        	$family["domain"] = $this->_domain;
        	
        	if($this->CI->dx_auth->get_role_id()!=3 and $this->CI->dx_auth->is_logged_in())
			$family['categoryAdd'] = $this->parser->parse('category/categoryAdd',array(),TRUE);

			$vistas['family'] = $this->parser->parse('category/family',$family,TRUE);
			$_data['contenido'] = $this->parser->parse('ini',$vistas, TRUE);
			$this->init($_data);
			
	}
	public function families($check,$family){
		$_datos = $this->mcatalogos->getFamily($this->id_user["id"],urls_amigables_disabled($family));
        
        if($check and $_datos):
			$check2 = $this->_domain.urls_amigables($_datos[0]["name"]);
			if(decode_url($check)==$check2)
			return $_datos[0]["id"];
			else
			return false;
		else:
			return $_datos;
		endif;		
	}
	public function departamentos(){
			$family["departamentList"] = $this->departaments("","");
        	$family["domain"] = $this->_domain;

			$vistas['departament'] = $this->parser->parse('category/departament',$family,TRUE);
			$_data['contenido'] = $this->parser->parse('ini',$vistas, TRUE);
			$this->init($_data);
			
	}	
	public function departaments($check,$family){
		$_datos = $this->mcatalogos->getDepartament($this->id_user["id"],urls_amigables_disabled($family));
        
        if($check and $_datos):
			$check2 = $this->_domain.urls_amigables($_datos[0]["name"]);
			if(decode_url($check)==$check2)
			return $_datos[0]["id"];
			else
			return false;
		else:
			return $_datos;
		endif;		
	}
	public function ubicacion(){
			$ubication["ubicationList"] = $this->ubication("","");
        	$ubication["domain"] = $this->_domain;

			$vistas['ubication'] = $this->parser->parse('category/ubication',$ubication,TRUE);
			$_data['contenido'] = $this->parser->parse('ini',$vistas, TRUE);
			$this->init($_data);
			
	}		
	public function ubication($check,$family){
		$_datos = $this->mcatalogos->getUbication($this->id_user["id"],urls_amigables_disabled($family));
        
        if($check and $_datos):
			$check2 = $this->_domain.urls_amigables($_datos[0]["name"]);
			if(decode_url($check)==$check2)
			return $_datos[0]["id"];
			else
			return false;
		else:
			return $_datos;
		endif;		
	}
	public function marcas(){
			$brand["brandList"] = $this->brands("","");
        	$brand["domain"] = $this->_domain;

			$vistas['brand'] = $this->parser->parse('category/brand',$brand,TRUE);
			$_data['contenido'] = $this->parser->parse('ini',$vistas, TRUE);
			$this->init($_data);
			
	}		
	public function brands($check,$brand){
		$_datos = $this->mcatalogos->getBrand($this->id_user["id"],urls_amigables_disabled($brand));
        
        if($check and $_datos):
			$check2 = $this->_domain.urls_amigables($_datos[0]["name"]);
			if(decode_url($check)==$check2)
			return $_datos[0]["id"];
			else
			return false;
		else:
			return $_datos;
		endif;		
	}	
}
