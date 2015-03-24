<?php
    /**
     * 
     */
    class Preguntas_seguimiento extends CI_Controller {
        
        function __construct() {
            parent::__construct();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->form_validation->set_error_delimiters('<span class="advertencia"><img src="'.base_url().'/assets/img/advertencia.png" width="15px" height="15px"><strong>', '</strong></span>');
        }
		
		function agregar($paciente,$id){
			$this->form_validation->set_rules('perdida_peso','Sensaci&oacute;n perdida de peso','required');
			$this->form_validation->set_rules('conservar','Cosas a &uacute;tiles','max_length[255]');
			$this->form_validation->set_rules('cumplimiento','Grado de Cumplimiento','required|is_natural|less_than[11]');
			$this->form_validation->set_rules('motivacion','Grado de Motivaci&oacute;n','required|is_natural|less_than[11]');
			$this->form_validation->set_rules('desgaste','Grado de Desgaste','required|is_natural|less_than[11]');
		//$this->form_validation->set_rules('meta_fecha','Fecha para alcanzar la meta','required');
			$this->form_validation->set_rules('meta_fecha_valor','Tiempo para alcanzar la meta','required|is_natural_no_zero');
			$this->form_validation->set_rules('meta_fecha_unidad','Tiempo para alcanzar la meta','required');
			$this->form_validation->set_rules('meta_valor','Meta','required|greater_than[0]');
			$this->form_validation->set_rules('hizo_tareas','Cumplimiento de tareas','required');
			if($this->input->post('hizo_tareas')=='No'){
				$this->form_validation->set_rules('tareas','Descripci&oacute;n de tareas','required|max_length[255]|min_length[2]');
			}
			
			$this->form_validation->set_rules('hambre','Sensaci&oacute;n de Hambre','required');
			if($this->input->post('hambre')=='Si'){
				$this->form_validation->set_rules('hambre_hora_relativa','Hora relativa de hambre','max_length[2]|min_length[1]');
				$this->form_validation->set_rules('hambre_horas','','exact_length[2]|numeric');
				$this->form_validation->set_rules('hambre_minutos','','exact_length[2]|numeric');
				$this->form_validation->set_rules('hambre_ampm','','exact_length[2]');
			}
			$this->form_validation->set_rules('ansiedad','Presencia de Ansiedad','required');
			if($this->input->post('ansiedad')=='Si'){
				$this->form_validation->set_rules('ansiedad_hora_relativa','Hora relativa de hambre','max_length[2]|min_length[1]');
				$this->form_validation->set_rules('ansiedad_horas','','exact_length[2]|numeric');
				$this->form_validation->set_rules('ansiedad_minutos','','exact_length[2]|numeric');
				$this->form_validation->set_rules('ansiedad_ampm','','exact_length[2]');
			}
			
			$this->form_validation->set_rules('eliminar_comida','Desea eliminar uno o m&acute;s tiempos de comida','required');
			if($this->input->post('eliminar_comida')=='Si'){
				$this->form_validation->set_rules('tiempo_eliminar','Tiempos a eliminar','required');
				$this->form_validation->set_rules('tiempo_eliminar_razon','Raz&oacute; para eliminar tiempo','required|max_length[255]|min_length[5]');
			}
			$this->form_validation->set_rules('agregar_comida','Desea agregar uno o m&aacute;s tiempos de comida','required');
			if($this->input->post('agregar_comida')=='Si'){
				$this->form_validation->set_rules('tiempo_agregar','Tiempos a agregar','required');
				$this->form_validation->set_rules('tiempo_agregar_razon','Raz&oacute; para agregar tiempo','required|max_length[255]|min_length[5]');
			}
			$this->form_validation->set_rules('alimento_agregar','Alimento que desea agregar','max_length[255]');
			$this->form_validation->set_rules('alimento_eliminar','Alimento que desea eliminar','max_length[255]');
			
			$this->form_validation->set_rules('ejercicio','Hace ejercicio','required');
			if($this->input->post('ejercicio')=='Si'){
				$this->form_validation->set_rules('ejercicio_duracion','Duraci&oacute;n del ejercicio','required|is_natural_no_zero|less_than[65535]');
				$this->form_validation->set_rules('ejercicio_frec','Frecuencia de pr&aacute;ctica','is_natural_no_zero|less_than[8]');
				$this->form_validation->set_rules('ejercicio_tipo','Tipo de ejercicio','required');
				$this->form_validation->set_rules('ejercicio_otro','Especificaci&oacute;n de ejercicio','max_length[30]');
			}
			if($this->input->post()){
				$datos['id_paciente'] = $this->input->post('paciente');
				$datos['id_evaluacion'] = $this->input->post('evaluacion');
				if($this->form_validation->run()){
					$preguntas_seguimiento['evaluacion'] = $this->input->post('evaluacion');
					$preguntas_seguimiento['cumplimiento'] = $this->input->post('cumplimiento');
					
					if($this->input->post('hambre')=='Si'){
						$preguntas_seguimiento['hambre_hora_relativa'] = $this->input->post('hambre_hora_relativa');
						$cadena_aux = ''.$this->input->post('hambre_horas').':'.$this->input->post('hambre_minutos').' '.$this->input->post('hambre_ampm').'';
						$hora_aux = DateTime::createFromFormat('h:i a',$cadena_aux);
						$preguntas_seguimiento['hambre_hora'] = ($hora_aux!=NULL)?$hora_aux->format('H:i:s'):NULL;	
					}
					
					if($this->input->post('ansiedad')=='Si'){
						$preguntas_seguimiento['ansiedad_hora_relativa'] = $this->input->post('ansiedad_hora_relativa');
						$cadena_aux = ''.$this->input->post('ansiedad_horas').':'.$this->input->post('ansiedad_minutos').' '.$this->input->post('ansiedad_ampm').'';
						$hora_aux = DateTime::createFromFormat('h:i a',$cadena_aux);
						$preguntas_seguimiento['ansiedad_hora'] = ($hora_aux!=NULL)?$hora_aux->format('H:i:s'):NULL;	
					}
					
					$preguntas_seguimiento['perdida_peso'] = $this->input->post('perdida_peso');
					
					$cadena_aux = "";
					if($this->input->post('eliminar_comida')=='Si'){
						$tiempo_aux = $this->input->post('tiempo_eliminar');
						for($i=0;$i<sizeof($tiempo_aux);$i++){
							$cadena_aux .= ''.$tiempo_aux[$i].'';
							$cadena_aux .= ($i+1<sizeof($tiempo_aux))?',':'';
						}
						$preguntas_seguimiento['tiempo_eliminar_razon'] = $this->input->post('tiempo_eliminar_razon');	
					}else{
						$cadena_aux = 'No';
					}
					$preguntas_seguimiento['tiempo_eliminar'] = $cadena_aux;
					
					$cadena_aux = "";
					if($this->input->post('agregar_comida')=='Si'){
						$tiempo_aux = $this->input->post('tiempo_agregar');
						for($i=0;$i<sizeof($tiempo_aux);$i++){
							$cadena_aux .= ''.$tiempo_aux[$i].'';
							$cadena_aux .= ($i+1<sizeof($tiempo_aux))?',':'';
						}
						$preguntas_seguimiento['tiempo_agregar_razon'] = $this->input->post('tiempo_agregar_razon');
					}else{
						$cadena_aux = 'No';
					}
					$preguntas_seguimiento['tiempo_agregar'] = $cadena_aux;
					
					$preguntas_seguimiento['alimento_eliminar'] = $this->input->post('alimento_eliminar');
					$preguntas_seguimiento['alimento_agregar'] = $this->input->post('alimento_agregar');
					$preguntas_seguimiento['conservar'] = $this->input->post('conservar');
					$preguntas_seguimiento['motivacion'] = $this->input->post('motivacion');
					$preguntas_seguimiento['desgaste'] = $this->input->post('desgaste');
					
					$fecha_hoy = new DateTime();
					$cadena_aux = 'P'.$this->input->post('meta_fecha_valor').''.$this->input->post('meta_fecha_unidad').'';
					$tiempo_add = new DateInterval($cadena_aux);
					$fecha_hoy->add($tiempo_add);
					$preguntas_seguimiento['meta_fecha'] = $fecha_hoy->format('Y-m-d');
					$preguntas_seguimiento['meta_valor'] = $this->input->post('meta_valor');
					
					if($this->input->post('hizo_tareas')=='No'){
						$preguntas_seguimiento['tareas'] = $this->input->post('tareas');	
					}
					
					if($this->input->post('ejercicio')=='Si'){
						$preguntas_seguimiento['ejercicio_duracion'] = $this->input->post('ejercicio_duracion');
						$preguntas_seguimiento['ejercicio_frec'] = $this->input->post('ejercicio_frec');
						
						$cadena_aux = "";
						$ejercicio_aux = $this->input->post('ejercicio_tipo');
						for($i=0;$i<sizeof($ejercicio_aux);$i++){
							$cadena_aux .= ''.$ejercicio_aux[$i].'';
							$cadena_aux .= ($i+1<sizeof($ejercicio_aux))?',':'';	
						}
						$preguntas_seguimiento['ejercicio_tipo'] = $cadena_aux;
						$preguntas_seguimiento['ejercicio_otro'] = $this->input->post('ejercicio_otro');	
					}
					
					$preguntas_seguimiento['ejercicio'] = $this->input->post('ejercicio');
					$preguntas_seguimiento['hambre'] = $this->input->post('hambre');
					$preguntas_seguimiento['ansiedad'] = $this->input->post('ansiedad');
					$preguntas_seguimiento['hizo_tareas'] = $this->input->post('hizo_tareas');
					
					$this->load->model('preguntas_seguimiento_modelo');
					$this->preguntas_seguimiento_modelo->agregar($preguntas_seguimiento);
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Preguntas de Seguimiento guardadas';
					$this->detalle($datos['id_paciente'], $datos['id_evaluacion']);
				}else{
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					$datos['menu'] = 'menu_paciente';
					$this->load->view('preguntas_seguimiento/preguntas_seguimiento_agregar',$datos);
				}
			}else{
				$datos['id_paciente'] = $paciente;
				$datos['id_evaluacion'] = $id;
				$datos['menu'] = 'menu_paciente';
				$this->load->view('preguntas_seguimiento/preguntas_seguimiento_agregar',$datos);
			}
		}
		
		function busqueda(){
			$datos['id_paciente'] = $paciente;
			$datos['id_evaluacion'] = $id;
			$datos['menu'] = 'menu_paciente';
			$datos['preguntas'] = $this->preguntas_seguimiento_modelo->buscar_evaluacion($id);
			$this->load->view('preguntas_seguimiento/preguntas_seguimiento_ficha',$datos);
		}
		
		function detalle($paciente,$id){
			$this->load->model('preguntas_seguimiento_modelo');
			$datos['id_paciente'] = $paciente;
			$datos['id_evaluacion'] = $id;
			$datos['menu'] = 'menu_paciente';
			$datos['preguntas'] = $this->preguntas_seguimiento_modelo->buscar_evaluacion($id);
			$this->load->view('preguntas_seguimiento/preguntas_seguimiento_ficha',$datos);
		}
		
		function modificar($id){
		}
		
		function borrar($id){
		}
		
		function listado(){
		}
    }
?>