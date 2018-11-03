<?php 
class postul_model extends CI_Model {
	var $table = "postuleo";


	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->load->database();
	// }
 

// public function listar(){
// 	 return $this->db
//          ->select('*')
//          ->from("employee e")
//          ->join('categoria c', 'c.id_categoria = e.id_categoria')
//          ->order_by('fecha', 'DESC')
//          ->limit(10)
//          ->get()
//          ->result();

// }

public function checkPostulacion($iduser, $idempleo){
	$result = $this->db->get_where($this->table, array('idUsuario' =>$iduser, 'idempleo' => $idempleo));
	if($result->num_rows() > 0){
		return true;
	}else{
		return false;
	}
}

public function Create($data = []){
	$this->db->insert($this->table, $data);
	return $this->db->insert_id();
}


public function delete($id){
	$this->db->where('idpostul', $id);
	$this->db->delete($this->table);
}

}

?>