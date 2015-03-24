<?php
    /**
     * 
     */
    class Preguntas_seguimiento_modelo extends CI_Model {
        
		function agregar($datos){
			$this->load->database();
			$this->db->insert('eval_seguimiento', $datos);
			return $this->db->insert_id();
		}
        
        function buscar($paciente){
        	$this->load->database();
        	$this->db->where('paciente',$paciente);
			$query = $this->db->get('laboratorio');
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_evaluacion($evaluacion){
        	$this->load->database();
        	$this->db->where('evaluacion',$evaluacion);
			$query = $this->db->get('eval_seguimiento');
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function borrar($id){
			$this->load->database();
        	$this->db->where('id',$id);
			$this->db->delete('laboratorio');
		}
		
		function modificar($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('laboratorio', $datos);
		}
    }
?>