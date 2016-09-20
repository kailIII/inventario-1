<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function format_response($data = null, $tipo='success', $msg = '', $error = false){
	if ($data === null and !func_num_args()){
		$data = array();
	}
	return array(
		'datos' => $data,
		'type'=>$tipo,
		'error' => $error,
		'msg' => $msg
	);
}