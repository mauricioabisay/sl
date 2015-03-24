<?php
    /**
     * 
     */
    class Laboratorio extends CI_Controller {
        
        function __construct() {
            parent::__construct();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->form_validation->set_error_delimiters('<span class="advertencia"><img src="'.base_url().'/assets/img/advertencia.png" width="15px" height="15px"><strong>', '</strong></span>');
        }
		
		function index($id){
			$datos['id_paciente'] = $id;
			$datos['menu'] = 'menu_paciente';
			$datos['menu_opcion_actual'] = 'laboratorio';
			$datos['listado'] = "".site_url()."/laboratorio/listado_mini/".$id."";
			$datos['pagina_frame'] = "".site_url()."/laboratorio/agregar/".$id."";
			$this->load->view('plantilla',$datos);
		}
		
		function agregar($id){
			$id_laboratorio_res = -1;
			$id_laboratorio_sol = -1;
			$this->load->model('laboratorio_modelo');
			$laboratorios_aux = $datos['laboratorios'] = $this->laboratorio_modelo->laboratorios();
//Inicio Reglas Generales
			$this->form_validation->set_rules('lab_sol','Solicitud de Laboratorio','required');
			$this->form_validation->set_rules('lab_res','Resultados de Laboratorios','required');
			$this->form_validation->set_rules('laboratorios','Especifación','');
			$this->form_validation->set_rules('laboratorios_res','Especificación','');
//Fin Reglas Generales
			if($this->input->post('lab_sol')=='Si'){
//Inicio Reglas Solicitud
				if ($this->input->post('sintomas') == 'Si'){
					$this->form_validation->set_rules('cuantos_sintomas','N&uacute;mero de S&iacute;ntomas','required');
				}
				$this->form_validation->set_rules('sintomas','','required');
				$this->form_validation->set_rules('laboratorios','','required');
//Fin Reglas Solicitud
			}
			if($this->input->post('lab_res')=='Si'){
//Inicio Reglas Resultados
				$this->form_validation->set_rules('fecha_laboratorio','','required');
	//Obteniendo Especificacion para resultados
				$especificacion_res = "";
				if($this->input->post('laboratorios_res')){
					$especificacion_aux = $this->input->post('laboratorios_res');
					for($i=0;$i<sizeof($especificacion_aux);$i++){
						$especificacion_res .= $especificacion_aux[$i];
						$especificacion_res .= ($i+1<sizeof($especificacion_aux))?',':'';
					}
				}
				foreach($laboratorios_aux as $lab_aux){
					if(stristr($especificacion_res, $lab_aux->id)){
						if($lab_aux->id!='otros'){
							$this->form_validation->set_rules($lab_aux->id.'_status','','required');
							if($this->input->post($lab_aux->id.'_status')=='Alterado'){
								$this->form_validation->set_rules($lab_aux,'','required|min_length[3]');	
							}	
						}else{
							for($i=0;$i<sizeof($this->input->post('otrores'));$i++){
								$this->form_validation->set_rules('status_'.$i,'','required');
							}
						}
					}
				}
//Fin Reglas Resultados
			}
//Venimos del Formulario
			if($this->input->post()){
				$datos['id_paciente'] = $this->input->post('paciente');
				if($this->form_validation->run()){
//Preparando datos generales de laboratorio
					$laboratorio['paciente'] = $laboratorio_res['paciente'] = $this->input->post('paciente');
					if($this->input->post('lab_sol')=='Si'){
//Inicio Solicitud
						$especificacion_sol = "";
						if($this->input->post('laboratorios')){
							$especificacion_aux = $this->input->post('laboratorios');
							for($i=0;$i<sizeof($especificacion_aux);$i++){
								$especificacion_sol .= $especificacion_aux[$i];
								$especificacion_sol .= ($i+1<sizeof($especificacion_aux))?',':'';
							}
						}
						$laboratorio['especificacion'] = $laboratorio['especificacion_resultados'] = $especificacion_sol;
						$laboratorio['fecha_solicitud'] = date('Y-m-d');
						$laboratorio['status'] = 'Pendiente';
						
						if($this->input->post('sintomas')=='Si'){
							$laboratorio['sintomas'] = $this->input->post('cuantos_sintomas');
						}else{
							$laboratorio['sintomas'] = 0;
						}
						if(stristr($especificacion_sol,'otros')){
							$laboratorio['otros'] = '';
							$otros_aux_nombre = $this->input->post('otro');
							for($i=0;$i<sizeof($otros_aux_nombre);$i++){
								$laboratorio['otros'] .= $otros_aux_nombre[$i];
								$laboratorio['otros'] .= ($i+1<sizeof($otros_aux_nombre))?',':'';
							}
						}
	//Alta Solicitud
						$id_laboratorio_sol = $this->laboratorio_modelo->agregar($laboratorio);
//Fin Solicitud
					}
					if($this->input->post('lab_res')=='Si'){
//Inicio Resultados
						$laboratorio_res['especificacion_resultados'] = $especificacion_res;
						$fecha_laboratorio = DateTime::createFromFormat('d-m-Y',$this->input->post('fecha_laboratorio'));
						$laboratorio_res['fecha_laboratorio'] = $fecha_laboratorio->format('Y-m-d');
						$laboratorio_res['fecha_captura'] = date('Y-m-d');
						$laboratorio_res['status'] = 'Capturado';
	//Alta Resultado
						$laboratorio_estudio['laboratorio'] = $id_laboratorio_res = $this->laboratorio_modelo->agregar($laboratorio_res);
						foreach($laboratorios_aux as $lab_aux){
							$laboratorio_estudio['nota'] = '';
							if(stristr($especificacion_res, $lab_aux->id)){
								if($lab_aux->id=='otros'){
									$laboratorio_estudio['nombre_id'] = 'otros';
									$otros_aux_nombre = $this->input->post('otrores');
									$otros_aux_nota = $this->input->post('otros');
									for($i=0;$i<sizeof($otros_aux_nombre);$i++){
										$laboratorio_estudio['nota'] = '';
										$laboratorio_estudio['nombre'] = $otros_aux_nombre[$i];
										$laboratorio_estudio['status'] = $this->input->post('status_'.$i);
										if($this->input->post('status_'.$i)=='Alterado'){
											$laboratorio_estudio['nota'] = $otros_aux_nota[$i];	
										}
	//Alta Otro Estudio
										$this->laboratorio_modelo->agregar_estudio($laboratorio_estudio);
									}
								}else{
									$laboratorio_estudio['nombre_id'] = $lab_aux->id;
									$laboratorio_estudio['nombre'] = $lab_aux->nombre;
									$laboratorio_estudio['status'] = $this->input->post($lab_aux->id.'_status');
									if($this->input->post($lab_aux->id.'_status')=='Alterado'){
										$laboratorio_estudio['nota'] = $this->input->post($lab_aux->id);	
									}
	//Alta Estudio
									$this->laboratorio_modelo->agregar_estudio($laboratorio_estudio);	
								}
								
							}
						}
//Fin Resultados
					}
//Alta Laboratorio
					
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Informaci&oacute;n de Estudio de Laboratorio actualizada';
//Alta Exitosa
					//$this->detalle($this->input->post('id'));
					$this->detalle_doble($id_laboratorio_sol,$id_laboratorio_res);
//Datos invalidos
				}else{
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					
					if($this->input->post('lab_sol')=='Si'){
						$especificacion = "";
						$especificacion_aux = $this->input->post('laboratorios');
						for($i=0;$i<sizeof($especificacion_aux);$i++){
							$especificacion .= $especificacion_aux[$i];
							$especificacion .= ($i+1<sizeof($especificacion_aux))?',':'';
						}
						if(stristr($especificacion,'otros')){
							$datos['sol_otro'] = $this->input->post('otro');
						}
					}
					if(($this->input->post('lab_res')=='Si')&&(stristr($especificacion_res,'otros'))){
						$datos['res_otro_nombre'] = $this->input->post('otrores');
						$datos['res_otro_nota'] = $this->input->post('otros');
					}
					$this->load->view('laboratorio/laboratorio_agregar',$datos);
				}
//No venimos del Formulario
			}else{
				$datos['id_paciente'] = $id;
				$this->load->view('laboratorio/laboratorio_agregar',$datos);
			}
		}
		
		function busqueda(){
		}
		
		function detalle($id){
			$this->load->model('laboratorio_modelo');
			$laboratorio = $datos['laboratorio'] = $this->laboratorio_modelo->buscar_id($id);
			$datos['id_paciente'] = $laboratorio->paciente;
			$datos['id'] = $id;
			$datos['estudios'] = $this->laboratorio_modelo->estudios($id);
			$datos['laboratorios'] = $this->laboratorio_modelo->laboratorios(); 
			$this->load->view('laboratorio/laboratorio_ficha',$datos);
		}
		
		function detalle_doble($sol,$res){
			$this->load->model('laboratorio_modelo');
			$laboratorio = $datos['laboratorio_sol'] = $this->laboratorio_modelo->buscar_id($sol);
			$datos['laboratorio_res'] = $this->laboratorio_modelo->buscar_id($res);
			$laboratorio = ($laboratorio)?$laboratorio:$datos['laboratorio_res'];
			$datos['id_paciente'] = $laboratorio->paciente;
			$datos['estudios'] = $this->laboratorio_modelo->estudios($res);
			$datos['laboratorios'] = $this->laboratorio_modelo->laboratorios(); 
			$this->load->view('laboratorio/laboratorio_ficha_doble',$datos);
		}

		function modificar($id){
			$this->load->model('laboratorio_modelo');
			$laboratorios_aux = $datos['laboratorios'] = $this->laboratorio_modelo->laboratorios();
//Inicio Reglas Generales
			$this->form_validation->set_rules('lab_sol','Solicitud de Laboratorio','required');
			$this->form_validation->set_rules('lab_res','Resultados de Laboratorios','required');
			$this->form_validation->set_rules('laboratorios','Especifación','');
			$this->form_validation->set_rules('laboratorios_res','Especificación','');
//Fin Reglas Generales
			if($this->input->post('lab_sol')=='Si'){
//Inicio Reglas Solicitud
				if ($this->input->post('sintomas') == 'Si'){
					$this->form_validation->set_rules('cuantos_sintomas','N&uacute;mero de S&iacute;ntomas','required');
				}
				$this->form_validation->set_rules('sintomas','','required');
				$this->form_validation->set_rules('laboratorios','','required');
//Fin Reglas Solicitud
			}
			if($this->input->post('lab_res')=='Si'){
//Inicio Reglas Resultados
				$this->form_validation->set_rules('fecha_laboratorio','','required');
	//Obteniendo Especificacion para resultados
				$especificacion_res = "";
				if($this->input->post('laboratorios_res')){
					$especificacion_aux = $this->input->post('laboratorios_res');
					for($i=0;$i<sizeof($especificacion_aux);$i++){
						$especificacion_res .= $especificacion_aux[$i];
						$especificacion_res .= ($i+1<sizeof($especificacion_aux))?',':'';
					}
				}
				foreach($laboratorios_aux as $lab_aux){
					if(stristr($especificacion_res, $lab_aux->id)){
						if($lab_aux->id!='otros'){
							$this->form_validation->set_rules($lab_aux->id.'_status','','required');
							if($this->input->post($lab_aux->id.'_status')=='Alterado'){
								$this->form_validation->set_rules($lab_aux,'','required|min_length[3]');	
							}	
						}else{
							for($i=0;$i<sizeof($this->input->post('otrores'));$i++){
								$this->form_validation->set_rules('status_'.$i,'','required');
							}
						}
					}
				}
//Fin Reglas Resultados
			}
//Venimos del Formulario
			if($this->input->post()){
				$datos['id_paciente'] = $this->input->post('paciente');
				if($this->form_validation->run()){
//Preparando datos generales de laboratorio
					$laboratorio['paciente'] = $laboratorio_res['paciente'] = $this->input->post('paciente');
					if($this->input->post('lab_sol')=='Si'){
//Inicio Solicitud
						$especificacion_sol = "";
						if($this->input->post('laboratorios')){
							$especificacion_aux = $this->input->post('laboratorios');
							for($i=0;$i<sizeof($especificacion_aux);$i++){
								$especificacion_sol .= $especificacion_aux[$i];
								$especificacion_sol .= ($i+1<sizeof($especificacion_aux))?',':'';
							}
						}
						$laboratorio['especificacion'] = $especificacion_sol;
						if($this->input->post('fecha_solicitud')){
							$laboratorio['fecha_solicitud'] = $this->input->post('fecha_solicitud');	
						}
						$laboratorio['status'] = 'Pendiente';
						
						if($this->input->post('sintomas')=='Si'){
							$laboratorio['sintomas'] = $this->input->post('cuantos_sintomas');
						}else{
							$laboratorio['sintomas'] = 0;
						}
						if(stristr($especificacion_sol,'otros')){
							$laboratorio['otros'] = '';
							$otros_aux_nombre = $this->input->post('otro');
							for($i=0;$i<sizeof($otros_aux_nombre);$i++){
								$laboratorio['otros'] .= $otros_aux_nombre[$i];
								$laboratorio['otros'] .= ($i+1<sizeof($otros_aux_nombre))?',':'';
							}
						}
//Fin Solicitud
					}
					if($this->input->post('lab_res')=='Si'){
//Inicio Resultados
						$laboratorio['especificacion_resultados'] = $especificacion_res;
						$fecha_laboratorio = DateTime::createFromFormat('d-m-Y',$this->input->post('fecha_laboratorio'));
						$laboratorio['fecha_laboratorio'] = $fecha_laboratorio->format('Y-m-d');
						if($this->input->post('fecha_captura')){
							$laboratorio['fecha_captura'] = $this->input->post('fecha_captura'); 
						}else{
							$laboratorio['fecha_captura'] = date('Y-m-d');
						}
						$laboratorio['status'] = 'Capturado';
//Actualizacion Laboratorio
						$this->laboratorio_modelo->modificar($this->input->post('id'),$laboratorio);
						
						$laboratorio_actual = $this->laboratorio_modelo->buscar_id($this->input->post('id'));
						
						$laboratorio_estudio['laboratorio'] = $this->input->post('id');
						foreach($laboratorios_aux as $lab_aux){
							$laboratorio_estudio['nota'] = '';
							if(stristr($especificacion_res, $lab_aux->id)){
								if($lab_aux->id=='otros'){
									$laboratorio_estudio['nombre_id'] = 'otros';
									$otros_aux_id = $this->input->post('otrores_id');
									$otros_aux_nombre = $this->input->post('otrores');
									$otros_aux_nota = $this->input->post('otros');
									for($i=0;$i<sizeof($otros_aux_nombre);$i++){
										$laboratorio_estudio['nota'] = '';
										$laboratorio_estudio['nombre'] = $otros_aux_nombre[$i];
										$laboratorio_estudio['status'] = $this->input->post('status_'.$i);
										if($this->input->post('status_'.$i)=='Alterado'){
											$laboratorio_estudio['nota'] = $otros_aux_nota[$i];	
										}
										if(isset($otros_aux_id[$i])&&($otros_aux_id[$i]!='')){
	//Actualizacion Otro Estudio
											$this->laboratorio_modelo->modificar_estudio($otros_aux_id[$i],$laboratorio_estudio);
										}else{
	//Alta Otro Estudio	
											$this->laboratorio_modelo->agregar_estudio($laboratorio_estudio);
										}
									}
								}else{
									$laboratorio_estudio['nombre_id'] = $lab_aux->id;
									$laboratorio_estudio['nombre'] = $lab_aux->nombre;
									$laboratorio_estudio['status'] = $this->input->post($lab_aux->id.'_status');
									if($this->input->post($lab_aux->id.'_status')=='Alterado'){
										$laboratorio_estudio['nota'] = $this->input->post($lab_aux->id);	
									}
									if($this->input->post($lab_aux->id.'_id')){
	//Actualizacion Estudio									
										$this->laboratorio_modelo->modificar_estudio($this->input->post($lab_aux->id.'_id'),$laboratorio_estudio);
									}else{
	//Alta Estudio
										$this->laboratorio_modelo->agregar_estudio($laboratorio_estudio);
									}
								}
								
							}
						}
//Fin Resultados
					}
//Alta Laboratorio
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Informaci&oacute;n de Estudio de Laboratorio actualizada';
//Alta Exitosa
					$this->detalle($id);
//Datos invalidos
				}else{
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					
					$laboratorio = $datos['laboratorio'] = $this->laboratorio_modelo->buscar_id($this->input->post('id'));
					$datos['fecha_solicitud'] = DateTime::createFromFormat('Y-m-d',$laboratorio->fecha_solicitud);
					if($laboratorio->status=='Capturado'){	
						$datos['fecha_captura'] = DateTime::createFromFormat('Y-m-d',$laboratorio->fecha_captura);
					}
					$datos['id_paciente'] = $laboratorio->paciente;
					$datos['id'] = $this->input->post('id');
					
					if($this->input->post('lab_sol')=='Si'){
						$especificacion = "";
						$especificacion_aux = $this->input->post('laboratorios');
						for($i=0;$i<sizeof($especificacion_aux);$i++){
							$especificacion .= $especificacion_aux[$i];
							$especificacion .= ($i+1<sizeof($especificacion_aux))?',':'';
						}
						if(stristr($especificacion,'otros')){
							$datos['sol_otro'] = $this->input->post('otro');
						}
					}
					if(($this->input->post('lab_res')=='Si')&&(stristr($especificacion_res,'otros'))){
						$datos['res_otro_id'] = $this->input->post('otrores_id');
						$datos['res_otro_nombre'] = $this->input->post('otrores');
						$datos['res_otro_nota'] = $this->input->post('otros');
					}
					
					$datos['estudios_std'] = $this->laboratorio_modelo->buscar_estudios($id,'AND nombre_id != "otros"');
					
					$this->load->view('laboratorio/laboratorio_modificar',$datos);
				}
//No venimos del Formulario
			}else{
				$laboratorio = $datos['laboratorio'] = $this->laboratorio_modelo->buscar_id($id);
				$datos['fecha_solicitud'] = DateTime::createFromFormat('Y-m-d',$laboratorio->fecha_solicitud);
				if($laboratorio->status=='Capturado'){
					$datos['fecha_laboratorio'] = DateTime::createFromFormat('Y-m-d',$laboratorio->fecha_laboratorio);	
					$datos['fecha_captura'] = DateTime::createFromFormat('Y-m-d',$laboratorio->fecha_captura);
				}
				$datos['id_paciente'] = $laboratorio->paciente;
				$datos['id'] = $id;
				
				$datos['sol_otro'] = explode(',', $laboratorio->otros);
				$datos['estudios_std'] = $this->laboratorio_modelo->buscar_estudios($id,'AND nombre_id != "otros"');
				if($resultados_otro = $this->laboratorio_modelo->buscar_estudios($id,'AND nombre_id = "otros"')){
					$i=0;
					foreach($resultados_otro as $r){
						$datos['res_otro_id'][$i] = $r->id;
						$datos['res_otro_nombre'][$i] = $r->nombre;
						$datos['res_otro_status'][$i] = $r->status;
						$datos['res_otro_nota'][$i] = $r->nota;
						$i++;
					}
				}else{
					$datos['res_otro_nombre'] = $datos['sol_otro'];
				}
				$this->load->view('laboratorio/laboratorio_modificar',$datos);
			}
		}
		
		function capturar_resultados($id){
			$this->load->model('laboratorio_modelo');
			$laboratorios_aux = $datos['laboratorios'] = $this->laboratorio_modelo->laboratorios();
//Inicio Reglas Generales
			$this->form_validation->set_rules('lab_sol','Solicitud de Laboratorio','required');
			$this->form_validation->set_rules('lab_res','Resultados de Laboratorios','required');
			$this->form_validation->set_rules('laboratorios','Especifación','');
			$this->form_validation->set_rules('laboratorios_res','Especificación','');
//Fin Reglas Generales
			if($this->input->post('lab_sol')=='Si'){
//Inicio Reglas Solicitud
				if ($this->input->post('sintomas') == 'Si'){
					$this->form_validation->set_rules('cuantos_sintomas','N&uacute;mero de S&iacute;ntomas','required');
				}
				$this->form_validation->set_rules('sintomas','','required');
				$this->form_validation->set_rules('laboratorios','','required');
//Fin Reglas Solicitud
			}
			if($this->input->post('lab_res')=='Si'){
//Inicio Reglas Resultados
				$this->form_validation->set_rules('fecha_laboratorio','','required');
	//Obteniendo Especificacion para resultados
				$especificacion_res = "";
				if($this->input->post('laboratorios_res')){
					$especificacion_aux = $this->input->post('laboratorios_res');
					for($i=0;$i<sizeof($especificacion_aux);$i++){
						$especificacion_res .= $especificacion_aux[$i];
						$especificacion_res .= ($i+1<sizeof($especificacion_aux))?',':'';
					}
				}
				foreach($laboratorios_aux as $lab_aux){
					if(stristr($especificacion_res, $lab_aux->id)){
						if($lab_aux->id!='otros'){
							$this->form_validation->set_rules($lab_aux->id.'_status','','required');
							if($this->input->post($lab_aux->id.'_status')=='Alterado'){
								$this->form_validation->set_rules($lab_aux,'','required|min_length[3]');	
							}	
						}else{
							for($i=0;$i<sizeof($this->input->post('otrores'));$i++){
								$this->form_validation->set_rules('status_'.$i,'','required');
							}
						}
					}
				}
//Fin Reglas Resultados
			}
//Venimos del Formulario
			if($this->input->post()){
				$datos['id_paciente'] = $this->input->post('paciente');
				if($this->form_validation->run()){
//Preparando datos generales de laboratorio
					$laboratorio['paciente'] = $laboratorio_res['paciente'] = $this->input->post('paciente');
					if($this->input->post('lab_sol')=='Si'){
//Inicio Solicitud
						$especificacion_sol = "";
						if($this->input->post('laboratorios')){
							$especificacion_aux = $this->input->post('laboratorios');
							for($i=0;$i<sizeof($especificacion_aux);$i++){
								$especificacion_sol .= $especificacion_aux[$i];
								$especificacion_sol .= ($i+1<sizeof($especificacion_aux))?',':'';
							}
						}
						$laboratorio['especificacion'] = $especificacion_sol;
						if($this->input->post('fecha_solicitud')){
							$laboratorio['fecha_solicitud'] = $this->input->post('fecha_solicitud');	
						}
						$laboratorio['status'] = 'Pendiente';
						
						if($this->input->post('sintomas')=='Si'){
							$laboratorio['sintomas'] = $this->input->post('cuantos_sintomas');
						}else{
							$laboratorio['sintomas'] = 0;
						}
						if(stristr($especificacion_sol,'otros')){
							$laboratorio['otros'] = '';
							$otros_aux_nombre = $this->input->post('otro');
							for($i=0;$i<sizeof($otros_aux_nombre);$i++){
								$laboratorio['otros'] .= $otros_aux_nombre[$i];
								$laboratorio['otros'] .= ($i+1<sizeof($otros_aux_nombre))?',':'';
							}
						}
//Fin Solicitud
					}
					if($this->input->post('lab_res')=='Si'){
//Inicio Resultados
						$laboratorio['especificacion_resultados'] = $especificacion_res;
						$fecha_laboratorio = DateTime::createFromFormat('d-m-Y',$this->input->post('fecha_laboratorio'));
						$laboratorio['fecha_laboratorio'] = $fecha_laboratorio->format('Y-m-d');
						if($this->input->post('fecha_captura')){
							$laboratorio['fecha_captura'] = $this->input->post('fecha_captura'); 
						}else{
							$laboratorio['fecha_captura'] = date('Y-m-d');
						}
						$laboratorio['status'] = 'Capturado';
//Actualizacion Laboratorio
						$this->laboratorio_modelo->modificar($this->input->post('id'),$laboratorio);
						
						$laboratorio_actual = $this->laboratorio_modelo->buscar_id($this->input->post('id'));
						
						$laboratorio_estudio['laboratorio'] = $this->input->post('id');
						foreach($laboratorios_aux as $lab_aux){
							$laboratorio_estudio['nota'] = '';
							if(stristr($especificacion_res, $lab_aux->id)){
								if($lab_aux->id=='otros'){
									$laboratorio_estudio['nombre_id'] = 'otros';
									$otros_aux_id = $this->input->post('otrores_id');
									$otros_aux_nombre = $this->input->post('otrores');
									$otros_aux_nota = $this->input->post('otros');
									for($i=0;$i<sizeof($otros_aux_nombre);$i++){
										$laboratorio_estudio['nota'] = '';
										$laboratorio_estudio['nombre'] = $otros_aux_nombre[$i];
										$laboratorio_estudio['status'] = $this->input->post('status_'.$i);
										if($this->input->post('status_'.$i)=='Alterado'){
											$laboratorio_estudio['nota'] = $otros_aux_nota[$i];	
										}
										if(isset($otros_aux_id[$i])&&($otros_aux_id[$i]!='')){
	//Actualizacion Otro Estudio
											$this->laboratorio_modelo->modificar_estudio($otros_aux_id[$i],$laboratorio_estudio);
										}else{
	//Alta Otro Estudio	
											$this->laboratorio_modelo->agregar_estudio($laboratorio_estudio);
										}
									}
								}else{
									$laboratorio_estudio['nombre_id'] = $lab_aux->id;
									$laboratorio_estudio['nombre'] = $lab_aux->nombre;
									$laboratorio_estudio['status'] = $this->input->post($lab_aux->id.'_status');
									if($this->input->post($lab_aux->id.'_status')=='Alterado'){
										$laboratorio_estudio['nota'] = $this->input->post($lab_aux->id);	
									}
									if($this->input->post($lab_aux->id.'_id')){
	//Actualizacion Estudio									
										$this->laboratorio_modelo->modificar_estudio($this->input->post($lab_aux->id.'_id'),$laboratorio_estudio);
									}else{
	//Alta Estudio
										$this->laboratorio_modelo->agregar_estudio($laboratorio_estudio);
									}
								}
								
							}
						}
//Fin Resultados
					}
//Alta Laboratorio
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Informaci&oacute;n de Estudio de Laboratorio actualizada';
//Alta Exitosa
					$this->detalle($this->input->post('id'));
//Datos invalidos
				}else{
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					
					$laboratorio = $datos['laboratorio'] = $this->laboratorio_modelo->buscar_id($this->input->post('id'));
					$datos['fecha_solicitud'] = DateTime::createFromFormat('Y-m-d',$laboratorio->fecha_solicitud);
					if($laboratorio->status=='Capturado'){	
						$datos['fecha_captura'] = DateTime::createFromFormat('Y-m-d',$laboratorio->fecha_captura);
					}
					$datos['id_paciente'] = $laboratorio->paciente;
					$datos['id'] = $this->input->post('id');
					
					if($this->input->post('lab_sol')=='Si'){
						$especificacion = "";
						$especificacion_aux = $this->input->post('laboratorios');
						for($i=0;$i<sizeof($especificacion_aux);$i++){
							$especificacion .= $especificacion_aux[$i];
							$especificacion .= ($i+1<sizeof($especificacion_aux))?',':'';
						}
						if(stristr($especificacion,'otros')){
							$datos['sol_otro'] = $this->input->post('otro');
						}
					}
					if(($this->input->post('lab_res')=='Si')&&(stristr($especificacion_res,'otros'))){
						$datos['res_otro_id'] = $this->input->post('otrores_id');
						$datos['res_otro_nombre'] = $this->input->post('otrores');
						$datos['res_otro_nota'] = $this->input->post('otros');
					}
					
					$datos['estudios_std'] = $this->laboratorio_modelo->buscar_estudios($id,'AND nombre_id != "otros"');
					
					$this->load->view('laboratorio/laboratorio_capturar',$datos);
				}
//No venimos del Formulario
			}else{
				$laboratorio = $datos['laboratorio'] = $this->laboratorio_modelo->buscar_id($id);
				$datos['fecha_solicitud'] = DateTime::createFromFormat('Y-m-d',$laboratorio->fecha_solicitud);
				if($laboratorio->status=='Capturado'){
					$datos['fecha_laboratorio'] = DateTime::createFromFormat('Y-m-d',$laboratorio->fecha_laboratorio);	
					$datos['fecha_captura'] = DateTime::createFromFormat('Y-m-d',$laboratorio->fecha_captura);
				}
				$datos['id_paciente'] = $laboratorio->paciente;
				$datos['id'] = $id;
				
				$datos['sol_otro'] = explode(',', $laboratorio->otros);
				$datos['estudios_std'] = $this->laboratorio_modelo->buscar_estudios($id,'AND nombre_id != "otros"');
				if($resultados_otro = $this->laboratorio_modelo->buscar_estudios($id,'AND nombre_id = "otros"')){
					$i=0;
					foreach($resultados_otro as $r){
						$datos['res_otro_id'][$i] = $r->id;
						$datos['res_otro_nombre'][$i] = $r->nombre;
						$datos['res_otro_status'][$i] = $r->status;
						$datos['res_otro_nota'][$i] = $r->nota;
						$i++;
					}
				}else{
					$datos['res_otro_nombre'] = $datos['sol_otro'];
				}
				$this->load->view('laboratorio/laboratorio_capturar',$datos);
			}
		}
		
		function borrar($id){
			$this->load->model('laboratorio_modelo');
			$laboratorio = $this->laboratorio_modelo->buscar_id($id);
			$paciente = $laboratorio->paciente;
			$this->laboratorio_modelo->borrar($id);
			if($paciente){
				$this->listado_mini($paciente);	
			}else{
				echo 'ERROR';
			}
		}
		
		function listado_mini($paciente){
			$datos['id_paciente'] = $paciente;
			$this->load->model('laboratorio_modelo');
			$inicio = ($this->uri->segment(4))?$this->uri->segment(4):0;
			$datos['resultados'] = $this->laboratorio_modelo->listado_mini($datos['id_paciente'],$inicio);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se ha realizado ninguna Evaluaci&oacute;n Diet&eacute;tica al Paciente';
			}
			$this->load->library('pagination');
			$pag_config['base_url'] = "".site_url()."/laboratorio/listado_mini/".$datos['id_paciente']."";
			$pag_config['total_rows'] = $this->laboratorio_modelo->total($datos['id_paciente']);
			$pag_config['per_page'] = 10;
			$pag_config['uri_segment'] = 4;
			$this->pagination->initialize($pag_config);
			$this->load->view('laboratorio/laboratorio_listado_mini',$datos);
		}
		
		function listado($paciente){
			$datos['id_paciente'] = $paciente;
			$datos['menu'] = 'menu_paciente';
			$datos['menu_opcion_actual'] = 'laboratorio';
			$datos['pagina'] = 'laboratorio/laboratorio_listado';
			$this->load->model('laboratorio_modelo');
			$datos['resultados'] = $this->laboratorio_modelo->buscar($paciente);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han solicitado Estudios de Laboratorio al Paciente';
			}
			$this->load->view($datos['pagina'],$datos);
		}
    }
?>