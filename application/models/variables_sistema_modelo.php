<?php
    /**
     * 
     */
    class Variables_sistema_modelo extends CI_Model {
        
		function agregar_horas_doctor($datos){
			$this->load->database();
			$this->db->insert('horas_esp_doctor', $datos);
			return $this->db->insert_id();
		}
		
		function buscar(){
			$this->load->database();
			$data=NULL;
			$sql = 'select *,hour(hora_ini) as horas_inicio, minute(hora_ini) as minutos_inicio, ';
			$sql .= 'hour(hora_fin) as horas_fin, minute(hora_fin) as minutos_fin, date_format(fecha_ini,"%d-%m-%Y") as fecha_ini, ';
			$sql .= 'date_format(fecha_fin,"%d-%m-%Y") as fecha_fin from horas_esp_doctor where doctor is NULL';
			$q2=$this->db->query($sql);
			foreach ($q2->result_array() as $row2){
				$data[] = $row2;
			}
			return($data);
					
		}
		
		function buscar_fechas(){
			$this->load->database();
			$data=NULL;
			$sql = 'select fecha_ini, fecha_fin from horas_esp_doctor where doctor is NULL and dias is NULL';
			$q2=$this->db->query($sql);
			foreach ($q2->result_array() as $row2){
				$data[] = $row2;
			}
			return($data);
					
		}
		
		function modificar_horario($dia,$datos){
			$this->load->database();
			$sql = 'update horas_esp_doctor set dias="'.$datos['dias'].'", hora_ini="'.$datos['hora_ini'].'", hora_fin="'.$datos['hora_fin'].'"';
			$sql .= ' where doctor is NULL and dias="'.$dia.'"';
			$this->db->query($sql);
		}
		
		function modificar_fecha($fecha,$datos){
			$this->load->database();
			$this->db->where('fecha_ini', $fecha);
			$this->db->update('horas_esp_doctor', $datos);
			return $this->db->insert_id();
			}
		function eliminar_horario($dia){
			$this->load->database();
			$sql = 'delete from horas_esp_doctor where doctor is NULL and dias="'.$dia.'"';
			$this->db->query($sql);
					
		}
		
		function eliminar_fecha(){
			$this->load->database();
			$sql = 'delete from horas_esp_doctor where doctor is NULL and dias is NULL ';
			$this->db->query($sql);
					
		}
		
			
			
		
		
	}