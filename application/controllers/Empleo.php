<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleo extends CI_Controller {
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
		$this->load->model('empleos_model');
		$this->request = json_decode(file_get_contents('php://input'));
		$this->load->model('postul_model');
		$this->load->helper('jsondata_helper');
	}

	/**
	 * listar()
	 * Get: empleo/listar
	 * listar empleados
	 * 
	 * @return jsondata_result()
	 */
	public function listar(){
		$lista = $this->empleos_model->listar();
		jsondata_result($lista);
	}

	/**
	 * listarid()
	 * Get: empleo/listarid/{id}
	 * Mustra un empleo por ID
	 * 
	 * @param int $id
	 * @return jsondata_result()
	 */

	public function listarid($id){
		$lista = $this->empleos_model->listarById($id);
		jsondata_result($lista);
	}
	/**
	 * listarc()
	 * Get: empleo/listarc?categoria={$categoria}
	 * Muestra un empleo por el id de la categoria
	 * 
	 * @param string $categoria
	 * @return jsondata_result()
	 */
	public function listarc($categoria){
		$lista = $this->empleos_model->listarByCategory($categoria);
		jsondata_result($lista);
	}

	/**
	 * create()
	 * POST: empleo/create
	 * Crear un empleo
	 * 
	 * @return jsondata_result()
	 */
	public function create(){
		$data = array(
			"compañia" => $this->request->compañia,
			"tipo" => $this->request->tipo,
			'logo' => $this->request->logo,
			'url' => $this->request->url,
			'posicion' => $this->request->posicion,
			'ubicacion' => $this->request->ubicacion,
			'id_categoria' => $this->request->id_categoria,
			'descripcion' =>$this->request->descripcion,
			'email' => $this->request->email,
			'idUsuario' => $this->request->idUsuario //Acuerdate de editar esto 
		);
		$this->empleos_model->create($data);
		echo json_encode(array('status'=> true));
	}

	/**
	 * edit()
	 * PUT: empleo/edit/{$id}
	 * Editar un empleo
	 * 
	 * @param int $id
	 * @return jsondata_result()
	 */
	public function edit($id){
			$data = array(
				"compañia" => $this->request->compañia,
			"tipo" => $this->request->tipo,
			'url' => $this->request->url,
			'posicion' => $this->request->posicion,
			'ubicacion' => $this->request->ubicacion,
			'descripcion' =>$this->request->descripcion,
		
		);
		if($this->empleos_model->edit($id, $data)>0){
			return jsondata_result(array('Status' => true));
		}else{
			return jsondata_result(array('Status' => false));
		}
		

	}

	/**
	 * delete()
	 * DELETE: empleo/delete/{$id}
	 * Borrar un empleo por el id
	 * 
	 * @param int $id
	 * @return jsondata_result()
	 */
	public function delete($id){
		$this->empleos_model->delete($id);
		return jsondata_result(array('Status' => true));
	}
	/**
	 * buscar()
	 * GET: empleo/buscar?busqueda={$busqueda}
	 * Buscar por valor pasado
	 * 
	 * @param string $busqueda
	 * @return jsondata_result()
	 */
	public function buscar($busqueda){
		echo jsondata_result($this->empleos_model->buscar($busqueda));
	}
	/**
	 * getpostul()
	 * GET: empleo/getpostul?idusuario={$idUsuario}&&idEmpleo={$idEmpleo}
	 * Chequear el estado de la postulacion.
	 * 
	 * @param int $idUsuario
	 * @param int $idEmpleo
	 * @return jsondata_result()
	 */
	public function getpostul($idUsuario, $idEmpleo){
		
		if($this->postul_model->checkPostulacion($idUsuario, $idEmpleo) ==false){
			jsondata_result(array('status'=>true));
		}else{
			$lista = $this->postul_model->checkPostulacion($idUsuario, $idEmpleo);
		jsondata_result($lista);
		}
	}
	/**
	 * postularse()
	 * Post: empleo/postularse
	 * Postular al usuario con el empleo.
	 * 
	 * @return jsondata_result()
	 */
	//POSTULACIONES postularse
	public function postularse(){
	
			$data = array(
		'idUsuario' => $this->request->idUsuario,
		'idempleo' => $this->request->idempleo
	);
		$this->postul_model->create($data);
		return jsondata_result(array('Status' => true));
	
	}
	/**
	 * despostularse()
	 * Put: empleo/postularse?id={$id}
	 * despotularse por el id.
	 * 
	 * @param int $id
	 * @return jsondata_result()
	 */
	public function despostularse($id){
		$this->postul_model->delete($id);
		return json_encode(array('Status' => true));
	}
}
?>