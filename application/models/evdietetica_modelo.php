<?php
    /**
     * 
     */
    class Evdietetica_modelo extends CI_Model {
        
		function agregar_evaluacion($datos){
			$this->load->database();
			$this->db->insert('eval_dietetica', $datos);
			return $this->db->insert_id();
		}
		
		function modificar_evaluacion($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('eval_dietetica', $datos);
		}
		
		function agregar_frecuencia($datos){
			$this->load->database();
			$this->db->insert('frec_alimentos', $datos);
			return $this->db->insert_id();
		}
		
		function modificar_frecuencia($id_evdietetica,$datos){
			$this->load->database();
			$this->db->where('eval_dietetica',$id_evdietetica);
			$this->db->update('frec_alimentos', $datos);
		}
		
		function agregar_historial($datos){
			$this->load->database();
			$this->db->insert('hist_peso', $datos);
			return $this->db->insert_id();
		}
		
		function modificar_historial($id_evdietetica,$datos){
			$this->load->database();
			$this->db->where('eval_dietetica',$id_evdietetica);
			$this->db->update('hist_peso', $datos);
		}
		
		function agregar_tratamiento($datos){
			$this->load->database();
			$this->db->insert('tratamiento', $datos);
			return $this->db->insert_id();
		}
		
		function modificar_tratamiento($id,$datos){
			$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('tratamiento', $datos);
		}
		
		function agregar_medicamento_dietetico($datos){
			$this->load->database();
			$this->db->insert('medicamento_dietetico', $datos);
			return $this->db->insert_id();
		}
		
		function modificar_medicamento_dietetico($id,$datos){
			$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('medicamento_dietetico', $datos);
		}
		
		function agregar_habito($datos){
			$this->load->database();
			$this->db->insert('habitos_alimenticios', $datos);
			return $this->db->insert_id();
		}
		
		function modificar_habito($id,$datos){
			$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('habitos_alimenticios', $datos);
		}
		
		function agregar_recordatorio($datos){
			$this->load->database();
			$this->db->insert('alimento_recordatorio', $datos);
			return $this->db->insert_id();
		}
		
		function modificar_recordatorio($id,$datos){
			$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('alimento_recordatorio', $datos);
		}
		
		function listado_mini($paciente,$inicio){
        	$this->load->database();
			$sql = 'select id,fecha_id from eval_dietetica ';
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
			$query = $this->db->get('eval_dietetica');
			return $query->num_rows();
		}
		
        function buscar($paciente){
        	$this->load->database();
        	$this->db->where('paciente',$paciente);
			$query = $this->db->get('eval_dietetica');
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_evdietetica($id){
        	$this->load->database();
        	$this->db->where('id',$id);
			$query = $this->db->get('eval_dietetica');
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_frecuencia($id_evdietetica){
        	$this->load->database();
        	$this->db->where('eval_dietetica',$id_evdietetica);
			$query = $this->db->get('frec_alimentos');
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_habitos($id_evdietetica){
        	$this->load->database();
        	$this->db->where('eval_dietetica',$id_evdietetica);
			$query = $this->db->get('habitos_alimenticios');
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_recordatorios($id_evdietetica){
        	$this->load->database();
        	$this->db->where('eval_dietetica',$id_evdietetica);
			$query = $this->db->get('alimento_recordatorio');
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_historial($id_evdietetica){
        	$this->load->database();
        	$this->db->where('eval_dietetica',$id_evdietetica);
			$query = $this->db->get('hist_peso');
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_tratamientos($id_historial){
        	$this->load->database();
        	$this->db->where('hist_peso',$id_historial);
			$query = $this->db->get('tratamiento');
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_medicamentos($id_historial){
        	$this->load->database();
        	$this->db->where('hist_peso',$id_historial);
			$query = $this->db->get('medicamento_dietetico');
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
        }
		
		function borrar($id_evdietetica){
			$this->load->database();
			$sql_historial = 'select id from hist_peso where eval_dietetica = '.$id_evdietetica;
			$aux_query = $this->db->query($sql_historial);
			if($aux_query->num_rows()>0){
				$id_historial = $aux_query->row()->id;
				$where_historial = 'where hist_peso = '.$id_historial.' ';
				$sql_delete = 'delete from tratamiento '.$where_historial;
				$this->db->query($sql_delete);
				$sql_delete = 'delete from medicamento_dietetico '.$where_historial;
				$this->db->query($sql_delete);
			}
			$where_evdietetica = 'where eval_dietetica = '.$id_evdietetica.' ';
			
			$sql_delete = 'delete from frec_alimentos '.$where_evdietetica;
			$this->db->query($sql_delete);
			
			$sql_delete = 'delete from hist_peso '.$where_evdietetica;
			$this->db->query($sql_delete);
			
			$sql_delete = 'delete from habitos_alimenticios '.$where_evdietetica;
			$this->db->query($sql_delete);
			
			$sql_delete = 'delete from alimento_recordatorio '.$where_evdietetica;
			$this->db->query($sql_delete);
			
			$sql_delete = 'delete from eval_dietetica where id = '.$id_evdietetica;
			$this->db->query($sql_delete);
		}
		
    }
?>