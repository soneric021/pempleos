<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class image extends CI_Controller {
    public function __construct() {
        header('Access-Control-Allow-Origin: *');
			header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
			$method = $_SERVER['REQUEST_METHOD'];
			if($method == "OPTIONS") {
				die();
			}
        parent::__construct();
        $this->load->helper('jsondata_helper');
    }

    function do_upload(){

        $config['upload_path']=  "./uploads/";
        $config['allowed_types']='gif|jpg|png';
        $config['encrypt_name'] = TRUE;
         
        $this->load->library('upload',$config);
        if($this->upload->do_upload("file")){
            $data = array('upload_data' => $this->upload->data());
 
            $image= $data['upload_data']['file_name']; 
             
            jsondata_result(array('datos'=> $data, 'image' => "http://localhost/pempleos/uploads/".$image ));
        }else{
            jsondata_result(array('err' => $this->upload->display_errors()));
        }
 
     }
     
}

   

?>