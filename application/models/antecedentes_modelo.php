<?php
    /**
     * 
     */
    class Antecedentes_modelo extends CI_Model {
        
		function agregar($datos){
			$this->load->database();
			$this->db->insert('antecedentes', $datos);
			return $this->db->insert_id();
		}
		
		function modificar($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('antecedentes', $datos);
		}
		
		function agregar_ejercicio($datos){
			$this->load->database();
			$this->db->insert('ejercicio', $datos);
			return $this->db->insert_id();
		}

		function modificar_ejercicio($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('ejercicio', $datos);
		}
		        
        function existe($paciente){
        	$this->load->database();
        	$this->db->where('paciente',$paciente);
			$query = $this->db->get('antecedentes');
			if($query->num_rows() > 0){
				return $query->last_row();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_id($id){
        	$this->load->database();
        	$this->db->where('id',$id);
			$query = $this->db->get('antecedentes');
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_ejercicios($id){
        	$this->load->database();
        	$this->db->where('antecedente',$id);
			$query = $this->db->get('ejercicio');
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
        }

		function ejercicios_actuales($paciente){
			$this->load->database();
        	$sql = 'select * from ejercicio,(select id as a_id from antecedentes where paciente = '.$paciente.') as a ';
			$sql.= 'where fecha_fin <=> NULL and antecedente = a_id';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
		}
		
		function borrar($id){
			$this->load->database();
        	$this->db->where('antecedente',$id);
			$this->db->delete('ejercicio');
			$this->db->where('id',$id);
			$this->db->delete('antecedentes');
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
		
		function embarazo($paciente){
			$this->load->database();
			$sql = 'select embarazo,peso_pregestacional as peso_pre_gesta, semana as semana_gesta from antecedentes,(select max(fecha_id) as fecha_max from antecedentes '; 
			$sql.= 'where paciente='.$paciente.') as a '; 
			$sql.= 'where fecha_id=fecha_max';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				$antecedentes = $query->row();
				if($antecedentes->embarazo == 'Si'){
					return $query->row();
				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}
    }
?>