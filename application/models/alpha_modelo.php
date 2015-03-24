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
		
		function buscar_id($id){
        	$this->load->database();
        	$this->db->where('id',$id);
			$query = $this->db->get('laboratorio');
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
		
		function listado_mini($paciente,$inicio){
        	$this->load->database();
			$sql = 'select id,fecha_id from antecedentes ';
			$sql.= 'where paciente = '.$paciente.' ';
			$sql.= 'limit '.$inicio.', 10 ';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
        }
		
		function total($paciente){
			$this->load->database();
        	$this->db->where('paciente',$paciente);
			$query = $this->db->get('antecedentes');
			return $query->num_rows();
		}
    }
?>