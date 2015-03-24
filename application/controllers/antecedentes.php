<?php
    /**
     * 
     */
    class Antecedentes extends CI_Controller {
        
        function __construct() {
            parent::__construct();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->form_validation->set_error_delimiters('<span class="advertencia"><img src="'.base_url().'/assets/img/advertencia.png" width="15px" height="15px"><strong>', '</strong></span>');
        }
		
		function antecedente($id){
			$this->load->model('antecedentes_modelo');
			$datos['menu'] = 'menu_paciente';
			$datos['id_paciente'] = $id;
			$datos['listado'] = "".site_url()."/antecedentes/listado_mini/".$id."";
			if($ultimo_antecedente = $this->antecedentes_modelo->existe($id)){
				$datos['pagina_frame'] = "".site_url()."/antecedentes/detalle/".$ultimo_antecedente->id."";
			}else{
				$datos['pagina_frame'] = "".site_url()."/antecedentes/agregar/".$id."";
			}
			
			$this->load->view('plantilla',$datos);
		}
		
		function agregar($id){
			$this->form_validation->set_rules('alcohol','Consumo de Alcohol','required');
			$this->form_validation->set_rules('fuma','Consumo de Tabaco','required');
			$this->form_validation->set_rules('ejercicio','Practica de Ejercicio','required');
			$this->form_validation->set_rules('embarazo','Edo. Embarazo','required');
			$this->form_validation->set_rules('lactancia','Edo. Lactancia','required');
			$this->form_validation->set_rules('ciclo_regular','Regularidad Menstrual','required');
			
			$datos['menu'] = 'menu_paciente';
			
			if($this->input->post()){
				$datos['id_paciente'] = $this->input->post('paciente');
				$alcohol_tipo = "";
				if($this->input->post('alcohol')=='Si'){
					$this->form_validation->set_rules('alcohol_valor_frec','Frecuencia','required|is_natural_no_zero');
					$this->form_validation->set_rules('alcohol_tipo_frec','Tipo de Frecuencia','required');
					$this->form_validation->set_rules('copas','N&uacute;m. Copas','required');
					$this->form_validation->set_rules('alcohol_tipo','Tipo de Alcohol','required');
					$aux = $this->input->post('alcohol_tipo');
					for($i=0; $i < sizeof($aux); $i++){
						if($aux[$i]=='otro'){
							$this->form_validation->set_rules('alcohol_otro','Otro Tipo','required|min_length[3]|max_length[30]');	
						}					
					}
					$aux = $this->input->post('alcohol_tipo');
					for($i=0; $i < sizeof($aux); $i++){					
						$alcohol_tipo .= ''.$aux[$i].'';
						$alcohol_tipo .= ($i+1==sizeof($aux))?"":",";
					}
				}
				if($this->input->post('fuma')=='Si'){
					$this->form_validation->set_rules('fuma_valor','','required|is_natural_no_zero');
					$this->form_validation->set_rules('fuma_tiempo','','required');
					$this->form_validation->set_rules('cigarros','','required|is_natural_no_zero');
					$this->form_validation->set_rules('fuma_tipo_frec','','required');
				}
				if($this->input->post('ejercicio')=='Si'){
					$this->form_validation->set_rules('ejercicio_nombre[]','Nombre del Ejercicio','required|min_length[3]|max_length[30]');
					$this->form_validation->set_rules('ejercicio_tipo[]','Tipo de Ejercicio','required');
					$this->form_validation->set_rules('ejercicio_valor_frec[]','Valor Frecuencia','required|is_natural_no_zero');
					$this->form_validation->set_rules('ejercicio_tipo_frec[]','Tipo Frecuencia','required');
					$this->form_validation->set_rules('ejercicio_duracion[]','Duraci&oacute;n de Ejercicio','required|is_natural_no_zero');
					$this->form_validation->set_rules('ejercicio_mes[]','Fecha de Pr&acute;ctica','required');
					$this->form_validation->set_rules('ejercicio_a[]','Fecha de Pr&acute;ctica','required');
				}
								
				if($this->input->post('embarazo')=='Si'){
					$this->form_validation->set_rules('gesta','','required|is_natural_no_zero');
					$this->form_validation->set_rules('semana','','required|is_natural');
					//$this->form_validation->set_rules('peso_total_esperado','','required');
					$this->form_validation->set_rules('peso_pregestacional','','required');
				}
				if($this->form_validation->run()){
					$antecedentes['paciente'] = $this->input->post('paciente');
					$antecedentes['alcohol'] = $this->input->post('alcohol');
					if($this->input->post('alcohol')=='Si'){
						$antecedentes['alcohol_valor_frec'] = $this->input->post('alcohol_valor_frec');
						$antecedentes['alcohol_tipo_frec'] = $this->input->post('alcohol_tipo_frec');
						$antecedentes['alcohol_tipo'] = $alcohol_tipo;
						$antecedentes['copas'] = $this->input->post('copas');
						for($i=0; $i < sizeof($aux); $i++){
							if($aux[$i]=='otro'){
								$antecedentes['alcohol_otro'] = $this->input->post('alcohol_otro');	
							}
						}	
					}
					
					$antecedentes['fuma'] = $this->input->post('fuma');
					if($this->input->post('fuma')=='Si'){
						$antecedentes['fuma_valor'] = $this->input->post('fuma_valor');
						$antecedentes['fuma_tiempo'] = $this->input->post('fuma_tiempo');
						$antecedentes['cigarros'] = $this->input->post('cigarros');
						$antecedentes['fuma_tipo_frec'] = $this->input->post('fuma_tipo_frec');	
					}
					
					$antecedentes['embarazo'] = $this->input->post('embarazo');
					if($this->input->post('embarazo')=='Si'){
						$antecedentes['gesta'] = $this->input->post('gesta');
						$antecedentes['semana'] = $this->input->post('semana');	
						//$antecedentes['peso_total_esperado'] = $this->input->post('peso_total_esperado');	
						$antecedentes['peso_pregestacional'] = $this->input->post('peso_pregestacional');	
					}else{
						$antecedentes['gesta'] = 0;
						$antecedentes['semana'] = 0;
					}
					$antecedentes['lactancia'] = $this->input->post('lactancia');
					$antecedentes['ejercicio'] = $this->input->post('ejercicio');
					$antecedentes['ciclo_regular'] = $this->input->post('ciclo_regular');
					$antecedentes['fecha_id'] = date('Y-m-d');
//Agregando Antecedentes No Patologicos
					$this->load->model('antecedentes_modelo');
					$id_antecedente = $this->antecedentes_modelo->agregar($antecedentes);
					
//Preparando Datos de Ejercicios
					if($this->input->post('ejercicio')=='Si'){
						
						$aux_ejercicio_nombre = $this->input->post('ejercicio_nombre');
						$aux_ejercicio_tipo = $this->input->post('ejercicio_tipo');
						$aux_ejercicio_valor_frec = $this->input->post('ejercicio_valor_frec');
						$aux_ejercicio_tipo_frec = $this->input->post('ejercicio_tipo_frec');
						$aux_ejercicio_duracion = $this->input->post('ejercicio_duracion');
						$aux_m = $this->input->post('ejercicio_mes');
						$aux_a = $this->input->post('ejercicio_a');
						
						for($i=0;$i<sizeof($aux_ejercicio_nombre);$i++){
							$ejercicio_fecha_ini = DateTime::createFromFormat('d-m-Y','1-'.$aux_m[$i].'-'.$aux_a[$i].'');	
							$ejercicio['nombre'] = $aux_ejercicio_nombre[$i];
							$ejercicio['tipo'] = $aux_ejercicio_tipo[$i];
							$ejercicio['valor_frec'] = $aux_ejercicio_valor_frec[$i];
							$ejercicio['tipo_frec'] = $aux_ejercicio_tipo_frec[$i];
							$ejercicio['duracion'] = $aux_ejercicio_duracion[$i];
							$ejercicio['fecha_ini'] = $ejercicio_fecha_ini->format('Y-m-d');
							$ejercicio['status'] = 'activo';
							$ejercicio['antecedente'] = $id_antecedente;
//Agregando Ejercicios
							$this->antecedentes_modelo->agregar_ejercicio($ejercicio);
						}
					}
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Antecedentes no Patol&oacute;gicos guardados';
//Alta exitosa
					$this->detalle($id_antecedente);
//Datos invalidos
				}else{
					$datos['ejercicio_nombre'] = $this->input->post('ejercicio_nombre');
					$datos['ejercicio_tipo'] = $this->input->post('ejercicio_tipo');
					$datos['ejercicio_valor_frec'] = $this->input->post('ejercicio_valor_frec');
					$datos['ejercicio_tipo_frec'] = $this->input->post('ejercicio_tipo_frec');
					$datos['ejercicio_duracion'] = $this->input->post('ejercicio_duracion');
					$datos['ejercicio_mes'] = $this->input->post('ejercicio_mes');
					$datos['ejercicio_a'] = $this->input->post('ejercicio_a');
					
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					$this->load->model('paciente_modelo');
					$datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
					$datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
					$this->load->view('antecedentes/antecedentes_agregar',$datos);
				}
//No venimos de un formulario
			}else{
				$datos['id_paciente'] = $id;
				$this->load->model('paciente_modelo');
				$datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
				$datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
				$this->load->view('antecedentes/antecedentes_agregar',$datos);
			}
		}
		
		function busqueda(){
		}
		
		function detalle($id){
			$this->load->model('antecedentes_modelo');
			$antecedente = $datos['antecedentes'] = $this->antecedentes_modelo->buscar_id($id);
			$datos['ejercicios'] = $this->antecedentes_modelo->buscar_ejercicios($id);
			$this->load->model('paciente_modelo');
			$datos['id_paciente'] = $antecedente->paciente;
			$datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
			$datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
			$this->load->view('antecedentes/antecedentes_ficha',$datos);
		}
		
		function modificar_detalle(){
			$datos['id_paciente'] = $this->input->post('paciente');
			$datos['menu'] = 'menu_paciente';
			$datos['pagina'] = 'antecedentes/antecedentes_modificar';
			$this->load->model('paciente_modelo');
			$datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
			$datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
			$this->load->model('antecedentes_modelo');
			$datos['antecedentes'] = $this->antecedentes_modelo->buscar($datos['id_paciente']);
			$this->load->view('plantilla',$datos);
		}
		
		function modificar($id_antecedente){
			$datos['menu'] = 'menu_paciente';
			$datos['id_antecedente'] = $id_antecedente;
			
			if($this->input->post()){
//Formulario
				$this->form_validation->set_rules('alcohol','Consumo de Alcohol','required');
				$this->form_validation->set_rules('fuma','Consumo de Tabaco','required');
				$this->form_validation->set_rules('ejercicio','Practica de Ejercicio','required');
				$this->form_validation->set_rules('embarazo','Edo. Embarazo','required');
				$this->form_validation->set_rules('lactancia','Edo. Lactancia','required');
				$this->form_validation->set_rules('ciclo_regular','Regularidad Menstrual','required');
				$datos['id_paciente'] = $this->input->post('paciente');
				$alcohol_tipo = "";
				if($this->input->post('alcohol')=='Si'){
					$this->form_validation->set_rules('alcohol_valor_frec','Frecuencia','required|is_natural_no_zero');
					$this->form_validation->set_rules('alcohol_tipo_frec','Tipo de Frecuencia','required');
					$this->form_validation->set_rules('copas','N&uacute;m. Copas','required');
					$this->form_validation->set_rules('alcohol_tipo','Tipo de Alcohol','required');
					$aux = $this->input->post('alcohol_tipo');
					for($i=0; $i < sizeof($aux); $i++){
						if($aux[$i]=='otro'){
							$this->form_validation->set_rules('alcohol_otro','Otro Tipo','required|min_length[3]|max_length[30]');	
						}					
					}
					$aux = $this->input->post('alcohol_tipo');
					for($i=0; $i < sizeof($aux); $i++){					
						$alcohol_tipo .= ''.$aux[$i].'';
						$alcohol_tipo .= ($i+1==sizeof($aux))?"":",";
					}
				}
				if($this->input->post('fuma')=='Si'){
					$this->form_validation->set_rules('fuma_valor','','required|is_natural_no_zero');
					$this->form_validation->set_rules('fuma_tiempo','','required');
					$this->form_validation->set_rules('cigarros','','required|is_natural_no_zero');
					$this->form_validation->set_rules('fuma_tipo_frec','','required');
				}
				if($this->input->post('ejercicio')=='Si'){
					$this->form_validation->set_rules('ejercicio_nombre[]','Nombre del Ejercicio','required|min_length[3]|max_length[30]');
					$this->form_validation->set_rules('ejercicio_tipo[]','Tipo de Ejercicio','required');
					$this->form_validation->set_rules('ejercicio_valor_frec[]','Valor Frecuencia','required|is_natural_no_zero');
					$this->form_validation->set_rules('ejercicio_tipo_frec[]','Tipo Frecuencia','required');
					$this->form_validation->set_rules('ejercicio_duracion[]','Duraci&oacute;n de Ejercicio','required|is_natural_no_zero');
					$this->form_validation->set_rules('ejercicio_mes[]','Fecha de Pr&acute;ctica','required');
					$this->form_validation->set_rules('ejercicio_a[]','Fecha de Pr&acute;ctica','required');
				}
								
				if($this->input->post('embarazo')=='Si'){
					$this->form_validation->set_rules('gesta','','required|is_natural_no_zero');
					$this->form_validation->set_rules('semana','','required|is_natural');
					//$this->form_validation->set_rules('peso_total_esperado','','required');
					$this->form_validation->set_rules('peso_pregestacional','','required');
				}
				if($this->form_validation->run()){
//Datos Validos
					$antecedentes['paciente'] = $this->input->post('paciente');
					$antecedentes['alcohol'] = $this->input->post('alcohol');
					if($this->input->post('alcohol')=='Si'){
						$antecedentes['alcohol_valor_frec'] = $this->input->post('alcohol_valor_frec');
						$antecedentes['alcohol_tipo_frec'] = $this->input->post('alcohol_tipo_frec');
						$antecedentes['alcohol_tipo'] = $alcohol_tipo;
						$antecedentes['copas'] = $this->input->post('copas');
						for($i=0; $i < sizeof($aux); $i++){
							if($aux[$i]=='otro'){
								$antecedentes['alcohol_otro'] = $this->input->post('alcohol_otro');	
							}
						}	
					}
					
					$antecedentes['fuma'] = $this->input->post('fuma');
					if($this->input->post('fuma')=='Si'){
						$antecedentes['fuma_valor'] = $this->input->post('fuma_valor');
						$antecedentes['fuma_tiempo'] = $this->input->post('fuma_tiempo');
						$antecedentes['cigarros'] = $this->input->post('cigarros');
						$antecedentes['fuma_tipo_frec'] = $this->input->post('fuma_tipo_frec');	
					}
					
					$antecedentes['embarazo'] = $this->input->post('embarazo');
					if($this->input->post('embarazo')=='Si'){
						$antecedentes['gesta'] = $this->input->post('gesta');
						$antecedentes['semana'] = $this->input->post('semana');	
						//$antecedentes['peso_total_esperado'] = $this->input->post('peso_total_esperado');	
						$antecedentes['peso_pregestacional'] = $this->input->post('peso_pregestacional');	
					}else{
						$antecedentes['gesta'] = 0;
						$antecedentes['semana'] = 0;
					}
					$antecedentes['lactancia'] = $this->input->post('lactancia');
					$antecedentes['ejercicio'] = $this->input->post('ejercicio');
					$antecedentes['ciclo_regular'] = $this->input->post('ciclo_regular');
					$antecedentes['fecha_id'] = date('Y-m-d');
//Modificando Antecedentes No Patologicos
					$this->load->model('antecedentes_modelo');
					$this->antecedentes_modelo->modificar($id_antecedente,$antecedentes);
					
//Preparando Datos de Ejercicios
					if($this->input->post('ejercicio')=='Si'){
						
						$aux_ejercicio_id = $this->input->post('ejercicio_id');
						$aux_ejercicio_nombre = $this->input->post('ejercicio_nombre');
						$aux_ejercicio_tipo = $this->input->post('ejercicio_tipo');
						$aux_ejercicio_valor_frec = $this->input->post('ejercicio_valor_frec');
						$aux_ejercicio_tipo_frec = $this->input->post('ejercicio_tipo_frec');
						$aux_ejercicio_duracion = $this->input->post('ejercicio_duracion');
						$aux_m = $this->input->post('ejercicio_mes');
						$aux_a = $this->input->post('ejercicio_a');
						
						for($i=0;$i<sizeof($aux_ejercicio_nombre);$i++){
							$ejercicio_fecha_ini = DateTime::createFromFormat('d-m-Y','1-'.$aux_m[$i].'-'.$aux_a[$i].'');	
							$ejercicio['nombre'] = $aux_ejercicio_nombre[$i];
							$ejercicio['tipo'] = $aux_ejercicio_tipo[$i];
							$ejercicio['valor_frec'] = $aux_ejercicio_valor_frec[$i];
							$ejercicio['tipo_frec'] = $aux_ejercicio_tipo_frec[$i];
							$ejercicio['duracion'] = $aux_ejercicio_duracion[$i];
							$ejercicio['fecha_ini'] = $ejercicio_fecha_ini->format('Y-m-d');
							$ejercicio['status'] = 'activo';
							$ejercicio['antecedente'] = $id_antecedente;
//Modificando Ejercicios
							if(isset($aux_ejercicio_id[$i])&&$aux_ejercicio_id[$i]){
								$this->antecedentes_modelo->modificar_ejercicio($aux_ejercicio_id[$i],$ejercicio);	
							}
							else{
								$this->antecedentes_modelo->agregar_ejercicio($ejercicio);
							}
						}
					}
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Antecedentes no Patol&oacute;gicos guardados';
//Alta exitosa
					$this->detalle($id_antecedente);
//Datos invalidos
				}else{
					$datos['ejercicio_id'] = $this->input->post('ejercicio_id');
					$datos['ejercicio_nombre'] = $this->input->post('ejercicio_nombre');
					$datos['ejercicio_tipo'] = $this->input->post('ejercicio_tipo');
					$datos['ejercicio_valor_frec'] = $this->input->post('ejercicio_valor_frec');
					$datos['ejercicio_tipo_frec'] = $this->input->post('ejercicio_tipo_frec');
					$datos['ejercicio_duracion'] = $this->input->post('ejercicio_duracion');
					$datos['ejercicio_mes'] = $this->input->post('ejercicio_mes');
					$datos['ejercicio_a'] = $this->input->post('ejercicio_a');
					
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					$this->load->model('paciente_modelo');
					$datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
					$datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
					$this->load->view('antecedentes/antecedentes_modificar',$datos);
				}
//No venimos de un formulario
			}else{
				$this->load->model('paciente_modelo');
				$this->load->model('antecedentes_modelo');
				$datos['antecedentes'] = $this->antecedentes_modelo->buscar_id($id_antecedente);
				$datos['id_paciente'] = $datos['antecedentes']->paciente;
				$datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
				$datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
				$datos['ejercicios'] = $this->antecedentes_modelo->buscar_ejercicios($id_antecedente);
				$this->load->view('antecedentes/antecedentes_modificar',$datos);
			}
		}
		
		function borrar($id_antecedente){
			$this->load->model('antecedentes_modelo');
			$antecedente = $this->antecedentes_modelo->buscar_id($id_antecedente);
			$paciente = $antecedente->paciente;
			$this->antecedentes_modelo->borrar($id_antecedente);
			if($paciente){
				$this->listado_mini($paciente);	
			}else{
				echo 'ERROR';
			}
		}
		
		function listado_mini($paciente){
			$datos['id_paciente'] = $paciente;
			$this->load->model('antecedentes_modelo');
			$inicio = ($this->uri->segment(4))?$this->uri->segment(4):0;
			$datos['resultados'] = $this->antecedentes_modelo->listado_mini($datos['id_paciente'],$inicio);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han capturado Ant.No Patol&oacute;gicos sobre el Paciente';
			}
			$this->load->library('pagination');
			$pag_config['base_url'] = "".site_url()."/antecedentes/listado_mini/".$datos['id_paciente']."";
			$pag_config['total_rows'] = $this->antecedentes_modelo->total($datos['id_paciente']);
			$pag_config['per_page'] = 10;
			$pag_config['uri_segment'] = 4;
			$this->pagination->initialize($pag_config);
			$this->load->view('antecedentes/antecedentes_listado_mini',$datos);
		}
		
		function listado(){
		}
    }
?>