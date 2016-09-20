<?php defined('BASEPATH') OR exit('No direct script access allowed');

class datos extends REST_Controller
{

    public function __construct(){

         parent::__construct();
        
        if(!$this->input->is_ajax_request()){
            show_404("",true);
        }
        
        //$this->id_user = $this->dx_auth->getUserDomain();
        $this->load->model('minicio');
        // $this->id_user = 10;
        // pr(count($this->uri->segments));
        // $this->module = $this->uri->rsegment_array();
        // $this->module = $this->uri->segments;
        // if($this->module){
        //     if(count($this->uri->segments)<=4)
        //     list($this->module, $this->category,$this->id_post,$this->title) = array_pad($this->module, 5, NULL);
        //     else
        //     show_404("",true);
        // }else{
        //     $this->module = $this->dx_auth->get_domain();
        // }        

    }


    public function articles_get(){
        // se obtiene via ajax el dominio y el id del usuario buscado por URL
        if($this->dx_auth->is_logged_in())
        $__uri = $this->get("m_uri");
        else
        $__uri=array("id"=>0);

        // $art["domain"] = $__uri["domain"];
        $art["art"] = $this->articles("","",$__uri["id"]);

        foreach ($art["art"] as $key => &$value) {
            $img=explode(",",$value["name"]);
            $value["name"]=site_url('application/assets/application/img/post/post_'.$__uri["id"].'/'.$img[0]);
            $value["description"]=strip_tags(html_entity_decode($value["description"]),"<p>");
            $value["description"]=substr(strip_tags(html_entity_decode($value["description"])),0,150).(strlen(html_entity_decode($value["description"]))>150?"....":"");
            //$value["video"]=($value["video"] ? html_entity_decode($value["video"]) : "");
          //  $value["url_title"]=site_url($__uri["domain"]."/".urls_amigables($value['category'])."/$value[id]/".urls_amigables($value['title']));
            //$value["url_cat"]=site_url($__uri["domain"]."/".urls_amigables($value['category']));
        
        }

        if(count($art["art"])==0)
        $art="";
    
        $_res = format_response($art,'success','ok',false);
        $this->response($_res,200);        

    }
    public function articles($id="",$check="",$id_user=""){
        $_datos=$this->minicio->getmypost($id,$id_user);

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
    public function addcar_post(){
  
        $id=$this->input->post("_c");
        $__uri = $this->post("m_uri");
        $art["art"] = $this->articles($id,"",$__uri["id"]);

        if(!empty($art["art"])){
            foreach ($art["art"] as $k => &$v) {
                $img=str_replace(" ","",$v["name"]);
                $v["name"]=explode(",",$img);
                $v["id"] = encode_url($v["id"]);
                $v["name"]=site_url('application/assets/application/img/post/post_'.$__uri["id"].'/'.$v["name"][0]);
                unset($v1);
                if($v["id_user"]==$this->dx_auth->get_user_id())
                $v["showIconEdit"]=true;
                else
                $v["showIconEdit"]=false;
            }
            unset($v);

            if($this->dx_auth->is_logged_in()):
            $vistas = $this->parser->parse('addcar',$art,TRUE);
            $_res = format_response($vistas,'success','Todo bien',false);
            else:
            $vistas = $this->parser->parse('error',$art,TRUE);
            $_res = format_response($vistas,'error','Debe de estar logueando',true);
            endif;
        }else{
            $vistas = $this->parser->parse('error',array(),TRUE);
            $_res = format_response(null,'error','No se encontraron datos.',true);
        }
        if($this->dx_auth->is_logged_in()):
            $checkcar=$this->minicio->checkCar($id,$this->dx_auth->get_user_id());
            
            if(!$checkcar):
            $this->minicio->addCar($id,$this->dx_auth->get_user_id(),$__uri["id"]);
            else:
            $this->minicio->updateCar($id,$this->dx_auth->get_user_id());
            endif;
        endif;
        $this->response($_res,200);

    }
    public function comments_post(){
        $_data = $this->post();
        if(!$_data["_cm"]){
            $_res = format_response(FALSE,'error','Comentario vacio',true);
            $this->response($_res,200);
        }
        $res=$this->minicio->checkMyPost(decode_url($_data["_p_ref"]));
        if(!$res){
            $_res = format_response(FALSE,'error','Error al comentar.',true);
            $this->response($_res,200);
        }
        $_data["_p_ref"] = $res->id;
        $_data["id_user"] = $this->dx_auth->get_user_id();
        
        $res=array();
        if(isset($_data["_com_r_ref"])){
            $_data["_com_r_ref"]=decode_url($_data["_com_r_ref"]);
            $res["id"]=$this->minicio->saveCommentResponse($_data);
            $res["_com_r_ref"]=1;
        }else{
            $res["id"]=$this->minicio->saveComment($_data);
        }
        // Mostrar el comentario cundo se guarde ya se de comments o comments_response
        if(!$res)
        $_res = format_response(FALSE,'error','No se pudo insertar el comentario.',true);
        else
        $_res = format_response($res,'success','ok',false);

        $this->response($_res,200);
    }
    public function comments_get(){
        $_data = $this->get();
        $_datos = $this->minicio->getComments(decode_url($_data["_p_ref"]),"");

        $this->response($_datos,200);
    }  
    public function conca_post(){
        $_data = $this->post();
        if(isset($_data["_com_r_ref"]))
        $_datos = $this->minicio->getCommentsResponse("",$_data["id"]);
        else
        $_datos = $this->minicio->getComments("",$_data["id"]);

        $this->response($_datos[0],200);
    }
   public function item_post(){
        $_datos = $this->post();
        
        $_datos["id_user"] = $this->dx_auth->get_user_id();
        
        //if(isset($_datos["price"]))
        $_datos["type"] = 2;
        //else
        //$_datos["type"] = 1;

        $_result = $this->minicio->updatItem($_datos);
        
        if($_result){
            $_res = format_response($_result, 'success','Articulo actualizado');
        }else{
            $_res = format_response(FALSE, 'error','Operación Fallida',TRUE);
        }
        $this->response($_res,200);

    }
    
}