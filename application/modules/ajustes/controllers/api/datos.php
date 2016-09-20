<?php defined('BASEPATH') OR exit('No direct script access allowed');

class datos extends REST_Controller
{

    public function __construct(){
         parent::__construct();
//        if(!$this->input->is_ajax_request()){
  //          show_404("",true);
    //    }
        $this->load->model('majustes');
        $this->load->model('dx_auth/menus');
        $this->id_user = $this->dx_auth->getUserDomain();
    }

    public function index_post(){

    }
    public function infoClient_get(){
        $_result = $this->majustes->getInfo($this->id_user);

        if($_result){
            $_res = format_response($_result, 'success','Datos cargados');
        }else{
            $_res = format_response(FALSE, 'error','Operación Fallida.',TRUE);
        }

        $this->response($_res,200);        
    }
    public function infoClient_post(){
        $_datos = $this->input->post();
        $id_user = $this->dx_auth->get_user_id();
        $_result = $this->majustes->updateInfo($_datos,$id_user);
        
        if($this->dx_auth->is_logged_in()){
            if($_result){
                $_res = format_response($_result, 'success','Datos actualizados correctamente');
            }else{
                $_res = format_response(FALSE, 'error','Operación Fallida.',TRUE);
            }
        }else{
            $_res = format_response(FALSE,'error','Se requiere de un usuario logeado.',TRUE);
        }
        $this->response($_res,200);        
    }
    public function UploadFile_post(){

        $return =array('status' => 1, 'msg' => 'subida de archivos',"data"=>"mi casa");

        // jQueryFileUpload
        $file_element_name = "file";

        if ($return["status"] != 0){

                $ruta=FCPATH."application/assets/application/img/logo/logo_".$this->id_user["id"]."/";
                $config['upload_path'] = $ruta;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']  = 0;
                // $config['max_size']  = 1024 * 8;
                $config['encrypt_name'] = TRUE;
                
                $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name)){
                $return =array('status' => 0, 'msg' => $this->upload->display_errors('', ''),"data"=>$config['upload_path']);
            }else{
                    
                    // informacion de la imagen subida 
                    $data = $this->upload->data();

                    // tratamiento de imagen
                    $this->load->library('image_lib');
                    $config_img = array();
             
                    $config_img['image_library'] = 'gd2';
                    $config_img['source_image'] =site_url('application/assets/application/img/logo/logo_'.$this->id_user["id"].'/'.$data['file_name']);
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
                    $file_id = $this->majustes->insert_img($data['file_name']);
                    
                    if($file_id){
                        $return =array('status' => 1, 'msg' =>'Imgane subida exitosamente',"data"=>false,"name"=>"application/assets/application/img/avatares/avatar_".$this->id_user["id"].'/perfil/'.$data['file_name'],"file_id"=>$file_id,'imagen'=>$data['file_name']);
                    }else{ 
                        unlink($data['full_path']); 
                        $return =array('status' => 0, 'msg' =>'Algo paso y no se pudo subir la imagen,porfavor trata nuevamente.',"data"=>false);
                    }
            }

            @unlink($_FILES[$file_element_name]);

        }
        $this->response($return, 200);
    }    
    public function logo_get()
    {
        $id_user = $this->dx_auth->get_user_id();
        $_logos = $this->majustes->get_img_logo($id_user);
        if(count($_logos)>0){
            foreach($_logos as $_a){
                // if(!avatar($_a["name"]))
                // continue;
            // $file = rtrim($file, '/').'/'.md5(mt_rand(1,100).mt_rand(1,100));
            // '_Pimg' => sha1(md5($_a['_Pimg']."ax>po+ret_13<56_2000>hoho$")."ax>po+ret_13<56_2000>hoho$"),

            
                $_data[] = array(
                    '_Pimg' => encode_url($_a['_Pimg']),
                    'logo' => $_a["name"],
                    'avatar' => logo($_a["name"]),
                );
            }
            $_res = format_response($_data);
        }else{
            $_res = format_response(FALSE,'error','Avatares no encontrados.',TRUE);
        }
        $this->response($_res,200);
    }        
    public function logo_post()
    {
        $id_user = $this->dx_auth->get_user_id();
        $_data = $this->input->post();
        $_res = $this->majustes->update_avatar($_data,$id_user);
        if($_res){
            $_res = format_response($_res, 'success','Avatar cambiado.');
        }else{
            $_res = format_response(FALSE,'error','Operación fallida.',TRUE);           
        }
        $this->response($_res,200);
    }
    public function delete_post(){

        $_ref=$this->security->xss_clean($_POST["_ref"]);
        $_ref=decode_url($_ref);
        if ($this->majustes->delete_file($_ref))
        $return = format_response(FALSE,'success','imagen eliminada',TRUE);
        else
        $return = format_response(FALSE,'error','No se pudo borrar la imagen',TRUE);

        $this->response($return, 200);
    }
    public function folio_post(){
        $_datos = $this->post();
       $_datos["id_user"] = $this->dx_auth->get_user_id();

        $_res = $this->majustes->saveFolio($_datos);
        if($_res){
            $_res = format_response(TRUE, 'success','Folio insertado.');
        }else{
            $_res = format_response(FALSE,'error','Operación fallida.',TRUE);           
        }        
        $this->response($_res,200);
    }
    public function folio_get(){
        $_res=$this->majustes->getFolio($this->id_user);
        
        if($_res){
            $_res = format_response($_res, 'success','Folio encontrados.');
        }else{
            $_res = format_response(FALSE,'error','No se encontro consecutivo de folios.',TRUE);           
        }        
        $this->response($_res,200);        

    }

    public function folio_delete(){
        $data = $this->delete();

        $_res = format_response($data, 'success','Folio desactivado.');

        $this->response($_res,200);        
    }
    public function sucursal_get(){
        $_res=$this->majustes->getSubsidiary($this->id_user);
        
        if($_res){
            $_res = format_response($_res, 'success','Sucursales encontradas.');
        }else{
            $_res = format_response(FALSE,'error','No se encontro sucrusales.',TRUE);           
        }        
        $this->response($_res,200);
    }
    public function sucursal_post(){
        $_datos = $this->post();
        $_datos["id_user"] = $this->dx_auth->get_user_id();
        $_datos["id_user_parent"] = $this->id_user["id_user"];
        
        if($_datos["id"]==0)
        {
            $_res = $this->majustes->saveSubsidiary($_datos);
            if($_res){
                $_res = format_response($_res, 'success','Folio insertado.');
            }else{
                $_res = format_response(FALSE,'error','Operación fallida.',TRUE);           
            }        
        }else{
            $_res = $this->majustes->updateSubsidiary($_datos);
            if($_res){
                $_res = format_response($_res, 'success','Sucursal actualizada.');
            }else{
                $_res = format_response(FALSE,'error','Operación fallida.',TRUE);           
            }  
        }
        $this->response($_res,200);
    }
    public function sucursal_delete(){
        $_datos = $this->delete();
        $_datos["id_user_parent"] = $this->id_user["id_user"];
        $data = $this->majustes->deleteSubsidiary($_datos);

        $_res = format_response($data, 'success','sucrusal desactivado.');

        $this->response($_res,200);       
    }
    public function state_get(){
        $_res=$this->majustes->getState();
        
        if($_res){
            $_res = format_response($_res, 'success','Estados encontradas.');
        }else{
            $_res = format_response(FALSE,'error','No se encontro sucrusales.',TRUE);           
        }        
        $this->response($_res,200);        

    }
    public function town_get(){
        $data=$this->get();
        $_res=$this->majustes->getTown($data["state"]);
        
        if($_res){
            $_res = format_response($_res, 'success','Ciudades encontradas.');
        }else{
            $_res = format_response(FALSE,'error','No se encontro sucrusales.',TRUE);           
        }        
        $this->response($_res,200);        

    }

}