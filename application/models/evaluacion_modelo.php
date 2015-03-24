<?php
    /**
     * 
     */
    class Evaluacion_modelo extends CI_Model {
        
		function agregar_evaluacion($datos){
			$this->load->database();
			$this->db->insert('evaluacion', $datos);
			$valor_retorno = $this->db->insert_id();
//Obtenemos los antecedentes no patologicos mas recientes
			$sql = 'select * from antecedentes,(select max(fecha_id) as fecha_max from antecedentes '; 
			$sql.= 'where paciente='.$datos["paciente"].') as a '; 
			$sql.= 'where fecha_id=fecha_max order by id desc';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
//Existen antecedentes no patologicos capturados
				$antecedentes = $query->row();
				if($antecedentes->embarazo == 'Si'){
	//Los antecedentes mas recientes indican embarazo
					$embarazo_previo = TRUE;
					if($datos['embarazo']=='No'){
						$sql = 'insert into antecedentes (';
						$sql.='paciente,';
						$sql.='alcohol,';
						$sql.=($antecedentes->alcohol=="Si")?'alcohol_valor_frec,alcohol_tipo_frec,alcohol_tipo,copas,':'';
						$sql.='fuma,';
						$sql.=($antecedentes->fuma=="Si")?'fuma_valor,fuma_tiempo,cigarros,fuma_tipo_frec,':'';
						$sql.='embarazo,gesta,semana,lactancia,';
						//$sql.='ejercicio,alcohol_otro,';
						$sql.='fecha_id,';
						$sql.='peso_pregestacional) ';
						$sql.= 'values (';
						$sql.=''.$antecedentes->paciente.',';
						$sql.='"'.$antecedentes->alcohol.'",';
						$sql.=($antecedentes->alcohol=="Si")?$antecedentes->alcohol_valor_frec.','.$antecedentes->alcohol_tipo_frec.','.$antecedentes->alcohol_tipo.','.$antecedentes->copas.',':'';
						$sql.='"'.$antecedentes->fuma.'",';
						$sql.=($antecedentes->fuma=="Si")?$antecedentes->fuma_valor.','.$antecedentes->fuma_tiempo.','.$antecedentes->cigarros.','.$antecedentes->fuma_tipo_frec.',':'';
						$sql.='"No",';//Embarazo No
						$sql.=''.($antecedentes->gesta).',0,';
						$sql.='"No",';//Lactancia NO
						//$sql.=''.$antecedentes->ejercicio.','.$antecedentes->alcohol_otro.',';
						$sql.="'".date('Y-m-d')."'";
						$sql.=','.$datos['peso'].'';
						//$sql.='peso_total_esperado.','.$antecedentes->peso_pregestacional) ';
						$sql.=')';
						$this->db->query($sql);	
					}
				}else if($datos['embarazo']=='Si'){
	//Los antecedentes mas recientes no indican embarazo
					$embarazo_previo = FALSE;
					$sql = 'insert into antecedentes (';
					$sql.='paciente,alcohol,alcohol_valor_frec,alcohol_tipo_frec,alcohol_tipo,copas,';
					$sql.='fuma,fuma_valor,fuma_tiempo,cigarros,fuma_tipo_frec,';
					$sql.='embarazo,gesta,semana,lactancia,';
					$sql.='ejercicio,alcohol_otro,';
					$sql.='fecha_id,';
					$sql.='peso_total_esperado,peso_pregestacional) ';
					$sql.= 'values (';
					$sql.=''.$antecedentes->paciente.','.$antecedentes->alcohol.','.$antecedentes->alcohol_valor_frec.','.$antecedentes->alcohol_tipo_frec.','.$antecedentes->alcohol_tipo.','.$antecedentes->copas.',';
					$sql.=''.$antecedentes->fuma.','.$antecedentes->fuma_valor.','.$antecedentes->fuma_tiempo.','.$antecedentes->cigarros.','.$antecedentes->fuma_tipo_frec.',';
					$sql.='"Si",';//Embarazo SI
					$sql.=''.($antecedentes->gesta+1).','.$datos['semana_gesta'].',';
					$sql.='"No",';//Lactancia NO
					$sql.=''.$antecedentes->ejercicio.','.$antecedentes->alcohol_otro.',';
					$sql.=date('Y-m-d');
					$sql.=','.$datos['peso_pre_gesta'].'';
					//$sql.='peso_total_esperado.','.$antecedentes->peso_pregestacional) ';
					$sql.=')';
					$this->db->query($sql);
				}		
			}else{
//No hay antecedentes patologicos capturados
				if($datos['embarazo']=='Si'){
					$antecedentes_default['paciente'] = $datos['paciente'];
					$antecedentes_default['alcohol'] = 'No';
					$antecedentes_default['fuma'] = 'No';
					$antecedentes_default['ejercicio'] = 'No';
					$antecedentes_default['embarazo'] = 'Si';
					$antecedentes_default['lactancia'] = 'No';
					$antecedentes_default['gesta'] = 1;
					$antecedentes_default['semana'] = $datos['semana_gesta'];
					$antecedentes_default['fecha_id'] = date('Y-m-d');
					$antecedentes_default['peso_pregestacional'] = $datos['peso_pre_gesta'];
					$this->db->insert('antecedentes', $antecedentes_default);
				}
				
			}
			return $valor_retorno;
		}

		function modificar_evaluacion($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('evaluacion', $datos);
			
			$this->db->where('paciente',$datos["paciente"]);
			$query = $this->db->get('antecedentes');
			if($query->num_rows()>0){
				$antecedentes = $query->row();
				if($antecedentes->embarazo == 'Si'){
					$embarazo_previo = TRUE;
				}else{
					$embarazo_previo = FALSE;
				}
				$gesta = $antecedentes->gesta;
			}else{
				$embarazo_previo = FALSE;
				$gesta = 0;
			}
			
			$sql = 'update antecedentes set ';
			$sql.= 'embarazo = "'.$datos["embarazo"].'" ';
			if($datos['embarazo']=='Si'){
				$sql.= ',semana = '.$datos["semana_gesta"].' ';
				if(!$embarazo_previo){
					$gesta = $gesta+1;
					$sql.= ',gesta = '.$gesta.' ';
				}	
			}
			$sql.= 'where paciente = '.$datos["paciente"].'';
			$this->db->query($sql);
		}		
		
		function agregar_tanita($datos){
			$this->load->database();
			$this->db->insert('eval_tanita', $datos);
			return $this->db->insert_id();
		}
		
		function modificar_tanita($id,$datos){
			$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('eval_tanita',$datos);
		}
		
		function buscar_datos_tanita($id){
			$this->load->database();
        	$this->db->where('id_eval',$id);
			$query = $this->db->get('eval_tanita');
			if($query->num_rows()>0){
				return $query->result();
			}
			else {
				return FALSE;
			}
		}

		function buscar_tanita_general($id){
			$this->load->database();
        	$sql = 'select * from eval_tanita ';
			$sql.= 'where id_eval = '.$id.' and concepto="General" ';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->row();
			}
			else {
				return FALSE;
			}
		}

		function buscar_tanita_segmentos($id){
			$this->load->database();
        	$sql = 'select * from eval_tanita ';
			$sql.= 'where id_eval = '.$id.' and concepto!="General" ';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}
			else {
				return FALSE;
			}
		}
        
        function buscar($paciente){
        	$this->load->database();
			$sql = 'select id, date_format(fecha,"%d-%b-%Y") as fecha, date_format(fecha,"%d-%m-%Y") as fecha_eval, ';
			$sql.= 'peso, estatura, ';
			$sql.= 'c_cintura, c_cadera, c_muneca, grasa, ';
			$sql.= 'p_biciptal, p_triciptal, p_subescapular, p_suprailiaco, ';
			$sql.= 'perim_cefalico, c_brazo, ';
			$sql.= 'peso_pre_gesta, semana_gesta, fondo_uterino, glucosa, presion, ';
			$sql.= 'paciente ';
			$sql.= 'from evaluacion ';
			$sql.= 'where paciente = '.$paciente.'';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
        }
		
		function buscar_id($id){
        	$this->load->database();
			$sql = 'select *, substring_index(presion,"/",1) as presion_sis,';
			$sql .= 'substring_index(substring_index(presion,"/",2),"/",-1) as presion_dia from evaluacion ';
			$sql .= 'where id ='.$id.'';
			//$this->db->where('id',$id);
			$query = $this->db->query($sql);
			//$query = $this->db->get('evaluacion');
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function borrar($id){
			$this->load->database();
			$this->db->where('evaluacion',$id);
			$query = $this->db->get('calculo_energetico');
			if($query->num_rows > 0){
				$calculo = $query->row();
				$this->db->where('calculo_energetico',$calculo->id);
				$this->db->delete('calculo_energetico_factor');
				$this->db->where('calculo_energetico',$calculo->id);
				$this->db->delete('plan_alimenticio');
			}
			$this->db->where('evaluacion',$id);
			$this->db->delete('calculo_energetico');
			$this->db->where('id_eval',$id);
			$this->db->delete('eval_tanita');
        	$this->db->where('id',$id);
			$this->db->delete('evaluacion');
		}
		
		function datos_embarazo($paciente){
			$this->load->database();
			$sql = 'select peso_pre_gesta, semana_gesta, fondo_uterino, fecha ';
			$sql.= 'from evaluacion ';
			$sql.= 'where paciente = '.$paciente.' AND embarazo = "Si" ';
			$sql.= 'order by fecha desc';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->row();
			}else{
				$sql = 'select embarazo,peso_pregestacional as peso_pre_gesta, semana as semana_gesta, fecha_id as fecha from antecedentes,';
				$sql.= '(select max(fecha_id) as fecha_max from antecedentes '; 
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

		function datos_embarazo_fecha($paciente,$fecha){
			$this->load->database();
			$sql = 'select peso_pre_gesta, semana_gesta, fondo_uterino, fecha ';
			$sql.= 'from evaluacion ';
			$sql.= 'where paciente = '.$paciente.' AND embarazo = "Si" ';
			$sql.= 'AND fecha="'.$fecha.'" ';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return $query->row();
			}else{
				$sql = 'select embarazo,peso_pregestacional as peso_pre_gesta, semana as semana_gesta, semana-4 as fondo_uterino, fecha_id as fecha from antecedentes,';
				$sql.= '(select max(fecha_id) as fecha_max from antecedentes '; 
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
		
		function existen_preguntas_seguimiento($id){
			$this->load->database();
			$this->db->where('evaluacion',$id);
			$query = $this->db->get('eval_seguimiento');
			if($query->num_rows()>0){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		function evaluacion_hoy($paciente){
			$this->load->database();
			$sql = 'select * from evaluacion ';
			$sql.= 'where paciente = '.$paciente.' and fecha = "'.date('Y-m-d').'" order by id desc';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
		}
		
		function evaluacion_reciente($paciente){
			$this->load->database();
			$sql = 'select * from evaluacion,(select max(fecha) as fecha_max from evaluacion) as a ';
			$sql.= 'where paciente = '.$paciente.' and fecha = fecha_max order by id desc';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
		}
		
		function listado_mini($paciente,$inicio){
        	$this->load->database();
			$sql = 'select id,fecha from evaluacion ';
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
			$query = $this->db->get('evaluacion');
			return $query->num_rows();
		}
    }
?>