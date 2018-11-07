<?php 
class categoria_model extends CI_Model {
	var $table = "categoria";


	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->load->database();
	// }
 

public function listar(){
	return $this->db
         ->select('*')
         ->from('categoria c')
         ->limit(10)
         ->get()
         ->result();
}

public function listarById($id){
	$lista = $this->db->get_where("categoria",  array('id_categoria' => $id));
	return $lista->row();
}

public function Create($data = []){
	$this->db->insert($this->table, $data);
	return $this->db->insert_id();
}

public function edit($id, $data = []){
	$this->db->where('id_categoria', $id);
	$this->db->update($this->table, $data);
	return $this->db->affected_rows();
}

public function delete($id){
	$this->db->where('id_categoria', $id);
	$this->db->delete($this->table);
}


}


?>