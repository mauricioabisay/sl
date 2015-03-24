<?php
    /**
     * 
     */
    class Medicamento_modelo extends CI_Model {
        
		function agregar_medicamento($datos){
			$this->load->database();
			$this->db->insert('medicamento', $datos);
			return $this->db->insert_id();
		}
		
		function agregar_medicamento_horario($datos){
			$this->load->database();
			$this->db->insert('medicamento_horario', $datos);
			return $this->db->insert_id();
		}
        
        function buscar($paciente){
        	$this->load->database();
        	$sql = 'select id,paciente,tipo_med, nombre, valor_frec, tipo_frec, causa, fecha_ini, left(fecha_ini,3) as fecha_ini_mes,';
        	$sql.= ' right(fecha_ini,4) as fecha_ini_a, status ';
        	$sql.= 'from medicamento ';
			$sql.= 'where paciente = '.$paciente.'';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_horarios($paciente){
			$this->load->database();
        	$sql = 'select medicamento_horario.id as id,hour(horario) as horas, minute(horario) as minutos, right(horario,2) as ampm,medicamento';
        	$sql.= ' from medicamento_horario,medicamento ';
			$sql.= 'where paciente = '.$paciente.' and medicamento_horario.medicamento = medicamento.id';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
		}
		
		function buscar_fecha($paciente,$fecha){
        	$this->load->database();
        	$sql = 'select id,paciente,tipo_med, nombre, valor_frec, tipo_frec, causa, fecha_ini,';
        	$sql.= 'status ';
        	$sql.= 'from medicamento ';
			$sql.= 'where paciente = '.$paciente.' and fecha_id<="'.$fecha.'"';
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
        	$sql = 'select id, tipo_med, nombre, valor_frec, tipo_frec, causa, fecha_ini, paciente';
        	$sql.= 'status';
        	$sql.= 'from medicamento';
			$sql.= 'where id = '.$id.'';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_medicamento_id($medicamento){
			$this->load->database();
			$this->db->where('id',$medicamento);
			$query = $this->db->get('medicamento');
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
		}

		function buscar_horarios_medicamento($medicamento){
			$this->load->database();
			$this->db->where('medicamento',$medicamento);
			$query = $this->db->get('medicamento_horario');
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
		}
		
		function borrar($fecha_id,$paciente){
			$this->load->database();
			/*
			$sql = 'select paciente from medicamento where id = '.$id.' ';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				$aux = $query->row();
			}else{
				$aux = FALSE;
			}*/
			
        	$this->db->where('fecha_id',$fecha_id);
			$this->db->where('paciente',$paciente);
			$this->db->delete('medicamento');
		
			//return $aux;
		}
		
		function modificar_medicamento($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('medicamento', $datos);
		}
		
		function modificar_medicamento_horario($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('medicamento_horario', $datos);
		}
		
		
		function modificar_estado($id,$status){
			$this->load->database();
			$sql = 'update medicamento set status = '.$status.' ';
			$sql.= 'where id = '.$id.'';
			$this->db->query($sql);
			$sql = 'select paciente from medicamento where id = '.$id.' ';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return FALSE;
			}
		}
		
		function listado_mini($paciente,$inicio){
        	$this->load->database();
			$sql = 'select id,fecha_id,paciente from medicamento ';
			$sql.= 'where paciente = '.$paciente.' ';
			$sql.= 'group by fecha_id ';
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
			$query = $this->db->get('medicamento');
			return $query->num_rows();
		}
		
		function ultima_fecha($paciente){
			$this->load->database();
			$sql = 'select max(fecha_id) as fecha from medicamento where paciente = '.$paciente.'';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->row();
			}else{
				return false;
			}
		}
    }
?>