<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class avatar extends REST_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('usuarios/mperfil');
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




	/**
	 * Obtiene el catalogo de avatares por default, es decir aquellos que la plataforma tiene por default.
	 * 
	 * @return json 	Formato de repsuesta estandar.
	 */
	public function default_get()
	{
		$_avaters = $this->config->item('app_avatares');
		if(count($_avaters)>0){
			foreach($_avaters as $_a){
				$_data[] = array(
					'imagen' => $_a,
					'imagen50' => avatar50x50($_a),
					'imagen250' => avatar250x250($_a)
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