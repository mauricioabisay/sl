<?php
    /**
     * 
     */
    class Usuario_modelo extends CI_Model {
        
		function agregar($datos){
			$this->load->database();
			$this->db->insert('usuario', $datos);
			return $this->db->insert_id();
		}
		
		function agregar_horario($datos){
			$this->load->database();
			$this->db->insert('horas_doctor',$datos);
			return $this->db->insert_id();
		}
		
		function modificar_horario($id, $datos){
			$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('horas_doctor',$datos);
			return $id;
		}
        
        function buscar($where){
        	$this->load->database();
        	$sql = 'select * from usuario ';
			$sql.= 'where 1=1 '.$where.'';
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
        	$sql = 'select ';
			$sql.= 'u.id as id_usuario,u.nombre as nombre_usuario,u.ap as ap,u.am as am,u.tipo as tipo,';
			$sql.= 'u.nick as nick,u.pass as pass,';
			$sql.= 'u.tiempo_evaluacion_primera as tiempo_evaluacion_primera,u.tiempo_consulta_primera as tiempo_consulta_primera,';
			$sql.= 'u.tiempo_evaluacion_recurrente as tiempo_evaluacion_recurrente,u.tiempo_consulta_recurrente as tiempo_consulta_recurrente,';
			$sql.= 't.id as id_tipo,t.nombre as nombre_tipo ';
        	$sql.= 'from usuario as u,tabla_usuario_tipo as t ';
			$sql.= 'where u.id = "'.$id.'" and t.id=u.tipo ';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_nick_id($nombre){
        	$this->load->database();
        	$sql = 'select ';
			$sql.= 'u.id as id_usuario,u.nombre as nombre_usuario,u.ap as ap,u.am as am,u.tipo as tipo,';
			$sql.= 'u.nick as nick,u.pass as pass,';
			$sql.= 'u.tiempo_evaluacion_primera as tiempo_evaluacion_primera,u.tiempo_consulta_primera as tiempo_consulta_primera,';
			$sql.= 'u.tiempo_evaluacion_recurrente as tiempo_evaluacion_recurrente,u.tiempo_consulta_recurrente as tiempo_consulta_recurrente,';
			$sql.= 't.id as id_tipo,t.nombre as nombre_tipo ';
        	$sql.= 'from usuario as u,tabla_usuario_tipo as t ';
			$sql.= 'where u.nick = "'.$nombre.'" and t.id=u.tipo ';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_nick($nombre){
        	$this->load->database();
        	$sql = 'select * from usuario ';
			$sql.= 'where nick like "'.$nombre.'%"';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
        }
		
		function borrar($usuario){
			$this->load->database();
			$this->db->where('doctor',$usuario);
			$this->db->delete('horas_doctor');
			$this->db->where('doctor',$usuario);
			$this->db->delete('horas_esp_doctor');
        	$this->db->where('id',$usuario);
			$this->db->delete('usuario');
		}
		
		function modificar($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('usuario', $datos);
		}
		
		function existe($nick){
			$this->load->database();
			$this->db->where('nick', $nick);
			$query = $this->db->get('usuario');
			if ($query->num_rows() > 0){
				return TRUE;
			}else{
				return FALSE;
			}
		}
/*
 * Las siguientes funciones son para establecer las bases de los privilegios de usuario
 */
		function agregar_modulo($datos){
			$this->load->database();
			$this->db->insert('tabla_usuario_modulos',$datos);
			return $this->db->insert_id();
		}
		
		function modulos(){
			$this->load->database();
			$query = $this->db->get('tabla_usuario_modulos');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function agregar_tipo_usuario($datos){
			$this->load->database();
			$this->db->insert('tabla_usuario_tipo',$datos);
			return $this->db->insert_id();
		}

		function tipos_usuario(){
			$this->load->database();
			$query = $this->db->get('tabla_usuario_tipo');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function agregar_privilegio_usuario($datos){
			$this->load->database();
			$sql = 'select * from tabla_usuario_privilegios where usuario = '.$datos["usuario"].' AND modulo = '.$datos["modulo"].'';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				$this->db->where('usuario',$datos['usuario']);
				$this->db->where('modulo',$datos['modulo']);
				$this->db->update('tabla_usuario_privilegios',$datos);
			}else{
				$this->db->insert('tabla_usuario_privilegios',$datos);	
			}
			return $this->db->insert_id();
		}
		
		function privilegios_usuario(){
			$this->load->database();
			$query = $this->db->get('tabla_usuario_privilegios');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
    }
    
?>