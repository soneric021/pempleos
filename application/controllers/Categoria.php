<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {
	private $request;
	public function __construct(){
		header('Access-Control-Allow-Origin: *');
			header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
			$method = $_SERVER['REQUEST_METHOD'];
			if($method == "OPTIONS") {
				die();
			}
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('categoria_model');
		$this->load->helper('jsondata_helper');
		$this->request = json_decode(file_get_contents('php://input'));
	}
	public function listar(){
		$lista = $this->categoria_model->listar();
		jsondata_result($lista);
	}
	public function create(){
		$data = array(
			'nombre' => $this->request->nombre,
			'idUsuario' => $this->request->id_usuario //que no se te olvide arreglar esto
		);
		$this->categoria_model->create($data);
		jsondata_result(array('Status' => true));
	}
	public function edit($id){
		$data = array(
			'nombre' => $this->request->nombre,
			'idUsuario' => $this->request->id_usuario //que no se te olvide arreglar esto
		);
		$this->categoria_model->edit($id,$data);
		return jsondata_result(array('Status' => true));
	}

	public function delete($id){
		$this->categoria_model->delete($id);
		return jsondata_result(array('Status' => true));
	}
}
?>