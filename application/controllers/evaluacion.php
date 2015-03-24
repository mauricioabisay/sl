<?php
    /**
     * 
     */
    class Evaluacion extends CI_Controller {
        
        function __construct() {
            parent::__construct();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->form_validation->set_error_delimiters('<span class="advertencia"><img src="'.base_url().'/assets/img/advertencia.png" width="15px" height="15px"><strong>', '</strong></span>');
        }
		
		function index($id){
			$datos['menu'] = 'menu_paciente';
			$datos['id_paciente'] = $id;
			$datos['listado'] = "".site_url()."/evaluacion/listado_mini/".$id."";
			$datos['pagina_frame'] = "".site_url()."/evaluacion/agregar/".$id."";
			
			$this->load->view('plantilla',$datos);
		}
		
		function evaluacion($id){
			$datos['menu'] = 'menu_paciente';
			$datos['id_paciente'] = $id;
			$datos['listado'] = "".site_url()."/evaluacion/listado_mini/".$id."";
			$datos['pagina_frame'] = "".site_url()."/evaluacion/agregar/".$id."";
			
			$this->load->view('plantilla',$datos);
		}
		
		function agregar($id){
			$datos['menu'] = 'menu_paciente';
			$this->load->model('evaluacion_modelo');
			if($this->input->post()){
//Formulario
//Inicio Reglas
				//Reglas Evaluacion
				$this->form_validation->set_rules('peso','Peso','required|greather_than[0]|less_than[500]');
				$this->form_validation->set_rules('estatura','Estatura','required|greather_than[0]|less_than[500]');
				$this->form_validation->set_rules('c_cintura','Circ. Cintura','max_length[5]|greather_than[0]|less_than[500]');
				$this->form_validation->set_rules('c_cadera','Circ. Cadera','max_length[5]|greather_than[0]|less_than[500]');
				$this->form_validation->set_rules('c_muneca','Circ. Mu&ntilde;eca','max_length[5]|greather_than[0]|less_than[99]');
				$this->form_validation->set_rules('grasa','% Grasa','max_length[5]');
				$this->form_validation->set_rules('p_biciptal','P. Biciptal','max_length[5]');
				$this->form_validation->set_rules('p_triciptal','P. Triciptal','max_length[5]');
				$this->form_validation->set_rules('p_subescapular','P. Subescapular','max_length[5]');
				$this->form_validation->set_rules('p_suprailiaco','P. Suprailiaco','max_length[5]');
				$this->form_validation->set_rules('perim_cefalico','Per&iacute;m Cef&aacute;lico','max_length[5]');
				$this->form_validation->set_rules('c_brazo','Circ. Brazo','max_length[5]');
				$this->form_validation->set_rules('embarazo','Embarazo','required');
				$this->form_validation->set_rules('peso_pre_gesta','Peso previo a la gestaci&oacute;n','max_length[5]');
				$this->form_validation->set_rules('semana_gesta','Semanas de Embarazo','max_length[5]');
				$this->form_validation->set_rules('fondo_uterino','Fondo Uterino','max_length[2]');
				$this->form_validation->set_rules('glucosa','Glucosa','numeric|greather_than[0]');
				$this->form_validation->set_rules('presion_sis','Presion Sistolica','numeric|greather_than[0]');
				$this->form_validation->set_rules('presion_dia','Presion Diastolica','numeric|greather_than[0]');
				$this->form_validation->set_rules('peso_saludable','Peso Saludable','greather_than[0]|less_than[500]');
				$this->form_validation->set_rules('peso_meta','Peso Meta','greather_than[0]|less_than[500]');
				//Reglas Tanita
				$this->form_validation->set_rules('tanita','Tanita','');
				$this->form_validation->set_rules('mg_p_gral','Masa grasa','max_length[5]|greather_than[0]|numeric');
				$this->form_validation->set_rules('mg_kg_gral','Masa grasa','max_length[5]|greather_than[0]|numeric');
				$this->form_validation->set_rules('masa_magra_gral','Masa magra','max_length[5]|greather_than[0]|numeric');
				$this->form_validation->set_rules('agua_total','Agua total','max_length[5]|greather_than[0]|numeric');
				$this->form_validation->set_rules('masa_grasa_idealp','Masa grasa ideal','max_length[5]|greather_than[0]|numeric');
				$this->form_validation->set_rules('masa_grasa_idealkg','Masa grasa ideal','max_length[5]|greather_than[0]|numeric');
				for ($i=0;$i<5;$i++){
					switch($i){
						case 0: $nombre='Pierna_der';break;
						case 1: $nombre='Pierna_izq';break;
						case 2: $nombre='Brazo_der';break;
						case 3: $nombre='Brazo_izq';break;
						case 4: $nombre='Tronco';break;
					}
					$this->form_validation->set_rules(''.$nombre.'masa_grasa_p','Masa grasa','max_length[5]|greather_than[0]|numeric');
					$this->form_validation->set_rules(''.$nombre.'masa_grasa_kg','Masa grasa','max_length[5]|greather_than[0]|numeric');
					$this->form_validation->set_rules(''.$nombre.'masa_magra','Masa grasa','max_length[5]|greather_than[0]|numeric');
					$this->form_validation->set_rules(''.$nombre.'masa_muscular','Masa grasa','max_length[5]|greather_than[0]|numeric');
				}
//Fin Reglas
				$datos['id_paciente'] = $this->input->post('paciente');
				if($this->form_validation->run()){
//Datos Validos
					$fecha = new DateTime();
					$evaluacion['fecha'] = $fecha->format('Y-m-d');
					$evaluacion['peso'] = $this->input->post('peso');
					$evaluacion['estatura'] = ($this->input->post('estatura')<10)?$this->input->post('estatura'):$this->input->post('estatura')/100;
					
					if($this->input->post('glucosa')){
						$evaluacion['glucosa'] = $this->input->post('glucosa');	
					}
					if($this->input->post('presion_sis')&&$this->input->post('presion_dia')){
						$evaluacion['presion'] = $this->input->post('presion_sis').'/'.$this->input->post('presion_dia');	
					}
					if($this->input->post('peso_saludable')){
						$evaluacion['peso_saludable'] = $this->input->post('peso_saludable');	
					}
					if($this->input->post('peso_meta')){
						$evaluacion['peso_meta'] = $this->input->post('peso_meta');	
					}
					
					$evaluacion['c_cintura'] = ($this->input->post('c_cintura'))?$this->input->post('c_cintura'):0;
					$evaluacion['c_cadera'] = ($this->input->post('c_cadera'))?$this->input->post('c_cadera'):0;
					$evaluacion['c_muneca'] = ($this->input->post('c_muneca'))?$this->input->post('c_muneca'):0;
					
					$evaluacion['grasa'] = ($this->input->post('grasa'))?$this->input->post('grasa'):0;
					$evaluacion['p_biciptal'] = ($this->input->post('p_biciptal'))?$this->input->post('p_biciptal'):0;
					$evaluacion['p_triciptal'] = ($this->input->post('p_triciptal'))?$this->input->post('p_triciptal'):0;
					$evaluacion['p_subescapular'] = ($this->input->post('p_subescapular'))?$this->input->post('p_subescapular'):0;
					$evaluacion['p_suprailiaco'] = ($this->input->post('p_suprailiaco'))?$this->input->post('p_suprailiaco'):0;
					$evaluacion['perim_cefalico'] = ($this->input->post('perim_cefalico'))?$this->input->post('perim_cefalico'):0;
					$evaluacion['c_brazo'] = ($this->input->post('c_brazo'))?$this->input->post('c_brazo'):0;
					
					$evaluacion['embarazo'] = $this->input->post('embarazo');
					if($this->input->post('embarazo')=='Si'){
						$evaluacion['peso_pre_gesta'] = $this->input->post('peso_pre_gesta');
						/*$edad_gesta=$this->input->post('fondo_uterino');*/
						/*$edad_gesta2=$edad_gesta+4;*/
						/*$evaluacion['semana_gesta'] = ($edad_gesta>=20 && $edad_gesta <=31)?$edad_gesta:$edad_gesta2 ;*/
						$evaluacion['fondo_uterino'] = $this->input->post('fondo_uterino');
						$evaluacion['semana_gesta'] = $this->input->post('semana_gesta');
					}else{
						$evaluacion['peso_pre_gesta'] = 0;
						$evaluacion['fondo_uterino'] = 0;
					}
					$evaluacion['paciente'] = $this->input->post('paciente');		
//Alta Evaluacion
					$id_evaluacion = $this->evaluacion_modelo->agregar_evaluacion($evaluacion);
					
//Inicio Tanita
					if($this->input->post('tanita')=='Si'){
					//Preparando datos Tanita General
						$tanita['id_eval']= $id_evaluacion;
						$tanita['concepto']= 'General';
						$tanita['masa_grasa_p']= $this->input->post('mg_p_gral');
						$tanita['masa_grasa_kg']= $this->input->post('mg_kg_gral');
						$tanita['masa_magra']= $this->input->post('masa_magra_gral');
						$tanita['agua_total']= $this->input->post('agua_total');
						$tanita['masa_grasa_idealp']= $this->input->post('masa_grasa_idealp');
						$tanita['masa_grasa_idealkg']= $this->input->post('masa_grasa_idealkg');
//Alta Tanita General
						if(($tanita['masa_grasa_p']=!NULL)&&($tanita['masa_grasa_kg']!=NULL)){
							$this->evaluacion_modelo->agregar_tanita($tanita);	
						}
					//Preparando datos Tanita Segmento
						for($i=0;$i<5;$i++){
							switch($i){
								case 0: $nombre='Pierna_der';break;
								case 1: $nombre= 'Pierna_izq';break;
								case 2: $nombre= 'Brazo_der';break;
								case 3: $nombre= 'Brazo_izq';break;
								case 4: $nombre= 'Tronco';break;
							}
							$tanita['concepto']=$nombre;
							$tanita['masa_grasa_p']= $this->input->post(''.$nombre.'masa_grasa_p');
							$tanita['masa_grasa_kg']= $this->input->post(''.$nombre.'masa_grasa_kg');
							$tanita['masa_magra']= $this->input->post(''.$nombre.'masa_magra');
							$tanita['masa_muscular']= $this->input->post(''.$nombre.'masa_muscular');
							$tanita['agua_total']= NULL;
							$tanita['masa_grasa_idealp']=NULL;
							$tanita['masa_grasa_idealkg']=NULL;
//Alta Tanita Segmento
							if(($tanita['masa_grasa_p']!=NULL)&&($tanita['masa_grasa_kg']!= NULL)){
								$this->evaluacion_modelo->agregar_tanita($tanita);	
							}
						}
//Fin Tanita
					}		
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Datos de Evaluaci&oacute;n Antropom&eacute;trica guardados';
					$this->detalle($id_evaluacion);
				}else{
//Datos Invalidos
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					$this->load->model('paciente_modelo');
					$datos['edad'] = $this->paciente_modelo->edad_num($datos['id_paciente'],date('Y-m-d'));
					$datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
					$datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
					if($datos['mujer']){
						$this->load->model('antecedentes_modelo');
						$embarazo = $this->antecedentes_modelo->embarazo($datos['id_paciente']);
						if($embarazo){
							$this->load->model('evaluacion_modelo');
							$datos['embarazo'] = $this->evaluacion_modelo->datos_embarazo($datos['id_paciente']);
						}
					}
					$this->load->view('evaluacion_antropometrica/evaluacion_agregar',$datos);
				}
			}else{
//No Formulario
				$datos['id_paciente'] = $id;
				$this->load->model('paciente_modelo');
				$datos['edad'] = $this->paciente_modelo->edad_num($datos['id_paciente'],date('Y-m-d'));
				$datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
				$datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
				$this->load->model('evaluacion_modelo');
				$datos['evaluacion'] = $this->evaluacion_modelo->evaluacion_reciente($datos['id_paciente']); 
				if($datos['mujer']){
					$this->load->model('antecedentes_modelo');
					$embarazo = $this->antecedentes_modelo->embarazo($datos['id_paciente']);
					if($embarazo){
						$this->load->model('evaluacion_modelo');
						$datos['embarazo'] = $this->evaluacion_modelo->datos_embarazo($datos['id_paciente']);
					}
				}
				$this->load->view('evaluacion_antropometrica/evaluacion_agregar',$datos);
			}
		}

		function modificar($id_evaluacion){
			$datos['menu'] = 'menu_paciente';
			$this->load->model('evaluacion_modelo');
			if($this->input->post()){
//Formulario
//Inicio Reglas
				//Reglas Evaluacion
				$this->form_validation->set_rules('peso','Peso','required|greather_than[0]|less_than[500]');
				$this->form_validation->set_rules('estatura','Estatura','required|greather_than[0]|less_than[500]');
				$this->form_validation->set_rules('c_cintura','Circ. Cintura','max_length[5]|greather_than[0]|less_than[500]');
				$this->form_validation->set_rules('c_cadera','Circ. Cadera','max_length[5]|greather_than[0]|less_than[500]');
				$this->form_validation->set_rules('c_muneca','Circ. Mu&ntilde;eca','max_length[5]|greather_than[0]|less_than[99]');
				$this->form_validation->set_rules('grasa','% Grasa','max_length[5]');
				$this->form_validation->set_rules('p_biciptal','P. Biciptal','max_length[5]');
				$this->form_validation->set_rules('p_triciptal','P. Triciptal','max_length[5]');
				$this->form_validation->set_rules('p_subescapular','P. Subescapular','max_length[5]');
				$this->form_validation->set_rules('p_suprailiaco','P. Suprailiaco','max_length[5]');
				$this->form_validation->set_rules('perim_cefalico','Per&iacute;m Cef&aacute;lico','max_length[5]');
				$this->form_validation->set_rules('c_brazo','Circ. Brazo','max_length[5]');
				$this->form_validation->set_rules('embarazo','Embarazo','required');
				$this->form_validation->set_rules('peso_pre_gesta','Peso previo a la gestaci&oacute;n','max_length[5]');
				$this->form_validation->set_rules('fondo_uterino','Fondo Uterino','max_length[2]');
				$this->form_validation->set_rules('glucosa','Glucosa','greather_than[0]|less_than[500]');
				$this->form_validation->set_rules('presion_sis','Presion Sistolica','numeric|greather_than[0]');
				$this->form_validation->set_rules('presion_dia','Presion Diastolica','numeric|greather_than[0]');
				$this->form_validation->set_rules('peso_saludable','Peso Saludable','greather_than[0]|less_than[500]');
				$this->form_validation->set_rules('peso_meta','Peso Meta','greather_than[0]|less_than[500]');
				//Reglas Tanita
				$this->form_validation->set_rules('tanita','Tanita','');
				$this->form_validation->set_rules('mg_p_gral','Masa grasa','max_length[5]|greather_than[0]|numeric');
				$this->form_validation->set_rules('mg_kg_gral','Masa grasa','max_length[5]|greather_than[0]|numeric');
				$this->form_validation->set_rules('masa_magra_gral','Masa magra','max_length[5]|greather_than[0]|numeric');
				$this->form_validation->set_rules('agua_total','Agua total','max_length[5]|greather_than[0]|numeric');
				$this->form_validation->set_rules('masa_grasa_idealp','Masa grasa ideal','max_length[5]|greather_than[0]|numeric');
				$this->form_validation->set_rules('masa_grasa_idealkg','Masa grasa ideal','max_length[5]|greather_than[0]|numeric');
				for ($i=0;$i<5;$i++){
					switch($i){
						case 0: $nombre='Pierna_der';break;
						case 1: $nombre='Pierna_izq';break;
						case 2: $nombre='Brazo_der';break;
						case 3: $nombre='Brazo_izq';break;
						case 4: $nombre='Tronco';break;
					}
					$this->form_validation->set_rules(''.$nombre.'masa_grasa_p','Masa grasa','max_length[5]|greather_than[0]|numeric');
					$this->form_validation->set_rules(''.$nombre.'masa_grasa_kg','Masa grasa','max_length[5]|greather_than[0]|numeric');
					$this->form_validation->set_rules(''.$nombre.'masa_magra','Masa grasa','max_length[5]|greather_than[0]|numeric');
					$this->form_validation->set_rules(''.$nombre.'masa_muscular','Masa grasa','max_length[5]|greather_than[0]|numeric');
				}
//Fin Reglas
				$datos['id_paciente'] = $this->input->post('paciente');
				if($this->form_validation->run()){
//Datos Validos
					$fecha = new DateTime();
					$evaluacion['fecha'] = $fecha->format('Y-m-d');
					$evaluacion['peso'] = $this->input->post('peso');
					$evaluacion['estatura'] = ($this->input->post('estatura')<10)?$this->input->post('estatura'):$this->input->post('estatura')/100;
					
					if($this->input->post('glucosa')){
						$evaluacion['glucosa'] = $this->input->post('glucosa');	
					}
					if($this->input->post('presion_sis')&&$this->input->post('presion_dia')){
						$evaluacion['presion'] = $this->input->post('presion_sis').'/'.$this->input->post('presion_dia');	
					}
					if($this->input->post('peso_saludable')){
						$evaluacion['peso_saludable'] = $this->input->post('peso_saludable');	
					}
					if($this->input->post('peso_meta')){
						$evaluacion['peso_meta'] = $this->input->post('peso_meta');	
					}
					
					$evaluacion['c_cintura'] = ($this->input->post('c_cintura'))?$this->input->post('c_cintura'):0;
					$evaluacion['c_cadera'] = ($this->input->post('c_cadera'))?$this->input->post('c_cadera'):0;
					$evaluacion['c_muneca'] = ($this->input->post('c_muneca'))?$this->input->post('c_muneca'):0;
					
					$evaluacion['grasa'] = ($this->input->post('grasa'))?$this->input->post('grasa'):0;
					$evaluacion['p_biciptal'] = ($this->input->post('p_biciptal'))?$this->input->post('p_biciptal'):0;
					$evaluacion['p_triciptal'] = ($this->input->post('p_triciptal'))?$this->input->post('p_triciptal'):0;
					$evaluacion['p_subescapular'] = ($this->input->post('p_subescapular'))?$this->input->post('p_subescapular'):0;
					$evaluacion['p_suprailiaco'] = ($this->input->post('p_suprailiaco'))?$this->input->post('p_suprailiaco'):0;
					$evaluacion['perim_cefalico'] = ($this->input->post('perim_cefalico'))?$this->input->post('perim_cefalico'):0;
					$evaluacion['c_brazo'] = ($this->input->post('c_brazo'))?$this->input->post('c_brazo'):0;
					
					$evaluacion['embarazo'] = $this->input->post('embarazo');
					if($this->input->post('embarazo')=='Si'){
						$evaluacion['peso_pre_gesta'] = $this->input->post('peso_pre_gesta');
						/*$edad_gesta=$this->input->post('fondo_uterino');*/
						/*$edad_gesta2=$edad_gesta+4;*/
						/*$evaluacion['semana_gesta'] = ($edad_gesta>=20 && $edad_gesta <=31)?$edad_gesta:$edad_gesta2 ;*/
						$evaluacion['fondo_uterino'] = $this->input->post('fondo_uterino');
						$evaluacion['semana_gesta'] = $this->input->post('semana_gesta');
					}else{
						$evaluacion['peso_pre_gesta'] = 0;
						$evaluacion['fondo_uterino'] = 0;
					}
					$evaluacion['paciente'] = $this->input->post('paciente');		
//Modificar Evaluacion
					$this->evaluacion_modelo->modificar_evaluacion($id_evaluacion,$evaluacion);
					
//Inicio Tanita
					if($this->input->post('tanita')=='Si'){
					//Preparando datos Tanita General
						$tanita['id_eval']= $id_evaluacion;
						$tanita['concepto']= 'General';
						$tanita['masa_grasa_p']= $this->input->post('mg_p_gral');
						$tanita['masa_grasa_kg']= $this->input->post('mg_kg_gral');
						$tanita['masa_magra']= $this->input->post('masa_magra_gral');
						$tanita['agua_total']= $this->input->post('agua_total');
						$tanita['masa_grasa_idealp']= $this->input->post('masa_grasa_idealp');
						$tanita['masa_grasa_idealkg']= $this->input->post('masa_grasa_idealkg');
//Modificar Tanita General
						if($this->input->post('mg_p_gral')&&$this->input->post('mg_kg_gral')){
							if($this->input->post('id_tanita_gral')){
								$this->evaluacion_modelo->modificar_tanita($this->input->post('id_tanita_gral'),$tanita);	
							}else{
								$this->evaluacion_modelo->agregar_tanita($tanita);
							}
								
						}
					//Preparando datos Tanita Segmento
						for($i=0;$i<5;$i++){
							switch($i){
								case 0: $nombre='Pierna_der';break;
								case 1: $nombre= 'Pierna_izq';break;
								case 2: $nombre= 'Brazo_der';break;
								case 3: $nombre= 'Brazo_izq';break;
								case 4: $nombre= 'Tronco';break;
							}
							$tanita['concepto']=$nombre;
							$tanita['masa_grasa_p']= $this->input->post(''.$nombre.'masa_grasa_p');
							$tanita['masa_grasa_kg']= $this->input->post(''.$nombre.'masa_grasa_kg');
							$tanita['masa_magra']= $this->input->post(''.$nombre.'masa_magra');
							$tanita['masa_muscular']= $this->input->post(''.$nombre.'masa_muscular');
							$tanita['agua_total']= NULL;
							$tanita['masa_grasa_idealp']=NULL;
							$tanita['masa_grasa_idealkg']=NULL;
//Alta Tanita Segmento
							if(($tanita['masa_grasa_p']!=NULL)&&($tanita['masa_grasa_kg']!= NULL)){
								if($this->input->post(''.$nombre.'id_tanita')){
								$this->evaluacion_modelo->modificar_tanita($this->input->post(''.$nombre.'id_tanita'),$tanita);	
								}else{
									$this->evaluacion_modelo->agregar_tanita($tanita);
								}	
							}
						}
//Fin Tanita
					}		
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Datos de Evaluaci&oacute;n Antropom&eacute;trica guardados';
					$this->detalle($id_evaluacion);
				}else{
//Datos Invalidos
					$datos['id_evaluacion'] = $id_evaluacion;
					$datos['preguntas_seguimiento'] = $this->evaluacion_modelo->existen_preguntas_seguimiento($id_evaluacion);
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					$this->load->model('paciente_modelo');
					$datos['edad'] = $this->paciente_modelo->edad_num($datos['id_paciente'],date('Y-m-d'));
					$datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
					$datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
					if($datos['mujer']){
						$this->load->model('antecedentes_modelo');
						$embarazo = $this->antecedentes_modelo->embarazo($datos['id_paciente']);
						if($embarazo){
							$this->load->model('evaluacion_modelo');
							$datos['embarazo'] = $this->evaluacion_modelo->datos_embarazo($datos['id_paciente']);
						}
					}
					$this->load->view('evaluacion_antropometrica/evaluacion_modificar',$datos);
				}
			}else{
//No Formulario
				$evaluacion = $this->evaluacion_modelo->buscar_id($id_evaluacion);
				$datos['evaluacion'] = $evaluacion;
				$datos['tanita_general'] = $this->evaluacion_modelo->buscar_tanita_general($id_evaluacion);
				$datos['tanita_segmentos'] = $this->evaluacion_modelo->buscar_tanita_segmentos($id_evaluacion);
				
				$datos['id_paciente'] = $evaluacion->paciente;
				$datos['id_evaluacion'] = $id_evaluacion;
				$datos['preguntas_seguimiento'] = $this->evaluacion_modelo->existen_preguntas_seguimiento($id_evaluacion);
				$this->load->model('paciente_modelo');
				$datos['edad'] = $this->paciente_modelo->edad_num($datos['id_paciente'],date('Y-m-d'));
				$datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
				$datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
				if($datos['mujer']){
					$this->load->model('antecedentes_modelo');
					$embarazo = $this->antecedentes_modelo->embarazo($datos['id_paciente']);
					if($embarazo){
						$this->load->model('evaluacion_modelo');
						$datos['embarazo'] = $this->evaluacion_modelo->datos_embarazo($datos['id_paciente']);
					}
				}
				$this->load->view('evaluacion_antropometrica/evaluacion_modificar',$datos);
			}
		}
		
		function busqueda(){
		}
		
		function detalle($id){
			include('eval_paciente.php');
			$this->load->model('evaluacion_modelo');
			$evaluacion = $this->evaluacion_modelo->buscar_id($id);
			$datos['evaluacion'] = $evaluacion;
			$datos['id_paciente'] = $evaluacion->paciente;
			$datos['preguntas_seguimiento'] = $this->evaluacion_modelo->existen_preguntas_seguimiento($id);
			$datos['menu'] = 'menu_paciente';
			
			$this->load->model('paciente_modelo');
			$menor = $datos['menor'] = $this->paciente_modelo->es_menor($datos['id_paciente']);
			$mujer = $datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
			$edad = $datos['edad'] =$this->paciente_modelo->edad_num($datos['id_paciente'],$evaluacion->fecha);
			
			if($menor){
				$eval_paciente = new Eval_paciente($evaluacion,$edad,$mujer,'infante');
				$datos['waterlow'] = $eval_paciente->evaluacion_waterlow();
				$datos['z'] = $eval_paciente->evaluacion_puntuacion_z();
				$datos['imc'] = $eval_paciente->evaluacion_imc();
				
				if($evaluacion->perim_cefalico>0){
					$datos['circ_cefalica'] = $eval_paciente->evaluacion_cefalica();
					$datos['ideal_circ_cefalica'] = $eval_paciente->ideal_cefalica();
				}
				
				if($evaluacion->c_brazo>0){
					$datos['circ_brazo'] = $eval_paciente->evaluacion_brazo();
					$datos['ideal_circ_brazo'] = $eval_paciente->ideal_brazo();	
				}
				
				$datos['ideal_waterlow'] = $eval_paciente->ideal_waterlow();
				$datos['ideal_z'] = $eval_paciente->ideal_puntuacion_z();
				$datos['ideal_imc'] = $eval_paciente->ideal_imc();
			}else if($mujer){
				$this->load->model('antecedentes_modelo');
				//$embarazo = $this->antecedentes_modelo->embarazo($datos['id_paciente']);
				$embarazo = ($evaluacion->embarazo=="Si")?TRUE:FALSE;	
				if($embarazo){
					$datos['embarazo'] = $this->evaluacion_modelo->datos_embarazo_fecha($datos['id_paciente'],$evaluacion->fecha);
					$eval_paciente = new Eval_paciente($evaluacion,$edad,$mujer,'embarazo');
					$eval_paciente->set_embarazo($datos['embarazo']);
					$datos['eval_embarazo'] = $eval_paciente->evaluacion_imc_embarazo();
					$datos['imc'] = $eval_paciente->evaluacion_imc();
					$datos['grasa_pliegues'] = $eval_paciente->evaluacion_pliegues();
					
					$datos['ideal_eval_embarazo'] = $eval_paciente->ideal_imc_embarazo();
					$datos['ideal_imc'] = $eval_paciente->ideal_imc();
					$datos['ideal_porcentaje_grasa'] = $eval_paciente->ideal_porcentaje_grasa();
				}else{
					$eval_paciente = new Eval_paciente($evaluacion,$edad,$mujer,'adulto');
					$datos['imc'] = $eval_paciente->evaluacion_imc();
					$datos['indice_cintura_cadera'] = $eval_paciente->evaluacion_cintura_cadera();
					$datos['complexion'] = $eval_paciente->evaluacion_complexion();
					$datos['grasa_pliegues'] = $eval_paciente->evaluacion_pliegues();
					
					$datos['ideal_imc'] = $eval_paciente->ideal_imc();
					$datos['ideal_indice_cintura_cadera'] = $eval_paciente->ideal_cintura_cadera();
					$datos['ideal_complexion'] = $eval_paciente->ideal_complexion();
					$datos['ideal_porcentaje_grasa'] = $eval_paciente->ideal_porcentaje_grasa();
				}
			}else{
				$eval_paciente = new Eval_paciente($evaluacion,$edad,$mujer,'adulto');
				$datos['imc'] = $eval_paciente->evaluacion_imc();
				$datos['indice_cintura_cadera'] = $eval_paciente->evaluacion_cintura_cadera();
				$datos['complexion'] = $eval_paciente->evaluacion_complexion();
				$datos['grasa_pliegues'] = $eval_paciente->evaluacion_pliegues();
				
				$datos['ideal_imc'] = $eval_paciente->ideal_imc();
				$datos['ideal_indice_cintura_cadera'] = $eval_paciente->ideal_cintura_cadera();
				$datos['ideal_complexion'] = $eval_paciente->ideal_complexion();
				$datos['ideal_porcentaje_grasa'] = $eval_paciente->ideal_porcentaje_grasa();
			}
			$lista_tanita=$this->evaluacion_modelo->buscar_datos_tanita($id);
			$datos['resultados']=($lista_tanita)?$lista_tanita:NULL;
			
			$this->load->view('evaluacion_antropometrica/evaluacion_ficha',$datos);
		}
		
		function borrar($id){
			$this->load->model('evaluacion_modelo');
			$evaluacion = $this->evaluacion_modelo->buscar_id($id);
			$paciente = $evaluacion->paciente;
			$this->evaluacion_modelo->borrar($id);
			if($paciente){
				$this->listado_mini($paciente);	
			}else{
				echo 'ERROR';
			}
		}
		
		function listado_mini($paciente){
			$datos['id_paciente'] = $paciente;
			$this->load->model('evaluacion_modelo');
			$inicio = ($this->uri->segment(4))?$this->uri->segment(4):0;
			$datos['resultados'] = $this->evaluacion_modelo->listado_mini($datos['id_paciente'],$inicio);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han capturado Evaluaciones sobre el Paciente';
			}
			$this->load->library('pagination');
			$pag_config['base_url'] = "".site_url()."/evaluacion/listado_mini/".$datos['id_paciente']."";
			$pag_config['total_rows'] = $this->evaluacion_modelo->total($datos['id_paciente']);
			$pag_config['per_page'] = 10;
			$pag_config['uri_segment'] = 4;
			$this->pagination->initialize($pag_config);
			$this->load->view('evaluacion_antropometrica/evaluacion_listado_mini',$datos);
		}
		
		function listado($id){
			$this->load->model('paciente_modelo');
			$datos['id_paciente'] = $id;
			$aux_paciente = $this->paciente_modelo->buscar_id($datos['id_paciente']);
			$datos['fecha_nac'] = DateTime::createFromFormat('d-m-Y',$aux_paciente->fecha_nac); 
			$datos['mujer'] = $this->paciente_modelo->es_mujer($datos['id_paciente']);
			$datos['menu'] = 'menu_paciente';
			$this->load->model('evaluacion_modelo');
			$datos['resultados'] = $this->evaluacion_modelo->buscar($id);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se ha realizado ninguna Evaluaci&oacute;n Antropom&eacute;trica al Paciente';
			}
			$this->load->view('evaluacion_antropometrica/evaluacion_listado',$datos);
		}
    }
?>