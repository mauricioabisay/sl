<?php

class Variables_sistema extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library("form_validation");
		$this->load->library('session');
		$this->form_validation->set_error_delimiters('<span class="advertencia"><img src="'.base_url().'/assets/img/advertencia.png" width="15px" height="15px"><strong>', '</strong></span>');
	}
	
	public function index(){
		$this->load->model('variables_sistema_modelo');
		$datos['menu'] = 'menu_principal';
		$datos['resultados']= $this->variables_sistema_modelo->buscar();
		$datos['pagina'] = $datos['resultados'] != NULL ? 'variables_sistema/variables_sistema_ficha':'variables_sistema/variables_sistema_agregar';
		$this->load->view('plantilla',$datos);
	}
	
	public function agregar(){
		for($i=0;$i<7;$i++){
			$this->form_validation->set_rules('dias_trabajo_'.$i,'','');
			if($this->input->post('dias_trabajo_'.$i)!= NULL){
				$this->form_validation->set_rules('horas_inicio_'.$i,'','required');
				$this->form_validation->set_rules('minutos_inicio_'.$i,'','required');
				$this->form_validation->set_rules('ampm_inicio_'.$i,'','required');
				$this->form_validation->set_rules('horas_fin_'.$i,'','required');
				$this->form_validation->set_rules('minutos_fin_'.$i,'','required');
				$this->form_validation->set_rules('ampm_fin_'.$i,'','required');
			}
		
		for($i=1;$i<=$this->input->post('num_fechas');$i++){
			$this->form_validation->set_rules('fecha_ini['.$i.']','','');
			$this->form_validation->set_rules('fecha_fin['.$i.']','','');	
	    }
		
		$this->load->model('variables_sistema_modelo');
		
		if ($this->input->post()){
			if ($this->form_validation->run()){
			for($i=0;$i<7;$i++){
					$horas_ini=($this->input->post('ampm_inicio_'.$i)== 'pm')?$this->input->post('horas_inicio_'.$i)+12:$this->input->post('horas_inicio_'.$i);
					$min_ini=$this->input->post('minutos_inicio_'.$i);
					
					$horas_fin=($this->input->post('ampm_fin_'.$i)== 'pm')?$this->input->post('horas_fin_'.$i)+12:$this->input->post('horas_fin_'.$i);
					$min_fin=$this->input->post('minutos_fin_'.$i);
					
					$dias=$this->input->post('dias_trabajo_'.$i);
					
					
					$horario['dias']=$dias;
					$horario['hora_ini']=$horas_ini.':'.$min_ini;
					$horario['hora_fin']=$horas_fin.':'.$min_fin;
					
					if($horario['dias']!= NULL)
						$this->variables_sistema_modelo->agregar_horas_doctor($horario);
			}
					
			$num = $this->input->post('num_fechas');
			
			for($j=1;$j<= $num;$j++){
				if($this->input->post('fecha_ini_'.$j) != NULL){
					$fecha_ini =  DateTime::createFromFormat('d/m/Y',$this->input->post('fecha_ini_'.$j));
					$fecha_fin =  DateTime::createFromFormat('d/m/Y',$this->input->post('fecha_fin_'.$j));
					
					$fecha['fecha_ini']=$fecha_ini->format('Y-m-d');
					$fecha['fecha_fin']=$fecha_fin != NULL ? $fecha_fin->format('Y-m-d'): NULL;
					
					$this->variables_sistema_modelo->agregar_horas_doctor($fecha);
				}
			}	
					$datos['tipo']='exito';
					$datos['mensaje']='Horario guardado';
					$datos['menu'] = 'menu_principal';
					$datos['pagina'] = 'variables_sistema/variables_sistema_ficha';
					$datos['resultados']= $this->variables_sistema_modelo->buscar();
					//$datos['resultados']= $this->usuarios_modelo->buscar($id_usr);
					$this->load->view('plantilla',$datos);
				}else{
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					
									
					$datos['menu'] = 'menu_principal';
					$datos['pagina'] = 'variables_sistema/variables_sistema_agregar';			
					$this->load->view('plantilla',$datos);
				}	
			}else{
					$datos['menu'] = 'menu_principal';
					$datos['pagina'] = 'variables_sistema/variables_sistema_agregar';
					$this->load->view('plantilla',$datos);
			}
		}
	}


	public function modificar_datos(){
		for($i=0;$i<7;$i++){
			$this->form_validation->set_rules('dias_trabajo_'.$i,'','');
			if($this->input->post('dias_trabajo_'.$i)!= NULL){
				$this->form_validation->set_rules('horas_inicio_'.$i,'','required');
				$this->form_validation->set_rules('minutos_inicio_'.$i,'','required');
				$this->form_validation->set_rules('ampm_inicio_'.$i,'','required');
				$this->form_validation->set_rules('horas_fin_'.$i,'','required');
				$this->form_validation->set_rules('minutos_fin_'.$i,'','required');
				$this->form_validation->set_rules('ampm_fin_'.$i,'','required');
			}
		
		for($i=1;$i<=$this->input->post('num_fechas');$i++){
			$this->form_validation->set_rules('fecha_ini['.$i.']','','');
			$this->form_validation->set_rules('fecha_fin['.$i.']','','');	
	    }
		
		$this->load->model('variables_sistema_modelo');
		$registros= $this->variables_sistema_modelo->buscar();
		
		
		if ($this->input->post()){
			if ($this->form_validation->run()){
			//$this->variables_sistema_modelo->eliminar_variables_sistema();
			$this->variables_sistema_modelo->eliminar_fecha();
		
				for($i=0;$i<7;$i++){
					$dias=$this->input->post('dias_trabajo_'.$i);
					if($dias != NULL){
						if ($this->input->post('ampm_inicio_'.$i)== 'pm'&& $this->input->post('horas_inicio_'.$i) != 12){
							$horas_ini= $this->input->post('horas_inicio_'.$i)+12;
						}
						elseif ($this->input->post('ampm_inicio_'.$i)== 'am' && $this->input->post('horas_inicio_'.$i) == 12){
							$horas_ini= $this->input->post('horas_inicio_'.$i)+12;
						}
						else{
							$horas_ini = $this->input->post('horas_inicio_'.$i);
						}
						
						$min_ini=$this->input->post('minutos_inicio_'.$i);
						
						
						if ($this->input->post('ampm_fin_'.$i)== 'pm'&& $this->input->post('horas_fin_'.$i) != 12){
							$horas_fin= $this->input->post('horas_fin_'.$i)+12;
						}
						elseif ($this->input->post('ampm_fin_'.$i)== 'am'&& $this->input->post('horas_fin_'.$i) == 12){
							$horas_fin= $this->input->post('horas_fin_'.$i)+12;
						}
						else{
							$horas_fin = $this->input->post('horas_fin_'.$i);
						}
						
						$min_fin=$this->input->post('minutos_fin_'.$i);	
										
						$horario['dias']=$dias;
						$horario['hora_ini']=$horas_ini.':'.$min_ini;
						$horario['hora_fin']=$horas_fin.':'.$min_fin;
						
						
						$nueva = true;
						if($registros != NULL)
						foreach($registros as $reg){
							if($reg == $horario)
								$nueva = false;
							elseif($reg['dias']== $horario['dias'] || $reg['hora_ini'] == $horario['hora_ini']
									|| $reg['hora_fin'] == $horario['hora_fin']){
									$nueva = false;
									$this->variables_sistema_modelo->modificar_horario($reg['dias'],$horario);
							}
		
						}
						if($nueva)
							$this->variables_sistema_modelo->agregar_horas_doctor($horario);
					}
					else{
							switch($i){
								case 0:$dia="Lunes";break;
								case 1:$dia="Martes";break;
								case 2:$dia="Miercoles";break;
								case 3:$dia="Jueves";break;
								case 4:$dia="Viernes";break;
								case 5:$dia="Sabado";break;
								case 6:$dia="Todos";break;
							}
							if($registros != NULL)
							foreach($registros as $reg){
								if($reg['dias']== $dia)
									$this->variables_sistema_modelo->eliminar_horario($dia);
							}
						
					}
				}	
			  
			  
			    $this->variables_sistema_modelo->eliminar_fecha();
			    $num = $this->input->post('num_fechas');
				echo $num;
				for($j=0;$j<= $num;$j++){
					 
					if($this->input->post('fecha_ini_'.$j) != NULL){
						$fecha_ini =  DateTime::createFromFormat('d/m/Y',$this->input->post('fecha_ini_'.$j));
						$fecha_fin =  DateTime::createFromFormat('d/m/Y',$this->input->post('fecha_fin_'.$j));
						
						if($fecha_ini == NULL){
							$fecha_ini =  DateTime::createFromFormat('d-m-Y',$this->input->post('fecha_ini_'.$j));
							$fecha_fin =  DateTime::createFromFormat('d-m-Y',$this->input->post('fecha_fin_'.$j));
						}
							
						$fecha['fecha_ini']=$fecha_ini->format('Y-m-d');
						$fecha['fecha_fin']=$fecha_fin != NULL ? $fecha_fin->format('Y-m-d'): NULL;			
						
						$this->variables_sistema_modelo->agregar_horas_doctor($fecha);
					}
				} 
						$datos['tipo']='exito';
						$datos['mensaje']='Horario guardado';
						$datos['menu'] = 'menu_principal';
						$datos['pagina'] = 'variables_sistema/variables_sistema_ficha';
						$datos['resultados']= $this->variables_sistema_modelo->buscar();
						//$datos['resultados']= $this->usuarios_modelo->buscar($id_usr);
						$this->load->view('plantilla',$datos);
			
			}else{
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					
									
					$datos['menu'] = 'menu_principal';
					$datos['resultados']= $this->variables_sistema_modelo->buscar();
					$datos['pagina'] = 'variables_sistema/variables_sistema_modificar';			
					$this->load->view('plantilla',$datos);
			}	
			}else{
					$datos['menu'] = 'menu_principal';
					$datos['resultados']= $this->variables_sistema_modelo->buscar();
					$datos['pagina'] = 'variables_sistema/variables_sistema_modificar';
					$this->load->view('plantilla',$datos);
			}
			}
			
	}
     public function modificar(){
     	$this->load->model('variables_sistema_modelo');
		$datos['menu'] = 'menu_principal';
		$datos['resultados']= $this->variables_sistema_modelo->buscar();
		$datos['pagina'] = 'variables_sistema/variables_sistema_modificar';
		$this->load->view('plantilla',$datos);
	}
	 
	public function cancelar(){
		$this->load->model('variables_sistema_modelo');
		$datos['menu'] = 'menu_principal';
		$datos['resultados']= $this->variables_sistema_modelo->buscar();
		$datos['pagina'] = 'variables_sistema/variables_sistema_ficha';
		$this->load->view('plantilla',$datos);
	}
	
	public function cerrar(){
		$datos['menu'] = 'menu_principal';
		$datos['pagina'] = 'paciente/paciente_buscar';
		$this->load->view('plantilla',$datos);
	}
	
}
?>