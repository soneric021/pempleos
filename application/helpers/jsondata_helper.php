<?php 
function jsondata_result($data){
    $CI = get_instance();
    $CI->output
		->set_content_type('application/json')
		->set_header("Access-Control-Allow-Origin:*")
		->set_output(json_encode(array($data)))
		;
}

?>