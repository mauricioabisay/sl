<?php
    /**
     * 
     */
    class Evdietetica extends CI_Controller {
        
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
			$datos['listado'] = "".site_url()."/evdietetica/listado_mini/".$id."";
			$datos['pagina_frame'] = "".site_url()."/evdietetica/agregar/".$id."";
			$this->load->view('plantilla',$datos);
		}
		
		function agregar($id){
			$this->form_validation->set_rules('medicamento','Uso de Medicamentos','required');
			$this->form_validation->set_rules('tratamiento','Uso de Tratamientos','required');
//Reglas para preguntas generales de la evaluacion dietetica
			$this->form_validation->set_rules('evolucion','Evoluci&oacute;n','required');
			$this->form_validation->set_rules('desgaste','Desgaste','required|is_natural|less_than[11]');
			$this->form_validation->set_rules('motivacion','Motivaci&oacute;n','required|is_natural|less_than[11]');
			$this->form_validation->set_rules('capacidad','Capacidad','required|is_natural|less_than[11]');
			$this->form_validation->set_rules('razon_motivacion','Raz&oacute;n','max_length[255]');
//Reglas para frecuencia de alimentos
			$this->form_validation->set_rules('verduras','Verduras','required|is_natural|less_than[8]');
			$this->form_validation->set_rules('frutas','Frutas','required|is_natural|less_than[8]');
			$this->form_validation->set_rules('car_sg','CyTsg', 'required|is_natural|less_than[8]');
			$this->form_validation->set_rules('car_cg','CyTcg', 'required|is_natural|less_than[8]');
			$this->form_validation->set_rules('grasa_sp','Grasa sp', 'required|is_natural|less_than[8]');
			$this->form_validation->set_rules('grasa_cp','Grasa cp', 'required|is_natural|less_than[8]');
			$this->form_validation->set_rules('leche','Leche', 'required|is_natural|less_than[8]');
			$this->form_validation->set_rules('azucar','Az&uacute;car', 'required|is_natural|less_than[8]');
			$this->form_validation->set_rules('leguminosas','Leguminosas', 'required|is_natural|less_than[8]');
			$this->form_validation->set_rules('origen_animal','Productos de origen animal', 'required|is_natural|less_than[8]');
//Reglas para Historial de Peso
			$this->form_validation->set_rules('peso_max','Peso M&aacute;ximo','required');
			$this->form_validation->set_rules('peso_max_m','Fecha de Peso M&aacute;ximo','required');
			$this->form_validation->set_rules('peso_max_a','Fecha de Peso M&aacute;ximo','required');
			$this->form_validation->set_rules('peso_min','Peso M&iacute;nimo','required');
			$this->form_validation->set_rules('peso_min_m','Fecha Peso M&iacute;nimo','required');
			$this->form_validation->set_rules('peso_min_a','Fecha Peso M&iacute;nimo','required');
//$this->form_validation->set_rules('peso_min_fecha','Fecha de Peso M&iacute;nimo','required');
			if($this->input->post('medicamento')=='Si'){
				$this->form_validation->set_rules('medicamento_nombre[]','Nombre del Medicamento','max_length[100]');
				$this->form_validation->set_rules('medicamento_mes[]','Mes del Medicamento','required');
				$this->form_validation->set_rules('medicamento_a[]','A&ntilde;o del Medicamento','numeric');
				$this->form_validation->set_rules('medicamento_exp[]','Experiencia con el Medicamento','max_length[255]');	
			}
			$this->form_validation->set_rules('desc_hist','Descripci&oacute;n de Historial de Peso','max_length[255]');
//Los siguientes campos son arreglos de campos
			//Reglas para Alimentos del Recordatorio de 24 Hrs.
			$this->form_validation->set_rules('tiempo[]','Tiempo','required');
			$this->form_validation->set_rules('alimento[]','Alimento','max_length[50]');
			$this->form_validation->set_rules('cantidad[]','Cantidad','max_length[50]');
			$this->form_validation->set_rules('unidad[]','Unidad','');
			$this->form_validation->set_rules('calorias[]','Calorias','');
//Reglas para Habitos Alimenticios
			for($i=0;$i<5;$i++){
				$this->form_validation->set_rules('existe'.$i.'','Existe', 'required');
			}
			$this->form_validation->set_rules('lugar[]','Lugar','max_length[30]');
			$this->form_validation->set_rules('horas[]','Hora','max_length[2]');
			$this->form_validation->set_rules('minutos[]','Minutos','max_length[2]');
			$this->form_validation->set_rules('ampm[]','Tiempo','max_length[2]');
			$this->form_validation->set_rules('cocinero[]','Cocinero','max_length[30]');
//Reglas para Tratamiento
		//$this->form_validation->set_rules('fecha[]','Fecha del Tratamiento','required');
			if($this->input->post('tratamiento')=='Si'){
				$this->form_validation->set_rules('tratamiento_nombre[]','Nombre del Tratamiento','max_length[100]');
				$this->form_validation->set_rules('tratamiento_mes[]','Mes del Tratamiento','');
				$this->form_validation->set_rules('tratamiento_a[]','A&ntilde;o del Tratamiento','numeric');
				$this->form_validation->set_rules('tratamiento_res[]','Experiencia con el Tratamiento','max_length[255]');	
			}
			
			if($this->input->post()){
				$datos['id_paciente'] = $this->input->post('paciente');
				if($this->form_validation->run()){
//Primero se guardará la evaluacion
					$evaluacion['evolucion'] = $this->input->post('evolucion');
					$evaluacion['desgaste'] = $this->input->post('desgaste');
					$evaluacion['motivacion'] = $this->input->post('motivacion');
					$evaluacion['capacidad'] = $this->input->post('capacidad');
					$evaluacion['paciente'] = $this->input->post('paciente');
					$evaluacion['razon_motivacion'] = $this->input->post('razon_motivacion');
					$evaluacion['fecha_id'] = date('Y-m-d');
					$this->load->model('evdietetica_modelo');
//Alta Evaluacion Dietetica
					$id_evdietetica = $this->evdietetica_modelo->agregar_evaluacion($evaluacion);
//Almacenando Frecuencia de alimentos
					$frecuencia['eval_dietetica'] = $id_evdietetica;
					$frecuencia['verduras'] = $this->input->post('verduras');
					$frecuencia['frutas'] = $this->input->post('frutas');
					$frecuencia['car_sg'] = $this->input->post('car_sg');
					$frecuencia['car_cg'] = $this->input->post('car_cg');
					$frecuencia['grasa_sp'] = $this->input->post('grasa_sp');
					$frecuencia['grasa_cp'] = $this->input->post('grasa_cp');
					$frecuencia['leche'] = $this->input->post('leche');
					$frecuencia['azucar'] = $this->input->post('azucar');
					$frecuencia['leguminosas'] = $this->input->post('leguminosas');
					$frecuencia['origen_animal'] = $this->input->post('origen_animal');
//Alta Frecuencia Alimenticia
					$this->evdietetica_modelo->agregar_frecuencia($frecuencia);
//Almacenando Historial de Peso
					$cadena_peso_max_fecha = '01-'.$this->input->post('peso_max_m').'-'.$this->input->post('peso_max_a').'';
					$cadena_peso_min_fecha = '01-'.$this->input->post('peso_min_m').'-'.$this->input->post('peso_min_a').'';
					$fecha_peso_max = DateTime::createFromFormat('d-m-Y',$cadena_peso_max_fecha);
					$fecha_peso_min = DateTime::createFromFormat('d-m-Y',$cadena_peso_min_fecha);
					$historial['eval_dietetica'] = $id_evdietetica;
					$historial['paciente'] = $this->input->post('paciente');
					$historial['peso_max'] = $this->input->post('peso_max');
					$historial['peso_max_fecha'] = $fecha_peso_max->format('Y-m-d');
					$historial['peso_min'] = $this->input->post('peso_min');
					$historial['peso_min_fecha'] = $fecha_peso_min->format('Y-m-d');
					$historial['medicamento'] = $this->input->post('medicamento');
					$historial['tratamiento'] = $this->input->post('tratamiento');					
					$historial['desc_hist'] = $this->input->post('desc_hist');
//Alta de Historial de Peso
					$id_hist = $this->evdietetica_modelo->agregar_historial($historial);
//Almacenando Medicamentos Dieteticos
					if($this->input->post('medicamento')=='Si'){
						$aux_nombre = $this->input->post('medicamento_nombre');
						$aux_exp = $this->input->post('medicamento_exp');
						$aux_m = $this->input->post('medicamento_mes');
						$aux_a = $this->input->post('medicamento_a');
						$aux_res = $this->input->post('medicamento_exp');
						for($i=0;$i<sizeof($aux_nombre);$i++){
							$fecha_medicamento = DateTime::createFromFormat('d-m-Y','1-'.$aux_m[$i].'-'.$aux_a[$i].'');
							$medicamento['hist_peso'] = $id_hist;
							$medicamento['nombre'] = $aux_nombre[$i];
							$medicamento['experiencia'] = $aux_res[$i];
							$medicamento['fecha'] = $fecha_medicamento->format('Y-m-d');
//Alta Medicamento Dietetico
							$this->evdietetica_modelo->agregar_medicamento_dietetico($medicamento);
						}
					}
//Almacenando Tratamientos para bajar de peso
					if($this->input->post('tratamiento')=='Si'){
						$aux_nombre = $this->input->post('tratamiento_nombre');
						$aux_res = $this->input->post('tratamiento_res');
						$aux_m = $this->input->post('tratamiento_mes');
						$aux_a = $this->input->post('tratamiento_a');
						for($i=0;$i<sizeof($aux_res);$i++){
							$fecha_tratamiento = DateTime::createFromFormat('d-m-Y','1-'.$aux_m[$i].'-'.$aux_a[$i].'');
							$tratamiento['hist_peso'] = $id_hist;
							$tratamiento['nombre'] = $aux_nombre[$i];
							$tratamiento['resultado'] = $aux_res[$i];
							$tratamiento['fecha'] = $fecha_tratamiento->format('Y-m-d');
//Alta Tratamiento
							$this->evdietetica_modelo->agregar_tratamiento($tratamiento);
						}
					}
//Almacenando los habitos alimenticios
					$aux_lugar = $this->input->post('lugar');
					$aux_h = $this->input->post('horas');
					$aux_m = $this->input->post('minutos');
					$aux_ampm = $this->input->post('ampm');
					$aux_cocinero = $this->input->post('cocinero');
					for($i=0;$i<5;$i++){
						switch($i){
							case '0':{$habito['tiempo'] = 'Des';break;}
							case '1':{$habito['tiempo'] = 'Co1';break;}
							case '2':{$habito['tiempo'] = 'Com';break;}
							case '3':{$habito['tiempo'] = 'Co2';break;}
							case '4':{$habito['tiempo'] = 'Cen';break;}
						}
						$hora_cadena = ''.$aux_h[$i].':'.$aux_m[$i].' '.$aux_ampm[$i].'';
						$aux_hora = DateTime::createFromFormat('h:i a',$hora_cadena);
						$habito['existe'] = $this->input->post('existe'.$i.'');
						if($habito['existe']=='Si'){
							$habito['lugar'] = $aux_lugar[$i];
							$habito['hora'] = $aux_hora->format('H:i:s');
							$habito['cocinero'] = $aux_cocinero[$i];	
						}
						$habito['eval_dietetica'] = $id_evdietetica;
//Alta Habito Alimenticio
						$this->evdietetica_modelo->agregar_habito($habito);
					}
//Almacenando el recordatorio de 24 hrs.
					$aux_tiempo = $this->input->post('tiempo');
					$aux_alimento = $this->input->post('alimento');
					$aux_cantidad = $this->input->post('cantidad');
					$aux_unidad = $this->input->post('unidad');
					$aux_calorias = $this->input->post('calorias');
					for($i=0;$i<sizeof($aux_alimento);$i++){
						$recordatorio['tiempo'] = $aux_tiempo[$i];
						$recordatorio['alimento'] = $aux_alimento[$i];
						$recordatorio['cantidad'] = $aux_cantidad[$i];
						$recordatorio['unidad'] = $aux_unidad[$i];
						if(isset($aux_calorias[$i]) && $aux_calorias[$i] != ''){
							$recordatorio['calorias'] = $aux_calorias[$i];
						}
						else{
							$recordatorio['calorias'] = NULL;
						}
						$recordatorio['eval_dietetica'] = $id_evdietetica;
//Alta Recordatorio
						$this->evdietetica_modelo->agregar_recordatorio($recordatorio);
					}
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Evaluaci&oacute;n Diet&eacute;tica guardada';
//Alta Exitosa
					$this->detalle($id_evdietetica);
//Datos invalidos
				}else{
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					
					$datos['tratamiento_nombre'] = $this->input->post('tratamiento_nombre');
					$datos['tratamiento_res'] = $this->input->post('tratamiento_res');
					$datos['tratamiento_mes'] = $this->input->post('tratamiento_mes');
					$datos['tratamiento_a'] = $this->input->post('tratamiento_a');
					
					$datos['medicamento_nombre'] = $this->input->post('medicamento_nombre');
					$datos['medicamento_exp'] = $this->input->post('medicamento_exp');
					$datos['medicamento_mes'] = $this->input->post('medicamento_mes');
					$datos['medicamento_a'] = $this->input->post('medicamento_a');
					
					$datos['lugar'] = $this->input->post('lugar');
					$datos['horas'] = $this->input->post('horas');
					$datos['minutos'] = $this->input->post('minutos');
					$datos['ampm'] = $this->input->post('ampm');
					$datos['cocinero'] = $this->input->post('cocinero');
					
					$datos['tiempo'] = $this->input->post('tiempo');
					$datos['alimento'] = $this->input->post('alimento');
					$datos['cantidad'] = $this->input->post('cantidad');
					$datos['unidad'] = $this->input->post('unidad');
					$datos['calorias'] = $this->input->post('calorias');
					
					$this->load->view('evaluacion_dietetica/evdietetica_agregar',$datos);
				}
//No venimos de un formulario
			}else{
				$datos['id_paciente'] = $id;
				$this->load->view('evaluacion_dietetica/evdietetica_agregar',$datos);
			}
		}
		
		function busqueda(){
		}
		
		function detalle($id){
			$this->load->model('evdietetica_modelo');
			$evdietetica = $datos['ev'] = $this->evdietetica_modelo->buscar_evdietetica($id);
			$datos['frec'] = $this->evdietetica_modelo->buscar_frecuencia($id);
			$historial = $datos['hist'] = $this->evdietetica_modelo->buscar_historial($id);
			$datos['tratamientos'] = $this->evdietetica_modelo->buscar_tratamientos($historial->id);
			$datos['habitos'] = $this->evdietetica_modelo->buscar_habitos($id);
			$datos['alimentos'] = $this->evdietetica_modelo->buscar_recordatorios($id);
			
			$datos['id_paciente'] = $evdietetica->paciente;
			$this->load->view('evaluacion_dietetica/evdietetica_ficha',$datos);
		}
		
		function modificar($id_evdietetica){
//Formulario
			if($this->input->post()){
//Inicio Reglas
				$this->form_validation->set_rules('medicamento','Uso de Medicamentos','required');
				$this->form_validation->set_rules('tratamiento','Uso de Tratamientos','required');
				//Reglas para preguntas generales de la evaluacion dietetica
				$this->form_validation->set_rules('evolucion','Evoluci&oacute;n','required');
				$this->form_validation->set_rules('desgaste','Desgaste','required|is_natural|less_than[11]');
				$this->form_validation->set_rules('motivacion','Motivaci&oacute;n','required|is_natural|less_than[11]');
				$this->form_validation->set_rules('capacidad','Capacidad','required|is_natural|less_than[11]');
				$this->form_validation->set_rules('razon_motivacion','Raz&oacute;n','max_length[255]');
				//Reglas para frecuencia de alimentos
				$this->form_validation->set_rules('verduras','Verduras','required|is_natural|less_than[8]');
				$this->form_validation->set_rules('frutas','Frutas','required|is_natural|less_than[8]');
				$this->form_validation->set_rules('car_sg','CyTsg', 'required|is_natural|less_than[8]');
				$this->form_validation->set_rules('car_cg','CyTcg', 'required|is_natural|less_than[8]');
				$this->form_validation->set_rules('grasa_sp','Grasa sp', 'required|is_natural|less_than[8]');
				$this->form_validation->set_rules('grasa_cp','Grasa cp', 'required|is_natural|less_than[8]');
				$this->form_validation->set_rules('leche','Leche', 'required|is_natural|less_than[8]');
				$this->form_validation->set_rules('azucar','Az&uacute;car', 'required|is_natural|less_than[8]');
				$this->form_validation->set_rules('leguminosas','Leguminosas', 'required|is_natural|less_than[8]');
				$this->form_validation->set_rules('origen_animal','Productos de origen animal', 'required|is_natural|less_than[8]');
				//Reglas para Historial de Peso
				$this->form_validation->set_rules('peso_max','Peso M&aacute;ximo','required');
				$this->form_validation->set_rules('peso_max_m','Fecha de Peso M&aacute;ximo','required');
				$this->form_validation->set_rules('peso_max_a','Fecha de Peso M&aacute;ximo','required');
				$this->form_validation->set_rules('peso_min','Peso M&iacute;nimo','required');
				$this->form_validation->set_rules('peso_min_m','Fecha Peso M&iacute;nimo','required');
				$this->form_validation->set_rules('peso_min_a','Fecha Peso M&iacute;nimo','required');
				//$this->form_validation->set_rules('peso_min_fecha','Fecha de Peso M&iacute;nimo','required');
				if($this->input->post('medicamento')=='Si'){
					$this->form_validation->set_rules('medicamento_nombre[]','Nombre del Medicamento','max_length[100]');
					$this->form_validation->set_rules('medicamento_mes[]','Mes del Medicamento','required');
					$this->form_validation->set_rules('medicamento_a[]','A&ntilde;o del Medicamento','numeric');
					$this->form_validation->set_rules('medicamento_exp[]','Experiencia con el Medicamento','max_length[255]');	
				}
				$this->form_validation->set_rules('desc_hist','Descripci&oacute;n de Historial de Peso','max_length[255]');
			//Los siguientes campos son arreglos de campos
				//Reglas para Alimentos del Recordatorio de 24 Hrs.
				$this->form_validation->set_rules('tiempo[]','Tiempo','required');
				$this->form_validation->set_rules('alimento[]','Alimento','max_length[50]');
				$this->form_validation->set_rules('cantidad[]','Cantidad','max_length[50]');
				$this->form_validation->set_rules('unidad[]','Unidad','');
				$this->form_validation->set_rules('calorias[]','Calorias','');
				//Reglas para Habitos Alimenticios
				for($i=0;$i<5;$i++){
					$this->form_validation->set_rules('existe'.$i.'','Existe', 'required');
				}
				$this->form_validation->set_rules('lugar[]','Lugar','max_length[30]');
				$this->form_validation->set_rules('horas[]','Hora','max_length[2]');
				$this->form_validation->set_rules('minutos[]','Minutos','max_length[2]');
				$this->form_validation->set_rules('ampm[]','Tiempo','max_length[2]');
				$this->form_validation->set_rules('cocinero[]','Cocinero','max_length[30]');
				//Reglas para Tratamiento
				//$this->form_validation->set_rules('fecha[]','Fecha del Tratamiento','required');
				if($this->input->post('tratamiento')=='Si'){
					$this->form_validation->set_rules('tratamiento_nombre[]','Nombre del Tratamiento','max_length[100]');
					$this->form_validation->set_rules('tratamiento_mes[]','Mes del Tratamiento','');
					$this->form_validation->set_rules('tratamiento_a[]','A&ntilde;o del Tratamiento','numeric');
					$this->form_validation->set_rules('tratamiento_res[]','Experiencia con el Tratamiento','max_length[255]');	
				}
//Fin Reglas
				$datos['id_paciente'] = $this->input->post('paciente');
				if($this->form_validation->run()){
//Primero se actualiza la evaluacion
					$evaluacion['evolucion'] = $this->input->post('evolucion');
					$evaluacion['desgaste'] = $this->input->post('desgaste');
					$evaluacion['motivacion'] = $this->input->post('motivacion');
					$evaluacion['capacidad'] = $this->input->post('capacidad');
					$evaluacion['paciente'] = $this->input->post('paciente');
					$evaluacion['razon_motivacion'] = $this->input->post('razon_motivacion');
					$evaluacion['fecha_id'] = date('Y-m-d');
					$this->load->model('evdietetica_modelo');
//Modificar Evaluacion Dietetica
					$this->evdietetica_modelo->modificar_evaluacion($id_evdietetica,$evaluacion);
//Preparando datos Frecuencia de alimentos
					$frecuencia['eval_dietetica'] = $id_evdietetica;
					$frecuencia['verduras'] = $this->input->post('verduras');
					$frecuencia['frutas'] = $this->input->post('frutas');
					$frecuencia['car_sg'] = $this->input->post('car_sg');
					$frecuencia['car_cg'] = $this->input->post('car_cg');
					$frecuencia['grasa_sp'] = $this->input->post('grasa_sp');
					$frecuencia['grasa_cp'] = $this->input->post('grasa_cp');
					$frecuencia['leche'] = $this->input->post('leche');
					$frecuencia['azucar'] = $this->input->post('azucar');
					$frecuencia['leguminosas'] = $this->input->post('leguminosas');
					$frecuencia['origen_animal'] = $this->input->post('origen_animal');
//Modificar Frecuencia Alimenticia
					$this->evdietetica_modelo->modificar_frecuencia($id_evdietetica,$frecuencia);
//Preparando datos Historial de Peso
					$cadena_peso_max_fecha = '01-'.$this->input->post('peso_max_m').'-'.$this->input->post('peso_max_a').'';
					$cadena_peso_min_fecha = '01-'.$this->input->post('peso_min_m').'-'.$this->input->post('peso_min_a').'';
					$fecha_peso_max = DateTime::createFromFormat('d-m-Y',$cadena_peso_max_fecha);
					$fecha_peso_min = DateTime::createFromFormat('d-m-Y',$cadena_peso_min_fecha);
					$historial['eval_dietetica'] = $id_evdietetica;
					$historial['paciente'] = $this->input->post('paciente');
					$historial['peso_max'] = $this->input->post('peso_max');
					$historial['peso_max_fecha'] = $fecha_peso_max->format('Y-m-d');
					$historial['peso_min'] = $this->input->post('peso_min');
					$historial['peso_min_fecha'] = $fecha_peso_min->format('Y-m-d');
					$historial['medicamento'] = $this->input->post('medicamento');
					$historial['tratamiento'] = $this->input->post('tratamiento');					
					$historial['desc_hist'] = $this->input->post('desc_hist');
//Modificar de Historial de Peso
					$this->evdietetica_modelo->modificar_historial($id_evdietetica,$historial);
					$id_hist = $this->evdietetica_modelo->buscar_historial($id_evdietetica)->id;
//Preparando datos Medicamentos Dieteticos
					if($this->input->post('medicamento')=='Si'){
						$aux_id = $this->input->post('medicamento_id');
						$aux_nombre = $this->input->post('medicamento_nombre');
						$aux_exp = $this->input->post('medicamento_exp');
						$aux_m = $this->input->post('medicamento_mes');
						$aux_a = $this->input->post('medicamento_a');
						$aux_res = $this->input->post('medicamento_exp');
						for($i=0;$i<sizeof($aux_nombre);$i++){
							$fecha_medicamento = DateTime::createFromFormat('d-m-Y','1-'.$aux_m[$i].'-'.$aux_a[$i].'');
							$medicamento['hist_peso'] = $id_hist;
							$medicamento['nombre'] = $aux_nombre[$i];
							$medicamento['experiencia'] = $aux_res[$i];
							$medicamento['fecha'] = $fecha_medicamento->format('Y-m-d');
//Modificar Medicamento Dietetico
							if(isset($aux_id[$i])){
								$this->evdietetica_modelo->modificar_medicamento_dietetico($aux_id[$i],$medicamento);	
							}else{
								$this->evdietetica_modelo->agregar_medicamento_dietetico($medicamento);
							}
						}
					}
//Preparando datos Tratamientos para bajar de peso
					if($this->input->post('tratamiento')=='Si'){
						$aux_id = $this->input->post('tratamiento_id');
						$aux_nombre = $this->input->post('tratamiento_nombre');
						$aux_res = $this->input->post('tratamiento_res');
						$aux_m = $this->input->post('tratamiento_mes');
						$aux_a = $this->input->post('tratamiento_a');
						for($i=0;$i<sizeof($aux_res);$i++){
							$fecha_tratamiento = DateTime::createFromFormat('d-m-Y','1-'.$aux_m[$i].'-'.$aux_a[$i].'');
							$tratamiento['hist_peso'] = $id_hist;
							$tratamiento['nombre'] = $aux_nombre[$i];
							$tratamiento['resultado'] = $aux_res[$i];
							$tratamiento['fecha'] = $fecha_tratamiento->format('Y-m-d');
//Modificar Tratamiento
							if(isset($aux_id[$i])){
								$this->evdietetica_modelo->modificar_tratamiento($aux_id[$i],$tratamiento);
							}else{
								$this->evdietetica_modelo->agregar_tratamiento($tratamiento);
							}
						}
					}
//Preparando datos habitos alimenticios
					$aux_id = $this->input->post('habito_id');
					$aux_lugar = $this->input->post('lugar');
					$aux_h = $this->input->post('horas');
					$aux_m = $this->input->post('minutos');
					$aux_ampm = $this->input->post('ampm');
					$aux_cocinero = $this->input->post('cocinero');
					for($i=0;$i<5;$i++){
						switch($i){
							case '0':{$habito['tiempo'] = 'Des';break;}
							case '1':{$habito['tiempo'] = 'Co1';break;}
							case '2':{$habito['tiempo'] = 'Com';break;}
							case '3':{$habito['tiempo'] = 'Co2';break;}
							case '4':{$habito['tiempo'] = 'Cen';break;}
						}
						$hora_cadena = ''.$aux_h[$i].':'.$aux_m[$i].' '.$aux_ampm[$i].'';
						$aux_hora = DateTime::createFromFormat('h:i a',$hora_cadena);
						$habito['existe'] = $this->input->post('existe'.$i.'');
						if($habito['existe']=='Si'){
							$habito['lugar'] = $aux_lugar[$i];
							$habito['hora'] = $aux_hora->format('H:i:s');
							$habito['cocinero'] = $aux_cocinero[$i];	
						}
						$habito['eval_dietetica'] = $id_evdietetica;
//Modificar Habito Alimenticio
						if(isset($aux_id[$i])){
							$this->evdietetica_modelo->modificar_habito($aux_id[$i],$habito);	
						}else{
							$this->evdietetica_modelo->agregar_habito($habito);
						}
					}
//Preparando datos del recordatorio de 24 hrs.
					$aux_id = $this->input->post('recordatorio_id');
					$aux_tiempo = $this->input->post('tiempo');
					$aux_alimento = $this->input->post('alimento');
					$aux_cantidad = $this->input->post('cantidad');
					$aux_unidad = $this->input->post('unidad');
					$aux_calorias = $this->input->post('calorias');
					for($i=0;$i<sizeof($aux_alimento);$i++){
						$recordatorio['tiempo'] = $aux_tiempo[$i];
						$recordatorio['alimento'] = $aux_alimento[$i];
						$recordatorio['cantidad'] = $aux_cantidad[$i];
						$recordatorio['unidad'] = $aux_unidad[$i];
						if(isset($aux_calorias[$i]) && $aux_calorias[$i] != ''){
							$recordatorio['calorias'] = $aux_calorias[$i];
						}
						else{
							$recordatorio['calorias'] = NULL;
						}
						$recordatorio['eval_dietetica'] = $id_evdietetica;
//Modificar Recordatorio
						if(isset($aux_id[$i])&&!($aux_id[$i]=='')){
							$this->evdietetica_modelo->modificar_recordatorio($aux_id[$i],$recordatorio);	
						}else{
							$this->evdietetica_modelo->agregar_recordatorio($recordatorio);
						}
					}
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Evaluaci&oacute;n Diet&eacute;tica guardada';
//Modificacion Exitosa
					$this->detalle($id_evdietetica);
//Datos invalidos
				}else{
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					
					$datos['id_evdietetica'] = $id_evdietetica;
					
					$datos['tratamiento_id'] = $this->input->post('tratamiento_id');
					$datos['tratamiento_nombre'] = $this->input->post('tratamiento_nombre');
					$datos['tratamiento_res'] = $this->input->post('tratamiento_res');
					$datos['tratamiento_mes'] = $this->input->post('tratamiento_mes');
					$datos['tratamiento_a'] = $this->input->post('tratamiento_a');
					
					$datos['medicamento_id'] = $this->input->post('medicamento_id');
					$datos['medicamento_nombre'] = $this->input->post('medicamento_nombre');
					$datos['medicamento_exp'] = $this->input->post('medicamento_exp');
					$datos['medicamento_mes'] = $this->input->post('medicamento_mes');
					$datos['medicamento_a'] = $this->input->post('medicamento_a');
					
					$datos['habito_id'] = $this->input->post('habito_id');
					$datos['lugar'] = $this->input->post('lugar');
					$datos['horas'] = $this->input->post('horas');
					$datos['minutos'] = $this->input->post('minutos');
					$datos['ampm'] = $this->input->post('ampm');
					$datos['cocinero'] = $this->input->post('cocinero');
					
					$datos['recordatorio_id'] = $this->input->post('recordatorio_id');
					$datos['tiempo'] = $this->input->post('tiempo');
					$datos['alimento'] = $this->input->post('alimento');
					$datos['cantidad'] = $this->input->post('cantidad');
					$datos['unidad'] = $this->input->post('unidad');
					$datos['calorias'] = $this->input->post('calorias');
					
					$this->load->view('evaluacion_dietetica/evdietetica_modificar',$datos);
				}
//No venimos de un formulario
			}else{
				$this->load->model('evdietetica_modelo');
				$datos['evaluacion'] = $this->evdietetica_modelo->buscar_evdietetica($id_evdietetica);
				$datos['recordatorios'] = $this->evdietetica_modelo->buscar_recordatorios($id_evdietetica);
				$datos['frecuencia'] = $this->evdietetica_modelo->buscar_frecuencia($id_evdietetica);
				$datos['historial'] = $this->evdietetica_modelo->buscar_historial($id_evdietetica);
				$datos['tratamientos'] = $this->evdietetica_modelo->buscar_tratamientos($datos['historial']->id);
				$datos['medicamentos'] = $this->evdietetica_modelo->buscar_medicamentos($datos['historial']->id);
				$datos['habitos'] = $this->evdietetica_modelo->buscar_habitos($id_evdietetica);
				
				$datos['id_paciente'] = $datos['evaluacion']->paciente;
				$datos['id_evdietetica'] = $id_evdietetica;
				$this->load->view('evaluacion_dietetica/evdietetica_modificar',$datos);
			}
		}
		
		function borrar($id_evdietetica){
			$this->load->model('evdietetica_modelo');
			$evdietetica = $this->evdietetica_modelo->buscar_evdietetica($id_evdietetica);
			$paciente = $evdietetica->paciente;
			$this->evdietetica_modelo->borrar($id_evdietetica);
			if($paciente){
				$this->listado_mini($paciente);	
			}else{
				echo 'ERROR';
			}
		}
		
		function listado_mini($paciente){
			$datos['id_paciente'] = $paciente;
			$this->load->model('evdietetica_modelo');
			$inicio = ($this->uri->segment(4))?$this->uri->segment(4):0;
			$datos['resultados'] = $this->evdietetica_modelo->listado_mini($datos['id_paciente'],$inicio);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han realizado Evaluaciones al Paciente';
			}
			$this->load->library('pagination');
			$pag_config['base_url'] = "".site_url()."/evdietetica/listado_mini/".$datos['id_paciente']."";
			$pag_config['total_rows'] = $this->evdietetica_modelo->total($datos['id_paciente']);
			$pag_config['per_page'] = 10;
			$pag_config['uri_segment'] = 4;
			$this->pagination->initialize($pag_config);
			$this->load->view('evaluacion_dietetica/evdietetica_listado_mini',$datos);
		}
		
		function listado($paciente){
			$datos['id_paciente'] = $paciente;
			$datos['menu'] = 'menu_paciente';
			$datos['pagina'] = 'evaluacion_dietetica/evdietetica_listado';
			$this->load->model('evdietetica_modelo');
			$datos['resultados'] = $this->evdietetica_modelo->buscar($paciente);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se ha realizado ninguna Evaluaci&oacute;n Diet&eacute;tica al Paciente';
			}
			$this->load->view($datos['pagina'],$datos);
		}
    }
?>