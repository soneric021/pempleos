<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleo extends CI_Controller {
	private $request;
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('empleos_model');
		$this->request = json_decode(file_get_contents('php://input'));
		$this->load->model('postul_model');
		$this->load->helper('jsondata_helper');
	}
	public function index(){
		echo "estamos aqui";
	}
	//GET: empleosController/listar
	// Muestra todos los empleos
	public function listar(){
		$lista = $this->empleos_model->listar();
		jsondata_result($lista);
	}
	//GET: empleosController/listarid/{id}
	//Mustra un empleo por ID
	public function listarid($id){
		$lista = $this->empleos_model->listarById($id);
		jsondata_result($lista);
	}

	//GET: empleo/listarc?categoria={$categoria}
	//Muestra un empleo por el id de la categoria
	public function listarc($categoria){
		$lista = $this->empleos_model->listarByCategory($categoria);
		jsondata_result($lista);
	}
	//POST:empleosController/create
	//Crear un empleo
	public function create(){
		$data = array(
			"compañia" => $this->request->company,
			"tipo" => $this->request->tipo,
			'logo' => $this->request->logo,
			'url' => $this->request->url,
			'posicion' => $this->request->posicion,
			'ubicacion' => $this->request->ubicacion,
			'id_categoria' => $this->request->id_categoria,
			'descripcion' =>$this->request->descripcion,
			'aplicar'=> "no sabia que poner aqui",
			'email' => $this->request->email,
			'idUsuario' => $this->request->id_usuario //Acuerdate de editar esto 
		);
		$this->empleos_model->create($data);
		jsondata_result(array('Status' => true));
	}
	//PUT: empleosController/edit/{$id}
	//Editar un empleo
	public function edit($id){
			$data = array(
				"compañia" => $this->request->company,
				"tipo" => $this->request->tipo,
				'logo' => $this->request->logo,
				'url' => $this->request->url,
				'posicion' => $this->request->posicion,
				'ubicacion' => $this->request->ubicacion,
				'id_categoria' => $this->request->id_categoria,
				'descripcion' =>$this->request->descripcion,
				'aplicar'=> "no sabia que poner aqui",
				'email' => $this->request->email,
				'idUsuario' => $this->request->id_usuario //Acuerdate de editar esto 
		);
		$this->empleos_model->edit($id, $data);
		return jsondata_result(array('Status' => true));

	}
	//DELETE: empleosController/delete/{$id}
	//Borrar un empleo por el id
	public function delete($id){
		$this->empleos_model->delete($id);
		return jsondata_result(array('Status' => true));
	}
	//GET: empleo/buscar?busqueda={$busqueda}
	//Nuscardor
	public function buscar($busqueda){
		echo jsondata_result($this->empleos_model->buscar($busqueda));
	}

	//POSTULACIONES postularse
	public function postularse($id){
	if($this->postul_model->checkpostulacion($this->session->userdata('id'), $id)){
		return jsondata_result(array('Status' => false));
	}else{
			$data = array(
		'idUsuario' => $this->request->id_usuario,
		'idempleo' => $id
	);
		$this->postul_model->create($data);
		return jsondata_result(array('Status' => true));
	}
	}

	//POSTULACIONES despostularse
	public function despostularse($id){
		$this->postul_model->delete($id);
		return json_encode(array('Status' => true));
	}
}
?>