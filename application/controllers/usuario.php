<?php
    /**
     * 
     */
    class Usuario extends CI_Controller {
        
        function __construct() {
            parent::__construct();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->form_validation->set_error_delimiters('<span class="advertencia"><img src="'.base_url().'/assets/img/advertencia.png" width="15px" height="15px"><strong>', '</strong></span>');
        }
		
		/*function index(){
			/*$this->load->model('usuario_modelo');
			if(! $datos['resultados'] = $this->usuario_modelo->buscar('')){
				$datos['tipo'] = 'error';
				$datos['mensaje'] = 'No se han encontrado resultados';
			}
			$datos['menu'] = 'menu_principal';
			$datos['pagina'] = 'usuario_listado';
			$this->load->view('plantilla',$datos);
		}*/
		
		function agregar(){
			$this->load->model('usuario_modelo');
			$this->load->model('cita_modelo');
			$datos['horario_general'] = $this->cita_modelo->horas_general();
			$datos['tipos_usuario'] = $this->usuario_modelo->tipos_usuario();
			if($this->input->post()){
				$this->form_validation->set_rules('nombre','Nombre','required|max_length[35');
				$this->form_validation->set_rules('ap','Apellido Paterno','required|max_length[35');
				$this->form_validation->set_rules('am','Apellido Materno','required|max_length[35');
				$this->form_validation->set_rules('tipo','Tipo de Usuario','required');
				
				$this->form_validation->set_rules('nick','Nombre de Usuario','required|max_length[30]|trim|alpha_numeric|callback_no_duplicar');
				$this->form_validation->set_rules('pass','Contrase&ntilde;a Temporal','required|min_length[4]|alpha_numeric|matches[pass_confirm]');
				$this->form_validation->set_rules('pass_confirm','Confirmar Contrase&ntilde;a Temporal','required|min_length[4]|alpha_numeric');
				
				if($this->input->post('tipo')==2){
					/*$this->form_validation->set_rules('h_entrada','','required');
					$this->form_validation->set_rules('m_entrada','','required');
					$this->form_validation->set_rules('ampm_entrada','','required');
					$this->form_validation->set_rules('h_salida','','required');
					$this->form_validation->set_rules('m_salida','','required');
					$this->form_validation->set_rules('ampm_salida','','required');*/
					$this->form_validation->set_rules('h_eval_primera','','required');
					$this->form_validation->set_rules('m_eval_primera','','required');
					$this->form_validation->set_rules('h_cons_primera','','required');
					$this->form_validation->set_rules('m_cons_primera','','required');
					$this->form_validation->set_rules('h_eval_recurrente','','required');
					$this->form_validation->set_rules('m_eval_recurrente','','required');
					$this->form_validation->set_rules('h_cons_recurrente','','required');
					$this->form_validation->set_rules('m_cons_recurrente','','required');
					
				}
				if($this->form_validation->run()){
					if(!$this->usuario_modelo->existe($this->input->post('nick'))){
//Preparacion de los datos de usuario
						$usuario['nombre'] = $this->input->post('nombre');
						$usuario['ap'] = $this->input->post('ap');
						$usuario['am'] = $this->input->post('am');
						$usuario['tipo'] = $this->input->post('tipo');
						$usuario['nick'] = $this->input->post('nick');
						$usuario['pass'] = $this->input->post('pass');
						if($this->input->post('tipo')<=2){
//Convertimos los tiempos de duracion de la evaluacion y consulta a minutos
							$usuario['tiempo_evaluacion_primera'] = $this->input->post('h_eval_primera')*60+$this->input->post('m_eval_primera');
							$usuario['tiempo_consulta_primera'] = $this->input->post('h_cons_primera')*60+$this->input->post('m_cons_primera');
							$usuario['tiempo_evaluacion_recurrente'] = $this->input->post('h_eval_recurrente')*60+$this->input->post('m_eval_recurrente');
							$usuario['tiempo_consulta_recurrente'] = $this->input->post('h_cons_recurrente')*60+$this->input->post('m_cons_recurrente');
						}
//Se agregan los datos del usuario
						$horario['doctor'] = $this->usuario_modelo->agregar($usuario);
//Preparacion de los datos de horario
						if($this->input->post('tipo')<=2){
							$aux_h_i = $this->input->post('h_entrada');
							$aux_m_i = $this->input->post('m_entrada');
							$aux_ampm_i = $this->input->post('ampm_entrada');
							$aux_h_f = $this->input->post('h_salida');
							$aux_m_f = $this->input->post('m_salida');
							$aux_ampm_f = $this->input->post('ampm_salida');
				
							$aux_lun = $this->input->post('lun');
							$aux_mar = $this->input->post('mar');
							$aux_mie = $this->input->post('mie');
							$aux_jue = $this->input->post('jue');
							$aux_vie = $this->input->post('vie');
							$aux_sab = $this->input->post('sab');
							$aux_dom = $this->input->post('dom');
							for($i=0;$i<sizeof($aux_h_i);$i++){
								$valido = false;
								$horario['dias'] = '';
								$horario['hora_ini'] = ($aux_ampm_i[$i]=='pm')&&($aux_h_i[$i]<12)?$aux_h_i[$i]+12:$aux_h_i[$i];
								$horario['hora_ini'] .= ':'.$aux_m_i[$i].':00';
								$horario['hora_fin'] = ($aux_ampm_f[$i]=='pm')&&($aux_h_f[$i]<12)?$aux_h_f[$i]+12:$aux_h_f[$i];
								$horario['hora_fin'] .= ':'.$aux_m_f[$i].':00';
							
								if(isset($aux_lun[$i])){
									$valido = true;
									if($horario['dias']==''){$horario['dias'] .= $aux_lun[$i];}
									else{$horario['dias'] .= ','.$aux_lun[$i];}
								}
								if(isset($aux_mar[$i])){
									$valido = true;
									if($horario['dias']==''){$horario['dias'] .= $aux_mar[$i];}
									else{$horario['dias'] .= ','.$aux_mar[$i];}
								}
								if(isset($aux_mie[$i])){
									$valido = true;
									if($horario['dias']==''){$horario['dias'] .= $aux_mie[$i];}
									else{$horario['dias'] .= ','.$aux_mie[$i];}
								}
								if(isset($aux_jue[$i])){
									$valido = true;
									if($horario['dias']==''){$horario['dias'] .= $aux_jue[$i];}
									else{$horario['dias'] .= ','.$aux_jue[$i];}
								}
								if(isset($aux_vie[$i])){
									$valido = true;
									if($horario['dias']==''){$horario['dias'] .= $aux_vie[$i];}
									else{$horario['dias'] .= ','.$aux_vie[$i];}
								}
								if(isset($aux_sab[$i])){
									$valido = true;
									if($horario['dias']==''){$horario['dias'] .= $aux_sab[$i];}
									else{$horario['dias'] .= ','.$aux_sab[$i];}
								}
								if(isset($aux_dom[$i])){
									$valido = true;
									if($horario['dias']==''){$horario['dias'] .= $aux_dom[$i];}
									else{$horario['dias'] .= ','.$aux_dom[$i];}
								}
								$horario['hora_consulta'] = 'Si';
//Se agrega el horario del doctor
								if($valido){
									$this->usuario_modelo->agregar_horario($horario);	
								}
								
							}
//Preparando datos para horas reservadas
							$aux_h_i = $this->input->post('hr_entrada');
							$aux_m_i = $this->input->post('mr_entrada');
							$aux_ampm_i = $this->input->post('ampmr_entrada');
							$aux_h_f = $this->input->post('hr_salida');
							$aux_m_f = $this->input->post('mr_salida');
							$aux_ampm_f = $this->input->post('ampmr_salida');
				
							$aux_lun = $this->input->post('lun_r');
							$aux_mar = $this->input->post('mar_r');
							$aux_mie = $this->input->post('mie_r');
							$aux_jue = $this->input->post('jue_r');
							$aux_vie = $this->input->post('vie_r');
							$aux_sab = $this->input->post('sab_r');
							$aux_dom = $this->input->post('dom_r');
							for($i=0;$i<sizeof($aux_h_i);$i++){
								$valido = false;
								$horario['dias'] = '';
								$horario['hora_ini'] = ($aux_ampm_i[$i]=='pm')&&($aux_h_i[$i]<12)?$aux_h_i[$i]+12:$aux_h_i[$i];
								$horario['hora_ini'] .= ':'.$aux_m_i[$i].':00';
								$horario['hora_fin'] = ($aux_ampm_f[$i]=='pm')&&($aux_h_f[$i]<12)?$aux_h_f[$i]+12:$aux_h_f[$i];
								$horario['hora_fin'] .= ':'.$aux_m_f[$i].':00';
							
								if(isset($aux_lun[$i])){
									$valido = true;
									if($horario['dias']==''){$horario['dias'] .= $aux_lun[$i];}
									else{$horario['dias'] .= ','.$aux_lun[$i];}
								}
								if(isset($aux_mar[$i])){
									$valido = true;
									if($horario['dias']==''){$horario['dias'] .= $aux_mar[$i];}
									else{$horario['dias'] .= ','.$aux_mar[$i];}
								}
								if(isset($aux_mie[$i])){
									$valido = true;
									if($horario['dias']==''){$horario['dias'] .= $aux_mie[$i];}
									else{$horario['dias'] .= ','.$aux_mie[$i];}
								}
								if(isset($aux_jue[$i])){
									$valido = true;
									if($horario['dias']==''){$horario['dias'] .= $aux_jue[$i];}
									else{$horario['dias'] .= ','.$aux_jue[$i];}
								}
								if(isset($aux_vie[$i])){
									$valido = true;
									if($horario['dias']==''){$horario['dias'] .= $aux_vie[$i];}
									else{$horario['dias'] .= ','.$aux_vie[$i];}
								}
								if(isset($aux_sab[$i])){
									$valido = true;
									if($horario['dias']==''){$horario['dias'] .= $aux_sab[$i];}
									else{$horario['dias'] .= ','.$aux_sab[$i];}
								}
								if(isset($aux_dom[$i])){
									$valido = true;
									if($horario['dias']==''){$horario['dias'] .= $aux_dom[$i];}
									else{$horario['dias'] .= ','.$aux_dom[$i];}
								}
								$horario['hora_consulta'] = 'Reservada';
//Se agrega la hora reservada del doctor
								if($valido){
									$this->usuario_modelo->agregar_horario($horario);	
								}
							}
							
						}
						if($this->input->post('tipo')==1){
							$aux_h_i = $this->input->post('h_entrada_general');
							$aux_m_i = $this->input->post('m_entrada_general');
							$aux_ampm_i = $this->input->post('ampm_entrada_general');
							$aux_h_f = $this->input->post('h_salida_general');
							$aux_m_f = $this->input->post('m_salida_general');
							$aux_ampm_f = $this->input->post('ampm_salida_general');
				
							$aux_lun = $this->input->post('lun_g');
							$aux_mar = $this->input->post('mar_g');
							$aux_mie = $this->input->post('mie_g');
							$aux_jue = $this->input->post('jue_g');
							$aux_vie = $this->input->post('vie_g');
							$aux_sab = $this->input->post('sab_g');
							$aux_dom = $this->input->post('dom_g');
							for($i=0;$i<sizeof($aux_h_i);$i++){
								$horario_general['dias'] = '';
								$horario_general['hora_ini'] = ($aux_ampm_i[$i]=='pm')&&($aux_h_i[$i]<12)?$aux_h_i[$i]+12:$aux_h_i[$i];
								$horario_general['hora_ini'] .= ':'.$aux_m_i[$i].':00';
								$horario_general['hora_fin'] = ($aux_ampm_f[$i]=='pm')&&($aux_h_f[$i]<12)?$aux_h_f[$i]+12:$aux_h_f[$i];
								$horario_general['hora_fin'] .= ':'.$aux_m_f[$i].':00';
							
								if(isset($aux_lun[$i])){
									if($horario_general['dias']==''){$horario_general['dias'] .= $aux_lun[$i];}
									else{$horario_general['dias'] .= ','.$aux_lun[$i];}
								}
								if(isset($aux_mar[$i])){
									if($horario_general['dias']==''){$horario_general['dias'] .= $aux_mar[$i];}
									else{$horario_general['dias'] .= ','.$aux_mar[$i];}
								}
								if(isset($aux_mie[$i])){
									if($horario_general['dias']==''){$horario_general['dias'] .= $aux_mie[$i];}
									else{$horario_general['dias'] .= ','.$aux_mie[$i];}
								}
								if(isset($aux_jue[$i])){
									if($horario_general['dias']==''){$horario_general['dias'] .= $aux_jue[$i];}
									else{$horario_general['dias'] .= ','.$aux_jue[$i];}
								}
								if(isset($aux_vie[$i])){
									if($horario_general['dias']==''){$horario_general['dias'] .= $aux_vie[$i];}
									else{$horario_general['dias'] .= ','.$aux_vie[$i];}
								}
								if(isset($aux_sab[$i])){
									if($horario_general['dias']==''){$horario_general['dias'] .= $aux_sab[$i];}
									else{$horario_general['dias'] .= ','.$aux_sab[$i];}
								}
								if(isset($aux_dom[$i])){
									if($horario_general['dias']==''){$horario_general['dias'] .= $aux_dom[$i];}
									else{$horario_general['dias'] .= ','.$aux_dom[$i];}
								}
								$horario_general['hora_consulta'] = 'Si';
//Se agrega el horario general del consultorio
								$this->usuario_modelo->agregar_horario($horario_general);
							}
						}
						$datos['tipo'] = 'exito';
						$datos['mensaje'] = 'Usuario almacenado exitosamente';
						if(! $datos['resultados'] = $this->usuario_modelo->buscar('')){
							$datos['tipo'] = 'error';
							$datos['mensaje'] = 'No se han encontrado resultados';
						}	
						$datos['menu'] = 'menu_principal';
						$datos['pagina'] = 'usuario/usuario_listado';
						$this->load->view('plantilla',$datos);
					}else{
						$datos['tipo'] = 'advertencia';
						$datos['mensaje'] = 'Ya existe un Usuario con ese Nombre de Usuario';
						$datos['menu'] = 'menu_principal';
						$datos['pagina'] = 'usuario/usuario_agregar';
						$this->load->view('plantilla',$datos);
					}
					
				}else{
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'Algunos datos proporcionados no son v&aacute;lidos';
					$datos['menu'] = 'menu_principal';
					$datos['pagina'] = 'usuario/usuario_agregar';
					$this->load->view('plantilla',$datos);
				}
			}else{
				$datos['menu'] = 'menu_principal';
				$datos['pagina'] = 'usuario/usuario_agregar';
				$this->load->view('plantilla',$datos);
			}
		}

		function buscar_nombre(){
			if($this->input->post('usuario')){
				$this->load->model('usuario_modelo');
				if(! $datos['resultados'] = $this->usuario_modelo->buscar_nombre($this->input->post('usuario')) ){
					$datos['tipo'] = 'error';
					$datos['mensaje'] = 'No se han encontrado resultados';
				}else{
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Coincidencias encontradas para "'.$this->input->post('usuario').'"';
				}
				$datos['menu'] = 'menu_principal';
				$datos['pagina'] = 'usuario_listado';
				$this->load->view('plantilla',$datos);
			}else{
				$this->listado();
			}
		}
		
		function modificar($id){
			$this->load->model('usuario_modelo');
			$this->load->model('cita_modelo');
			$datos['usuario'] = $this->usuario_modelo->buscar_id($id);
			if(($datos['usuario']->nombre_tipo!="Recepcionista")&&($datos['usuario']->nombre_tipo!="Practicante")){
				$datos['horario_general'] = $this->cita_modelo->horas_general();
				$datos['horas_consulta'] = $this->cita_modelo->horas_general_consulta_doctor($id);
				$datos['horas_reservadas'] = $this->cita_modelo->horas_general_reservadas_doctor($id);
			}
			$datos['tipos_usuario'] = $this->usuario_modelo->tipos_usuario();
			if($this->input->post()){
//Formulario
				$this->form_validation->set_rules('pass','Contrase&ntilde;a','min_length[4]|alpha_numeric|matches[pass_confirm]');
				$this->form_validation->set_rules('pass_confirm','Confirmar Contrase&ntilde;a','min_length[4]|alpha_numeric');
				if($this->form_validation->run()){
//Datos validos
					$cambio_usuario = false;
					if($this->input->post('nombre')){
						$cambio_usuario = true;
						$usuario['nombre'] = $this->input->post('nombre');	
					}
					if($this->input->post('ap')){
						$cambio_usuario = true;
						$usuario['ap'] = $this->input->post('ap');	
					}
					if($this->input->post('am')){
						$cambio_usuario = true;
						$usuario['am'] = $this->input->post('am');	
					}
					if($this->input->post('nick')){
						$cambio_usuario = true;
						$usuario['nick'] = $this->input->post('nick');	
					}
					if($this->input->post('pass')){
						$cambio_usuario = true;
						$usuario['pass'] = $this->input->post('pass');	
					}
				//Actualizacion de datos personales del usuario
					if($cambio_usuario){
						$this->usuario_modelo->modificar($id,$usuario);	
					}
					$horario['doctor'] = $id;
//Preparacion de los datos de horario
					if($datos['usuario']->tipo<=2){
						$aux_h_id = $this->input->post('h_id');
						$aux_h_i = $this->input->post('h_entrada');
						$aux_m_i = $this->input->post('m_entrada');
						$aux_ampm_i = $this->input->post('ampm_entrada');
						$aux_h_f = $this->input->post('h_salida');
						$aux_m_f = $this->input->post('m_salida');
						$aux_ampm_f = $this->input->post('ampm_salida');
				
						$aux_lun = $this->input->post('lun');
						$aux_mar = $this->input->post('mar');
						$aux_mie = $this->input->post('mie');
						$aux_jue = $this->input->post('jue');
						$aux_vie = $this->input->post('vie');
						$aux_sab = $this->input->post('sab');
						$aux_dom = $this->input->post('dom');
						
						for($i=0;$i<sizeof($aux_h_i);$i++){
							$valido = false;
							$horario['dias'] = '';
							$horario['hora_ini'] = ($aux_ampm_i[$i]=='pm')&&($aux_h_i[$i]<12)?$aux_h_i[$i]+12:$aux_h_i[$i];
							$horario['hora_ini'] .= ':'.$aux_m_i[$i].':00';
							$horario['hora_fin'] = ($aux_ampm_f[$i]=='pm')&&($aux_h_f[$i]<12)?$aux_h_f[$i]+12:$aux_h_f[$i];
							$horario['hora_fin'] .= ':'.$aux_m_f[$i].':00';
							
							if(isset($aux_lun[$i])){
								$valido = true;
								if($horario['dias']==''){$horario['dias'] .= $aux_lun[$i];}
								else{$horario['dias'] .= ','.$aux_lun[$i];}
							}
							if(isset($aux_mar[$i])){
								$valido = true;
								if($horario['dias']==''){$horario['dias'] .= $aux_mar[$i];}
								else{$horario['dias'] .= ','.$aux_mar[$i];}
							}
							if(isset($aux_mie[$i])){
								$valido = true;
								if($horario['dias']==''){$horario['dias'] .= $aux_mie[$i];}
								else{$horario['dias'] .= ','.$aux_mie[$i];}
							}
							if(isset($aux_jue[$i])){
								$valido = true;
								if($horario['dias']==''){$horario['dias'] .= $aux_jue[$i];}
								else{$horario['dias'] .= ','.$aux_jue[$i];}
							}
							if(isset($aux_vie[$i])){
								$valido = true;
								if($horario['dias']==''){$horario['dias'] .= $aux_vie[$i];}
								else{$horario['dias'] .= ','.$aux_vie[$i];}
							}
							if(isset($aux_sab[$i])){
								$valido = true;
								if($horario['dias']==''){$horario['dias'] .= $aux_sab[$i];}
								else{$horario['dias'] .= ','.$aux_sab[$i];}
							}
							if(isset($aux_dom[$i])){
								$valido = true;
								if($horario['dias']==''){$horario['dias'] .= $aux_dom[$i];}
								else{$horario['dias'] .= ','.$aux_dom[$i];}
							}
							$horario['hora_consulta'] = 'Si';
//Se agrega el horario del doctor
							if($valido){
								if(isset($aux_h_id[$i])){
									$this->usuario_modelo->modificar_horario($aux_h_id[$i],$horario);		
								}else{
									$this->usuario_modelo->agregar_horario($horario);
								}	
							}
						}
//Preparando datos para horas reservadas
						$aux_h_id = $this->input->post('hr_id');
						$aux_h_i = $this->input->post('hr_entrada');
						$aux_m_i = $this->input->post('mr_entrada');
						$aux_ampm_i = $this->input->post('ampmr_entrada');
						$aux_h_f = $this->input->post('hr_salida');
						$aux_m_f = $this->input->post('mr_salida');
						$aux_ampm_f = $this->input->post('ampmr_salida');
						$aux_lun = $this->input->post('lun_r');
						$aux_mar = $this->input->post('mar_r');
						$aux_mie = $this->input->post('mie_r');
						$aux_jue = $this->input->post('jue_r');
						$aux_vie = $this->input->post('vie_r');
						$aux_sab = $this->input->post('sab_r');
						$aux_dom = $this->input->post('dom_r');
						for($i=0;$i<sizeof($aux_h_i);$i++){
							$valido = false;
							$horario['dias'] = '';
							$horario['hora_ini'] = ($aux_ampm_i[$i]=='pm')&&($aux_h_i[$i]<12)?$aux_h_i[$i]+12:$aux_h_i[$i];
							$horario['hora_ini'] .= ':'.$aux_m_i[$i].':00';
							$horario['hora_fin'] = ($aux_ampm_f[$i]=='pm')&&($aux_h_f[$i]<12)?$aux_h_f[$i]+12:$aux_h_f[$i];
							$horario['hora_fin'] .= ':'.$aux_m_f[$i].':00';
							
							if(isset($aux_lun[$i])){
								$valido = true;
								if($horario['dias']==''){$horario['dias'] .= $aux_lun[$i];}
								else{$horario['dias'] .= ','.$aux_lun[$i];}
							}
							if(isset($aux_mar[$i])){
								$valido = true;
								if($horario['dias']==''){$horario['dias'] .= $aux_mar[$i];}
								else{$horario['dias'] .= ','.$aux_mar[$i];}
							}
							if(isset($aux_mie[$i])){
								$valido = true;
								if($horario['dias']==''){$horario['dias'] .= $aux_mie[$i];}
								else{$horario['dias'] .= ','.$aux_mie[$i];}
							}
							if(isset($aux_jue[$i])){
								$valido = true;
								if($horario['dias']==''){$horario['dias'] .= $aux_jue[$i];}
								else{$horario['dias'] .= ','.$aux_jue[$i];}
							}
							if(isset($aux_vie[$i])){
								$valido = true;
								if($horario['dias']==''){$horario['dias'] .= $aux_vie[$i];}
								else{$horario['dias'] .= ','.$aux_vie[$i];}
							}
							if(isset($aux_sab[$i])){
								$valido = true;
								if($horario['dias']==''){$horario['dias'] .= $aux_sab[$i];}
								else{$horario['dias'] .= ','.$aux_sab[$i];}
							}
							if(isset($aux_dom[$i])){
								$valido = true;
								if($horario['dias']==''){$horario['dias'] .= $aux_dom[$i];}
								else{$horario['dias'] .= ','.$aux_dom[$i];}
							}
							$horario['hora_consulta'] = 'Reservada';
//Se agrega la hora reservada del doctor
							if($valido){
								if(isset($aux_h_id[$i])){
									$this->usuario_modelo->modificar_horario($aux_h_id[$i],$horario);		
								}else{
									$this->usuario_modelo->agregar_horario($horario);
								}		
							}
						}
					}
					if($datos['usuario']->tipo==1){
						$aux_h_id = $this->input->post('h_id_general');
						$aux_h_i = $this->input->post('h_entrada_general');
						$aux_m_i = $this->input->post('m_entrada_general');
						$aux_ampm_i = $this->input->post('ampm_entrada_general');
						$aux_h_f = $this->input->post('h_salida_general');
						$aux_m_f = $this->input->post('m_salida_general');
						$aux_ampm_f = $this->input->post('ampm_salida_general');
				
						$aux_lun = $this->input->post('lun_g');
						$aux_mar = $this->input->post('mar_g');
						$aux_mie = $this->input->post('mie_g');
						$aux_jue = $this->input->post('jue_g');
						$aux_vie = $this->input->post('vie_g');
						$aux_sab = $this->input->post('sab_g');
						$aux_dom = $this->input->post('dom_g');
						for($i=0;$i<sizeof($aux_h_i);$i++){
							$valido = false;
							$horario_general['dias'] = '';
							$horario_general['hora_ini'] = ($aux_ampm_i[$i]=='pm')&&($aux_h_i[$i]<12)?$aux_h_i[$i]+12:$aux_h_i[$i];
							$horario_general['hora_ini'] .= ':'.$aux_m_i[$i].':00';
							$horario_general['hora_fin'] = ($aux_ampm_f[$i]=='pm')&&($aux_h_f[$i]<12)?$aux_h_f[$i]+12:$aux_h_f[$i];
							$horario_general['hora_fin'] .= ':'.$aux_m_f[$i].':00';
						
							if(isset($aux_lun[$i])){
								$valido = true;
								if($horario_general['dias']==''){$horario_general['dias'] .= $aux_lun[$i];}
								else{$horario_general['dias'] .= ','.$aux_lun[$i];}
							}
							if(isset($aux_mar[$i])){
								$valido = true;
								if($horario_general['dias']==''){$horario_general['dias'] .= $aux_mar[$i];}
								else{$horario_general['dias'] .= ','.$aux_mar[$i];}
							}
							if(isset($aux_mie[$i])){
								$valido = true;
								if($horario_general['dias']==''){$horario_general['dias'] .= $aux_mie[$i];}
								else{$horario_general['dias'] .= ','.$aux_mie[$i];}
							}
							if(isset($aux_jue[$i])){
								$valido = true;
								if($horario_general['dias']==''){$horario_general['dias'] .= $aux_jue[$i];}
								else{$horario_general['dias'] .= ','.$aux_jue[$i];}
							}
							if(isset($aux_vie[$i])){
								$valido = true;
								if($horario_general['dias']==''){$horario_general['dias'] .= $aux_vie[$i];}
								else{$horario_general['dias'] .= ','.$aux_vie[$i];}
							}
							if(isset($aux_sab[$i])){
								$valido = true;
								if($horario_general['dias']==''){$horario_general['dias'] .= $aux_sab[$i];}
								else{$horario_general['dias'] .= ','.$aux_sab[$i];}
							}
							if(isset($aux_dom[$i])){
								$valido = true;
								if($horario_general['dias']==''){$horario_general['dias'] .= $aux_dom[$i];}
								else{$horario_general['dias'] .= ','.$aux_dom[$i];}
							}
							$horario_general['hora_consulta'] = 'Si';
//Se agrega el horario general del consultorio
							if($valido){
								if(isset($aux_h_id[$i])){
									$this->usuario_modelo->modificar_horario($aux_h_id[$i],$horario_general);		
								}else{
									$this->usuario_modelo->agregar_horario($horario_general);
								}		
							}
						}
					}
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Datos de Usuario actualizados exitosamente';
					if(! $datos['resultados'] = $this->usuario_modelo->buscar('')){
						$datos['tipo'] = 'error';
						$datos['mensaje'] = 'No se han encontrado resultados';
					}	
					$datos['menu'] = 'menu_principal';
					$datos['pagina'] = 'usuario/usuario_listado';
					$this->load->view('plantilla',$datos);
				}else{
//Datos invalidos
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'Algunos datos proporcionados no son v&aacute;lidos';
					$datos['menu'] = 'menu_principal';
					$datos['pagina'] = 'usuario/usuario_modificar';
					$this->load->view('plantilla',$datos);
				}
			}else{
//No formulario
				$datos['menu'] = 'menu_principal';
				$datos['pagina'] = 'usuario/usuario_modificar';
				$this->load->view('plantilla',$datos);
			}
		}

		function detalle($id){
			$this->load->model('usuario_modelo');
			$this->load->model('cita_modelo');
			$datos['usuario'] = $this->usuario_modelo->buscar_id($id);
			if(($datos['usuario']->nombre_tipo!="Recepcionista")&&($datos['usuario']->nombre_tipo!="Practicante")){
				$datos['horario_general'] = $this->cita_modelo->horas_general();
				$datos['horas_consulta'] = $this->cita_modelo->horas_general_consulta_doctor($id);
				$datos['horas_reservadas'] = $this->cita_modelo->horas_general_reservadas_doctor($id);
			}
			$datos['tipos_usuario'] = $this->usuario_modelo->tipos_usuario();
			$datos['menu'] = 'menu_principal';
			$datos['pagina'] = 'usuario/usuario_ficha';
			$this->load->view('plantilla',$datos);
		}

		function periodo_inhabil($id){
			$datos['id_usuario'] = $id;
			$this->load->model('cita_modelo');
			$datos['resultados'] = $this->cita_modelo->horas_general_inhabiles_doctor($id,date('Y-m-d'));
			if($this->input->post()){
//Formulario
				$num = $this->input->post('hora_counter');
				for($i=0;$i<$num;$i++){
					$this->form_validation->set_rules('fini_'.$i,'Fecha Inicio','required');
					$this->form_validation->set_rules('hini_'.$i,'Hora Inicio','required');
					$this->form_validation->set_rules('mini_'.$i,'Minuto Inicio','required');
					$this->form_validation->set_rules('ampmini_'.$i,'AMPM Inicio','required');
					$this->form_validation->set_rules('ffin_'.$i,'Fecha Fin','required');
					$this->form_validation->set_rules('hfin_'.$i,'Hora Fin','required');
					$this->form_validation->set_rules('mfin_'.$i,'Minuto Fin','required');
					$this->form_validation->set_rules('ampmfin_'.$i,'AMPM Fin','required');	
				}
				
				if($this->form_validation->run()){
//Datos validos
					$this->load->model('usuario_modelo');
					$horario['doctor'] = $id;
					$horario['hora_consulta'] = 'No';
					for($i=0;$i<$num;$i++){
						$aux_hora = $this->input->post('hini_'.$i);
						$aux_hora .=':'.$this->input->post('mini_'.$i).':00';
						$aux_hora .=' '.$this->input->post('ampmini_'.$i); 
						$aux_fecha = DateTime::createFromFormat('d/m/Y g:i:s a',$this->input->post('fini_'.$i).' '.$aux_hora);
						$horario['fecha_ini'] = $aux_fecha->format('Y-m-d');
						$horario['hora_ini'] = $aux_fecha->format('H:i:s');
						$aux_hora = $this->input->post('hfin_'.$i);
						$aux_hora .=':'.$this->input->post('mfin_'.$i).':00';
						$aux_hora .=' '.$this->input->post('ampmfin_'.$i);
						$aux_fecha = DateTime::createFromFormat('d/m/Y g:i:s a',$this->input->post('ffin_'.$i).' '.$aux_hora);
						$horario['fecha_fin'] = $aux_fecha->format('Y-m-d');
						$horario['hora_fin'] = $aux_fecha->format('H:i:s');
						$this->usuario_modelo->agregar_horario($horario);	
					}
					$datos['resultados'] = $this->cita_modelo->horas_general_inhabiles_doctor($id,date('Y-m-d'));
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Fecha inhabil agregada exitosamente.';
					$datos['menu'] = 'menu_principal';
					$datos['pagina'] = 'usuario/usuario_break';
					$this->load->view('plantilla',$datos);
				}else{
//Datos invalidos
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'Algunos datos proporcionados no son v&aacute;lidos';
					$datos['menu'] = 'menu_principal';
					$datos['pagina'] = 'usuario/usuario_break';
					$this->load->view('plantilla',$datos);
				}
			}else{
//No venimos de un formulario
				$datos['menu'] = 'menu_principal';
				$datos['pagina'] = 'usuario/usuario_break';
				$this->load->view('plantilla',$datos);
			}
		}

		function periodo_inhabil_borrar($id){
			$this->load->model('cita_modelo');
			$aux_hora = $this->cita_modelo->buscar_horas_doctor_id_hora($id);
			$this->cita_modelo->borrar_horas_doctor_id_hora($id);
			$datos['id_usuario'] = $aux_hora->doctor;
			$datos['resultados'] = $this->cita_modelo->horas_general_inhabiles_doctor($datos['id_usuario'],date('Y-m-d'));
			$datos['tipo'] = 'exito';
			$datos['mensaje'] = 'Periodo Inh&aacute;bil eliminado exitosamente.';
			$datos['menu'] = 'menu_principal';
			$datos['pagina'] = 'usuario/usuario_break';
			$this->load->view('plantilla',$datos);
		}
		
		function borrar($id){
			$this->load->model('usuario_modelo');
			$this->usuario_modelo->borrar($id);
			if(! $datos['resultados'] = $this->usuario_modelo->buscar('')){
				$datos['tipo'] = 'error';
				$datos['mensaje'] = 'No se han encontrado resultados';
			}
			$datos['tipo'] = 'exito';
			$datos['mensaje'] = 'Usuario eliminado exitosamente';
			$datos['menu'] = 'menu_principal';
			$datos['pagina'] = 'usuario/usuario_listado';
			$this->load->view('plantilla',$datos);
		}
		
		function listado(){
			$this->load->model('usuario_modelo');
			$datos['resultados'] = $this->usuario_modelo->buscar('');
			$datos['menu'] = 'menu_principal';
			$datos['pagina'] = 'usuario/usuario_listado';
			$this->load->view('plantilla',$datos);
		}

		function no_duplicar($str){
			$this->load->model('usuario_modelo');
			if($this->usuario_modelo->existe($str)){
				$this->form_validation->set_message('existe','El %s elegido ya existe');
				return FALSE;
			}else{
				return TRUE;
			}
		}
//Las siguientes funciones son para la admnistracion de la configuracion del modulo de usuarios
		function admin_modulos(){
			$this->load->model('usuario_modelo');
			$datos['resultados'] = $this->usuario_modelo->modulos();
			if($this->input->post()){
				$this->form_validation->set_rules('nombre_mod','Nombre del M&oacute;dulo','required');
				$this->form_validation->set_rules('codigo','C&oacute;digo del M&oacute;dulo','required');
				if($this->form_validation->run()){
					$modulo['nombre'] = $this->input->post('nombre_mod');
					$modulo['codigo'] = $this->input->post('codigo');
					$this->usuario_modelo->agregar_modulo($modulo);
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'M&oacute;dulo Agregado';
					$datos['menu'] = 'menu_soporte';
					$datos['pagina'] = 'usuario/config_admin/modulo_admin';
					$datos['resultados'] = $this->usuario_modelo->modulos();
					$this->load->view('plantilla',$datos);
				}else{
					$datos['tipo'] = 'error';
					$datos['mensaje'] = 'Algunos datos proporcionados no son v&aacute;lidos';
					$datos['menu'] = 'menu_soporte';
					$datos['pagina'] = 'usuario/config_admin/modulo_admin';
					$this->load->view('plantilla',$datos);	
				}
			}else{
				$datos['menu'] = 'menu_soporte';
				$datos['pagina'] = 'usuario/config_admin/modulo_admin';
				$this->load->view('plantilla',$datos);
			}
		}

		function admin_tipos_usuario(){
			$this->load->model('usuario_modelo');
			$datos['resultados'] = $this->usuario_modelo->tipos_usuario();
			if($this->input->post()){
				$this->form_validation->set_rules('nombre_tipo_usuario','Nombre del Tipo de Usuario','required');
				if($this->form_validation->run()){
					$tipo_usuario['nombre'] = $this->input->post('nombre_tipo_usuario');
					$this->usuario_modelo->agregar_tipo_usuario($tipo_usuario);
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Tipo de Usuario Agregado';
					$datos['menu'] = 'menu_soporte';
					$datos['pagina'] = 'usuario/config_admin/tipo_usuario_admin';
					$datos['resultados'] = $this->usuario_modelo->tipos_usuario();
					$this->load->view('plantilla',$datos);
				}else{
					$datos['tipo'] = 'error';
					$datos['mensaje'] = 'Algunos datos proporcionados no son v&aacute;lidos';
					$datos['menu'] = 'menu_soporte';
					$datos['pagina'] = 'usuario/config_admin/tipo_usuario_admin';
					$this->load->view('plantilla',$datos);	
				}
			}else{
				$datos['menu'] = 'menu_soporte';
				$datos['pagina'] = 'usuario/config_admin/tipo_usuario_admin';
				$this->load->view('plantilla',$datos);
			}
		}

		function admin_privilegios_usuario(){
			$this->load->model('usuario_modelo');
			$datos['usuarios'] = $this->usuario_modelo->tipos_usuario();
			$datos['modulos'] = $this->usuario_modelo->modulos();
			$datos['privilegios'] = $this->usuario_modelo->privilegios_usuario();
			if($this->input->post()){
				if(TRUE){
					foreach($datos['usuarios'] as $usuario){
						$privilegio['usuario'] = $usuario->id;
						foreach($datos['modulos'] as $modulo){
							$privilegio['modulo'] = $modulo->id;
							$aux = ($this->input->post($usuario->id.'_'.$modulo->id.'_'.'permiso'))?$this->input->post($usuario->id.'_'.$modulo->id.'_'.'permiso'):array('Bloqueado');
							for($i=0;$i<sizeof($aux);$i++){
								if(0<$i){
									$privilegio['permiso'] .= ','.$aux[$i];
								}else{
									$privilegio['permiso'] = $aux[$i];
								}
							}
							$this->usuario_modelo->agregar_privilegio_usuario($privilegio);
						}
					}
					$datos['privilegios'] = $this->usuario_modelo->privilegios_usuario();
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Privilegios de Usuarios Actualizados';
					$datos['menu'] = 'menu_soporte';
					$datos['pagina'] = 'usuario/config_admin/privilegios_usuario_admin';
					//$datos['resultados'] = $this->usuario_modelo->tipos_usuario();
					$this->load->view('plantilla',$datos);
				}else{
					$datos['tipo'] = 'error';
					$datos['mensaje'] = 'Algunos datos proporcionados no son v&aacute;lidos';
					$datos['menu'] = 'menu_soporte';
					$datos['pagina'] = 'usuario/config_admin/tipo_usuario_admin';
					$this->load->view('plantilla',$datos);	
				}
			}else{
				$datos['menu'] = 'menu_soporte';
				$datos['pagina'] = 'usuario/config_admin/privilegios_usuario_admin';
				$this->load->view('plantilla',$datos);
			}
		}
    }
    
?>