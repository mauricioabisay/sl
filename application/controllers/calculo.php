<?php
    /**
     * 
     */
    class Calculo extends CI_Controller {
        
        function __construct() {
            parent::__construct();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->form_validation->set_error_delimiters('<span class="advertencia"><img src="'.base_url().'/assets/img/advertencia.png" width="15px" height="15px"><strong>', '</strong></span>');
			include ('calc_paciente.php');
        }
		
		function index($id){
			$datos['menu'] = 'menu_paciente';
			$datos['id_paciente'] = $id;
			$datos['listado'] = "".site_url()."/calculo/listado_mini/".$id."";
			$datos['pagina_frame'] = "".site_url()."/calculo/agregar/".$id."";
			$this->load->view('plantilla',$datos);
		}
		
		function agregar($id){
			$datos['menu'] = 'menu_paciente';
			$datos['id_paciente'] = $id;
			/*$datos['listado'] = "".site_url()."/calculo/listado_mini/".$id."";
			$datos['pagina_frame'] = "".site_url()."/calculo/agregar/".$id."";*/
			$datos['pagina'] = 'calculo_energetico/calculo_agregar';
			
			$this->load->model('paciente_modelo');
			$this->load->model('antecedentes_modelo');
			$this->load->model('evaluacion_modelo');
			$evaluacion = $datos['evaluacion'] = $this->evaluacion_modelo->evaluacion_hoy($datos['id_paciente']);
			if($evaluacion){
//Existe una evaluacion actual para realizar el calculo energetico
				$menor = $datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
				$mujer = $datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
				$edad = $datos['edad'] =$this->paciente_modelo->edad_num($datos['id_paciente'],$evaluacion->fecha);
				
				$pre_calculo = new Calc_paciente($evaluacion,$edad,$mujer);
			
				if($datos['menor']){
					$datos['pagina'] = 'calculo_energetico/calculo_agregar';
					$datos['evaluacion'] = $evaluacion;
					$datos['tabla'] = $pre_calculo->calculo_infante($edad,$mujer);
				}else{
					$datos['harris_gasto_energetico_basal'] = $pre_calculo->harris_gasto_energetico_basal();
					$datos['shanblogue_gasto_energetico_basal'] = $pre_calculo->shanblogue_gasto_energetico_basal();
					$datos['mifflin_gasto_energetico_basal'] = $pre_calculo->mifflin_gasto_energetico_basal();
				}
				$this->load->model('calculo_modelo');
				$datos['tabla_harris_actividad_fisica'] = $this->calculo_modelo->tabla_harris_actividad_fisica();
				$datos['tabla_harris_factor'] = $this->calculo_modelo->tabla_harris_factor();
				$datos['tabla_harris_condiciones_especiales'] = $this->calculo_modelo->tabla_harris_condiciones_especiales();
				$datos['tabla_shanblogue_actividad_fisica'] = $this->calculo_modelo->tabla_shanblogue_actividad_fisica();
				$datos['tabla_shanblogue_condiciones_especiales'] = $this->calculo_modelo->tabla_shanblogue_condiciones_especiales();
				$datos['ejercicios'] = $this->antecedentes_modelo->ejercicios_actuales($id);
				if($this->input->post()){
//Venimos de un formulario
					$this->form_validation->set_rules('calorimetro','Calor&iacute;metro','less_than[10000]');
					$this->form_validation->set_rules('consumo_energetico','Consumo Energ&eacute;tico','required');
					$this->form_validation->set_rules('evaluacion','Evaluaci&oacute;n','required');
					
					if(!$datos['menor']){
						$this->form_validation->set_rules('harris_factor_actividad','Factor de Actividad','required|greater_than[1]');
						$this->form_validation->set_rules('harris_actividad_fisica','Tipo de Actividad F&iacute;sica','required');
						$this->form_validation->set_rules('harris_actividad_fisica_factor','Factor de Actividad F&iacute;sica','required|numeric|less_than[50]');
						foreach($datos['tabla_harris_condiciones_especiales'] as $dato_tabla){
							$temp_nombre = "".$dato_tabla->id."_factor";
							$this->form_validation->set_rules($temp_nombre,'Factor de Condici&oacute;n Especial','numeric|less_than[5]');
						}
						$this->form_validation->set_rules('shanblogue_actividad_fisica','Tipo de Actividad F&iacute;sica','required');
						$this->form_validation->set_rules('shanblogue_actividad_fisica_factor','Factor de Actividad F&iacute;sica','required|numeric|less_than[50]');
						foreach($datos['tabla_shanblogue_condiciones_especiales'] as $dato_tabla){
							$temp_nombre = "".$dato_tabla->id."_factor";
							$this->form_validation->set_rules($temp_nombre,'Factor de Condici&oacute;n Especial','numeric|less_than[5]');
						}	
					}
					if($this->form_validation->run()){
//Datos validos			
	//Almacenando el Consumo Energetico
						$consumo['evaluacion'] = $this->input->post('evaluacion');
						$consumo['consumo_energetico'] =  $this->input->post('consumo_energetico');
						$consumo['calorimetro'] = $this->input->post('calorimetro');
						$datos_calculo['calculo_energetico'] = $this->calculo_modelo->agregar_consumo_energetico($consumo);
						if(!$datos['menor']){
//Preparando almacenamiento de Calculo Harris
							$datos_calculo['variable'] = $this->input->post('harris_factor_actividad');
							$aux_variable_calculo_energetico = $this->calculo_modelo->buscar_variable_calculo_energetico($datos_calculo['variable']); 
							$datos_calculo['factor'] = ($aux_variable_calculo_energetico)?$aux_variable_calculo_energetico->valor_inf:1;
							$this->calculo_modelo->agregar($datos_calculo);
	//Almacennado el Factor Actividad de Harris
							$condiciones_variable = $this->input->post('harris_condiciones_especiales');
							for($i=0;$i<sizeof($condiciones_variable);$i++){
	//Almacenando las Condiciones Especiales de Harris
								$datos_calculo['variable'] = $condiciones_variable[$i];
								$datos_calculo['factor'] = $this->input->post(''.$condiciones_variable[$i].'_factor');
								$this->calculo_modelo->agregar($datos_calculo);
							}
	//Almacenando la actividad fisica de Harris
							$datos_calculo['variable'] = $this->input->post('harris_actividad_fisica');
							$datos_calculo['factor'] = $this->input->post('harris_actividad_fisica_factor');
							$this->calculo_modelo->agregar($datos_calculo);
//Preparando almacenamiento de Calculo Shanblogue
							$condiciones_variable = $this->input->post('shanblogue_condiciones_especiales');
							for($i=0;$i<sizeof($condiciones_variable);$i++){
	//Almacenando las Condiciones de Estres de Shablogue
								$datos_calculo['variable'] = $condiciones_variable[$i];
								$datos_calculo['factor'] = $this->input->post(''.$condiciones_variable[$i].'_factor');
								$this->calculo_modelo->agregar($datos_calculo);
							}
	//Almacenando la actividad fisica de Shanblogue
							$datos_calculo['variable'] = $this->input->post('shanblogue_actividad_fisica');
							$datos_calculo['factor'] = $this->input->post('shanblogue_actividad_fisica_factor');
							$this->calculo_modelo->agregar($datos_calculo);		
						}
	//Alta exitosa		
						$this->detalle($datos_calculo['calculo_energetico']);
					}else{
//Datos invalidos
						$datos['tipo'] = 'advertencia';
						$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
						$this->load->view($datos['pagina'],$datos);
					}
				}else{
//No venimos de un formulario
					$this->load->view($datos['pagina'],$datos);
				}
			}else{
//No se ha capturado una evaluacion lo suficientemente actual para realizar el calculo energetico
			}
		}
		
		function busqueda(){
		}
		
		function detalle($id_consumo){
			$this->load->model('calculo_modelo');
			$this->load->model('evaluacion_modelo');
			$consumo = $datos['consumo_energetico'] = $this->calculo_modelo->buscar_consumo($id_consumo);
			$evaluacion = $datos['evaluacion'] = $this->evaluacion_modelo->buscar_id($consumo->evaluacion);
			$id = $evaluacion->paciente;
			$datos['menu'] = 'menu_paciente';
			$datos['id_paciente'] = $id;
			/*$datos['listado'] = "".site_url()."/calculo/listado_mini/".$id."";
			$datos['pagina_frame'] = "".site_url()."/calculo/agregar/".$id."";*/
			$datos['pagina'] = 'calculo_energetico/calculo_ficha';
			$this->load->model('paciente_modelo');
			$this->load->model('antecedentes_modelo');
			
			$menor = $datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
			$mujer = $datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
			$edad = $datos['edad'] = $this->paciente_modelo->edad_num($datos['id_paciente'],$evaluacion->fecha);
			
			$calculo = new Calc_paciente($evaluacion,$edad,$mujer);
			if($datos['menor']){
				$datos['tabla'] = $calculo->calculo_infante($edad,$mujer); 
			}else{
				$datos['variables'] = $this->calculo_modelo->buscar_calculo_energetico_factores($consumo->id);
				$calculo->set_variables($datos['variables']);
				$datos['harris'] = $calculo->harris();
				$datos['shanblogue'] = $calculo->shanblogue();
				$datos['mifflin'] = $calculo->mifflin();
			}
			$datos['ejercicios'] = $this->antecedentes_modelo->ejercicios_actuales($id);
			$this->load->view($datos['pagina'],$datos);
		}
		
		function modificar($id){
			$datos['menu'] = 'menu_paciente';
			$datos['id_calculo_energetico'] = $id;
			$datos['pagina'] = 'calculo_energetico/calculo_modificar';
			
			$this->load->model('paciente_modelo');
			$this->load->model('antecedentes_modelo');
			$this->load->model('evaluacion_modelo');
			$this->load->model('calculo_modelo');
			
			$aux_calculo = $this->calculo_modelo->buscar_consumo($datos['id_calculo_energetico']);
			$datos['id_evaluacion'] = $aux_calculo->evaluacion;
			$evaluacion = $datos['evaluacion'] = $this->evaluacion_modelo->buscar_id($datos['id_evaluacion']);
			$datos['id_paciente'] = $evaluacion->paciente;
			if($evaluacion){
//Existe una evaluacion actual para realizar el calculo energetico
				$menor = $datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
				$mujer = $datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
				$edad = $datos['edad'] = $this->paciente_modelo->edad_num($datos['id_paciente'],$evaluacion->fecha);
				
				$pre_calculo = new Calc_paciente($evaluacion,$edad,$mujer);
			
				if($datos['menor']){
					$datos['pagina'] = 'calculo_energetico/calculo_modificar';
					$datos['tabla'] = $pre_calculo->calculo_infante($edad,$mujer);
				}else{
					$datos['harris_gasto_energetico_basal'] = $pre_calculo->harris_gasto_energetico_basal();
					$datos['shanblogue_gasto_energetico_basal'] = $pre_calculo->shanblogue_gasto_energetico_basal();
					$datos['mifflin_gasto_energetico_basal'] = $pre_calculo->mifflin_gasto_energetico_basal();
				}
				
				$datos['tabla_harris_actividad_fisica'] = $this->calculo_modelo->tabla_harris_actividad_fisica();
				$datos['tabla_harris_factor'] = $this->calculo_modelo->tabla_harris_factor();
				$datos['tabla_harris_condiciones_especiales'] = $this->calculo_modelo->tabla_harris_condiciones_especiales();
				$datos['tabla_shanblogue_actividad_fisica'] = $this->calculo_modelo->tabla_shanblogue_actividad_fisica();
				$datos['tabla_shanblogue_condiciones_especiales'] = $this->calculo_modelo->tabla_shanblogue_condiciones_especiales();
				$datos['ejercicios'] = $this->antecedentes_modelo->ejercicios_actuales($id);
				if($this->input->post()){
//Venimos de un formulario
					$this->form_validation->set_rules('calorimetro','Calor&iacute;metro','less_than[10000]');
					$this->form_validation->set_rules('consumo_energetico','Consumo Energ&eacute;tico','required');
					$this->form_validation->set_rules('evaluacion','Evaluaci&oacute;n','required');
					$this->form_validation->set_rules('harris_actividad_fisica','Tipo de Actividad F&iacute;sica','required');
					$this->form_validation->set_rules('harris_actividad_fisica_factor','Factor de Actividad F&iacute;sica','required|numeric|less_than[50]');
					foreach($datos['tabla_harris_condiciones_especiales'] as $dato_tabla){
						$temp_nombre = "".$dato_tabla->id."_factor";
						$this->form_validation->set_rules($temp_nombre,'Factor de Condici&oacute;n Especial','numeric|less_than[5]');
					}
					$this->form_validation->set_rules('shanblogue_actividad_fisica','Tipo de Actividad F&iacute;sica','required');
					$this->form_validation->set_rules('shanblogue_actividad_fisica_factor','Factor de Actividad F&iacute;sica','required|numeric|less_than[50]');
					foreach($datos['tabla_shanblogue_condiciones_especiales'] as $dato_tabla){
						$temp_nombre = "".$dato_tabla->id."_factor";
						$this->form_validation->set_rules($temp_nombre,'Factor de Condici&oacute;n Especial','numeric|less_than[5]');
					}
					if($this->form_validation->run()){
//Datos validos			
	//Preparando datos de Consumo Energetico
						$consumo['evaluacion'] = $this->input->post('evaluacion');
						$consumo['consumo_energetico'] =  $this->input->post('consumo_energetico');
						$consumo['calorimetro'] = $this->input->post('calorimetro');
	//Modificar Consumo Energetico
						$datos_calculo['calculo_energetico'] = $this->calculo_modelo->modificar_consumo_energetico($datos['id_consumo'],$consumo);
//Preparando almacenamiento de Calculo Harris
						$datos_calculo['variable'] = $this->input->post('harris_factor_actividad');
						$aux_variable_calculo_energetico = $this->calculo_modelo->buscar_variable_calculo_energetico($datos_calculo['variable']); 
						$datos_calculo['factor'] = ($aux_variable_calculo_energetico)?$aux_variable_calculo_energetico->valor_inf:1;
						$this->calculo_modelo->agregar($datos_calculo);
	//Almacennado el Factor Actividad de Harris
						$condiciones_variable = $this->input->post('harris_condiciones_especiales');
						for($i=0;$i<sizeof($condiciones_variable);$i++){
	//Almacenando las Condiciones Especiales de Harris
							$datos_calculo['variable'] = $condiciones_variable[$i];
							$datos_calculo['factor'] = $this->input->post(''.$condiciones_variable[$i].'_factor');
							$this->calculo_modelo->agregar($datos_calculo);
						}
	//Almacenando la actividad fisica de Harris
						$datos_calculo['variable'] = $this->input->post('harris_actividad_fisica');
						$datos_calculo['factor'] = $this->input->post('harris_actividad_fisica_factor');
						$this->calculo_modelo->agregar($datos_calculo);
//Preparando almacenamiento de Calculo Shanblogue
						$condiciones_variable = $this->input->post('shanblogue_condiciones_especiales');
						for($i=0;$i<sizeof($condiciones_variable);$i++){
	//Almacenando las Condiciones de Estres de Shablogue
							$datos_calculo['variable'] = $condiciones_variable[$i];
							$datos_calculo['factor'] = $this->input->post(''.$condiciones_variable[$i].'_factor');
							$this->calculo_modelo->agregar($datos_calculo);
						}
	//Almacenando la actividad fisica de Shanblogue
						$datos_calculo['variable'] = $this->input->post('shanblogue_actividad_fisica');
						$datos_calculo['factor'] = $this->input->post('shanblogue_actividad_fisica_factor');
						$this->calculo_modelo->agregar($datos_calculo);	
	//Alta exitosa		
						$this->detalle($datos_calculo['calculo_energetico']);
					}else{
//Datos invalidos
						$datos['tipo'] = 'advertencia';
						$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
						$this->load->view($datos['pagina'],$datos);
					}
				}else{
//No venimos de un formulario
					$this->load->view($datos['pagina'],$datos);
				}
			}else{
//No se ha capturado una evaluacion lo suficientemente actual para realizar el calculo energetico
			}
		}
		
		function borrar($id_consumo){
			$this->load->model('calculo_modelo');
			$this->load->model('evaluacion_modelo');
			$consumo = $this->calculo_modelo->buscar_consumo($id_consumo);
			$evaluacion = $this->evaluacion_modelo->buscar_id($consumo->evaluacion);
			
			$paciente = $evaluacion->paciente;;
			$this->calculo_modelo->borrar($id_consumo);
			if($paciente){
				$this->listado_mini($paciente);	
			}else{
				echo 'ERROR';
			}
		}
		
		function listado($paciente){
			$this->load->model('calculo_modelo');
			$this->load->model('evaluacion_modelo');
			
			$datos['menu'] = 'menu_paciente';
			$datos['id_paciente'] = $paciente;
			$datos['pagina'] = 'calculo_energetico/calculo_listado';
			$this->load->model('paciente_modelo');
			$this->load->model('antecedentes_modelo');
			$menor = $datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
			$mujer = $datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
			
			$datos['resultados'] = $this->calculo_modelo->listado($paciente);
			$i=0;
			foreach($datos['resultados'] as $consumo){
				$evaluacion = $datos['evaluacion'] = $this->evaluacion_modelo->buscar_id($consumo->evaluacion);
				$edad = $datos['edad'] = $this->paciente_modelo->edad_num($datos['id_paciente'],$evaluacion->fecha);
				$calculo = new Calc_paciente($evaluacion,$edad,$mujer);
				if($datos['menor']){
					//$datos['tabla'] = $calculo->calculo_infante($edad,$mujer); 
				}else{
					$variables = $this->calculo_modelo->buscar_calculo_energetico_factores($consumo->id);
					$calculo->set_variables($variables);
					$datos['resultados'][$i]->harris = $calculo->harris();
					$datos['resultados'][$i]->shanblogue = $calculo->shanblogue();
					$datos['resultados'][$i]->mifflin = $calculo->mifflin();
				}
				$i++;
			}
			$this->load->view($datos['pagina'],$datos);
		}
		
		function listado_mini($id){
			$datos['id_paciente'] = $id;
			$this->load->model('calculo_modelo');
			$inicio = ($this->uri->segment(4))?$this->uri->segment(4):0;
			$datos['resultados'] = $this->calculo_modelo->listado_mini($datos['id_paciente'],$inicio);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han capturado Evaluaciones sobre el Paciente';
			}
			$this->load->library('pagination');
			$pag_config['base_url'] = "".site_url()."/calculo/listado_mini/".$datos['id_paciente']."";
			$pag_config['total_rows'] = $this->calculo_modelo->total($datos['id_paciente']);
			$pag_config['per_page'] = 10;
			$pag_config['uri_segment'] = 4;
			$this->pagination->initialize($pag_config);
			$this->load->view('calculo_energetico/calculo_listado_mini',$datos);
		}
    }
?>