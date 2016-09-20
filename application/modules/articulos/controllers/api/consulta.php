<?php defined('BASEPATH') OR exit('No direct script access allowed');

class consulta extends REST_Controller
{

    public function __construct(){
         parent::__construct();
        if(!$this->input->is_ajax_request()){
            show_404("",true);
        }
        $this->id_user = $this->dx_auth->getUserDomain();
        $this->_domain = $this->dx_auth->get_domain();
          $__url = array_slice($this->uri->segments,0,5);
        list($this->_domain1, $this->category,$this->method_,$this->id_post,$this->title) = array_pad($__url, 5, NULL);
        if(!$this->_domain){
          $this->_domain=$this->_domain1;
        }        
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('marticulos');
    }

    public function proyectos_get(){
      $data=$this->get();
      $resultado=$this->marticulos->getmypost("",$this->id_user["id"],$data["order_by"],$data["search"]);
      if($resultado){
        $resultado = $this->response($resultado);
      }else{
        $resultado = format_response(null,'error','No se encontraron datos.',true);
      }
      $this->response($resultado);
    }
    public function pay_purchase_post(){
        $this->marticulos->pay_purchase($this->id_user["id"]);
                
        $resultado = format_response(null,'alert','<span class="fa fa-check-circle fa-5x"></span>',true);
        $this->response($resultado);
    }
    public function editar_get(){
          $id_user = $this->dx_auth->get_user_id();
          $art = $this->articles(decode_url($this->id_post),$id_user);
      $this->response($this->id_post);

      if(!$art):
      $vistas['editPost'] = $this->parser->parse('error',array(),TRUE);
      else:
        $art["id_img"]=str_replace(" ","",encode_url($art["id_img"]));
          $art["name"]=str_replace(" ","",$art["name"]);
        $art["img"]=array_combine(explode(",",$art["id_img"]),explode(",",$art["name"]));
        $art["ide"]=$this->id_post;
        $art["url"]=site_url('application/assets/application/img/post/post_'.$this->id_user["id"]);
          $art["domain"] = $this->_domain;
        $art["catList"] = $this->categories("","");
        // if($art["type"]==1) //post de noticias
        // $vistas['editPost'] = $this->parser->parse('editPost',$art ,TRUE);
        // elseif($art["type"]==2) //post de articulos de venta
        // $vistas['editPost'] = $this->parser->parse('editItem',$art ,TRUE);
      endif;


      // $resultado = format_response($art,'success','Exito',true);

      // $_data['contenido'] = $this->parser->parse('ini',$vistas, TRUE);
      // $this->init($_data);
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
    public function categorias(){
        $cat["catList"] = $this->categories("","");
            $cat["domain"] = $this->_domain;
            $cat["cat_imgs"] = site_url('application/modules/articulos/img/1.8.png');

        $vistas['categories'] = $this->parser->parse('category/category',$cat,TRUE);
        $_data['contenido'] = $this->parser->parse('ini',$vistas, TRUE);
        $this->init($_data);
        
    }
    
}