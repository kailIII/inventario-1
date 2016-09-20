<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class articulos extends APP_Controller {

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

        //$art["art_"] = $this->articles_("","");

		//foreach ($art["art_"] as $key => &$value) {
		//	$img=explode(",",$value["name"]);
			//$value["category"]=urls_amigables($value["category"]);
		//	$value["name"]=site_url('application/assets/application/img/post/post_'.$this->id_user["id"].'/'.$img[0]);
		//	$value["description"]=strip_tags(html_entity_decode($value["description"]),"<p>");
		//}
        //$art["category_"] = $this->categories("","");
        $art["domain"] = $this->_domain;
		$vistas['galery'] = $this->parser->parse('galery',$art,TRUE);
		$_data['contenido'] = $this->parser->parse('ini',$vistas, TRUE);
		$this->init($_data);
	}
	public function delete(){
        $res=$this->marticulos->checkMyPost(decode_url($this->id_post));
        if(!$res){
			redirect(site_url(), 'location');
        }else{
	        $this->marticulos->delete_post(decode_url($this->id_post));
			redirect(site_url(), 'location');
        }
	}
	public function editar(){
       	$id_user = $this->dx_auth->get_user_id();
        $art = $this->articles(decode_url($this->id_post),$id_user);
        if(!$art):
		$vistas['editPost'] = $this->parser->parse('error',array(),TRUE);
		else:
		    
			$art["id_img"]=str_replace(" ","",$art["id_img"]);
		    $art["name"]=str_replace(" ","",$art["name"]);
			$art["id_img"]=explode(",",$art["id_img"]);
        	foreach ($art["id_img"] as $k1 => &$v1) {
        		$v1=encode_url($v1);
        	}
		    $art_1["name"]=explode(",",$art["name"]);
			// $art["description"]=htmlentities($art["description"]);
			$art["description"]=html_entity_decode($art["description"]);
			$art["img"]=($art["name"] ? array_combine($art["id_img"],$art_1["name"]) : array());
			$art["ide"]=$this->id_post;
			$art["url"]=site_url('application/assets/application/img/post/post_'.$this->id_user["id"]);
		    $art["domain"] = $this->_domain;
			$art["catList"] = $this->categories("","");

			if($art["type"]==1) //post de noticias
			$vistas['editPost'] = $this->parser->parse('editPost',$art ,TRUE);
			elseif($art["type"]==2) //post de articulos de venta
			$vistas['editPost'] = $this->parser->parse('editItem',$art ,TRUE);
		endif;
		$_data['contenido'] = $this->parser->parse('ini',$vistas, TRUE);
		$this->init($_data);
	}
	public function articles_(){
        $_datos=$this->marticulos->getmypost("",$this->id_user["id"]);
		return $_datos;
	}
	public function articles($id,$id_user){
        $_datos=$this->marticulos->getmypost($id,$id_user);
        if($_datos):
			if($id==$_datos[0]["id"])
			return $_datos[0];
			else
			return false;
		else:
			return $_datos;
		endif;
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
	public function carrito(){
     	
        if($this->dx_auth->is_logged_in()):
        $art["art_"]=$this->marticulos->getmypost_addcar($this->dx_auth->get_user_id());
    	else:
        $art["art_"]=array();
    	endif;
        $total_pay=0;
		foreach ($art["art_"] as $key => &$value) {
			$img=explode(",",$value["name"]);
			$value["category"]=urls_amigables($value["category"]);
			$value["name"]=site_url('application/assets/application/img/post/post_'.$value["id_owner"].'/'.$img[0]);
			$value["description"]=strip_tags(html_entity_decode($value["description"]),"<p>");
			$value["total"]=($value["price"]*$value["quantity"]);
			$total_pay+=$value["total"];
		}

        $art["total_pay"]=$total_pay;
        $art["company"]=$this->id_user["company"];

		$vistas['addcar'] = $this->parser->parse('addcar',$art,TRUE);
		$_data['contenido'] = $this->parser->parse('ini',$vistas, TRUE);
		$this->init($_data);
	} 
}
