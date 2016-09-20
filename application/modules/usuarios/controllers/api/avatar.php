<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class avatar extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
        
        if(!$this->input->is_ajax_request()){
            show_404("",true);
        }

		$this->load->model('dx_auth/menus');
		$this->load->model('mperfil');
	}


	/**
	 * Cambia el avatar.
	 * 
	 * @return json 	Formato de respuesta estandar.
	 */
	public function index_post()
	{
		$_data = $this->input->post(NULL,TRUE);
		$_res = $this->mperfil->update_avatar($_data);
		if($_res){
			$_res = format_response(TRUE, 'success','Avatar cambiado.');
		}else{
			$_res = format_response(FALSE,'error','Operación fallida.',TRUE);			
		}
		$this->response($_res,200);
	}

    public function delete_post(){

        $_ref=$this->security->xss_clean($_POST["_ref"]);
        $_ref=decode_url($_ref);
        if ($this->mperfil->delete_file($_ref))
		$return = format_response(FALSE,'success','imagen eliminada',TRUE);
        else
		$return = format_response(FALSE,'error','No se pudo borrar la imagen',TRUE);

        $this->response($return, 200);
    }

	/**
	 * Obtiene el catalogo de avatares por default, es decir aquellos que la plataforma tiene por default.
	 * 
	 * @return json 	Formato de repsuesta estandar.
	 */
	public function default_get()
	{
		$_avaters = $this->menus->get_img_perfil("");
		if(count($_avaters)>0){
			foreach($_avaters as $_a){
			
				if(!avatar($_a["name"]))
				continue;
			// $file = rtrim($file, '/').'/'.md5(mt_rand(1,100).mt_rand(1,100));
					// '_Pimg' => sha1(md5($_a['_Pimg']."ax>po+ret_13<56_2000>hoho$")."ax>po+ret_13<56_2000>hoho$"),

			
				$_data[] = array(
					'_Pimg' => encode_url($_a['_Pimg']),
					'imagen' => $_a["name"],
					'avatar' => avatar($_a["name"]),
					// 'imagen250' => avatar250x250($_a)
				);
			}
			$_res = format_response($_data);
		}else{
			$_res = format_response(FALSE,'error','Avatares no encontrados.',TRUE);
		}
		$this->response($_res,200);
	}

}

/* End of file avatar.php */
/* Location: ./application/controllers/api/avatar.php */