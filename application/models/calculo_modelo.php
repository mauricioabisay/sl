<?php
    /**
     * 
     */
    class Calculo_modelo extends CI_Model {
        
		function agregar($datos){
			$this->load->database();
			$this->db->insert('calculo_energetico_factor', $datos);
			return $this->db->insert_id();
		}
		
		function agregar_consumo_energetico($datos){
			$this->load->database();
			$this->db->insert('calculo_energetico', $datos);
			return $this->db->insert_id();
		}
        
        function buscar($paciente){
        	$this->load->database();
        	$this->db->where('paciente',$paciente);
			$query = $this->db->get('calculo_energetico');
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
        }
		
		function calculo_reciente($paciente){
			$this->load->database();
			$sql = 'select b.id as id,fecha,b.eval as evaluacion,b.consumo_energetico as consumo_energetico,b.calorimetro as calorimetro ';
			$sql.= 'from evaluacion as a, ';
			$sql.= '(select id,evaluacion as eval,consumo_energetico,calorimetro from calculo_energetico) as b ';
			$sql.= 'where a.id = b.eval and paciente = '.$paciente.' order by fecha desc';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return FALSE;
			}
		}
		
		function buscar_calculo_energetico_factores($consumo){
        	$this->load->database();
        	$sql = 'select nombre,factor,formula,tipo from calculo_energetico_factor as a,(select id,nombre,formula,tipo from tabla_variables_calculo_energetico) as b ';
			$sql.= 'where b.id=a.variable and calculo_energetico = '.$consumo.'';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_consumo($id){
        	$this->load->database();
        	$this->db->where('id',$id);
			$query = $this->db->get('calculo_energetico');
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
        }
		
		function buscar_variable_calculo_energetico($id){
			$this->load->database();
			$this->db->where('id',$id);
			$query = $this->db->get('tabla_variables_calculo_energetico');
			if($query->num_rows() > 0){
				return $query->row();
			}
			else {
				return FALSE;
			}
		}
		
		function borrar($id){
			$this->load->database();
			$sql = 'delete from calculo_energetico_factor where calculo_energetico = '.$id;
			$this->db->query($sql);
			$sql = 'delete from plan_alimenticio where calculo = '.$id;
			$this->db->query($sql);
        	$this->db->where('id',$id);
			$this->db->delete('calculo_energetico');
		}
		
		function modificar($id, $datos){
			$this->load->database();
			$this->db->where('id', $id);
			$this->db->update('calculo_energetico', $datos);
		}
		
		function listado($paciente){
        	$this->load->database();
			$sql = 'select b.id as id,fecha,b.eval as evaluacion,b.consumo_energetico as consumo_energetico,b.calorimetro as calorimetro ';
			$sql.= 'from evaluacion as a, ';
			$sql.= '(select id,evaluacion as eval,consumo_energetico,calorimetro from calculo_energetico) as b ';
			$sql.= 'where a.id = b.eval and paciente = '.$paciente.' ';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
        }
		
		function listado_mini($paciente,$inicio){
        	$this->load->database();
			$sql = 'select b.id as id,fecha from evaluacion as a,(select id,evaluacion as eval from calculo_energetico) as b ';
			$sql.= 'where a.id = b.eval and paciente = '.$paciente.' ';
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
		
		function tabla_harris_factor(){
			$this->load->database();
			$this->db->where('formula','harris');
			$this->db->where('tipo','factor');
			$query = $this->db->get('tabla_variables_calculo_energetico');
			return $query->result();
		}
		
		function tabla_harris_actividad_fisica(){
			$this->load->database();
			$this->db->where('formula','harris');
			$this->db->where('tipo','actividad');
			$query = $this->db->get('tabla_variables_calculo_energetico');
			return $query->result();
		}
		
		function tabla_harris_condiciones_especiales(){
			$this->load->database();
			$this->db->where('formula','harris');
			$this->db->where('tipo','condicion');
			$query = $this->db->get('tabla_variables_calculo_energetico');
			return $query->result();
		}
		
		function tabla_shanblogue_actividad_fisica(){
			$this->load->database();
			$this->db->where('formula','shanblogue');
			$this->db->where('tipo','actividad');
			$query = $this->db->get('tabla_variables_calculo_energetico');
			return $query->result();
		}
		
		function tabla_shanblogue_condiciones_especiales(){
			$this->load->database();
			$this->db->where('formula','shanblogue');
			$this->db->where('tipo','condicion');
			$query = $this->db->get('tabla_variables_calculo_energetico');
			return $query->result();
		}
    }
?>