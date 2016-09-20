<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class APP_Excel extends PHPExcel{
	private $CI;
	
	public function __construct(){
		parent::__construct();

		$this->CI =& get_instance();
	}
}

/* End of file APP_Excel.php */
/* Location: ./application/libraries/APP_Excel.php */