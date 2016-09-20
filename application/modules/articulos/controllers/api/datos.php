<?php defined('BASEPATH') OR exit('No direct script access allowed');

class datos extends REST_Controller
{

    public function __construct(){
         parent::__construct();
        if(!$this->input->is_ajax_request()){
            show_404("",true);
        }
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('marticulos');
        $this->load->model('mcatalogos');
    }

    public function index_post(){
        $_datos = $this->post();
        $_datos["id_user"] = $this->dx_auth->get_user_id();
        $_result = $this->mcatalogos->savemypost($_datos);
        
        if($_result){
            $_res = format_response($_result, 'success','Articulo agregado');
        }else{
            $_res = format_response(FALSE, 'error','Operación Fallida.',TRUE);
        }

        $this->response($_res,200);


    }
    public function category_post(){
        $_datos = $this->post();
        $_datos["id_user"] = $this->dx_auth->get_user_id();
        $_result = $this->mcatalogos->saveCategory($_datos);
        
        if($_result){
            $_res = format_response($_result, 'success','Categoria agregada');
        }else{
            $_res = format_response(FALSE, 'error','Operación Fallida.',TRUE);
        }

        $this->response($_res,200);        
    }
    public function family_post(){
        $_datos = $this->post();
        $_datos["id_user"] = $this->dx_auth->get_user_id();
        $_result = $this->mcatalogos->saveFamily($_datos);
        
        if($_result){
            $_res = format_response($_result, 'success','Familia agregada');
        }else{
            $_res = format_response(FALSE, 'error','Operación Fallida.',TRUE);
        }

        $this->response($_res,200);        
    }
    public function departament_post(){
        $_datos = $this->post();
        $_datos["id_user"] = $this->dx_auth->get_user_id();
        $_result = $this->mcatalogos->saveDepartament($_datos);
        
        if($_result){
            $_res = format_response($_result, 'success','Departamento agregada');
        }else{
            $_res = format_response(FALSE, 'error','Operación Fallida.',TRUE);
        }

        $this->response($_res,200);        
    }
    public function ubication_post(){
        $_datos = $this->post();
        $_datos["id_user"] = $this->dx_auth->get_user_id();
        $_result = $this->mcatalogos->saveUbication($_datos);
        
        if($_result){
            $_res = format_response($_result, 'success','Ubicacion agregada');
        }else{
            $_res = format_response(FALSE, 'error','Operación Fallida.',TRUE);
        }

        $this->response($_res,200);        
    }     
    public function edit_post(){
        $_datos = $this->post();
        $_datos["id_user"] = $this->dx_auth->get_user_id();

        if(!isset($_datos["id_imgpost"]) and !$_datos["video"]){
            $_res = format_response(FALSE, 'error','Es necesario agregar una imagen ó inserte un video embed iframe',TRUE);
            $this->response($_res,200);
            
        }
        
        if(isset($_datos["video"])){
            $iframe = substring_between($_datos["video"],'<iframe','</iframe>');
            if(!$iframe and $_datos["video"]){
                $_res = format_response(FALSE, 'error','Formato de video invalido',TRUE);
                $this->response($_res,200);
            }
        }

        $res = $this->marticulos->checkMyPost(decode_url($_datos["_w"]));
       if(!$res){
            $_res = format_response(FALSE,'error','Error al comentar.',true);
            $this->response($_res,200);
        }
            
        $_result = $this->marticulos->updatePost($_datos);

        if($_result){
            $_res = format_response($_result, 'success','Post editado');
        }else{
            $_res = format_response(false, 'error','Operación Fallida.',TRUE);
        }

        $this->response($_res,200);
    }    
    public function delete_post(){

    // $file_id = $this->post("file_id");
    $file_id=$this->security->xss_clean($_POST["file_id"]);
    if ($this->marticulos->delete_file(decode_url($file_id)))
    $return = format_response(FALSE, 'success','imagen eliminada.',TRUE);
    else
    $return = format_response(FALSE, 'error','No se pudo borrar la imagen',TRUE);

       echo json_encode($return);
    }
    public function UploadFile_post(){
        
        $return =array('status' => 1, 'msg' => '',"data"=>false);

        $file_element_name = "file";

        if ($return["status"] != 0){

                $config['upload_path'] = FCPATH.'application/modules/postear/img/upload/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']  = 0;
                // $config['max_size']  = 1024 * 8;
                $config['encrypt_name'] = TRUE;
                
                $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name))

                $return =array('status' => 0, 'msg' => $this->upload->display_errors('', ''),"data"=>$config['upload_path']);
            else{
                    
                    // informacion de la imagen subida 
                    $data = $this->upload->data();

                    // tratamiento de imagen
                    $this->load->library('image_lib');
                    $config_img = array();
             
                    $config_img['image_library'] = 'gd2';
                    $config_img['source_image'] = FCPATH.'application/modules/postear/img/upload/'.$data['file_name'];
                    $config_img['create_thumb'] = FALSE;
                    $config_img['maintain_ratio'] = FALSE;

                    $img_size  = getimagesize($config_img['source_image']);
                    $img_width_new = null;
                    $img_height_new = null;
                    $img_w  = $img_size[0];
                    $img_h  = $img_size[1];

                     if($img_h>=2048 || $img_w>=2048){
                     
                        $w_limite=2048;
                        $h_limite=2048;

                        if($img_w>$img_h){
                            $img_width_new = $w_limite;
                            $img_height_new = $w_limite*$img_h/$img_w;
                        }else{
                            $img_height_new = $h_limite;
                            $img_width_new = $w_limite*$img_w/$img_h;                       
                        } 
                        
                     }else{
                     
                        $img_width_new = $img_w;
                        $img_height_new = $img_h;
                     }
      
                    $config_img['width'] = $img_width_new;
                    $config_img['height'] = $img_height_new;

                    $this->image_lib->initialize($config_img);
                    $this->image_lib->watermark();
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    //... 

                    $file_id = $this->marticulos->insert_img($data['file_name']);
                    
                    if($file_id)
                    $return =array('status' => 1, 'msg' =>'Imgane subida exitosamente',"data"=>false,"name"=>"application/modules/postear/img/upload/".$data['file_name'],"file_id"=>encode_url($file_id));
                    else{ unlink($data['full_path']); $return =array('status' => 0, 'msg' =>'Algo paso y no se pudo subir la imagen,porfavor trata nuevamente.',"data"=>false);}
            }

                @unlink($_FILES[$file_element_name]);

        }
            echo json_encode($return);
             return;        
    }

    
}