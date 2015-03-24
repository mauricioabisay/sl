<?php

class Usuarios extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library("form_validation");
		$this->load->library('session');
		$this->form_validation->set_error_delimiters('<span class="advertencia"><img src="'.base_url().'/assets/img/advertencia.png" width="15px" height="15px"><strong>', '</strong></span>');
	}
	
	public function index(){
		$this->load->model('usuarios_modelo');
		$datos['menu'] = 'menu_principal';
		$datos['pagina'] = 'usuarios/usuarios_agregar';
		$this->load->view('plantilla',$datos);
	}
	
		
	//Función para agregar un nuevo usuario
	public function agregar(){
		$this->form_validation->set_rules('nombre','Nombre','required|max_length[30]');
		$this->form_validation->set_rules('ap','Apellido Paterno','required|max_length[30]');
		$this->form_validation->set_rules('am','Apellido Materno','required|max_length[30]');	
		//$this->form_validation->set_rules('nick','Usuario','required|max_length[30]|trim|alpha_numeric');
		//$this->form_validation->set_rules('pass','Contrase&ntilde;a','required|min_length[4]|md5|trim|alpha_numeric');
		$existe_horario=false;
		for($i=0;$i<7;$i++){
			$this->form_validation->set_rules('dias_trabajo_'.$i,'','');
			if($this->input->post('dias_trabajo_'.$i)!= NULL){
				$existe_horario=true;
				$this->form_validation->set_rules('horas_inicio_'.$i,'','required');
				$this->form_validation->set_rules('minutos_inicio_'.$i,'','required');
				$this->form_validation->set_rules('ampm_inicio_'.$i,'','required');
				$this->form_validation->set_rules('horas_fin_'.$i,'','required');
				$this->form_validation->set_rules('minutos_fin_'.$i,'','required');
				$this->form_validation->set_rules('ampm_fin_'.$i,'','required');
			}
		}
		if(!$existe_horario){
			$this->form_validation->set_rules('horas_trabajo_0','','required');
		}
		if ($this->input->post()){
			if ($this->form_validation->run()){
				$usuario['nombre']= $this->input->post('nombre');
				$usuario['ap']= $this->input->post('ap');				
				$usuario['am']= $this->input->post('am');
				$usuario['nick']= $this->input->post('nick');
				$usuario['pass']= $this->input->post('pass');
				$usuario['tipo']= 'Doctor';
				
				$this->load->model('usuarios_modelo');
				$id_usr=$this->usuarios_modelo->agregar($usuario);
				
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
						$horario['doctor']=$id_usr;
						
						$this->usuarios_modelo->agregar_horas_doctor($horario);
					}
				}
				
				
				$datos['tipo']='exito';
				$datos['mensaje']='Usuario guardado';
				$datos['menu'] = 'menu_principal';
				$datos['pagina'] = 'usuarios/usuarios_ficha';
				$datos['resultados']= $this->usuarios_modelo->buscar($id_usr);
				$this->load->view('plantilla',$datos);
			}else{
				$usuario['tipo'] = 'advertencia';
				$usuario['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
				
				$usuario['nombre']= $this->input->post('nombre');
				$usuario['ap']= $this->input->post('ap');
				$usuario['am']= $this->input->post('am');
				$usuario['nick']= $this->input->post('nick');
				
				$usuario['menu'] = 'menu_principal';
				$usuario['pagina'] = 'usuarios/usuarios_agregar';			
				$this->load->view('plantilla',$usuario);
			}	
		}else{
			$datos['menu'] = 'menu_principal';
			$datos['pagina'] = 'usuarios/usuarios_agregar';
			$this->load->view('plantilla',$datos);
		}
	}

	public function modificar_datos(){
		$this->form_validation->set_rules('nombre','Nombre','required|max_length[30]');
		$this->form_validation->set_rules('ap','Apellido Paterno','required|max_length[30]');
		$this->form_validation->set_rules('am','Apellido Materno','required|max_length[30]');	
		//$this->form_validation->set_rules('nick','Usuario','required|max_length[30]|trim|alpha_numeric');
		//$this->form_validation->set_rules('pass','Contrase&ntilde;a','required|min_length[4]|md5|trim|alpha_numeric');
		$existe_horario=false;
		for($i=0;$i<7;$i++){
			$this->form_validation->set_rules('dias_trabajo_'.$i,'','');
			if($this->input->post('dias_trabajo_'.$i)!= NULL){
				$existe_horario=true;
				$this->form_validation->set_rules('horas_inicio_'.$i,'','required');
				$this->form_validation->set_rules('minutos_inicio_'.$i,'','required');
				$this->form_validation->set_rules('ampm_inicio_'.$i,'','required');
				$this->form_validation->set_rules('horas_fin_'.$i,'','required');
				$this->form_validation->set_rules('minutos_fin_'.$i,'','required');
				$this->form_validation->set_rules('ampm_fin_'.$i,'','required');
			}
		}
		if(!$existe_horario){
			$this->form_validation->set_rules('dias_trabajo_0','','required');
		}

		$this->load->model('usuarios_modelo');
		
		$id_usr=$this->input->post('id_usr');
		if ($this->input->post()){
			//$this->usuarios_modelo->eliminar_horarios();
			if ($this->form_validation->run()){
				
				$usuario['nombre']= $this->input->post('nombre');
				$usuario['ap']= $this->input->post('ap');				
				$usuario['am']= $this->input->post('am');
				/*$usuario['nick']= $this->input->post('nick');
				$usuario['pass']= $this->input->post('pass');*/
				$usuario['tipo']= 'Doctor';
				
				
				$this->load->model('usuarios_modelo');
				$registros= $this->usuarios_modelo->buscar($id_usr);
				
				foreach ($registros as $reg){
						if($usuario != $reg)
							$this->usuarios_modelo->modificar_usuario($usuario,$id_usr);
				}
				
				
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
						elseif ($this->input->post('ampm_fin_'.$i)== 'am' && $this->input->post('horas_fin_'.$i) == 12){
							$horas_fin= $this->input->post('horas_fin_'.$i)+12;
						}
						else{
							$horas_fin = $this->input->post('horas_fin_'.$i);
						}
						
						$min_fin=$this->input->post('minutos_fin_'.$i);
						
						$horario['dias']=$dias;
						$horario['hora_ini']=$horas_ini.':'.$min_ini;
						$horario['hora_fin']=$horas_fin.':'.$min_fin;
						$horario['doctor']=$id_usr;
						
						$nueva = true;
						foreach($registros as $reg){
							if($reg == $horario)
								$nueva = false;
							elseif($reg['dias']== $horario['dias'] || $reg['hora_ini'] == $horario['hora_ini']
									|| $reg['hora_fin'] == $horario['hora_fin']){
									$nueva = false;
									$this->usuarios_modelo->modificar_horario($reg['dias'],$id_usr,$horario);
							}
		
						}
						if($nueva)
							$this->usuarios_modelo->agregar_horas_doctor($horario);
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
						foreach($registros as $reg){
							if($reg['dias']== $dia)
								$this->usuarios_modelo->eliminar_horario($dia,$id_usr);
						}
						
						//if($nueva)
							//$this->usuarios_modelo->agregar_horas_doctor($horario);

					}
					
					
				}
				
				$datos['tipo']='exito';
				$datos['mensaje']='Usuario guardado';
				$datos['menu'] = 'menu_principal';
				$datos['pagina'] = 'usuarios/usuarios_ficha';
				$datos['resultados']= $this->usuarios_modelo->buscar($id_usr);
				$this->load->view('plantilla',$datos);
			}else{
				$usuario['tipo'] = 'advertencia';
				$usuario['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
				
				$usuario['nombre']= $this->input->post('nombre');
				$usuario['ap']= $this->input->post('ap');
				$usuario['am']= $this->input->post('am');
				$usuario['nick']= $this->input->post('nick');
				
				$usuario['menu'] = 'menu_principal';
				$usuario['resultados']=$this->usuarios_modelo->buscar($id_usr);
				$usuario['pagina'] = 'usuarios/usuarios_modificar';			
				$this->load->view('plantilla',$usuario);
			}	
		}else{
			$datos['menu'] = 'menu_principal';
			$datos['resultados']=$this->usuarios_modelo->buscar($id_usr);
			$datos['pagina'] = 'usuarios/usuarios_modificar';
			$this->load->view('plantilla',$datos);
		}
	}

	public function modificar($id_usr){
		$this->load->model('usuarios_modelo');
		$datos['menu'] = 'menu_principal';
		$datos['resultados']=$this->usuarios_modelo->buscar($id_usr);
		$datos['pagina'] = 'usuarios/usuarios_modificar';
		$this->load->view('plantilla',$datos);
	}
	 
	public function cancelar($id){
		$this->load->model('usuarios_modelo');
		$datos['menu'] = 'menu_principal';
		$datos['resultados']=$this->usuarios_modelo->buscar($id);
		$datos['pagina'] = 'usuarios/usuarios_ficha';
		$this->load->view('plantilla',$datos);
	}
	
	public function aceptar_nuevo(){
		$datos['menu'] = 'menu_principal';
		$datos['pagina'] = 'usuarios/usuarios_agregar';
		$this->load->view('plantilla',$datos);
	}
	
	public function cerrar(){
		$datos['menu'] = 'menu_principal';
		$datos['pagina'] = 'paciente/paciente_buscar';
		$this->load->view('plantilla',$datos);
	}
	

}