<?php
    class modelo_formularios extends CI_Model{


	public function alta_antecedentes($datos){
		$this->load->database();
		$this->db->insert('antecedentes',$datos);
		return $this->db->insert_id();
	}
	
	public function alta_evaluacion_frecuencia($datos){
		
	
	$this->load->database();
	$this->db->insert('frec_alimentos',$datos);
	return $this->db->insert_id();
	
	}
	
	
	public function alta_evaluacion_recordatorio($datos){
		
	
	$this->load->database();
	$this->db->insert('alimento_recordatorio',$datos);
	return $this->db->insert_id();
	
	}
	
	public function alta_evaluacion_historico($r,$f,$h,$t_1,$t_2,$t_3,$h_1,$h_2,$h_3,$h_4,$h_5,$p){
		
	
	$this->load->database();
	$this->db->insert('alimento_recordatorio',$r);
	$this->db->insert('frec_alimentos',$f);
	$this->db->insert('hist_peso',$h);
	$this->db->insert('tratamiento',$t_1);
	$this->db->insert('tratamiento',$t_2);
	$this->db->insert('tratamiento',$t_3);
	$this->db->insert('habitos_alimenticios',$h_1);
	$this->db->insert('habitos_alimenticios',$h_2);
	$this->db->insert('habitos_alimenticios',$h_3);
	$this->db->insert('habitos_alimenticios',$h_4);
	$this->db->insert('habitos_alimenticios',$h_5);
	$this->db->insert('eval_dietetica',$p);
	
	return $this->db->insert_id();
	
	}
	
	public function alta_laboratorios($datos){
	
	$this->load->database();	
	$this->db->insert('laboratorio',$datos); 
	}

	public function alta_preguntas_seg($datos){
	
	$this->load->database();	
	$this->db->insert('eval_seguimiento',$datos); 
	}
}
?>