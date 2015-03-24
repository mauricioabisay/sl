<?php
    /**
     * 
     */
    class Plan_alimenticio_modelo extends CI_Model {
        
		function agregar($datos){
			$this->load->database();
			$this->db->insert('plan_alimenticio', $datos);
			return $this->db->insert_id();
		}
        
        function buscar($where){
        	$this->load->database();
			$query = $this->db->query($where);
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
			$query = $this->db->get('plan_alimenticio');
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_plan($id,$mujer){
			$this->load->database();
			if($mujer){
				$sql = 'select * from tabla_plan_alimenticio_mujeres ';
			}else{
				$sql = 'select * from tabla_plan_alimenticio_hombres ';
			}
			$sql .= 'where id = '.$id.' ';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row();				
			}else{
				return FALSE;
			}
		}
		
		function buscar_alimentos($id,$mujer){
			$this->load->database();
			if($mujer){
				$sql = 'select * from tabla_plan_alimenticio_alimento_mujeres ';
			}else{
				$sql = 'select * from tabla_plan_alimenticio_alimento_hombres ';
			}
			$sql .= 'where plan_alimenticio = '.$id.' ';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->result();				
			}else{
				return FALSE;
			}
		}
		
		function borrar($id){
			$this->load->database();
        	$this->db->where('id',$id);
			$this->db->delete('plan_alimenticio');
		}
		
		function modificar($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('laboratorio', $datos);
		}
		
		function listado_mini($paciente,$inicio){
        	$this->load->database();
			$sql = 'select id,fecha from plan_alimenticio ';
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
			$sql = 'select b.id,fecha from evaluacion as a,(select id,evaluacion as eval from calculo_energetico) as b ';
			$sql.= 'where a.id = b.eval and paciente = '.$paciente.' ';
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function agregar_nuevo($datos,$sexo){
			$this->load->database();
			$this->db->insert('tabla_plan_alimenticio_'.$sexo, $datos);
			return $this->db->insert_id();
		}
		
		function agregar_nuevo_plan_alimento($datos,$sexo){
			$this->load->database();
			$this->db->insert('tabla_plan_alimenticio_alimento_'.$sexo, $datos);
			return $this->db->insert_id();
		}
		
		function buscar_nuevo_plan($id_plan,$sexo){
			$this->load->database();
			$sql = 'select * ';
			$sql .=' from tabla_plan_alimenticio_'.$sexo.'';
			$sql .= ' where id ='.$id_plan ;
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
		}
		
		function buscar_nuevo_plan_alimento($id_plan,$sexo){
			$this->load->database();
			$sql = 'select * ';
			$sql .=' from tabla_plan_alimenticio_alimento_'.$sexo.'';
			$sql .= ' where plan_alimenticio ='.$id_plan ;
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
		}
        
		function modificar_nuevo($datos,$sexo, $id){
			$this->load->database();			
			$this->db->where('id', $id);
			$this->db->update('tabla_plan_alimenticio_'.$sexo, $datos);
		}
		
		function modificar_nuevo_plan_alimento($datos,$sexo,$id,$id_plan_alimento){
			$this->load->database();			
			$this->db->where('plan_alimenticio', $id);
			$this->db->where('id', $id_plan_alimento);
			$this->db->update('tabla_plan_alimenticio_alimento_'.$sexo, $datos);
		}
		
		function eliminar($id, $sexo){
			
			$this->load->database();
			$this->db->where('plan_alimenticio',$id);
			$this->db->delete('tabla_plan_alimenticio_alimento_'.$sexo);
			
        	$this->db->where('id',$id);
			$this->db->delete('tabla_plan_alimenticio_'.$sexo);
			
			
		}
		
    }
?>