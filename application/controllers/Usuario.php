<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	private $request;
	public function __construct()
	 	{
	 		parent::__construct();
			$this->load->helper('url');
	 		$this->load->model('usuario_model');
			 $this->load->helper('jsondata_helper');
			 $this->request = json_decode(file_get_contents('php://input'));
	 	}
	 

	public function registro(){
		$data = array(
			'nombre' => $this->request->nombre, 
			'apellido' => $this->request->apellido,
			'cedula' => $this->request->cedula,
			'contraseña' => $this->request->contraseña,
			'correo' => $this->request->correo,
			'foto' => 'loquesea',
			'tipo' => $this->request->tipo
	);
		$this->usuario_model->create($data);

		return jsondata_result(array('Status' => true));
}
	public function login(){
		$email = $this->request->correo;
		$pass = $this->request->contraseña;

		$fila = $this->usuario_model->getuser($email);
		$token = bin2hex(random_bytes(64));

		if($fila != null){
			if ($fila->contraseña == $pass) {
				$data = array('token'=> $token,
								'id' => $fila->idUsuario);
				jsondata_result($data);
			}else{
			jsondata_result(array('err'=> 'hay un error'));
			}
			
		}else{
			jsondata_result(array('err'=> 'hay un error'));
		}

	}

	public function update($id){
		$data = array(
			'nombre' => $this->request->nombre, 
			'apellido' => $this->request->apellido,
			'cedula' => $this->request->cedula,
			'contraseña' => $this->request->contraseña,
			'correo' => $this->request->correo,
			'foto' => 'loquesea',
			'tipo' => $this->request->tipo
	);
		$this->usuario_model->edit($id, $data);
		return jsondata_result(array('Status' => true));
	}

	public function delete($id){
		$this->usuario_model->delete($id);
		return jsondata_result(array('Status' => true)); 
	}
}
