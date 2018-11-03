<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('categoria_model');
	}
	public function listar(){
		$lista = $this->categoria_model->listar();
		echo json_encode($lista);
	}
	public function create(){
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'idUsuario' => $this->session->userdata('id') //que no se te olvide arreglar esto
		);
		$this->categoria_model->create($data);
		return json_encode(array('Status' => true));
	}
	public function edit($id){
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'idUsuario' => $this->session->userdata('id')  //que no se te olvide arreglar esto
		);
		$this->categoria_model->edit($id,$data);
		return json_encode(array('Status' => true));
	}

	public function delete($id){
		$this->categoria_model->delete($id);
		return json_encode(array('Status' => true));
	}
}
?>