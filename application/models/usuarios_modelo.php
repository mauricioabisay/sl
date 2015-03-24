<?php
    /**
     * 
     */
    class Usuarios_modelo extends CI_Model {
        
		function agregar($datos){
			$this->load->database();
			$this->db->insert('usuario', $datos);
			return $this->db->insert_id();
		}
		
		function agregar_horas_doctor($datos){
			$this->load->database();
			$this->db->insert('horas_esp_doctor', $datos);
			return $this->db->insert_id();
		}
		
		function buscar($id){
			$this->load->database();
			$data=NULL;
			$sql = 'select *,usuario.id as id_usr, hour(hora_ini) as horas_inicio, minute(hora_ini) as minutos_inicio, ';
			$sql .= 'hour(hora_fin) as horas_fin, minute(hora_fin) as minutos_fin, date_format(fecha_ini,"%d-%m-%Y") as fecha_ini, ';
			$sql .= 'date_format(fecha_fin,"%d-%m-%Y") as fecha_fin from usuario,horas_esp_doctor where tipo ="doctor" ';
			$sql .= 'and usuario.id ='.$id.' and doctor= usuario.id';
			$q2=$this->db->query($sql);
			foreach ($q2->result_array() as $row2){
				$data[] = $row2;
			}
			return($data);
					
			
		}
		
		function modificar_usuario($datos,$id){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('usuario', $datos);
			return $this->db->insert_id();
		}
		
		function modificar_horario($dia,$id,$datos){
			$this->load->database();
			$sql = 'update horas_esp_doctor set dias="'.$datos['dias'].'",hora_ini="'.$datos['hora_ini'].'",hora_fin="'.$datos['hora_fin'].'" ';
			$sql .= ' where doctor='.$id.' and dias ="'.$dia.'"';
			$this->db->query($sql);
		}
		
		
		
		function eliminar_horario($dia,$id){
			$this->load->database();
			$sql = 'delete from horas_esp_doctor where doctor='.$id.' and dias ="'.$dia.'"';
			$this->db->query($sql);
					
		}
		
	}	