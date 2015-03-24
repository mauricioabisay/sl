<?php

class Antecedentes_patologicos extends CI_Controller{

	public function __construct() {
	parent::__construct();
	$this->load->helper('url');
	$this->load->library("form_validation");
	$this->load->library('session');
	$this->form_validation->set_error_delimiters('<span class="advertencia"><img src="'.base_url().'/assets/img/advertencia.png" width="15px" height="15px"><strong>', '</strong></span>');
	}
	
	
	public function borrar($id,$id_paciente){
		$this->load->model('antecedentes_patologicos_modelo');
			$antecedente = $this->antecedentes_patologicos_modelo->buscar_id($id);
			if($antecedente){
				$paciente = $antecedente->paciente;
				$this->antecedentes_patologicos_modelo->borrar($id_paciente,$antecedente->fecha_id);
				if($paciente){
					$this->load->model('antecedentes_patologicos_modelo');
					$datos['pagina_frame']="".site_url().'/welcome/blank'."";
					$datos['menu'] = 'menu_paciente';
					$datos['id_paciente'] = $paciente;
					$datos['listado'] = "".site_url()."/antecedentes_patologicos/listado_mini/".$paciente."";
					$this->load->view('plantilla',$datos);
				}else{
					echo 'ERROR';
				}
			}
			else{
				$this->antecedente($id_paciente);
			}
	}
	
	//Función para cargar las patologías en el segundo select
	public function patologias_select(){
    	$clasificacion=$_GET['id'];
    	$this->load->model('antecedentes_patologicos_modelo');
		$datos['patologia']=$this->antecedentes_patologicos_modelo->obtenerPatologias($clasificacion);
		$this->load->view('antecedentes_patologicos/patologias_select',$datos);
	}
	
	public function antecedente($id){
			$this->load->model('antecedentes_patologicos_modelo');
			$datos['menu'] = 'menu_paciente';
			$datos['id_paciente'] = $id;
			$datos['listado'] = "".site_url()."/antecedentes_patologicos/listado_mini/".$id."";
			if($ultimo_antecedente = $this->antecedentes_patologicos_modelo->existe($id)){
				$datos['pagina_frame'] = "".site_url()."/antecedentes_patologicos/detalle/".$id."/".$ultimo_antecedente->fecha_id."";
			}else{
				$datos['pagina_frame'] = "".site_url()."/antecedentes_patologicos/agregar/".$id."";
			}
			
			$this->load->view('plantilla',$datos);
	}
	
	    
	//Función para consultar las patologías
	public function agregar($id){
		$this->load->model('antecedentes_patologicos_modelo');
		$anteriores=$this->antecedentes_patologicos_modelo->listar_patologias_fecha($id,date('Y-m-d'));
		$this->form_validation->set_rules('enfermedad','','required');
		$this->form_validation->set_rules('otra_patologia','Otra','');
		$this->form_validation->set_rules('otra_clasificacion','Otra','');
		$this->form_validation->set_rules('status_otra','Status','');
		
		if($this->input->post('enfermedad')=='Si'){
				$aux = $this->input->post('patologia');								$aux0 = $this->input->post('otra_clasificacion');
				$aux1 = $this->input->post('otra_patologia');								
				
				if($aux1==NULL && $aux0 == NULL){
					$this->form_validation->set_rules('patologia','Patologia','required');
					for($i=0; $i < sizeof($aux); $i++)
					$this->form_validation->set_rules('status_'.$aux[$i],'Status','');
				}
				else {
					$this->form_validation->set_rules('patologia','Patologia','');
					for($i=0; $i < sizeof($aux1); $i++){
						$this->form_validation->set_rules('otra['.$aux1[$i].']','','min_lenght[3]|max_lenght[50]');
						$this->form_validation->set_rules('status_otra'.$aux1[$i],'Status','');
					} 
				}
			}		
		
		for ($i=0;$i<4;$i++){
			$this->form_validation->set_rules('existe'.$i,'','');
			$this->form_validation->set_rules('otro_parentesco_'.$i,'Otro','min_lenght[3]|max_lenght[30]');
			
			if ($this->input->post('existe'.$i)=='Si'){
				if($this->input->post('otro_parentesco_'.$i)==NULL){
					$this->form_validation->set_rules('parentesco_'.$i,'Parentesco','required');
					}
					else {
						$this->form_validation->set_rules('parentesco_'.$i,'Parentesco','');
					}
			}
		}
		
		$aux_otra_patologia  = $this->input->post('otra_patologia_h');
		$aux_otra_hereditaria = $this->input->post('otra_hereditaria');
		$aux_abuelo_materno = $this->input->post('abuelo_materno');
		$aux_abuelo_paterno = $this->input->post('abuelo_paterno');
		$aux_abuela_materna = $this->input->post('abuela_materna');
		$aux_abuela_paterna = $this->input->post('abuela_paterna');
		$aux_padre = $this->input->post('padre');
		$aux_madre = $this->input->post('madre');
		
		$otro = $this->input->post('otra_parentesco');	
		
		for($i = 0; $i < sizeof($aux_otra_patologia); $i++){
			$this->form_validation->set_rules('otra_patologia_h['.$i.']','Otra','');
			if($aux_otra_patologia[$i] != '-1'){
				
				if(!isset($aux_abuela_materna[$i]) && !isset($aux_abuela_paterna[$i])
				   && !isset($aux_abuelo_materno[$i]) && !isset($aux_abuelo_paterno[$i])
				   && !isset($aux_madre[$i]) && !isset($aux_padre[$i]))
					$this->form_validation->set_rules('otra_parentesco['.$i.']','Parentesco','required|min_lenght[3]|max_lenght[30]');
				else{
					$this->form_validation->set_rules('otra_parentesco['.$i.']','Parentesco','min_lenght[3]|max_lenght[30]');
				}
		
					
				if($aux_otra_patologia[$i] == 'otra'){
					$this->form_validation->set_rules('otra_hereditaria['.$i.']','Otra','required');
				}
			
			}
		}
		$datos['menu'] = 'menu_paciente';
		
		
		
		if($this->input->post()){
			$datos['id_paciente'] = $this->input->post('paciente');
			$aux = $this->input->post('patologia');
			$aux2 = $this->input->post('parentesco');
			$aux3= $this->input->post('otra');
			
			if($this->form_validation->run()){		
				$this->load->model('antecedentes_patologicos_modelo');
//Agregando patologias personales
				if ($aux != NULL){
					for($i=0; $i < sizeof($aux); $i++){
						$nueva = TRUE;
						$status = $this->input->post('status_'.$aux[$i]);
						
						foreach($anteriores as $a){
							if($a['id_patologia'] == $aux[$i] && $status == $a['status'])
								$nueva=FALSE;
						}
						
						if($nueva){
							$antecedentes['paciente'] = $this->input->post('paciente');
							$antecedentes['fecha_id'] = date('Y-m-d');
							$antecedentes['patologia']= $aux[$i];
							$antecedentes['hereditaria']='No';
							$antecedentes['status'] = $status;
							$this->antecedentes_patologicos_modelo->agregar($antecedentes);
						}
					}
				}
					
				for($i=0; $i < 12; $i++){
					if ($aux3[$i]!= NULL){
						$patologias['clasificacion']=$i+1;
						$patologias['nombre']=$aux3[$i];
						$id_patologia=$this->antecedentes_patologicos_modelo->agregar_patologia($patologias);
						$antecedentes['paciente'] = $this->input->post('paciente');
						$antecedentes['fecha_id'] = date('Y-m-d');
						$antecedentes['patologia']= $id_patologia;
						$antecedentes['hereditaria']='No';
						$antecedentes['status']=$this->input->post('status_otra'.$i);
						$this->antecedentes_patologicos_modelo->agregar($antecedentes);
					}
				}
				$existe=0;
				for ($i=0;$i<4;$i++){
					switch($i){
						case '0':{$patologia=32;break;}
						case '1':{$patologia=27;break;}
						case '2':{$patologia=17;break;}
						case '3':{$patologia=3;break;}
					}
						
					$parentesco = "";
					$otro = $this->input->post('otro_parentesco_'.$i);
					$aux2 = $this->input->post('parentesco_'.$i);
					
					for($j=0; $j < sizeof($aux2); $j++){					
						$parentesco .= ''.$aux2[$j].'';
						$parentesco .= ($j+1==sizeof($aux2))?"":",";
					}
							
					
					if ($this->input->post('existe'.$i)=='Si'){
							$nueva = TRUE;
							
							foreach($anteriores as $a){
								if($a['id_patologia'] == $patologia && ($parentesco == $a['parentesco'] && $otro == $a['otro_parentesco']))
									$nueva=FALSE;
							}
						if($nueva){
							$existe=1;
							$antecedentes['paciente'] = $this->input->post('paciente');
							$antecedentes['fecha_id'] = date('Y-m-d');
							$antecedentes['patologia']= $patologia;
							$antecedentes['hereditaria']='Si';
							
							$antecedentes['parentesco']=($parentesco != "")? $parentesco: NULL;
							$antecedentes['otro_parentesco']=($otro != "")? $otro: NULL;
							$antecedentes['status']=NULL;
							$this->antecedentes_patologicos_modelo->agregar($antecedentes);
						}
					}
					
				}
				
				
				$aux_otra_hereditaria = $this->input->post('otra_hereditaria');
				$aux_abuelo_materno = $this->input->post('abuelo_materno');
				$aux_abuelo_paterno = $this->input->post('abuelo_paterno');
				$aux_abuela_materna = $this->input->post('abuela_materna');
				$aux_abuela_paterna = $this->input->post('abuela_paterna');
				$aux_padre = $this->input->post('padre');
				$aux_madre = $this->input->post('madre');
				
				$otro = $this->input->post('otra_parentesco');
					
				for($i = 0; $i < sizeof($aux_otra_patologia); $i++){
					if($aux_otra_patologia[$i]!= '-1'){
						if($aux_otra_patologia[$i]!= 'otra'){
							$antecedentes['paciente'] = $this->input->post('paciente');
							$antecedentes['fecha_id'] = date('Y-m-d');
							$antecedentes['patologia']= $aux_otra_patologia[$i];
							$antecedentes['hereditaria']='Si';
							$antecedentes['parentesco']='';
							
							if(isset($aux_abuelo_materno[$i])){
									if($antecedentes['parentesco']==''){$antecedentes['parentesco'] .= $aux_abuelo_materno[$i];}
									else{$antecedentes['parentesco'] .= ','.$aux_abuelo_materno[$i];}
							}
							if(isset($aux_abuelo_paterno[$i])){
									if($antecedentes['parentesco']==''){$antecedentes['parentesco'] .= $aux_abuelo_paterno[$i];}
									else{$antecedentes['parentesco'] .= ','.$aux_abuelo_paterno[$i];}
							}
							if(isset($aux_abuela_materna[$i])){
									if($antecedentes['parentesco']==''){$antecedentes['parentesco'] .= $aux_abuela_materna[$i];}
									else{$antecedentes['parentesco'] .= ','.$aux_abuela_materna[$i];}
							}
							if(isset($aux_abuela_paterna[$i])){
									if($antecedentes['parentesco']==''){$antecedentes['parentesco'] .= $aux_abuela_paterna[$i];}
									else{$antecedentes['parentesco'] .= ','.$aux_abuela_paterna[$i];}
							}
							if(isset($aux_padre[$i])){
									if($antecedentes['parentesco']==''){$antecedentes['parentesco'] .= $aux_padre[$i];}
									else{$antecedentes['parentesco'] .= ','.$aux_padre[$i];}
							}
							if(isset($aux_madre[$i])){
									if($antecedentes['parentesco']==''){$antecedentes['parentesco'] .= $aux_madre[$i];}
									else{$antecedentes['parentesco'] .= ','.$aux_madre[$i];}
							}
							
							
							$antecedentes['otro_parentesco']=($otro[$i] != "")? $otro[$i]: NULL;
							$antecedentes['status']=NULL;
							$this->antecedentes_patologicos_modelo->agregar($antecedentes);
						}
						else{
							$otras['clasificacion']=13;
							$otras['nombre']=$aux_otra_hereditaria[$i];
							if($aux_otra_hereditaria[$i] != ''){
								$id_patologia = $this->antecedentes_patologicos_modelo->agregar_patologia($otras);
							}
							$antecedentes['paciente'] = $this->input->post('paciente');
							$antecedentes['fecha_id'] = date('Y-m-d');
							$antecedentes['patologia']= $id_patologia;
							$antecedentes['hereditaria']='Si';
							$antecedentes['parentesco']='';
							
							if(isset($aux_abuelo_materno[$i])){
									if($antecedentes['parentesco']==''){$antecedentes['parentesco'] .= $aux_abuelo_materno[$i];}
									else{$antecedentes['parentesco'] .= ','.$aux_abuelo_materno[$i];}
							}
							if(isset($aux_abuelo_paterno[$i])){
									if($antecedentes['parentesco']==''){$antecedentes['parentesco'] .= $aux_abuelo_paterno[$i];}
									else{$antecedentes['parentesco'] .= ','.$aux_abuelo_paterno[$i];}
							}
							if(isset($aux_abuela_materna[$i])){
									if($antecedentes['parentesco']==''){$antecedentes['parentesco'] .= $aux_abuela_materna[$i];}
									else{$antecedentes['parentesco'] .= ','.$aux_abuela_materna[$i];}
							}
							if(isset($aux_abuela_paterna[$i])){
									if($antecedentes['parentesco']==''){$antecedentes['parentesco'] .= $aux_abuela_paterna[$i];}
									else{$antecedentes['parentesco'] .= ','.$aux_abuela_paterna[$i];}
							}
							if(isset($aux_padre[$i])){
									if($antecedentes['parentesco']==''){$antecedentes['parentesco'] .= $aux_padre[$i];}
									else{$antecedentes['parentesco'] .= ','.$aux_padre[$i];}
							}
							if(isset($aux_madre[$i])){
									if($antecedentes['parentesco']==''){$antecedentes['parentesco'] .= $aux_madre[$i];}
									else{$antecedentes['parentesco'] .= ','.$aux_madre[$i];}
							}

							$antecedentes['otro_parentesco']=($otro[$i] != "")? $otro[$i]: NULL;
							$antecedentes['status']=NULL;
							$this->antecedentes_patologicos_modelo->agregar($antecedentes);
						}
					}
				}
				
				//Condición para guardar el registro sin patologías
				if(($this->input->post('enfermedad')=='No') && $existe==0 && $this->input->post('otras')=='No' ){
					$antecedentes['paciente'] = $this->input->post('paciente');
					$antecedentes['fecha_id'] = date('Y-m-d');
					$this->antecedentes_patologicos_modelo->agregar($antecedentes);
				}
					
				
				$aux_nombre = $this->input->post('otra_clasificacion');
				$aux_status = $this->input->post('status_otra');
				for($i=0;$i<sizeof($aux_nombre);$i++){
					$otras['clasificacion']=13;
					$otras['nombre']=$aux_nombre[$i];
					if($aux_nombre[$i] != ''){
						$id_patologia = $this->antecedentes_patologicos_modelo->agregar_patologia($otras);
					
						$patologias['fecha_id']=date('Y-m-d');
						$patologias['paciente']=$this->input->post('paciente');
						$patologias['patologia']= $id_patologia;
						$patologias['hereditaria']='No';
						$patologias['status']=$aux_status[$i];
						
						$this->antecedentes_patologicos_modelo->agregar($patologias);
					}
				}
				
				$datos['tipo'] = 'exito';
				$datos['mensaje'] = 'Antecedentes Patol&oacute;gicos guardados';
				$datos['personales'] = $this->antecedentes_patologicos_modelo->listar_patologias_fecha($this->input->post('paciente'),date('Y-m-d'));
				$this->load->view('antecedentes_patologicos/antecedentes_patologicos_detalle',$datos);
				//Alta exitosa	
				
				//$this->detalle($id_antecedente);	
				}else{
					$datos['id_paciente'] = $id;
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					
					$datos['otra_patologia']=$this->input->post('otra_patologia');
					$datos['otra_patologia_h']=$this->input->post('otra_patologia_h');
					$datos['otra_hereditaria']=$this->input->post('otra_hereditaria');
					$datos['abuelo_materno']=$this->input->post('abuelo_materno');
					$datos['abuelo_paterno']=$this->input->post('abuelo_paterno');
					$datos['abuela_materna']=$this->input->post('abuela_materna');
					$datos['abuela_paterna']=$this->input->post('abuela_paterna');
					$datos['padre']=$this->input->post('padre');
					$datos['madre']=$this->input->post('madre');
					$datos['otra_parentesco']=$this->input->post('otra_parentesco');
					
					$this->load->model('antecedentes_patologicos_modelo');
					$datos['clasificaciones']=$this->antecedentes_patologicos_modelo->obtenerClasificaciones();
					$datos['patologias']=$this->antecedentes_patologicos_modelo->buscar_patologias();
					$datos['parentesco']=$this->input->post('parentesco'); 
					$datos['otra']=$this->input->post('otra');
					$datos['resultados']=NULL;					
					
					$this->load->view('antecedentes_patologicos/antecedentes_patologicos_agregar',$datos);
				}
//No venimos de un formulario
		}else{
			$datos['id_paciente'] = $id;
			$this->load->model('antecedentes_patologicos_modelo');
			$datos['clasificaciones']=$this->antecedentes_patologicos_modelo->obtenerClasificaciones();
			$datos['patologias']=$this->antecedentes_patologicos_modelo->buscar_patologias();
			
			$datos['resultados']=$this->antecedentes_patologicos_modelo->listar_patologias_fecha($id,date('Y-m-d'));
			
			
			$this->load->view('antecedentes_patologicos/antecedentes_patologicos_agregar',$datos);
		}
	}

	public function modificar($id,$fecha_id){
		$this->load->model('antecedentes_patologicos_modelo');
		$anteriores=$this->antecedentes_patologicos_modelo->listar_patologias_fecha($id,$fecha_id);
		
		
		$this->form_validation->set_rules('enfermedad','','required');
		$this->form_validation->set_rules('otra_patologia','Otra','');
		$this->form_validation->set_rules('otra_clasificacion','Otra','');
		$this->form_validation->set_rules('status_otra','Status','');
		
		if($this->input->post('enfermedad')=='Si'){
				$aux = $this->input->post('patologia');
				$aux1 = $this->input->post('otra_patologia');
				
				if($aux1==NULL){
					$this->form_validation->set_rules('patologia','Patologia','required');
					for($i=0; $i < sizeof($aux); $i++)
					$this->form_validation->set_rules('status_'.$aux[$i],'Status','');
				}
				else {
					$this->form_validation->set_rules('patologia','Patologia','');
					for($i=0; $i < sizeof($aux1); $i++){
						$this->form_validation->set_rules('otra['.$aux1[$i].']','','min_lenght[3]|max_lenght[50]');
						$this->form_validation->set_rules('status_otra'.$aux1[$i],'Status','');
					} 
				}
			}		
		
		$i= 0;
		foreach ($anteriores as $a){
			if($a['hereditaria']== 'Si'){
				$this->form_validation->set_rules('existe'.$i,'','');
				$this->form_validation->set_rules('otro_parentesco_'.$i,'Otro','min_lenght[3]|max_lenght[30]');
				
				if ($this->input->post('existe'.$i)=='Si'){
					if($this->input->post('otro_parentesco_'.$i)==NULL){
						$this->form_validation->set_rules('parentesco_'.$i,'Parentesco','required');
						}
						else {
							$this->form_validation->set_rules('parentesco_'.$i,'Parentesco','');
						}
				}
				$i++;
			}
		}
		
		$datos['menu'] = 'menu_paciente';
		
		
		
		if($this->input->post()){
			$datos['id_paciente'] = $this->input->post('paciente');
			$aux = $this->input->post('patologia');
			$aux2 = $this->input->post('parentesco');
			$aux3= $this->input->post('otra');
			
			if($this->form_validation->run()){		
				$this->load->model('antecedentes_patologicos_modelo');
//Agregando patologias personales
				if ($aux != NULL){    			
					for($i=0; $i < sizeof($aux); $i++){					
						$nueva = TRUE;
						$status = $this->input->post('status_'.$aux[$i]);
						
						foreach($anteriores as $a){
							if($a['id_patologia'] == $aux[$i] && $status == $a['status'])
								$nueva=FALSE;					
						}
						
						if($nueva){
							
							$res_antecedente = $this->antecedentes_patologicos_modelo->buscar_no_hereditaria($this->input->post('paciente'),$aux[$i]);
							if($res_antecedente != NULL){								$antecedentes['status'] = $status;								
								$this->antecedentes_patologicos_modelo->modificar($res_antecedente->id,$antecedentes);															}
							else {								$antecedentes['paciente'] = $this->input->post('paciente');								$antecedentes['fecha_id'] = $fecha_id;									$antecedentes['patologia']= $aux[$i];									$antecedentes['hereditaria']='No';									$antecedentes['status'] = $status;								
								$this->antecedentes_patologicos_modelo->agregar($antecedentes);								
							}
						}
					}
				}
					
				for($i=0; $i < 12; $i++){
					if ($aux3[$i]!= NULL){
						$patologias['clasificacion']=$i+1;
						$patologias['nombre']=$aux3[$i];
						$id_patologia=$this->antecedentes_patologicos_modelo->agregar_patologia($patologias);
						$antecedentes['paciente'] = $this->input->post('paciente');
						$antecedentes['fecha_id'] = $fecha_id;
						$antecedentes['patologia']= $id_patologia;
						$antecedentes['hereditaria']='No';
						$antecedentes['status']=$this->input->post('status_otra'.$i);
						$this->antecedentes_patologicos_modelo->agregar($antecedentes);						
					}
				}
				$i = 0;
				foreach($anteriores as $a){
					if($a['hereditaria'] == 'Si'){						  				
					$parentesco = "";
					$otro = $this->input->post('otro_parentesco_'.$i);
					$aux2 = $this->input->post('parentesco_'.$i);
					
					for($j=0; $j < sizeof($aux2); $j++){					
						$parentesco .= ''.$aux2[$j].'';
						$parentesco .= ($j+1==sizeof($aux2))?"":",";
					}
							$antecedentes_hereditarios['parentesco']=($parentesco != "")? $parentesco: NULL;
							$antecedentes_hereditarios['otro_parentesco']=($otro != "")? $otro: NULL;
							$antecedentes_hereditarios['status']=NULL;
							
							$res_antecedente = $this->antecedentes_patologicos_modelo->buscar_hereditaria($this->input->post('paciente'),$this->input->post('id_patologia_'.$i));														$this->antecedentes_patologicos_modelo->modificar($res_antecedente->id,$antecedentes_hereditarios);														
					}					
					$i++;								
				}
				
				$aux_nombre = $this->input->post('otra_clasificacion');
				$aux_status = $this->input->post('status_otra');
				for($i=0;$i<sizeof($aux_nombre);$i++){
					$otras['clasificacion']=13;
					$otras['nombre']=$aux_nombre[$i];
					if($aux_nombre[$i] != ''){
						$id_patologia = $this->antecedentes_patologicos_modelo->agregar_patologia($otras);
						$patologias['fecha_id']=date('Y-m-d');
						$patologias['paciente']=$this->input->post('paciente');
						$patologias['patologia']= $id_patologia;
						$patologias['hereditaria']='No';
						$patologias['status']=$aux_status[$i];
						$this->antecedentes_patologicos_modelo->agregar($patologias);
					}
				}
				
				
				$datos['tipo'] = 'exito';
				$datos['mensaje'] = 'Antecedentes Patol&oacute;gicos modificados';
				$datos['personales'] = $this->antecedentes_patologicos_modelo->listar_patologias_fecha($this->input->post('paciente'),$fecha_id);
				$this->load->view('antecedentes_patologicos/antecedentes_patologicos_detalle',$datos);
//Alta exitosa
				//$this->detalle($id_antecedente);	
				}else{
					$datos['id_paciente'] = $id;
					$datos['fecha_id']= $fecha_id;
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					$this->load->model('antecedentes_patologicos_modelo');
					$datos['clasificaciones']=$this->antecedentes_patologicos_modelo->obtenerClasificaciones();
					$datos['patologias']=$this->antecedentes_patologicos_modelo->buscar_patologias();
					$datos['parentesco']=$this->input->post('parentesco');
					$datos['otra']=$this->input->post('otra');
					$datos['resultados']=$this->antecedentes_patologicos_modelo->listar_patologias_fecha($id,$fecha_id);				
					
					$this->load->view('antecedentes_patologicos/antecedentes_patologicos_modificar',$datos);
				}
//No venimos de un formulario
		}else{
			$datos['id_paciente'] = $id;
			$datos['fecha_id']= $fecha_id;
			$this->load->model('antecedentes_patologicos_modelo');
			$datos['clasificaciones']=$this->antecedentes_patologicos_modelo->obtenerClasificaciones();
			$datos['patologias']=$this->antecedentes_patologicos_modelo->buscar_patologias();
			
			$datos['resultados']=$this->antecedentes_patologicos_modelo->listar_patologias_fecha($id,$fecha_id);
			
			
			$this->load->view('antecedentes_patologicos/antecedentes_patologicos_modificar',$datos);
		}
	}

	function detalle($id,$fecha){   
		$datos['id_paciente'] = $id;
		$datos['fecha_id']= $fecha;
		$this->load->model('antecedentes_patologicos_modelo');
		$datos['personales'] = $this->antecedentes_patologicos_modelo->listar_patologias_fecha($id,$fecha);
		$this->load->view('antecedentes_patologicos/antecedentes_patologicos_detalle',$datos);
	}

	function modificar_status(){
		
		
	}

	function listado_mini($paciente){
			$datos['id_paciente'] = $paciente;
			$this->load->model('antecedentes_patologicos_modelo');
			$inicio = ($this->uri->segment(4))?$this->uri->segment(4):0;
			$datos['resultados'] = $this->antecedentes_patologicos_modelo->listado_mini($datos['id_paciente'],$inicio);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han capturado Ant. Patol&oacute;gicos sobre el Paciente';
			}
			$this->load->library('pagination');
			$pag_config['base_url'] = "".site_url()."/antecedentes_patologicos/listado_mini/".$datos['id_paciente']."";
			$pag_config['total_rows'] = $this->antecedentes_patologicos_modelo->total($datos['id_paciente']);
			$pag_config['per_page'] = 10;
			$pag_config['uri_segment'] = 4;
			$this->pagination->initialize($pag_config);
			$this->load->view('antecedentes_patologicos/antecedentes_listado_mini',$datos);
		}
}
?>