<?php
    /**
     * 
     */
    class Plan_alimenticio extends CI_Controller {
        
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
			$datos['listado'] = "".site_url()."/plan_alimenticio/listado_mini/".$id."";
			$datos['pagina_frame'] = "".site_url()."/plan_alimenticio/busqueda/".$id."";
			$this->load->view('plantilla',$datos);
		}
		
		function agregar($plan,$calculo){
			$this->load->model('calculo_modelo');
			$this->load->model('evaluacion_modelo');
			$consumo = $this->calculo_modelo->buscar_consumo($calculo);
			$evaluacion = $this->evaluacion_modelo->buscar_id($consumo->evaluacion);
			$paciente = $evaluacion->paciente;
			$this->load->model('plan_alimenticio_modelo');
			$plan_alimenticio['plan'] = $plan;
			$plan_alimenticio['calculo'] = $calculo;
			$plan_alimenticio['paciente'] = $paciente;
			$plan_alimenticio['fecha'] = date('Y-m-d');
			$id = $this->plan_alimenticio_modelo->agregar($plan_alimenticio);
			$this->detalle($id);
		}
		
		function busqueda($paciente){
			$this->load->model('calculo_modelo');
			$this->load->model('evaluacion_modelo');
			$id_consumo = $this->calculo_modelo->calculo_reciente($paciente);
			if($id_consumo){
				$id_consumo = $id_consumo->id;
				$consumo = $datos['consumo_energetico'] = $this->calculo_modelo->buscar_consumo($id_consumo);
				$evaluacion = $datos['evaluacion'] = $this->evaluacion_modelo->buscar_id($consumo->evaluacion);
				$id = $evaluacion->paciente;
				$datos['menu'] = 'menu_paciente';
				$datos['id_paciente'] = $id;
				/*$datos['listado'] = "".site_url()."/calculo/listado_mini/".$id."";
				$datos['pagina_frame'] = "".site_url()."/calculo/agregar/".$id."";*/
				$datos['pagina'] = 'plan_alimenticio/calculo_ficha';
				$this->load->model('paciente_modelo');
				$this->load->model('antecedentes_modelo');
				$this->load->model('antecedentes_patologicos_modelo');
				
				$datos['patologias'] = $this->antecedentes_patologicos_modelo->buscar_patologias_paciente($datos['id_paciente']);
				
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
				
				if($this->input->post()){
					$sql = '';
					$sql .= ($mujer)?'select * from tabla_plan_alimenticio_mujeres':'select * from tabla_plan_alimenticio_hombres';
					$sql .= ' WHERE ';
					if($this->input->post('calorias')){
						$calorias = $this->input->post('calorias');
						$calorias_aux = $calorias%100;
						$calorias = $calorias - $calorias_aux;
						$calorias += ($calorias_aux>49)?100:0;
						$sql .= 'calorias='.$calorias;
					}else{
						$sql .= 'calorias='.$consumo->consumo_energetico;
					}
					if($this->input->post('carbohidratos')){
						$sql .= ' AND  carbohidratos='.$this->input->post('carbohidratos');
					}
					if($this->input->post('proteinas')){
						$sql .= ' AND  proteinas='.$this->input->post('proteinas');
					}
					if($this->input->post('lipidos')){
						$sql .= ' AND  lipidos='.$this->input->post('lipidos');
					}
					if($this->input->post('azucar')){
						$sql .= ' AND  azucar="'.$this->input->post('azucar').'"';
					}
					
					$sql .= ($this->input->post('desayuno'))?' AND  desayuno="Si"':' AND  desayuno="No"';
					$sql .= ($this->input->post('co1'))?' AND  co1="Si"':' AND  co1="No"';
					$sql .= ($this->input->post('comida'))?' AND  comida="Si"':' AND  comida="No"';
					$sql .= ($this->input->post('co2'))?' AND  co2="Si"':' AND  co2="No"';
					$sql .= ($this->input->post('cena'))?' AND  cena="Si"':' AND  cena="No"';
					
					if($this->input->post('prioridad')){
						if($this->input->post('prioridad')=="desayuno"){
							$sql.= ' AND  p_desayuno="Si"';
						}
						if($this->input->post('prioridad')=="co1"){
							$sql.= ' AND  p_co1="Si"';
						}
						if($this->input->post('prioridad')=="comida"){
							$sql.= ' AND  p_comida="Si"';
						}
						if($this->input->post('prioridad')=="co2"){
							$sql.= ' AND  p_co2="Si"';
						}
						if($this->input->post('prioridad')=="cena"){
							$sql.= ' AND  p_cena="Si"';
						}
					}
					
					$this->load->model('plan_alimenticio_modelo');
					$datos['resultados'] = $this->plan_alimenticio_modelo->buscar($sql);
				}
				$this->load->view($datos['pagina'],$datos);	
			}
		}
		
		function detalle($id){
			$this->load->model('plan_alimenticio_modelo');
			$this->load->model('paciente_modelo');
			$this->load->model('calculo_modelo');
			$this->load->model('evaluacion_modelo');
			
			$datos['plan_ficha'] = $this->plan_alimenticio_modelo->buscar_id($id);
			$mujer = $datos['mujer'] = $this->paciente_modelo->es_mujer($datos['plan_ficha']->paciente);
			$datos['plan'] = $this->plan_alimenticio_modelo->buscar_plan($datos['plan_ficha']->plan,$mujer);
			$datos['resultados'] = $this->plan_alimenticio_modelo->buscar_alimentos($datos['plan']->id,$mujer);
			$datos['pagina'] = 'plan_alimenticio/ficha';
			
			$id_consumo = $datos['plan_ficha']->calculo;
			if($id_consumo){
				$id_consumo = $id_consumo;
				$consumo = $datos['consumo_energetico'] = $this->calculo_modelo->buscar_consumo($id_consumo);
				$evaluacion = $datos['evaluacion'] = $this->evaluacion_modelo->buscar_id($consumo->evaluacion);
				$id = $evaluacion->paciente;
				$datos['menu'] = 'menu_paciente';
				$datos['id_paciente'] = $id;
				
				$this->load->model('paciente_modelo');
				$this->load->model('antecedentes_modelo');
				$this->load->model('antecedentes_patologicos_modelo');
				
				$datos['patologias'] = $this->antecedentes_patologicos_modelo->buscar_patologias_paciente($datos['id_paciente']);
				
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
			}
			$this->load->view($datos['pagina'],$datos);
		}
		
		function modificar($id){
		}
		
		function borrar($id){
			$this->load->model('plan_alimenticio_modelo');
			$plan = $this->plan_alimenticio_modelo->buscar_id($id);
			$paciente = $plan->paciente;
			$this->plan_alimenticio_modelo->borrar($id);
			$this->listado_mini($paciente);
		}
		
		function listado(){
		}
		
		function listado_mini($id){
			$datos['id_paciente'] = $id;
			$this->load->model('plan_alimenticio_modelo');
			$inicio = ($this->uri->segment(4))?$this->uri->segment(4):0;
			$datos['resultados'] = $this->plan_alimenticio_modelo->listado_mini($datos['id_paciente'],$inicio);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han capturado Planes al Paciente';
			}
			$this->load->library('pagination');
			$pag_config['base_url'] = "".site_url()."/plan_alimenticio/listado_mini/".$datos['id_paciente']."";
			$pag_config['total_rows'] = $this->plan_alimenticio_modelo->total($datos['id_paciente']);
			$pag_config['per_page'] = 10;
			$pag_config['uri_segment'] = 4;
			$this->pagination->initialize($pag_config);
			$this->load->view('plan_alimenticio/plan_listado_mini',$datos);
		}
		
		function agregar_plan_nuevo(){
			$this->form_validation->set_rules('genero','Genero','required');
			$this->form_validation->set_rules('calorias','Calorias','required|max_length[6]');
			$this->form_validation->set_rules('carbohidratos','Carbohidratos','required|max_length[4]');
			$this->form_validation->set_rules('proteinas','Proteinas','required||max_length[4]');
			$this->form_validation->set_rules('lipidos','Lipidos','required|max_length[4]');
			$this->form_validation->set_rules('azucar','Azucar','required');
			$this->form_validation->set_rules('desayuno','Desayuno','');
			$this->form_validation->set_rules('co1','Colacion Mañana','');
			$this->form_validation->set_rules('comida','Comida','');
			$this->form_validation->set_rules('co2','Colacion Tarde','');
			$this->form_validation->set_rules('cena','Cena','');
			$this->form_validation->set_rules('prioridad','Prioridad','required');
			
			for ($i = 1; $i <= 17; $i++){
				$this->form_validation->set_rules('total_'.$i,'Total','');
				$this->form_validation->set_rules('des_'.$i,'Des','');
				$this->form_validation->set_rules('co1_'.$i,'CoM','');
				$this->form_validation->set_rules('com_'.$i,'Com','');
				$this->form_validation->set_rules('co2_'.$i,'CoT','');
				$this->form_validation->set_rules('cen_'.$i,'Cen','');
			}
			
			if ($this->input->post()){
				if ($this->form_validation->run()){
					$plan['calorias'] = $this->input->post('calorias');
					$plan['carbohidratos'] = $this->input->post('carbohidratos');
					$plan['proteinas'] = $this->input->post('proteinas');
					$plan['lipidos'] = $this->input->post('lipidos');
					$plan['azucar'] = $this->input->post('azucar');
					
					$plan['desayuno'] = $this->input->post('desayuno')!= NULL ?$this->input->post('desayuno'):'No';
					$plan['co1'] = $this->input->post('co1') != NULL ?$this->input->post('co1'):'No';
					$plan['comida'] = $this->input->post('comida') != NULL ?$this->input->post('comida'):'No';
					$plan['co2'] = $this->input->post('co2') != NULL ?$this->input->post('co2'):'No';
					$plan['cena'] = $this->input->post('cena') != NULL ?$this->input->post('cena'):'No';
					
					if($plan['desayuno'] == 'Si' && $plan['co1'] == 'No' && $plan['comida'] == 'Si'&&
					   $plan['co2'] == 'No' && $plan['cena'] =='Si')
						$plan['numero_comidas'] = 3;
					if($plan['desayuno'] == 'Si' && $plan['co1'] == 'Si' && $plan['comida'] == 'Si' &&
					   $plan['co2'] == 'Si' && $plan['cena'] == 'Si')
					   	$plan['numero_comidas'] = 5;
					if($plan['desayuno'] == 'Si'&& $plan['co1'] == 'Si' && $plan['comida'] == 'Si' &&
					   $plan['co2'] == 'No')
						$plan['numero_comidas'] = '3CoM';
					if($plan['desayuno'] == 'Si' && $plan['co1'] == 'No' && $plan['comida'] == 'Si' &&
					   $plan['co2'] == 'Si')
						$plan['numero_comidas'] = '3CoT';
						
					
					
					$prioridad = $this->input->post('prioridad');
					
					switch ($prioridad){
						case 'desayuno':{
							$plan['p_desayuno'] = "Si";
							$plan['p_co1'] = "No";
							$plan['p_comida'] = "No";
							$plan['p_co2'] = "No";
							$plan['p_cena'] = "No";
							$plan['prioridad'] = "PDM";
						}break;
						case 'co1':{
							$plan['p_desayuno'] = "No";
							$plan['p_co1'] = "Si";
							$plan['p_comida'] = "No";
							$plan['p_co2'] = "No";
							$plan['p_cena'] = "No";
							$plan['prioridad'] = "PCoMM";
						}break;
						case 'comida':{
							$plan['p_desayuno'] = "No";
							$plan['p_co1'] = "No";
							$plan['p_comida'] = "Si";
							$plan['p_co2'] = "No";
							$plan['p_cena'] = "No";
							$plan['prioridad'] = "PCM";
						}break;
						case 'co2':{
							$plan['p_desayuno'] = "No";
							$plan['p_co1'] = "No";
							$plan['p_comida'] = "No";
							$plan['p_co2'] = "Si";
							$plan['p_cena'] = "No";
							$plan['prioridad'] = "PCoTM";
						}break;
						case 'cena':{
							$plan['p_desayuno'] = "No";
							$plan['p_co1'] = "No";
							$plan['p_comida'] = "No";
							$plan['p_co2'] = "No";
							$plan['p_cena'] = "Si";
							$plan['prioridad'] = "PCeM";
						}break;
						
					}
					$sexo = $this->input->post('genero');
					$this->load->model('plan_alimenticio_modelo');
					$id_plan = $this->plan_alimenticio_modelo->agregar_nuevo($plan, $sexo);
					
					$plan_alimento['plan_alimenticio']=$id_plan;
					for($i = 1; $i <= 17; $i++){
						$guardar = FALSE;
						if($i <= 2 && $this->input->post('total_'.$i) != ''){
							$plan_alimento['nombre'] = 'Cy T';
							if($i == 1)
								$plan_alimento['recomendacion'] = 'General';
							if($i == 2)
								$plan_alimento['recomendacion'] = 'Recomendado';
							$guardar = TRUE;
						}
						
						
						if($i == 3 && $this->input->post('total_'.$i) != ''){
							$plan_alimento['nombre'] = 'Leguminosas';
							$plan_alimento['recomendacion']='General';
							$guardar = TRUE;
						}
						
						if($i == 4 && $this->input->post('total_'.$i) != ''){
							$plan_alimento['nombre'] = 'Verduras';
							$plan_alimento['recomendacion']='General';
							$guardar = TRUE;
						}
						
						if($i == 5 && $this->input->post('total_'.$i) != ''){
							$plan_alimento['nombre'] = 'Frutas';
							$plan_alimento['recomendacion']='General';
							$guardar = TRUE;
						}
						
						if($i > 5 && $i <= 9 && $this->input->post('total_'.$i) != ''){
							$plan_alimento['nombre'] = 'A.O.A';
							switch ($i){
								case '6': $rec = 'General'; break;
								case '7': $rec = 'Recomendado'; break;
								case '8': $rec = 'Prohibido'; break;
								case '9': $rec = 'Enfermedad'; break;
							}
							
							$plan_alimento['recomendacion']= $rec;
							$guardar = TRUE;
						}
						if($i > 9 && $i <= 13 && $this->input->post('total_'.$i) != ''){
							$plan_alimento['nombre'] = 'Leche';
							switch ($i){
								case '10': $rec = 'General'; break;
								case '11': $rec = 'Recomendado'; break;
								case '12': $rec = 'Prohibido'; break;
								case '13': $rec = 'Enfermedad'; break;
							}
							
							$plan_alimento['recomendacion']= $rec;
							$guardar = TRUE;
						}
						
						if($i > 13 && $i <= 15 && $this->input->post('total_'.$i) != ''){
							$plan_alimento['nombre'] = 'Aceites y Grasas';
							switch ($i){
								case '14': $rec = 'General'; break;
								case '15': $rec = 'Recomendado'; break;
							}
							
							$plan_alimento['recomendacion']= $rec;
							$guardar = TRUE;
						}
						
						if($i > 15 && $i <= 17 && $this->input->post('total_'.$i) != ''){
							$plan_alimento['nombre'] = 'Azucares';
							switch ($i){
								case '16': $rec = 'General'; break;
								case '17': $rec = 'Recomendado'; break;
							}
							
							$plan_alimento['recomendacion']= $rec;
							$guardar = TRUE;
						}
						
						
						if($guardar){
							$plan_alimento['total_tiempos'] = $this->input->post('total_'.$i);
							$plan_alimento['desayuno'] = ($this->input->post('des_'.$i)!= '')?$this->input->post('des_'.$i): 0;
							$plan_alimento['co1'] = ($this->input->post('co1_'.$i)!= '')?$this->input->post('co1_'.$i):0;
							$plan_alimento['comida'] = ($this->input->post('com_'.$i) != '')?$this->input->post('com_'.$i):0;
							$plan_alimento['co2'] = ($this->input->post('co2_'.$i) != '')? $this->input->post('co2_'.$i):0;
							$plan_alimento['cena'] = ($this->input->post('cen_'.$i) != '')? $this->input->post('cen_'.$i):0;
							
							$id_plan_alimento =$this->plan_alimenticio_modelo->agregar_nuevo_plan_alimento($plan_alimento,$sexo);
							
							
							$datos['tipo'] = 'exito';
							$datos['mensaje']="Plan Alimenticio guardado correctamente";
							
							$datos['id_plan'] = $id_plan;
							$datos['sexo'] = $sexo;
							$this->load->model('plan_alimenticio_modelo');
							$datos['plan'] = $this->plan_alimenticio_modelo->buscar_nuevo_plan($id_plan, $sexo);
							$datos['resultados'] = $this->plan_alimenticio_modelo->buscar_nuevo_plan_alimento($id_plan, $sexo);
							$datos['pagina'] = 'plan_alimenticio/plan_nuevo_ficha';
							
						}
						}
						$datos['menu'] = 'menu_principal';
						$this->load->view('plantilla',$datos);
							
					}
				else{
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					
					$datos['calorias'] = $this->input->post('calorias');
					$datos['carbohidratos'] = $this->input->post('carbohidratos');
					$datos['proteinas'] = $this->input->post('proteinas');
					$datos['lipidos'] = $this->input->post('lipidos');
					$datos['azucar'] = $this->input->post('azucar');
					$datos['desayuno'] = $this->input->post('desayuno');
					$datos['co1'] = $this->input->post('co1');
					$datos['comida'] = $this->input->post('comida');
					$datos['co2'] = $this->input->post('co2');
					$datos['cena'] = $this->input->post('cena');
					
					$datos['mensaje']="La informaci&oacute;n proporcionada es inv&aacute;lida";
					$datos['menu'] = 'menu_principal';
					$datos['pagina'] = 'plan_alimenticio/plan_agregar';
					$this->load->view('plantilla',$datos);
				}
				
				
			}else{
					$datos['mensaje']="";
					$datos['menu'] = 'menu_principal';
					$datos['pagina'] = 'plan_alimenticio/plan_agregar';
					$this->load->view('plantilla',$datos);
				}
			
			
		}

		function modificar_plan_nuevo($id_plan,$sexo){
			//$this->form_validation->set_rules('genero','Genero','');
			$this->form_validation->set_rules('calorias','Calorias','required|max_length[9]');
			$this->form_validation->set_rules('carbohidratos','Carbohidratos','required|max_length[6]');
			$this->form_validation->set_rules('proteinas','Proteinas','required|max_length[6]');
			$this->form_validation->set_rules('lipidos','Lipidos','required|max_length[6]');
			$this->form_validation->set_rules('azucar','Azucar','required');
			$this->form_validation->set_rules('desayuno','Desayuno','');
			$this->form_validation->set_rules('co1','Colacion Mañana','');
			$this->form_validation->set_rules('comida','Comida','');
			$this->form_validation->set_rules('co2','Colacion Tarde','');
			$this->form_validation->set_rules('cena','Cena','');
			$this->form_validation->set_rules('prioridad','Prioridad','required');
			
			$this->load->model('plan_alimenticio_modelo');
			$resultados = $this->plan_alimenticio_modelo->buscar_nuevo_plan_alimento($id_plan, $sexo);
			$i = 0;
			foreach ($resultados as $r){
				$this->form_validation->set_rules('total_'.$i,'Total','');
				$this->form_validation->set_rules('des_'.$i,'Des','');
				$this->form_validation->set_rules('co1_'.$i,'CoM','');
				$this->form_validation->set_rules('com_'.$i,'Com','');
				$this->form_validation->set_rules('co2_'.$i,'CoT','');
				$this->form_validation->set_rules('cen_'.$i,'Cen','');
				
				$i++;
			}
			
			if ($this->input->post()){
				if ($this->form_validation->run()){
					$plan['calorias'] = $this->input->post('calorias');
					$plan['carbohidratos'] = $this->input->post('carbohidratos');
					$plan['proteinas'] = $this->input->post('proteinas');
					$plan['lipidos'] = $this->input->post('lipidos');
					$plan['azucar'] = $this->input->post('azucar');
					
					$plan['desayuno'] = $this->input->post('desayuno')!= NULL ?$this->input->post('desayuno'):'No';
					$plan['co1'] = $this->input->post('co1') != NULL ?$this->input->post('co1'):'No';
					$plan['comida'] = $this->input->post('comida') != NULL ?$this->input->post('comida'):'No';
					$plan['co2'] = $this->input->post('co2') != NULL ?$this->input->post('co2'):'No';
					$plan['cena'] = $this->input->post('cena') != NULL ?$this->input->post('cena'):'No';
					
					if($plan['desayuno'] == 'Si' && $plan['co1'] == 'No' && $plan['comida'] == 'Si'&&
					   $plan['co2'] == 'No' && $plan['cena'] =='Si')
						$plan['numero_comidas'] = 3;
					if($plan['desayuno'] == 'Si' && $plan['co1'] == 'Si' && $plan['comida'] == 'Si' &&
					   $plan['co2'] == 'Si' && $plan['cena'] == 'Si')
					   	$plan['numero_comidas'] = 5;
					if($plan['desayuno'] == 'Si'&& $plan['co1'] == 'Si' && $plan['comida'] == 'Si' &&
					   $plan['co2'] == 'No')
						$plan['numero_comidas'] = '3CoM';
					if($plan['desayuno'] == 'Si' && $plan['co1'] == 'No' && $plan['comida'] == 'Si' &&
					   $plan['co2'] == 'Si')
						$plan['numero_comidas'] = '3CoT';
						
					
					
					$prioridad = $this->input->post('prioridad');
					
					switch ($prioridad){
						case 'desayuno':{
							$plan['p_desayuno'] = "Si";
							$plan['p_co1'] = "No";
							$plan['p_comida'] = "No";
							$plan['p_co2'] = "No";
							$plan['p_cena'] = "No";
							$plan['prioridad'] = "PDM";
						}break;
						case 'co1':{
							$plan['p_desayuno'] = "No";
							$plan['p_co1'] = "Si";
							$plan['p_comida'] = "No";
							$plan['p_co2'] = "No";
							$plan['p_cena'] = "No";
							$plan['prioridad'] = "PCoMM";
						}break;
						case 'comida':{
							$plan['p_desayuno'] = "No";
							$plan['p_co1'] = "No";
							$plan['p_comida'] = "Si";
							$plan['p_co2'] = "No";
							$plan['p_cena'] = "No";
							$plan['prioridad'] = "PCM";
						}break;
						case 'co2':{
							$plan['p_desayuno'] = "No";
							$plan['p_co1'] = "No";
							$plan['p_comida'] = "No";
							$plan['p_co2'] = "Si";
							$plan['p_cena'] = "No";
							$plan['prioridad'] = "PCoTM";
						}break;
						case 'cena':{
							$plan['p_desayuno'] = "No";
							$plan['p_co1'] = "No";
							$plan['p_comida'] = "No";
							$plan['p_co2'] = "No";
							$plan['p_cena'] = "Si";
							$plan['prioridad'] = "PCeM";
						}break;
						
					}
					//$sexo = $this->input->post('genero');
					$this->load->model('plan_alimenticio_modelo');
					$this->plan_alimenticio_modelo->modificar_nuevo($plan, $sexo, $id_plan);
					
					$plan_alimento['plan_alimenticio']=$id_plan;
					$resultados = $this->plan_alimenticio_modelo->buscar_nuevo_plan_alimento($id_plan, $sexo);
					$i = 0;
					foreach($resultados as $resultados){
						   
						   $id_plan_alimento = $this->input->post('id_'.$i);
							$plan_alimento['total_tiempos'] = $this->input->post('total_'.$i);
							$plan_alimento['desayuno'] = ($this->input->post('des_'.$i)!= '')?$this->input->post('des_'.$i): 0;
							$plan_alimento['co1'] = ($this->input->post('co1_'.$i)!= '')?$this->input->post('co1_'.$i):0;
							$plan_alimento['comida'] = ($this->input->post('com_'.$i) != '')?$this->input->post('com_'.$i):0;
							$plan_alimento['co2'] = ($this->input->post('co2_'.$i) != '')? $this->input->post('co2_'.$i):0;
							$plan_alimento['cena'] = ($this->input->post('cen_'.$i) != '')? $this->input->post('cen_'.$i):0;
							
							$this->plan_alimenticio_modelo->modificar_nuevo_plan_alimento($plan_alimento,$sexo,$id_plan, $id_plan_alimento);
							
							
							$datos['tipo'] = 'exito';
							$datos['mensaje']="Plan Alimenticio guardado correctamente";
							
							$datos['id_plan'] = $id_plan;
							$datos['sexo'] = $sexo;
							$this->load->model('plan_alimenticio_modelo');
							$datos['plan'] = $this->plan_alimenticio_modelo->buscar_nuevo_plan($id_plan, $sexo);
							$datos['resultados'] = $this->plan_alimenticio_modelo->buscar_nuevo_plan_alimento($id_plan, $sexo);
							$datos['pagina'] = 'plan_alimenticio/plan_nuevo_ficha';
							
							$i++;
						
						}
						$datos['menu'] = 'menu_principal';
						$this->load->view('plantilla',$datos);
					}
				else{
					$datos['tipo'] = 'advertencia';
					
					
					$datos['calorias'] = $this->input->post('calorias');
					$datos['carbohidratos'] = $this->input->post('carbohidratos');
					$datos['proteinas'] = $this->input->post('proteinas');
					$datos['lipidos'] = $this->input->post('lipidos');
					$datos['azucar'] = $this->input->post('azucar');
					$datos['desayuno'] = $this->input->post('desayuno');
					$datos['co1'] = $this->input->post('co1');
					$datos['comida'] = $this->input->post('comida');
					$datos['co2'] = $this->input->post('co2');
					$datos['cena'] = $this->input->post('cena');
					
					$datos['id_plan'] = $id_plan;
					$datos['sexo'] = $sexo;
					$datos['mensaje']="La informaci&oacute;n proporcionada es inv&aacute;lida";
					$this->load->model('plan_alimenticio_modelo');
					$datos['plan'] = $this->plan_alimenticio_modelo->buscar_nuevo_plan($id_plan, $sexo);
					$datos['menu'] = 'menu_principal';
					$datos['pagina'] = 'plan_alimenticio/plan_modificar';
	
					$this->load->view('plantilla',$datos);
				}
				
				
			}else{
					$datos['mensaje']="";
					$datos['menu'] = 'menu_principal';
					$datos['id_plan'] = $id_plan;
					$datos['sexo'] = $sexo;
					$this->load->model('plan_alimenticio_modelo');
					$datos['plan'] = $this->plan_alimenticio_modelo->buscar_nuevo_plan($id_plan, $sexo);
					$datos['resultados'] = $this->plan_alimenticio_modelo->buscar_nuevo_plan_alimento($id_plan, $sexo);
					$datos['pagina'] = 'plan_alimenticio/plan_modificar';
					
					$this->load->view('plantilla',$datos);
				}
			
			
		}

		function ficha_plan_nuevo($id_plan,$sexo){
			$this->load->model('plan_alimenticio_modelo');
			$datos['resultados'] = $this->plan_alimenticio_modelo->buscar_nuevo_plan($id_plan, $sexo);
			
			$datos['pagina'] = 'plan_alimenticio/plan_nuevo_ficha';
			$this->load->view('plantilla',$datos);
		}
		
		function eliminar($id_plan, $sexo){
			$this->load->model('plan_alimenticio_modelo');
			$this->plan_alimenticio_modelo->eliminar($id_plan,$sexo);
			
			$datos['mensaje']="";
			$datos['menu'] = 'menu_principal';
			$datos['pagina'] = 'plan_alimenticio/plan_agregar';
			$this->load->view('plantilla',$datos);
			
		}
    }
?>