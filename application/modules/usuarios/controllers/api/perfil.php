<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class perfil extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->input->is_ajax_request()){
            show_404("",true);
        }
		$this->load->library('form_validation');
		$this->load->model('mperfil');
		$this->load->model('usuarios/muser');
		$this->load->model('usuarios/mpass');
        // $this->load->model('dx_auth/menus');
        // if($this->dx_auth->get_role_id()==3):
            $this->id_user["id"] = $this->dx_auth->get_user_id();
        // else:
            // $this->id_user = $this->dx_auth->getUserDomain();
            // $id_user = $this->dx_auth->get_user_id();
        // endif		
        // $this->id_user = $this->dx_auth->getUserDomain();

		$this->form_validation->set_message('min_length', 'La contraseña debe de tener minimo 8 caracteres.');
		$this->form_validation->set_message('matches', 'La contraseña nueva no coincide.');
		$this->form_validation->set_message('required', 'Los campos son obligatorios.');
		$this->form_validation->set_message('checkPass', 'La contraseña es incorrecta.');
		$this->form_validation->set_message('strong', 'La contraseña debe de contener mayusculas, minusculas, números y caracteres especiales.');
		$this->form_validation->set_message('unica', 'La contraseña no debe de ser igual a las últimas 5 usadas.');
		$this->form_validation->set_message('disponible', 'El nombre de usuario no esta disponible, favor de elegir otro nombre.');
	}


	/**
	 * Graba el perfil del usuario logeado. Esto solo funciona si el usuario esta logeado
	 * 
	 * @return json 	Formato de respuesta estandar
	 */
	public function index_post()
	{
		$_data = $this->input->post(NULL,TRUE);
		$this->firephp->log($_data);


		$this->form_validation->set_rules('perfil[nombre]','Nombre','required|trim|xss_clean');
		$this->form_validation->set_rules('email','Correo','required|valid_email|trim|xss_clean');

		//REGLAS DE VALIDACION PARA EL CAMBIO DE CONTRASEÑA, VERIFICAMOS SI NO VIENEN VACIOS.
		if($_data['actual']!=''){
			$this->form_validation->set_rules('actual','Contraseña Actual','trim|xss_clean|required|callback_checkPass');
			//$this->form_validation->set_rules('pass','Contraseña Nueva','trim|xss_clean|required|matches[repass]|min_length[8]|callback_strong|callback_unica');
			$this->form_validation->set_rules('pass','Contraseña Nueva','trim|xss_clean|required|matches[repass]|min_length[8]|callback_unica');
			$this->form_validation->set_rules('repass', 'Repetir Nueva Contraseña', 'trim|xss_clean');
		}

		if($this->dx_auth->is_logged_in()){
			if ($this->form_validation->run()){
				$_upd_perfil = $this->mperfil->update_item($_data['perfil'],$_data['actual'],$_data['pass'],$_data['email']);
				// return $_upd_perfil;
				// $this->response($_upd_perfil);
				$_res = format_response(TRUE, 'success','Perfil actualizado.');
			}else{
				$_res = format_response(FALSE, 'error',validation_errors(),TRUE);
			}			
		}else{
			$_res = format_response(FALSE,'error','Se requiere de un usuario logeado.',TRUE);
		}	
		$this->response($_res,200);
	}



	/**
	 * Obtiene la informacion de perfil de un usuario logeado. Esto solo funciona si el usuario esta logeado.
	 * 
	 * @return json 	Formato de respuesta estandar
	 */
	public function index_get()
	{
		if($this->dx_auth->is_logged_in()){
			$_id = $this->dx_auth->get_user_id();
			$_data = $this->muser->get_item($_id);
			$_res = format_response($_data,200);
		}else{
			$_res = format_response(FALSE,'error','Se requiere de un usuario logeado.',TRUE);
		}
		$this->response($_res,200);	
	}
    public function delete_post(){

        $_ref=$this->security->xss_clean($_POST["_ref"]);
        if ($this->mperfil->delete_file($_ref))
        $return = array('status' => 1, 'msg' => 'imagen eliminada');
        else
        $return =array('status' => 0, 'msg' => 'No se pudo borrar la imagen');

        $this->response($return, 200);
    }
    public function UploadFile_post(){
        
        $return =array('status' => 1, 'msg' => 'Empieza todo',"data"=>false);

        // jQueryFileUpload
        $file_element_name = "file";

        if ($return["status"] != 0){

                $config['upload_path'] = FCPATH.'application/assets/application/img/avatares/avatar_'.$this->id_user["id"]."/perfil";
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
                    $config_img['source_image'] =FCPATH.'application/assets/application/img/avatares/avatar_'.$this->id_user["id"].'/perfil/'.$data['file_name'];
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
                    $file_id = $this->mperfil->insert_img($data['file_name']);
                    
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
//ESTAS FUNCIONES SON PARA LA VALIDACION DE LA CONTRASEÑA. SON CALLBACKS USADOS POR LA LIBRERIA FORM_VALIDAION
	public function strong($str){
		if($this->mpass->strong_password($str)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function unica($str){
		if(!$this->mpass->ultima_password($str)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function checkPass($str){
		if($this->mpass->same_pass($str)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function disponible($str){
		return $this->mpass->usuario_disponible($str);
	}
//-----------------------------------------------------------------------------------------------------------

}

/* End of file perfil.php */
/* Location: ./application/controllers/api/perfil.php */