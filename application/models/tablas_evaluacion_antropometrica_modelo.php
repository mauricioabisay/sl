<?php
    /**
     * 
     */
    class Tablas_evaluacion_antropometrica_modelo extends CI_Model {
        
		function ninos_waterlow($tipo){
			$this->load->database();
			$this->db->where('evaluacion','waterlow');
			$this->db->where('tipo',$tipo);
			$query = $this->db->get('tabla_evaluacion_antropometrica_criterios_ninos');
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
		}
		
		function ninos_puntuacion_z($tipo){
			$this->load->database();
			$this->db->where('evaluacion','puntuacion_z');
			$this->db->where('tipo',$tipo);
			$query = $this->db->get('tabla_evaluacion_antropometrica_criterios_ninos');
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
		}
		
		function ninos_evaluacion($evaluacion){
			$this->load->database();
			$this->db->where('evaluacion',$evaluacion);
			$query = $this->db->get('tabla_evaluacion_antropometrica_criterios_ninos');
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
		}
		
		function adultos_evaluacion($evaluacion,$sexo){
			$this->load->database();
			$this->db->where('evaluacion',$evaluacion);
			if($sexo){
				$this->db->where('sexo',$sexo);
			}
			$query = $this->db->get('tabla_evaluacion_antropometrica_criterios_adultos');
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
		}
    }
?>