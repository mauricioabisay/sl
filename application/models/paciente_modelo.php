<?php
    /**
     * 
     */
    class Paciente_modelo extends CI_Model {
        
		function agregar_paciente($datos){
			$this->load->database();
			$this->db->insert('paciente', $datos);
			return $this->db->insert_id();
		}
		
		function modificar_paciente($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('paciente', $datos);
		}
		
		function agregar_direccion($datos){
			$this->load->database();
			$this->db->insert('direccion', $datos);
			return $this->db->insert_id();
		}
		
		function modificar_direccion($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('direccion', $datos);
		}
		
		function agregar_responsable($datos){
			$this->load->database();
			
			$responsable['nombre'] = $datos['nombre'];
			$responsable['ap'] = $datos['ap'];
			$responsable['am'] = $datos['am'];
			$responsable['parentesco'] = $datos['parentesco'];
			
			if(isset($datos['mail']))
				$responsable['mail'] = $datos['mail'];
			if(isset($datos['tel_casa']))
				$responsable['tel_casa'] = $datos['tel_casa'];
			if(isset($datos['tel_oficina']))
				$responsable['tel_oficina'] = $datos['tel_oficina'];
			if(isset($datos['ext_oficina']))
				$responsable['ext_oficina'] = $datos['ext_oficina'];
			if(isset($datos['cel']))	
				$responsable['cel'] = $datos['cel'];
			
			$this->db->insert('responsable', $responsable);
			$id_responsable = $this->db->insert_id();
			
			$this->db->where('id', $datos['paciente']);
			$this->db->query('update paciente set responsable = '.$id_responsable.' where id = '.$datos['paciente'].'');
		}
		
		function modificar_responsable($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('responsable', $datos);
		}
        
        function buscar($where){
        	$this->load->database();
        	$sql = 'select id, nombre, ap, am, nick, sexo, date_format(fecha_ini,"%d-%b-%Y") as fecha_ini ';
        	$sql.= 'from paciente ';
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
        	$sql = 'select id, nombre, ap, am, nick, sexo, edo_civil, '; 
        	$sql.= 'date_format(fecha_ini,"%d-%m-%Y") as fecha_ini, date_format(fecha_nac,"%d-%m-%Y") as fecha_nac, ';
			$sql.= 'referencia, rfc, ocupacion, ';
			$sql.= 'tel_casa, tel_oficina, ext_oficina, cel1, cel2, radio, radio_id, mail1, mail2, mail3, ';
			$sql.= 'direccion, direccion_fiscal, responsable, ';
			$sql.= 'tipo,servicio_alimentos ';
        	$sql.= 'from paciente ';
			$sql.= 'where id = '.$id.'';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }

		function buscar_responsable($id){
			$this->load->database();
			$sql = 'select  id, nombre, ap, am, parentesco, mail, tel_casa, tel_oficina, ext_oficina, cel, ';
			$sql.= "concat_ws(' ',nombre,ap,am) as nombre_completo ";
			$sql.= 'from responsable ';
			$sql.= 'where id = '.$id.'';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return FALSE;
			}
		}
		
		function buscar_direccion($id){
			$this->load->database();
			$sql = 'select calle, num_ext, num_int, colonia, ciudad, estado, cp ';
			$sql.= 'from direccion ';
			$sql.= 'where id = '.$id.'';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return FALSE;
			}
		}
		
		function buscar_nombre($nombre){
        	$this->load->database();
        	$sql = 'select id, nombre, ap, am, nick, sexo, date_format(fecha_ini,"%d-%b-%Y") as fecha_ini, tipo, ';
			$sql.= "concat_ws(' ',nombre,ap,am) as nombre_completo ";
        	$sql.= 'from paciente ';
			$sql.= 'where nombre like "%'.$nombre.'%" ';
			$sql.= 'or ap like "%'.$nombre.'%" ';
			$sql.= 'or am like "%'.$nombre.'%" ';
			$sql.= "or concat_ws(' ',nombre,ap,am) ";//formateo del nombre completo para buscar coincidencias
			$sql.= 'like "%'.$nombre.'%" ';
			$sql.= "or concat_ws(' ',ap,am) ";//formateo de los apellidos para buscar coincidencias
			$sql.= 'like "%'.$nombre.'%" ';
			$sql.= "or concat_ws(' ',nombre,ap) ";//formateo del nombre y el ap. parterno para buscar coincidencias
			$sql.= 'like "%'.$nombre.'%" ';
			$sql.= "or concat_ws(' ',nombre,am) ";//formateo del nombre y el ap. materno para buscar coincidencias
			$sql.= 'like "%'.$nombre.'%" ';
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
			//Borrando Comentarios
			$this->db->where('paciente',$id);
			$this->db->delete('comentario');
			
			//Borrando Antecedentes No Patologicos
			$this->db->where('paciente',$id);
			$query = $this->db->get('antecedentes');
			$resultados = $query->result();
			foreach($resultados as $r){
			$this->db->where('antecedente',$r->id);
			$this->db->delete('ejercicio');
			}
			$this->db->where('paciente',$id);
			$this->db->delete('antecedentes');
			
			//Borrando Citas
			$this->db->where('paciente',$id);
			$this->db->delete('cita');
			
			//Borrando Evaluaciones Primera Vez
			$this->db->where('paciente',$id);
			$this->db->delete('eval_1a_vez');
			
			//Borrando Evaluaciones Dieteticas
			$this->db->where('paciente',$id);
			$query = $this->db->get('eval_dietetica');
			$resultados = $query->result();
			foreach($resultados as $r){
			$this->db->where('eval_dietetica',$r->id);
			$this->db->delete('habitos_alimenticios');
			$this->db->where('eval_dietetica',$r->id);
			$this->db->delete('frec_alimentos');
			$this->db->where('eval_dietetica',$r->id);
			$this->db->delete('hist_peso');
			}
			$this->db->where('paciente',$id);
			$this->db->delete('eval_dietetica');
			
			//Borrando Evaluaciones Antropometricas
			$this->db->where('paciente',$id);
			$query = $this->db->get('evaluacion');
			$resultados = $query->result();
			foreach($resultados as $r){
			$this->db->where('id_eval',$r->id);
			$this->db->delete('eval_tanita');
			$this->db->where('evaluacion',$r->id);
			$this->db->delete('eval_seguimiento');
			
			$this->db->where('evaluacion',$r->id);
			$query2 = $this->db->get('calculo_energetico');
			$resultados2 = $query2->result();
			foreach($resultados2 as $r2){
			$this->db->where('calculo_energetico',$r->id);
			$this->db->delete('calculo_energetico_factor');
			}
			$this->db->where('evaluacion',$r->id);
			$this->db->delete('calculo_energetico');
			}
			
			//Borrando Laboratorios
			$this->db->where('paciente',$id);
			$query = $this->db->get('laboratorio');
			$resultados = $query->result();
			foreach($resultados as $r){
			$this->db->where('laboratorio',$r->id);
			$this->db->delete('laboratorio_estudio');
			}
			$this->db->where('paciente',$id);
			$this->db->delete('laboratorio');
			
			//Borrando Medicamentos
			$this->db->where('paciente',$id);
			$query = $this->db->get('medicamento');
			$resultados = $query->result();
			foreach($resultados as $r){
			$this->db->where('medicamento',$r->id);
			$this->db->delete('medicamento_horario');
			}
			$this->db->where('paciente',$id);
			$this->db->delete('medicamento');
			
			//Borrando Preferencias Horario
			$this->db->where('paciente',$id);
			$this->db->delete('paciente_preferencia_hora');
			$this->db->where('paciente',$id);
			$this->db->delete('paciente_preferencia_horario');
			
			//Borrando Antecedentes Patologicos
			$this->db->where('paciente',$id);
			$this->db->delete('patologia_paciente');
			
			//Borrando Datos Personales
			$this->db->where('id',$id);
			$this->db->delete('paciente');
		}

		function edad($id){
			$hoy = new DateTime();
			
			$this->load->database();
			$this->db->where('id', $id);
			$query = $this->db->get('paciente');
			$paciente = $query->row();
			
			$fecha_nac = DateTime::createFromFormat('Y-m-d',$paciente->fecha_nac);
			
			$edad = ($fecha_nac)?date_diff($hoy, $fecha_nac):FALSE;
			return ($edad)?$edad->format('%Y años, %m meses, %d días'):FALSE;
		}
		
		function edad_num($id,$fecha){
			
			$this->load->database();
			$this->db->where('id', $id);
			$query = $this->db->get('paciente');
			$paciente = $query->row();
			
			$fecha_nac = DateTime::createFromFormat('Y-m-d',$paciente->fecha_nac);
			$fecha_eval = DateTime::createFromFormat('Y-m-d',$fecha);
			$edad = date_diff($fecha_eval, $fecha_nac);
			
			$valor_edad = $edad->y;
			$valor_edad = $valor_edad + ($edad->m/12);
			
			return $valor_edad;
		}
		
		function es_menor($id){
			$hoy = new DateTime();
			
			$this->load->database();
			$this->db->where('id', $id);
			$query = $this->db->get('paciente');
			$paciente = $query->row();
			
			$fecha_nac = DateTime::createFromFormat('Y-m-d',$paciente->fecha_nac);
			
			$edad = ($fecha_nac)?date_diff($hoy, $fecha_nac):FALSE;
			
			if($edad){
				if($edad->y >= 18){
					return false;
				}else{
					return true;
				}	
			}else{
				return false;
			}
		}
		
		function es_mujer($id){
			$this->load->database();
			$this->db->where('id', $id);
			$query = $this->db->get('paciente');
			$paciente = $query->row();
			
			if($paciente->sexo == 'Femenino'){
				return TRUE;
			}else{
				return FALSE;
			}
		}
    }
?>