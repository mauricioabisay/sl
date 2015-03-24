<?php
    /**
     * 
     */
    class Comentario_modelo extends CI_Model {
        
		function agregar($datos){
			$this->load->database();
			$this->db->insert('comentario', $datos);
			return $this->db->insert_id();
		}
        
        function buscar_paciente($paciente){
        	$this->load->database();
        	$this->db->where('paciente',$paciente);
			$query = $this->db->get('comentario');
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
			$query = $this->db->get('comentario');
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_paciente_fecha($paciente,$fecha){
        	$this->load->database();
        	$this->db->where('paciente',$paciente);
			$this->db->where('fecha',$fecha);
			$query = $this->db->get('comentario');
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
			$this->db->delete('comentario');
		}
		
		function modificar($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('comentario', $datos);
		}
		
		function listado_mini($paciente,$inicio){
        	$this->load->database();
			$sql = 'select id,fecha from comentario ';
			$sql.= 'where paciente = '.$paciente.' ';
			$sql.= 'order by fecha desc ';
			$sql.= 'limit '.$inicio.', 4 ';
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
			$query = $this->db->get('comentario');
			return $query->num_rows();
		}
    }
?>