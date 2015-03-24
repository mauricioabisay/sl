<?php

class alumno_modelo extends CI_Model{


	public function alta($datos){
		
	$this->load->database();
	$this->db->insert('alumno',$datos);
 
	}

	public function buscar_alumno($dato){
	$this->load->database();
	$this->db->where('matricula',$dato);
	$query = $this->db->get('alumno');
	return $query -> row();
	

	}	
	public function borrar_alumno($dato){
	$this->load->database();
	$this->db->where('matricula',$dato);
	$this->db->delete('alumno');


	}	
	
	public function modificar($datos,$matricula){
	$this->load->database();
	$this->db->where('matricula',$matricula);
	$this->db->update('alumno',$datos);

	}
	
	public function buscar_nombre($dato){
	$this->load->database();
	$sql = 'select * from alumno where ';
	$sql .= "nombre like '%".$dato."%'";
	$query = $this->db->query($sql);
	
	return $query -> result();
	

	}
}





?>