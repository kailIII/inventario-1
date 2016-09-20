<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class inicio extends APP_Controller {

	private $id_user;
	private $method;
	private $id_post;
	private $title;
	private $some;

	public function __construct(){
		
		parent::__construct();
        $this->load->model('minicio');
        $this->load->library('pagination');
		$this->load->model('dx_auth/menus');
        $this->load->library('form_validation');
        // $this->load->helper("url_helper");
		$this->id_user = $this->dx_auth->getUserDomain();

       	$this->module = $this->uri->segments;
		if($this->module){
			if(count($this->uri->segments)<=4)
			list($this->module, $this->category,$this->id_post,$this->title) = array_pad($this->module, 5, NULL);
			else
			show_404("",true);
		}else{
			$this->module = $this->dx_auth->get_domain();
		}

	}
	public function index(){
		$vistas['paso1'] = $this->parser->parse('product/parte1',array(),TRUE);
		$vistas['paso2'] = $this->parser->parse('product/parte2',array(),TRUE);
		$_articles['articles'] = $this->parser->parse('articles',$vistas,TRUE);
		$_data['contenido'] = $this->parser->parse('ini',$_articles, TRUE);
		$this->init($_data);
	}
	public function mipost(){
		$id = $this->id_post;
		$check = encode_url($id.$this->category.$this->title);
	    $art["art"] = $this->articles($id,$check);
		$logo_post="";
		$title_post="";
		$decrip_post="";
		$price_post="";
		if(!empty($art["art"])){
	        foreach ($art["art"] as $k => &$v) {
			    
				if($v["name"]):
			    $img=str_replace(" ","",$v["name"]);
	        	$v["name"]=explode(",",$img);
	        	foreach ($v["name"] as $k1 => &$v1) {
	        		$v1=site_url('application/assets/application/img/post/post_'.$this->id_user["id"].'/'.$v1);
	        	}

	        	unset($v1);
	        	$logo_post=$v["name"][0];
	        	else:
	        	$logo_post="";
				endif;
	        	$v["id"] = encode_url($v["id"]);
				$v["description"]=htmlspecialchars_decode($v["description"]);
	        	$title_post=$v["title"];
	        	$price_post=$v["price"];
            	$decrip_post=(strlen(strip_tags($v["description"]))>250 ? substr(strip_tags($v["description"]),0,250) : strip_tags($v["description"]));
				//$decrip_post=htmlspecialchars($v["description"]);
				//$decrip_post=strip_tags($decrip_post);
				//$decrip_post=htmlentities($decrip_post);
	        	if($v["id_user"]==$this->dx_auth->get_user_id())
	        	$v["showIconEdit"]=true;
	        	else
	        	$v["showIconEdit"]=false;
	        }
	        unset($v);
	        $art["_url_"] = site_url().$this->module."/".$this->category."/".encode_url($this->id_post)."/".$this->title;
	        $art["_url_f"] = site_url().$this->module."/".$this->category."/".$this->id_post."/".$this->title;

	        $art["domain"] = $this->module;
	        $art["title"] = $this->title;
	        $art["id_post"] = encode_url($this->id_post);
	        // $art["comments"] = $this->comments($this->id_post);
	        $art["log_open"] = $this->dx_auth->is_logged_in();

			$vistas['post'] = $this->parser->parse('post',$art,TRUE);
		}else{
			$vistas['post'] = $this->parser->parse('error',array(),TRUE);
		}
		$_data['contenido'] = $this->parser->parse('ini',$vistas, TRUE);

		$this->init($_data,$title_post,$decrip_post,$logo_post,$price_post);
	}	
	public function misarticulos(){
		$id = $this->input->get('id');
        $art["art"] = $this->artSidebar($id);
		$vistas['sidebar'] = $this->parser->parse('sidebar',$art,TRUE);
		$_data['contenido'] = $this->parser->parse('ini',$vistas, TRUE);
		$this->init($_data);
	}
	// public function comments($id_post){
	// 	$_datos = $this->minicio->getComments($id_post);
	// 	return $_datos;
	// }			
	public function articles($id,$check=""){
        $_datos=$this->minicio->getmypost($id,$this->id_user["id"]);

        if($check and $_datos):
			$check2 = $_datos[0]["id"].urls_amigables($_datos[0]["category"]).urls_amigables($_datos[0]["title"]);
			if(decode_url($check)==$check2)
			return $_datos;
			else
			return false;
		else:
			return $_datos;
		endif;
	}
	public function artSidebar($id){
		$id = $this->input->get('id');
        $_datos=$this->minicio->getsidebar($id,$this->id_user["id"]);
		return $_datos;
	}	
	public function domain(){

		if($_user){
			$_user = $_user["id"];
		}else{
			show_404("",true);
			// $_user = false;
		}

		return $_user;
	}
  
}