<?php
    /**
     * 
     */
    class Laboratorio_modelo extends CI_Model {
        
		function agregar($datos){
			$this->load->database();
			$this->db->insert('laboratorio', $datos);
			return $this->db->insert_id();
		}
		
		function modificar($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('laboratorio', $datos);
		}
		
		function agregar_estudio($datos){
			$this->load->database();
			$this->db->insert('laboratorio_estudio',$datos);
			return $this->db->insert_id();
		}
		
		function modificar_estudio($id,$datos){
			$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('laboratorio_estudio',$datos);
		}
		
		function estudios($laboratorio){
			$this->load->database();
			$this->db->where('laboratorio',$laboratorio);
			$query = $this->db->get('laboratorio_estudio');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function buscar_estudios($laboratorio,$where){
			$this->load->database();
			$sql = 'select * from laboratorio_estudio ';
			$sql.= 'where laboratorio = '.$laboratorio.' '.$where.' ';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return FALSE;
			}
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
		
		function listado_mini($paciente,$inicio){
        	$this->load->database();
			$sql = 'select id, ';
			$sql.= 'date_format(fecha_captura,"%d-%m-%Y") as fecha_captura, ';
			$sql.= 'date_format(fecha_solicitud,"%d-%m-%Y") as fecha_solicitud, ';
			$sql.= 'date_format(fecha_laboratorio,"%d-%m-%Y") as fecha_laboratorio, ';
			$sql.= 'status ';
			$sql.= 'from laboratorio ';
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
			$this->db->where('laboratorio',$id);
			$this->db->delete('laboratorio_estudio');
        	$this->db->where('id',$id);
			$this->db->delete('laboratorio');
		}
		
		function laboratorios(){
			$this->load->database();
			$query = $this->db->get('tabla_laboratorios');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function total($paciente){
			$this->load->database();
        	$this->db->where('paciente',$paciente);
			$query = $this->db->get('laboratorio');
			return $query->num_rows();
		}
    }
?>