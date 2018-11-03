<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class image extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('jsondata_helper');
    }

    function do_upload(){
        $config['upload_path']= base_url() . "client/src/assets/";
        $config['allowed_types']='gif|jpg|png';
        $config['encrypt_name'] = TRUE;
         
        $this->load->library('upload',$config);
        if($this->upload->do_upload("file")){
            $data = array('upload_data' => $this->upload->data());
 
            $image= $data['upload_data']['file_name']; 
             
            jsondata_result(array('datos'=> $data, 'image' => $image));
        }else{
            jsondata_result(array('err' => 'Error'));
        }
 
     }
     
}

   

?>