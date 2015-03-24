<?php
    class modelo_formularios extends CI_Model{


	
	public function alta_preguntas_seg($datos){
	
	$this->load->database();	
	$this->db->insert('eval_seguimiento',$datos); 
	}
}
?>