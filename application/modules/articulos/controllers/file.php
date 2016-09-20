<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once (dirname(__FILE__) . "../../libraries/GifCreator/AnimGif.php");

class File extends CI_Controller {
    
private $max_size = 1024;

	// cargamos las librerias a usar 
	public function __construct() {

		parent:: __construct();
        $this->load->model('file_model');

        $this->load->helper('url');
        $this->load->helper('security');
	}

    /*public function upload(){
        //directorio de almacén de imágenes
        $uploaddir = 'images/uploads/imgPost/';

        $tmp_name = $_FILES['file']['tmp_name'];
        
        //nombre del fichero sin espacios en blanco
        $nombre_fichero_sin_espacios=str_replace(" ","",$_FILES['file']['name']);
        
        //ruta completa del fichero
        $uploadfile = $uploaddir.$nombre_fichero_sin_espacios;
               
        //nombre del fichero
        $file_name=$_FILES['file']['name'];

      
        //compruebo si existe el directorio y si no existe lo creo
        if(!is_dir($uploaddir)){ 
            @mkdir($uploaddir, 0700); 
        }
                
        //compruebo si existe el fichero y si existe le pongo _copia_ en el nombre
        if (file_exists($uploadfile)){ 
            $uploadfile = $uploaddir ."_copia_". $nombre_fichero_sin_espacios;
            $file_name="_copia_" .$nombre_fichero_sin_espacios;
        } 

         move_uploaded_file($tmp_name,$uploadfile);

         // **************************************************************************
         // **************************************************************************

        echo '{"name":"'.$uploadfile.'"}';  
    }*/

    public function delete(){

    if(unlink(FCPATH.$_POST["path_img"]))
    $return=array('status' => 1, 'msg' =>"se borro la imagen","data"=>false); 
    else
    $return=array('status' => 0, 'msg' =>"No hay imagen","data"=>false); 

    return print_r(json_encode($return));
    }

    // con el otro metodo para subir imagenes este'puede servir para los dos 
    // metodos :) porque lo configure
    
    public function doUploadFile(){

    $return =array('status' => 1, 'msg' => '',"data"=>false);

    // jQueryFileUpload
    $file_element_name = "file";

    // $file_element_name = 'userfile';
    
    if ($return["status"] != 0){


            $config['upload_path'] = FCPATH.'images/uploads/imgPost/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']  = 1024 * 8;
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
                $config_img['source_image'] = FCPATH.'images/uploads/imgPost/'.$data['file_name'];
                $config_img['create_thumb'] = FALSE;
                $config_img['maintain_ratio'] = FALSE;

                // calcular las dimensiones de la imagen 
                // alto 810
                // ancho 436
                $img_size  = getimagesize($config_img['source_image']);
                $img_width_new = null;
                $img_height_new = null;
                $img_w  = $img_size[0];
                $img_h  = $img_size[1];

                switch ($img_h) {
                    case $img_h>=1000:
                        $img_width_new = ( $img_w * 50 ) / 200;
                        $img_height_new = ( $img_h * 50 ) / 200;
                        break;
                    case $img_h>=810:
                        $img_width_new = ( $img_w * 50 ) / 100;
                        $img_height_new = ( $img_h * 50 ) / 100;
                        break;

                    default:
                        # code...
                        break;
                }

                $config_img['width'] = $img_width_new;
                $config_img['height'] = $img_height_new;

                // ponerle una marca de agua a la foto
                // $config_img['wm_text']          = 'www.pirabook.com';
                // $config_img['wm_type']          = 'text';
                // $config_img['wm_font_path']     = './system/fonts/texb.ttf';
                // $config_img['wm_font_size']     = '90';
                // $config_img['wm_font_color']    = 'ffffff';
                // $config_img['wm_vrt_alignment'] = 'bottom';
                // $config_img['wm_hor_alignment'] = 'center';
                // $config_img['wm_padding']       = '20';



                $this->image_lib->initialize($config_img);
                $this->image_lib->watermark();
                $this->image_lib->resize();
                $this->image_lib->clear();
                //... 

                $file_id = $this->file_model->insert_file($data['file_name']);
                
                if($file_id)
                $return =array('status' => 1, 'msg' =>'Imgane subida exitosamente',"data"=>false,"name"=>"images/uploads/imgPost/".$data['file_name'],"file_id"=>$file_id);
                else{ unlink($data['full_path']); $return =array('status' => 0, 'msg' =>'Algo paso y no se pudo subir la imagen,porfavor trata nuevamente.',"data"=>false);}
            }

            @unlink($_FILES[$file_element_name]);

        }

        // header('Content-Type: application/json');
        // jQueryFileUpload
        // echo '{"name":"images/uploads/imgPost/'.$data['file_name'].'"}';  

        echo json_encode($return);
         return;
    }

/*
    public function files(){
       $files = $this->file_model->get_files();
       $this->load->view('files_view', array('files' => $files));
    }
    ******************************************************/

    public function delete_file(){

    $file_id=$this->security->xss_clean($_POST["file_id"]);
    if ($this->file_model->delete_file($file_id))
    $return = array('status' => 1, 'msg' => 'imagen eliminada');
    else
    $return =array('status' => 0, 'msg' => 'No se pudo borrar la imagen');

       echo json_encode($return);
    }

    public function create_gif($publication_id){

    $images_array=$this->file_model->get_files_by($publication_id);
    if(!empty($images_array) )
    foreach ($images_array as $key => $value) {
    $images_array_to_gif[$key]=FCPATH.'images/uploads/imgPost/'.$value["filename"];

    }    

    if(!empty($images_array_to_gif) and count($images_array_to_gif)>1){
    $anim = new GifCreator\AnimGif();
    $gif=$anim->create($images_array_to_gif,array(200,200));

    mt_srand();
    $filename = md5(uniqid(mt_rand())).".gif";
    $gif->save(FCPATH.'images/uploads/gifPost/'.$filename);
    return $filename;
    }

    }


}
?>