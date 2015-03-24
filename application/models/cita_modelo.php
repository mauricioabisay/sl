<?php
    /**
     * 
     */
    class Cita_modelo extends CI_Model {
        
		function agregar_pre_paciente($datos){
			$this->load->database();
			$this->db->insert('paciente', $datos);
			return $this->db->insert_id();
		}
		
		function agregar_cita($datos){
			$this->load->database();
			$this->db->insert('cita',$datos);
			return $this->db->insert_id();
		}
		
		function agregar_preferencia($datos){
			$this->load->database();
			$this->db->insert('paciente_preferencia_horario',$datos);
			return $this->db->insert_id();
		}
		
		function agregar_preferencia_hora($datos){
			$this->load->database();
			$this->db->insert('paciente_preferencia_hora',$datos);
			return $this->db->insert_id();
		}
		
		function borrar_preferencia_hora($paciente){
			$this->load->database();
			$this->db->where('paciente',$paciente);
			$this->db->delete('paciente_preferencia_hora');
		}
		
		function tipo_cita($paciente){
			$this->load->database();
			$sql = 'select tipo from paciente where id = '.$paciente.'';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				$fila = $query->row();
				return $fila->tipo;
			}else{
				return 'Nuevo';
			}
		}
		
		function dias_semana_general(){
			$this->load->database();
			$sql = 'select dias from horas_doctor where doctor<=>null and fecha_ini<=>null and fecha_fin<=>null';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function dias_semana_doctor($id_doctor){
			$this->load->database();
			$sql = 'select dias from horas_doctor where doctor = '.$id_doctor.' and fecha_ini<=>null and fecha_fin<=>null';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function is_dia_doctor($id_doctor,$dia){
			$this->load->database();
			$sql = 'select dias from horas_doctor ';
			$sql.= 'where doctor = '.$id_doctor.' '; 
			$sql.= 'and fecha_ini<=>null and fecha_fin<=>null ';
			$sql.= 'and dias like "%'.$dia.'%" ';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		function horas_general(){
			$this->load->database();
			$sql = 'select id,dias,hora_ini,hora_fin from horas_doctor where doctor<=>null and fecha_ini<=>null and fecha_fin<=>null';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function dias_generales(){
			$this->load->database();
			$sql = 'select dias,hora_ini,hora_fin from horas_doctor where fecha_ini<=>null and fecha_fin<=>null';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}

		function horas_especiales($fecha){
			$this->load->database();
			$sql = 'select dias,hora_consulta,hora_ini,hora_fin from horas_doctor where (fecha_ini="'.$fecha.'" or fecha_fin="'.$fecha.'")';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function horas_min_max_general(){
			$this->load->database();
			$sql = 'select min(hora_ini) as hora_ini,max(hora_fin) as hora_fin from horas_doctor ';
			$sql.= 'where (doctor<=>null)';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->row();
			}else{
				return FALSE;
			}
		}
		
		function horas_general_doctor($doctor){
			$this->load->database();
			$sql = 'select dias,hora_ini,hora_fin,';
			$sql.= 'tiempo_evaluacion_primera,tiempo_consulta_primera,';
			$sql.= 'tiempo_evaluacion_recurrente,tiempo_consulta_recurrente ';
			$sql.= 'from horas_doctor,usuario as u '; 
			$sql.= 'where doctor='.$doctor.' and u.id='.$doctor.' and fecha_ini is null and fecha_fin is null';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function horas_general_doctor_fecha($doctor,$fecha){
			$dia_name = $fecha->format('D');
			switch($dia_name){
				case 'Mon':{$dia_nombre='Lun';break;}
				case 'Tue':{$dia_nombre='Mar';break;}
				case 'Wed':{$dia_nombre='Mie';break;}
				case 'Thu':{$dia_nombre='Jue';break;}
				case 'Fri':{$dia_nombre='Vie';break;}
				case 'Sat':{$dia_nombre='Sab';break;}
				case 'Sun':{$dia_nombre='Dom';break;}
			}
			$this->load->database();
			$sql = 'select hora_ini,hora_fin,';
			$sql.= 'tiempo_evaluacion_primera,tiempo_consulta_primera,';
			$sql.= 'tiempo_evaluacion_recurrente,tiempo_consulta_recurrente ';
			$sql.= 'from horas_doctor,usuario as u '; 
			$sql.= 'where doctor='.$doctor.' and u.id='.$doctor.' and fecha_ini is null and fecha_fin is null ';
			$sql.= 'and dias like "%'.$dia_nombre.'%" ';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function horas_general_consulta_doctor($doctor){
			$this->load->database();
			$sql = 'select id,dias,hora_consulta,hora_ini,hora_fin from horas_doctor ';
			$sql.= 'where doctor='.$doctor.' and '; 
			$sql.= 'hora_consulta="Si" ';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function duracion_cita_doctor($doctor){
			$this->load->database();
			$sql = 'select '; 
			$sql.= 'tiempo_evaluacion_primera, tiempo_consulta_primera, ';
			$sql.= 'tiempo_evaluacion_recurrente, tiempo_consulta_recurrente ';
			$sql.= 'from usuario ';
			$sql.= 'where id = '.$doctor.' ';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->row();
			}else{
				return FALSE;
			}
		}
		
		
		function horas_general_reservadas_doctor($doctor){
			$this->load->database();
			$sql = 'select id,dias,hora_consulta,hora_ini,hora_fin from horas_doctor ';
			$sql.= 'where doctor='.$doctor.' and '; 
			$sql.= 'hora_consulta="Reservada" ';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}

		function horas_general_inhabiles_doctor($doctor,$fecha_ini){
			$this->load->database();
			$sql = 'select id,dias,hora_consulta, ';
			$sql.= 'date_format(fecha_ini,"%d-%m-%Y") as fecha_ini,date_format(hora_ini,"%h:%i %p") as hora_ini, ';
			$sql.= 'date_format(fecha_fin,"%d-%m-%Y") as fecha_fin,date_format(hora_fin,"%h:%i %p") as hora_fin '; 
			$sql.= 'from horas_doctor ';
			$sql.= 'where doctor='.$doctor.' and '; 
			$sql.= 'hora_consulta="No" and fecha_ini>="'.$fecha_ini.'" ';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}

		function horas_especiales_doctor($doctor,$fecha,$dia,$reservada){
			$this->load->database();
			$sql = 'select dias,hora_consulta,hora_ini,hora_fin from horas_doctor ';
			$sql.= 'where doctor='.$doctor.' and '; 
			$sql.= '( ';
			$sql.= '(fecha_ini="'.$fecha.'" or fecha_fin="'.$fecha.'") or ';
			$sql.= '(';
			$sql.= '(';
			$sql.= ($reservada=="TRUE")?'hora_consulta="No"':'hora_consulta="Reservada" or hora_consulta="No"';
			$sql.= ') and '; 
			$sql.= 'dias like "%'.$dia.'%"';
			$sql.= ')';
			$sql.= ') ';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function horas_reservadas_doctor($doctor,$dia){
			$this->load->database();
			$sql = 'select dias,hora_consulta,hora_ini,hora_fin from horas_doctor ';
			$sql.= 'where doctor='.$doctor.' and '; 
			$sql.= 'hora_consulta="Reservada" and ';
			$sql.= 'dias like "%'.$dia.'%" ';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function citas_doctor($doctor,$fecha){
			$this->load->database();
			$sql = 'select * from cita ';
			$sql.= 'where doctor='.$doctor.' and fecha="'.$fecha.'"';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function citas_ocupadas_doctor($doctor,$fecha){
			$this->load->database();
			$sql = 'select * from cita ';
			$sql.= 'where doctor='.$doctor.' and fecha="'.$fecha.'" ';
			$sql.= 'and (status="Asignada" or status="Confirmada") ';
			$sql.= 'order by hora asc ';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}

		function horas_ocupadas_doctor($doctor,$fecha){
			$this->load->database();
			$sql = 'select * from horas_doctor ';
			$sql.= 'where doctor='.$doctor.' and fecha="'.$fecha.'" ';
			$sql.= 'and (hora_consulta="Reservada" or hora_consulta="No") ';
			$sql.= 'order by hora_ini desc ';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function horario_dia($fecha){
			$this->load->database();
			$sql = 'select * from horas_doctor where fecha_ini = '.$fecha.'';
			if($query->num_rows()>0){
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
		
		function buscar_id($id){
        	$this->load->database();
        	$this->db->where('id',$id);
			$query = $this->db->get('cita');
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function es_nuevo($paciente){
			$this->load->database();
        	$this->db->where('id',$paciente);
			$query = $this->db->get('paciente');
			if($query->num_rows()>0){
				return $query->row();
			}else{
				return FALSE;
			}
		}
		
		function prioridades(){
			$this->load->database();
			$query = $this->db->get('tabla_cita_prioridades');
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function borrar($id){
			$this->load->database();
        	$this->db->where('id',$id);
			$this->db->delete('cita');
		}
		
		function modificar($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('cita', $datos);
			$this->db->where('id', $id);
			$query = $this->db->get('cita');
			return $query->row()->fecha;
		}
		
		function buscar_horas_doctor_id_hora($id){
			$this->load->database();
			$this->db->where('id',$id);
			$query = $this->db->get('horas_doctor');
			if($query->num_rows()>0){
				return $query->row();
			}else{
				return FALSE;
			}
		}
		
		function borrar_horas_doctor_id_hora($id){
			$this->load->database();
			$this->db->where('id',$id);
			$this->db->delete('horas_doctor');
		}
		
		function listado_citas_fecha($fecha){
			$this->load->database();
			$sql = 'select p.id as paciente, p.nombre, p.ap, p.am,p.tipo, '; 
			$sql.= 'p.tel_casa, p.tel_oficina, p.ext_oficina, p.cel1, p.cel2, p.radio, p.radio_id, ';
			$sql.= 'c.id,c.status,c.pagada,c.fecha,c.hora,c.tipo  from cita as c, paciente as p ';
			$sql.= 'where c.paciente = p.id and c.fecha="'.$fecha.'" order by c.hora asc';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}

		function listado_citas_nombre($nombre){
			$this->load->database();
			$sql = 'select p.id as paciente, p.nombre, p.ap, p.am,p.tipo, '; 
			$sql.= 'p.tel_casa, p.tel_oficina, p.ext_oficina, p.cel1, p.cel2, p.radio, p.radio_id, ';
			$sql.= 'c.id,c.status,c.pagada,c.fecha,c.hora,c.tipo';
        	$sql.= ' from cita as c, paciente as p where c.paciente = p.id ';
			$sql.= 'and (p.nombre like "%'.$nombre.'%" ';
			$sql.= 'or p.ap like "%'.$nombre.'%" ';
			$sql.= 'or p.am like "%'.$nombre.'%" ';
			$sql.= "or concat_ws(' ',nombre,ap,am) ";//formateo del nombre completo para buscar coincidencias
			$sql.= 'like "%'.$nombre.'%" ';
			$sql.= "or concat_ws(' ',ap,am) ";//formateo de los apellidos para buscar coincidencias
			$sql.= 'like "%'.$nombre.'%" ';
			$sql.= "or concat_ws(' ',nombre,ap) ";//formateo del nombre y el ap. parterno para buscar coincidencias
			$sql.= 'like "%'.$nombre.'%" ';
			$sql.= "or concat_ws(' ',nombre,am) ";//formateo del nombre y el ap. materno para buscar coincidencias
			$sql.= 'like "%'.$nombre.'%" )';
			$sql.= ' order by c.hora asc';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}

		function listado_espera_fecha($fecha,$hora){
			switch($fecha->format('D')){
				case 'Mon':{$dia = 'Lun';break;}
				case 'Tue':{$dia = 'Mar';break;}
				case 'Wed':{$dia = 'Mie';break;}
				case 'Thu':{$dia = 'Jue';break;}
				case 'Fri':{$dia = 'Vie';break;}
				case 'Sat':{$dia = 'Sab';break;}
				case 'Sun':{$dia = 'Dom';break;}
			}
			$this->load->database();
			$sql = 'select p.id as paciente, p.nombre, p.ap, p.am,p.tipo,p.tel_casa, p.tel_oficina, p.ext_oficina, ';
			$sql.= 'p.cel1, p.cel2, p.radio, p.radio_id,c.id,c.status,c.pagada,c.fecha,c.hora,c.tipo from ';
    		$sql.= 'cita as c, ';
			$sql.= '(select * from paciente as pac, ';
			$sql.= "(select paciente from paciente_preferencia_hora ";
			$sql.= "where ";
			$sql.= "dias like '%".$dia."%' ";
			// Inicio Preferencia por hora
			if($hora){
				$sql.= "and ("; 
				$sql.= "(hora_nombre='E' and hora_ini>='".$fecha->format('H:i:s')."' and '".$fecha->format('H:i:s')."'<=hora_fin) or ";
				$sql.= "(hora_nombre='".$fecha->format('A')."') ";
				$sql.= ")";
			}
			//Fin de Preferencia por hora
			$sql.= ") as pref ";
			$sql.= 'where pac.id = pref.paciente) as p ';
    		$sql.= "where c.paciente = p.id and c.fecha>='".$fecha->format("Y-m-d")."' ";
    		$sql.= "and c.lista_espera = 'Si' order by c.prioridad desc ";
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}

		function listado_espera_fecha_cancelacion($fecha,$paciente){
			switch($fecha->format('D')){
				case 'Mon':{$dia = 'Lun';break;}
				case 'Tue':{$dia = 'Mar';break;}
				case 'Wed':{$dia = 'Mie';break;}
				case 'Thu':{$dia = 'Jue';break;}
				case 'Fri':{$dia = 'Vie';break;}
				case 'Sat':{$dia = 'Sab';break;}
				case 'Sun':{$dia = 'Dom';break;}
			}
			$this->load->database();
			$sql = 'select p.id as paciente, p.nombre, p.ap, p.am,p.tipo,p.tel_casa, p.tel_oficina, p.ext_oficina, ';
			$sql.= 'p.cel1, p.cel2, p.radio, p.radio_id,c.id,c.status,c.pagada,c.fecha,c.hora,c.tipo from ';
    		$sql.= 'cita as c, ';
			$sql.= '(select * from paciente as pac, ';
			$sql.= "(select paciente from paciente_preferencia_hora ";
			$sql.= "where ";
			$sql.= "dias like '%".$dia."%' and ("; 
			$sql.= "(hora_nombre='E' and hora_ini<='".$fecha->format('H:i:s')."' and '".$fecha->format('H:i:s')."'<hora_fin) or ";
			$sql.= "(hora_nombre='".$fecha->format('A')."') ";
			$sql.= ") and paciente != ".$paciente." ";
			$sql.= ") as pref ";
			$sql.= 'where pac.id = pref.paciente) as p ';
    		$sql.= 'where c.paciente = p.id and c.fecha>="'.$fecha->format("Y-m-d").'" ';
			$sql.= "and c.lista_espera = 'Si' ";
			$sql.= 'and c.status="Asignada" order by c.prioridad desc';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		function listado_citas_doctor($doctor,$fecha){
			$this->load->database();
			$sql = 'select p.id as paciente, p.nombre, p.ap, p.am,p.tipo, '; 
			$sql.= 'p.tel_casa, p.tel_oficina, p.ext_oficina, p.cel1, p.cel2, p.radio, p.radio_id, ';
			$sql.= 'c.id,c.status,c.pagada,c.fecha,c.hora,c.tipo  from cita as c, paciente as p ';
			$sql.= 'where c.paciente = p.id and c.fecha="'.$fecha.'" and c.doctor='.$doctor.' and c.status="Confirmada" order by c.hora asc';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
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