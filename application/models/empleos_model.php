<?php 
class empleos_model extends CI_Model {
	var $table = "employee";


	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->load->database();
	// }
 

public function listar(){
	 return $this->db
         ->select('*')
         ->from("employee e")
         ->join('categoria c', 'e.id_categoria = c.id_categoria')
         ->order_by('fecha', 'DESC') 	
         ->limit(10)
         ->get()
         ->result();


}

public function listarById($id){
	$lista = $this->db->get_where("employee",  array('id_empleo' => $id));
	return $lista->row();
}

public function listarByCategory($category){
	return $this->db
         ->select('*')
         ->from("employee e")
         ->join('categoria c', 'e.id_categoria = c.id_categoria')
         ->order_by('fecha', 'DESC') 
         ->where('e.id_categoria', $category)	
         ->limit(10)
         ->get()
         ->result();
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
	$this->db->where('id_empleos', $id);
	$this->db->delete($this->table);
}

public function buscar($busqueda){
	$lista = $this->db->query("SELECT * FROM employee e  INNER JOIN categoria c on c.id_categoria = e.id_categoria
	WHERE MATCH(e.compañia) AGAINST('$busqueda'  IN BOOLEAN MODE)
	 OR  MATCH(e.posicion) AGAINST('$busqueda'  IN BOOLEAN MODE) OR 
	MATCH(e.ubicacion) AGAINST('$busqueda'  IN BOOLEAN MODE)
	OR  c.nombre like '$busqueda'
	ORDER BY fecha LIMIT 10");
	return $lista->result();
}
public function num_empleos(){
	$number = $this->db->query('SELECT COUNT(*) as number FROM employee')->row()->number;
	return intval($number);
}

public function pagination($number_por_page){
	$this->db->get($this->table, $number_por_page, $this->uri->segment(3));
}
}

?>