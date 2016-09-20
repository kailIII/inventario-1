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
        $this->load->model('mpostear');

        $this->id_user = $this->dx_auth->getUserDomain();

    }
    public function index_post(){
        $_datos = $this->post();

        $_datos["id_user"] = $this->dx_auth->get_user_id();
        $_result = $this->mpostear->savemypost($_datos);
        
        if($_result){
            $_res = format_response($_result, 'success','Articulo agregado');
        }else{
            $_res = format_response(FALSE, 'error','Operación Fallida.',TRUE);
        }
        
        $this->response($_res,200);

    }

    public function items_post(){
        $_datos = $this->post("products");
        
        $_datos["type"] = 2;
        $_datos["id_user_prime"] = $this->id_user["id_user"];
        $_datos["id_user"] = $this->dx_auth->get_user_id();

        if($_datos["newProvider"]) // Agregar al catalogo de proveedores
        $_datos["Provider_id"] = $this->mpostear->saveProvider($_datos["Provider"],$_datos["id_user"],$_datos["id_user_prime"]);
        
        if($_datos["newBrand"]) // Agregar al catalogo de marcas
        $_datos["Brand_id"] = $this->mpostear->saveBrand($_datos["Brand"],$_datos["id_user"],$_datos["id_user_prime"]);

        if($_datos["newFamily"]) // Agregar al catalogo de familias
        $_datos["Family_id"] = $this->mpostear->saveFamily($_datos["Family"],$_datos["id_user"],$_datos["id_user_prime"]);
        
        if($_datos["newUbication"]) // Agregar al catalogo de ubicacion
        $_datos["Ubication_id"] = $this->mpostear->saveCostCenter($_datos["Ubication"],$_datos["id_user"],$_datos["id_user_prime"]);

        $_result = $this->mpostear->savemyitem($_datos);
        
        if($_result){
            $_res = format_response($_datos, 'success','Articulo agregado');
        }else{
            $_res = format_response(FALSE, 'error','Operación Fallida.',TRUE);
        }
        $this->response($_res,200);

    }

    public function delete_post(){

        $file_id=$this->security->xss_clean($_POST["file_id"]);
        if ($this->mpostear->delete_file(decode_url($file_id)))
        $return = array('status' => 1, 'msg' => 'imagen eliminada');
        else
        $return =array('status' => 0, 'msg' => 'No se pudo borrar la imagen');

        $this->response($return, 200);
    }
    public function UploadFile_post(){
        
        $return =array('status' => 1, 'msg' => '',"data"=>false);

        // jQueryFileUpload
        $file_element_name = "file";

        if ($return["status"] != 0){

                $config['upload_path'] = FCPATH.'application/assets/application/img/post/post_'.$this->id_user["id"];
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
                    $config_img['source_image'] =FCPATH.'application/assets/application/img/post/post_'.$this->id_user["id"].'/'.$data['file_name'];
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

                    $file_id = $this->mpostear->insert_img($data['file_name']);
                    
                    if($file_id)
                    $return =array('status' => 1, 'msg' =>'Imgane subida exitosamente',"data"=>false,"name"=>"application/assets/application/img/post/post_".$this->id_user["id"].'/'.$data['file_name'],"file_id"=>encode_url($file_id));
                    else{ unlink($data['full_path']); $return =array('status' => 0, 'msg' =>'Algo paso y no se pudo subir la imagen,porfavor trata nuevamente.',"data"=>false);}
            }

                @unlink($_FILES[$file_element_name]);

        }
        // $return =array('status' => 0, 'msg' => 'No se pudo borrar la imagen');
        $this->response($return, 200);
    }
    public function product_get(){
        $id_user = $this->id_user["id_user"];
        //$id_user = $this->dx_auth->get_user_id();

        $_res=array();
        $_res["brands"]=$this->mpostear->getBrand($id_user);
        $_res["TypeFixedAssets"]=$this->mpostear->getTypeFixedAssets($id_user);
        $_res["TypeOfCurrence"]=$this->mpostear->getTypeOfCurrence($id_user);
        $_res["Provider"]=$this->mpostear->getProvider($id_user);
        $_res["Subsidiary"]=$this->mpostear->getSubsidiary($id_user);
        $_res["Class"]=$this->mpostear->getClass($id_user);
        $_res["Use"]=$this->mpostear->getUse($id_user);
        $_res["Level_obsolescence"]=$this->mpostear->getLevel_obsolescence($id_user);
        $_res["Physical_state"]=$this->mpostear->getPhysical_state($id_user);
        $_res["Departament"]=$this->mpostear->getDepartament($id_user);
        $_res["CostCenter"]=$this->mpostear->getCostCenter($id_user);
        $_res["SubCostCenter"]=$this->mpostear->getSubCostCenter($id_user);
        $_res["Family"]=$this->mpostear->getFamily($id_user);
        $_res["Users"]=$this->mpostear->getUsers($id_user);
        $_res["Folio"]=$this->mpostear->getFolio($id_user);
        $_data = array(
                    'brands' => $_res["brands"],
                    'TypeFixedAssets' => $_res["TypeFixedAssets"],
                    'TypeOfCurrence' => $_res["TypeOfCurrence"],
                    'Provider' => $_res["Provider"],
                    'Subsidiary' => $_res["Subsidiary"],
                    'Class' => $_res["Class"],
                    'Use' => $_res["Use"],
                    'Level_obsolescence' => $_res["Level_obsolescence"],
                    'Physical_state' => $_res["Physical_state"],
                    'Departament' => $_res["Departament"],
                    'CostCenter' => $_res["CostCenter"],
                    'SubCostCenter' => $_res["SubCostCenter"],
                    'Family' => $_res["Family"],
                    'Users' => $_res["Users"],
                    'Folio' => $_res["Folio"],
                );        
        if($_res){
            $_res = format_response($_data, 'success','Folio encontrados.');
        }else{
            $_res = format_response(FALSE,'error','No se encontro consecutivo de folios.',TRUE);           
        }        
        $this->response($_res,200);        

    }

}