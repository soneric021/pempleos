<?php 
class usuario_model extends CI_Model {
	var $table = "usuarios";


	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->load->database();
	// }
 

public function listar(){
	$lista = $this->db->get("usuarios");

	return $lista->result();
}

public function listarById($id){
	$lista = $this->db->get_where("usuarios",  array('id' => $id));
	return $lista->row();
}

public function Create($data = []){
	$this->db->insert($this->table, $data);
	return $this->db->insert_id();
}

public function edit($id, $data = []){
	$this->db->update($this->table, $data, $id);
	return $this->db->affected_rows();
}

public function delete($id){
	$this->db->where('idUsuario', $id);
	$this->db->delete($this->table);
}

public function getuser($email = ''){
	$result = $this->db->query("SELECT * FROM usuarios WHERE correo = '$email'");
	if ($result->num_rows() > 0) {
		return $result->row();
	}else{
		return null;
	}
}

}


?>