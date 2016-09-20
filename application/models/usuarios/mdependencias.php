<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdependencias extends CI_Model {

	private $_t_dependencias;

	public function __construct(){
		parent::__construct();

		$this->_t_dependencias = 'dependencias';
	}


	public function get_dependencias($_id_dependencia){
		//en caso de que solo queremos obtener la informacion 
		//de una dependencia
		if($_id_dependencia && is_numeric($_id_dependencia)){
			$this->db->where('dependencia_id',$_id_dependencia);
		}

		//obtenemos los registros de la tabla de dependencias
		$this->db->order_by('Dependencia');
		$_result = $this->db->get($this->_t_dependencias);

		//generamos arreglo de resultados
		if($_result->num_rows()>0){
			foreach ($_result->result_array() as $_row) {
				$_data[] = $_row;
			}
			return $_data;
		}else{
			return FALSE;
		}
	}





}