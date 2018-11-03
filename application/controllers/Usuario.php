<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct()
	 	{
	 		parent::__construct();
			$this->load->helper('url');
	 		$this->load->model('usuario_model');
	 		
	 	}
	 

	public function registro(){
		$data = array(
			'nombre' => $this->input->post("nombre"), 
			'apellido' => $this->input->post("apellido"),
			'cedula' => $this->input->post("cedula"),
			'contraseña' => $this->input->post("contraseña"),
			'correo' => $this->input->post('correo'),
			'foto' => 'loquesea',
			'tipo' => $this->input->post('tipo')
	);
		$this->usuario_model->create($data);

		return json_encode(array('Status' => true));
	}
	
	public function login(){
		$email = $this->input->post('correo');
		$pass = $this->input->post('contraseña');

		$fila = $this->usuario_model->getuser($email);
		
		if($fila->tipo == 0){
			$tipo = "admin";
		}else if($fila->tipo == 1){
			$tipo = "poster";
		}else if($fila->tipo == 2){
			$tipo = "user";
		}

		if($fila != null){
			if ($fila->contraseña == $pass) {
				$data = array('email'=> $email,
								'id' => $fila->idUsuario,
								'login' => true, 
								'tipo' => $tipo);
				$this->session->set_userdata($data);
				header("location" . base_url());
				echo "Todo esta bien chicos";
			}else{
				echo "algo mal11" ;
			header("location" . base_url());
			}
			
		}else{
			echo "algo mal";
			header("location" . base_url());
		}

	}

	public function update($id){
		$data = array(
			'nombre' => $this->input->post("nombre"), 
			'apellido' => $this->input->post("apellido"),
			'cedula' => $this->input->post("cedula"),
			'contraseña' => $this->input->post("contraseña"),
			'correo' => $this->input->post('correo'),
			'foto' => 'loquesea',
			'tipo' => '1'
	);
		$this->usuario_model->edit($id, $data);
		return json_encode(array('Status' => true));
	}
	public function delete($id){
		$this->usuario_model->delete($id);
		return json_encode(array('Status' => true)); 
	}
}
