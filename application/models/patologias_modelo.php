<?php
    /**
     * 
     */
    class Patologias_modelo extends CI_Model {
        
		//Agrega una nueva patología
		function agregar($datos){
			$this->load->database();
			$this->db->insert('patologia', $datos);
			return $this->db->insert_id();
		}
		
		//Modifica los datos de una patología recibiendo el id de la misma
		function modificar_id($id,$datos){
			$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('patologia', $datos);
			return $this->db->insert_id();
		}
		
		//Modifica la clasificación recibiendo el id de la misma
		function modificar_clasificacion($id,$datos){
			$this->load->database();
			$this->db->where('id',$id);
			$this->db->update('clasificacion_patologia', $datos);
			return $this->db->insert_id();
		}
		
		//Busca los valores de una patología recibiendo su id
		function buscar($datos){
			$this->load->database();
			$this->db->where('id', $datos);
			$q2 = $this->db->select('*');
			$q2 = $this->db->get('patologia');
			
			foreach ($q2->result_array() as $row2){
				$data[] = $row2;
			}
			return($data);
			
		}
		
		//Se trae la clasificacion de la patología seleccionada
		function buscar_clasificacion($id)
		{
			$this->load->database();
			$sql = 'select clasificacion_patologia.clasificacion as clasificacion,patologia.id as id,patologia.clasificacion as id_clasificacion, ';
			$sql.='nombre, caracteristicas from patologia,clasificacion_patologia ';
			$sql.= 'where patologia.id = '.$id.' and patologia.clasificacion = clasificacion_patologia.id ';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->result();
			}
			else {
				return FALSE;
			}
		}
		
		//Elimina el registro de la patología
		function eliminar($datos){
			$this->load->database();
			$this->db->where('id', $datos);
			$this->db->delete('patologia');
		}
		
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
		
		//Obtiene las patologías según la clasificación seleccionada
	    function obtenerPatologias($id)
	    {
	        $data=array();
			$this->load->database();
			$q2 = $this->db->select('*');
			$q2 = $this->db->where('clasificacion',$id);
			$q2 = $this->db->get('patologia');
			foreach ($q2->result_array() as $row2){
				$data[] = $row2;
			}
			return($data);
	    }
			
		
    }
?>