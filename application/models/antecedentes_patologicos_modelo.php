<?php
    /**
     * 
     */
    class Antecedentes_patologicos_modelo extends CI_Model {    		    	function buscar_patologias_paciente($paciente){			$this->load->database();			$sql = 'select p.nombre as nombre,p.caracteristicas as recomendacion '; 			$sql.= 'from patologia as p,patologia_paciente as pp '; 			$sql.= 'where p.id=pp.patologia and pp.paciente='.$paciente.' ';			$query = $this->db->query($sql);			if($query->num_rows() > 0){				return $query->result();			}else{				return FALSE;			}		}
    	//Obtiene las clasificaciones existentes 
		function obtenerClasificaciones()
	    {
	        $data=array();
			$this->load->database();
			$q2 = $this->db->select('*');
			$q2 = $this->db->get('clasificacion_patologia');
			foreach ($q2->result_array() as $row2){
				$data[] = $row2;
			}
			return($data);
	    }
		
		function buscar_id($id){
        	$this->load->database();
        	$this->db->where('id',$id);
			$query = $this->db->get('patologia_paciente');
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_no_hereditaria($paciente,$patologia){
        	$this->load->database();
        	$sql = 'select id from patologia_paciente ';
			$sql .='where paciente= '.$paciente.' and patologia ='.$patologia.' and hereditaria = "No"';
			$query=$this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_hereditaria($paciente,$patologia){
        	$this->load->database();
        	$sql = 'select id from patologia_paciente ';
			$sql .='where paciente= '.$paciente.' and patologia ='.$patologia.' and hereditaria = "Si"';
			$query=$this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function listar_patologias($id){
			$data=array();
			$this->load->database();			
			$sql = 'select clasificacion_patologia.clasificacion as clasificacion,nombre as patologia,patologia_paciente.patologia as id_patologia ';
			$sql .='parentesco, hereditaria from patologia, clasificacion_patologia, patologia_paciente ';
			$sql .='where patologia_paciente.patologia=patologia.id and patologia.clasificacion=clasificacion_patologia.id ';
			$sql .='and paciente='.$id.'';
			$q2=$this->db->query($sql);
			foreach ($q2->result_array() as $row2){
				$data[] = $row2;
			}
			return($data);
		}
		
		function listar_patologias_fecha($paciente,$fecha){
			$data=array();
			$this->load->database();			
			$sql = 'select clasificacion_patologia.clasificacion as clasificacion,nombre as patologia, patologia as id_patologia, ';
			$sql .='parentesco, otro_parentesco, hereditaria, status,date_format(fecha_id,"%d-%m-%y") as fecha_id from patologia, clasificacion_patologia, patologia_paciente ';
			$sql .='where patologia_paciente.patologia=patologia.id and patologia.clasificacion=clasificacion_patologia.id ';
			$sql .='and patologia_paciente.paciente = '.$paciente.' ';
			$sql .='and patologia_paciente.fecha_id <= "'.$fecha.'" order by fecha_id asc';
			$q2=$this->db->query($sql);
			foreach ($q2->result_array() as $row2){
				$data[] = $row2;
			}
			return($data);
		}					
		function buscar_patologias()
	    {
	        $data=array();
			$this->load->database();			
			$sql = 'select * from patologia order by nombre asc';
			$q2=$this->db->query($sql);
			foreach ($q2->result_array() as $row2){
				$data[] = $row2;
			}
			return($data);
	    }
		
		function agregar_patologia($datos){
			$this->load->database();
			$this->db->insert('patologia', $datos);
			return $this->db->insert_id();
		}
		
		function agregar($datos){
			$this->load->database();
			$this->db->insert('patologia_paciente', $datos);
			return $this->db->insert_id();
		}
		
		function modificar($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('patologia_paciente', $datos);
		}
		
		function borrar($paciente,$fecha){
			$this->load->database();
			$this->db->where('fecha_id',$fecha);
			$this->db->where('paciente',$paciente);
			$this->db->delete('patologia_paciente');
		}

		function borrar_id($id){
			$this->load->database();
			$this->db->where('id',$id);
			$this->db->delete('patologia_paciente');
		}
		
		function existe($paciente){
        	$this->load->database();
        	$this->db->where('paciente',$paciente);
			$query = $this->db->get('patologia_paciente');
			if($query->num_rows() > 0){
				return $query->last_row();
			}
			else {
				return FALSE;
			}
        }
		
		function listado_mini($paciente,$inicio){
        	$this->load->database();
			$sql = 'select id,fecha_id from patologia_paciente ';
			$sql.= 'where paciente = '.$paciente.' group by fecha_id ';
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
			$query = $this->db->get('patologia_paciente');
			return $query->num_rows();
		}
		
		
	}
?>