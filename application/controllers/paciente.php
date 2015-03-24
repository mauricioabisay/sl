<?php
    /**
     * 
     */
    class Paciente extends CI_Controller {
        
        function __construct() {
            parent::__construct();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->form_validation->set_error_delimiters('<span class="advertencia"><img src="'.base_url().'/assets/img/advertencia.png" width="15px" height="15px"><strong>', '</strong></span>');
        }
		
		function index(){
			$this->load->model('paciente_modelo');
			if(! $datos['resultados'] = $this->paciente_modelo->buscar('')){
				$datos['tipo'] = 'error';
				$datos['mensaje'] = 'No se han encontrado resultados';
			} 
			$datos['menu'] = 'menu_principal';
			$datos['pagina'] = 'paciente/paciente_listado';
			$this->load->view('plantilla',$datos);
		}
		
		function agregar(){		
			$this->form_validation->set_rules('nombre','Nombre','required');
			$this->form_validation->set_rules('ap','Apellido Paterno','required');
			$this->form_validation->set_rules('am','Apellido Materno','required');
			$this->form_validation->set_rules('fecha_nac','Fecha de Nacimiento','required');
			$this->form_validation->set_rules('ocupacion','Ocupaci&oacute;n','');
			$this->form_validation->set_rules('nick','¿C&oacute;mo le gustan que le digan?','required');
			$this->form_validation->set_rules('sexo','Sexo','required');
			$this->form_validation->set_rules('fecha_nac','Fecha de Nacimiento','required');
			$this->form_validation->set_rules('edo_civil','Estado Civil','required');
			
			$this->form_validation->set_rules('calle','Calle','min_length[3]|max_length[40]');
			$this->form_validation->set_rules('num_ext','N&uacute;m.Exterior','alpha_numeric');
			$this->form_validation->set_rules('num_int','N&uacute;m.Interior','alpha_numeric');
			$this->form_validation->set_rules('colonia','Colonia','max_length[40]');
			$this->form_validation->set_rules('ciudad','Ciudad','max_length[40]');
			$this->form_validation->set_rules('estado','Estado','max_length[40]');
			$this->form_validation->set_rules('cp','C&oacute;digo Postal','numeric');
			
			$this->form_validation->set_rules('servicio_alimentos','¿Desea el Servicio de Alimentos Sabor and Light?','required');
			
			$this->form_validation->set_rules('recomendacion','Recomendacion','required');
			if($this->input->post('recomendacion')=='Si'){
				$this->form_validation->set_rules('referencia','Referencia','required|min_length[5]|max_length[50]');	
			}
			
			if($this->input->post('tel_casa_d1')){
				$this->form_validation->set_rules('tel_casa_lada','Lada Tel. Casa','required');
				$this->form_validation->set_rules('tel_casa_d1','Tel. Casa','required');
				$this->form_validation->set_rules('tel_casa_d2','Tel. Casa','required');
				$this->form_validation->set_rules('tel_casa_d3','Tel. Casa','required');
				$this->form_validation->set_rules('tel_casa_d4','Tel. Casa','required');
			}
			if($this->input->post('tel_oficina_d1')){
				$this->form_validation->set_rules('tel_oficina_lada','Lada Tel. Oficina','required');
				$this->form_validation->set_rules('tel_oficina_d1','Tel. Oficina','required');
				$this->form_validation->set_rules('tel_oficina_d2','Tel. Oficina','required');
				$this->form_validation->set_rules('tel_oficina_d3','Tel. Oficina','required');
				$this->form_validation->set_rules('tel_oficina_d4','Tel. Oficina','required');
			}
			if($this->input->post('cel1_d3')){
				$this->form_validation->set_rules('cel1_d1','Tel. Celular 1','required');
				$this->form_validation->set_rules('cel1_d2','Tel. Celular 1','required');
				$this->form_validation->set_rules('cel1_d3','Tel. Celular 1','required');
				$this->form_validation->set_rules('cel1_d4','Tel. Celular 1','required');
				$this->form_validation->set_rules('cel1_d5','Tel. Celular 1','required');
			}
			if($this->input->post('cel2_d3')){
				$this->form_validation->set_rules('cel2_d1','Tel. Celular 2','required');
				$this->form_validation->set_rules('cel2_d2','Tel. Celular 2','required');
				$this->form_validation->set_rules('cel2_d3','Tel. Celular 2','required');
				$this->form_validation->set_rules('cel2_d4','Tel. Celular 2','required');
				$this->form_validation->set_rules('cel2_d5','Tel. Celular 2','required');
			}
			if($this->input->post('radio_d1')){
				$this->form_validation->set_rules('radio_d1','N&uacute;. Radio','required');
				$this->form_validation->set_rules('radio_d2','N&uacute;. Radio','required');
				$this->form_validation->set_rules('radio_d3','N&uacute;. Radio','required');
			}
			if($this->input->post('radio_id_d2')){
				$this->form_validation->set_rules('radio_id_d1','ID Radio','required');
				$this->form_validation->set_rules('radio_id_d2','ID Radio','required');
				$this->form_validation->set_rules('radio_id_d3','ID Radio','required');
			}
			
			if($this->input->post('mail1')){
				$this->form_validation->set_rules('mail1','E-mail 1','required|min_length[3]|max_length[50]|valid_email');
			}
			if($this->input->post('mail2')){
				$this->form_validation->set_rules('mail2','E-mail 2','min_length[3]|max_length[50]|valid_email');
			}
			if($this->input->post('mail3')){
				$this->form_validation->set_rules('mail3','E-mail 3','min_length[3]|max_length[50]|valid_email');
			}
			
			$this->form_validation->set_rules('facturacion','Facturaci&oacute;n','required');
			
			if($this->input->post('facturacion')=='Si'){
				$this->form_validation->set_rules('rfc','R.F.C.','required|max_length[13]');
				$this->form_validation->set_rules('fiscal_calle','Calle','required|min_length[3]|max_length[40]');
				$this->form_validation->set_rules('fiscal_num_ext','N&uacute;m.Exterior','required|alpha_numeric');
				$this->form_validation->set_rules('fiscal_num_int','N&uacute;m.Interior','alpha_numeric');
				$this->form_validation->set_rules('fiscal_colonia','Colonia','required');
				$this->form_validation->set_rules('fiscal_ciudad','Ciudad','required');
				$this->form_validation->set_rules('fiscal_estado','Estado','required');
				$this->form_validation->set_rules('fiscal_cp','C&oacute;digo Postal','numeric');
			}
			
			if($this->input->post()){
				if($this->form_validation->run()){
					$this->load->model('paciente_modelo');
					
					$direccion['calle'] = $this->input->post('calle');
					$direccion['num_ext'] = $this->input->post('num_ext');
					$direccion['num_int'] = ($this->input->post('num_int'))?$this->input->post('num_int'):0;
					$direccion['colonia'] = $this->input->post('colonia');
					$direccion['ciudad'] = $this->input->post('ciudad');
					$direccion['estado'] = $this->input->post('estado');
					$direccion['cp'] = ($this->input->post('cp'))?$this->input->post('cp'):0;
					$paciente['direccion'] = $this->paciente_modelo->agregar_direccion($direccion);
				
				if($this->input->post('tel_casa_d1')){
					$tel_casa = $this->input->post('tel_casa_lada').$this->input->post('tel_casa_d1').$this->input->post('tel_casa_d2').$this->input->post('tel_casa_d3').$this->input->post('tel_casa_d4');	
				}
				
				if($this->input->post('tel_oficina_d1')){
					$tel_oficina = $this->input->post('tel_oficina_lada').$this->input->post('tel_oficina_d1').$this->input->post('tel_oficina_d2').$this->input->post('tel_oficina_d3').$this->input->post('tel_oficina_d4');	
				}
				
				if($this->input->post('cel1_d3')){
					$cel1 = $this->input->post('cel1_d1');
					$cel1 .=$this->input->post('cel1_d2');
					$cel1 .=$this->input->post('cel1_d3');
					$cel1 .=$this->input->post('cel1_d4');
					$cel1 .=$this->input->post('cel1_d5');
				}
				
				if($this->input->post('cel2_d3')){
					$cel2 = $this->input->post('cel2_d1');
					$cel2 .=$this->input->post('cel2_d2');
					$cel2 .=$this->input->post('cel2_d3');
					$cel2 .=$this->input->post('cel2_d4');
					$cel2 .=$this->input->post('cel2_d5');
				}
				
				if($this->input->post('radio_d1')){
					$radio = $this->input->post('radio_d1');
					$radio .=$this->input->post('radio_d2');
					$radio .=$this->input->post('radio_d3');
				}
				
				if($this->input->post('radio_id_d2')){
					$radio_id = $this->input->post('radio_id_d1');
					$radio_id .='*';
					$radio_id .=$this->input->post('radio_id_d2');
					$radio_id .='*';
					$radio_id .=$this->input->post('radio_id_d3');
				}
					
					if($this->input->post('facturacion')=='Si'){
						$fiscal['calle'] = $this->input->post('fiscal_calle');
						$fiscal['num_ext'] = $this->input->post('fiscal_num_ext');
						$fiscal['num_int'] = ($this->input->post('fiscal_num_int'))?$this->input->post('fiscal_num_int'):0;
						$fiscal['colonia'] = $this->input->post('fiscal_colonia');
						$fiscal['ciudad'] = $this->input->post('fiscal_ciudad');
						$fiscal['estado'] = $this->input->post('fiscal_estado');
						$fiscal['cp'] = ($this->input->post('fiscal_cp'))?$this->input->post('fiscal_cp'):0;
						$paciente['direccion_fiscal'] = $this->paciente_modelo->agregar_direccion($fiscal);	
					}
					
					$fecha_nac = DateTime::createFromFormat('d-m-Y',$this->input->post('fecha_nac'));
					
					$paciente['nombre'] = $this->input->post('nombre');
					$paciente['ap'] = $this->input->post('ap');
					$paciente['am'] = $this->input->post('am');
					$paciente['nick'] = $this->input->post('nick');
					$paciente['fecha_ini'] = date('Y-m-d');
					$paciente['fecha_nac'] = $fecha_nac->format('Y-m-d');
					$paciente['referencia'] = $this->input->post('referencia');
					$paciente['sexo'] = $this->input->post('sexo');
					$paciente['edo_civil'] = $this->input->post('edo_civil');
					$paciente['rfc'] = $this->input->post('rfc');
					$paciente['ocupacion'] = $this->input->post('ocupacion');
					$paciente['tipo'] = 'Nuevo';
					$paciente['servicio_alimentos'] = $this->input->post('servicio_alimentos');
					if(isset($tel_casa)){
						$paciente['tel_casa'] = $tel_casa;	
					}
					if(isset($tel_oficina)){
						$paciente['tel_oficina'] = $tel_oficina;
						$paciente['ext_oficina'] = $this->input->post('ext_oficina');
					}	
					if(isset($cel1)){
						$paciente['cel1'] = $cel1;
					}
					if(isset($cel2)){
						$paciente['cel2'] = $cel2;	
					}
					if(isset($radio)){
						$paciente['radio'] = $radio;	
					}
					if(isset($radio_id)){
						$paciente['radio_id'] = $radio_id;	
					}
					$paciente['mail1'] = $this->input->post('mail1');
					$paciente['mail2'] = $this->input->post('mail2');
					$paciente['mail3'] = $this->input->post('mail3');
					
					$id_paciente = $this->paciente_modelo->agregar_paciente($paciente);
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Datos de paciente guardados exitosamente';
					$datos['paciente'] = $this->paciente_modelo->buscar_id($id_paciente);
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Informaci&oacute;n del Paciente guardada';
					move_uploaded_file($_FILES["foto"]["tmp_name"],'assets/img/paciente/'.$id_paciente.'.png');
					if($this->paciente_modelo->es_menor($id_paciente)){//El paciente es menor de edad
						$datos['menu'] = 'menu_principal';
						$datos['pagina'] = 'paciente/responsable_agregar';
						$this->load->view('plantilla', $datos);
					}else{//El paciente no es menor de edad
						$this->detalle($id_paciente);
					}
				}else{//Si cometimos errores en el formulario
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					$datos['menu'] = 'menu_principal';
					$datos['pagina'] = 'paciente/paciente_agregar';
					$this->load->view('plantilla', $datos);
				}
			}else{//Si no hemos llenado ningun formulario
				$datos['menu'] = 'menu_principal';
				$datos['pagina'] = 'paciente/paciente_agregar';
				$this->load->view('plantilla', $datos);
			}
		}

		function agregar_responsable(){
			$this->load->model('paciente_modelo');
			$datos['paciente'] = $this->paciente_modelo->buscar_id($this->input->post('paciente'));
			
			$this->form_validation->set_rules('res_nombre','Nombre','required');
			$this->form_validation->set_rules('res_ap','Apellido Paterno','required');
			$this->form_validation->set_rules('res_am','Apellido Materno','required');
			$this->form_validation->set_rules('parentesco','Parentesco','required');
			$this->form_validation->set_rules('mail','E-mail','required|min_length[3]|max_length[50]|valid_email');
			
			if($this->input->post('res_tel_casa_d1')){
				$this->form_validation->set_rules('res_tel_casa_lada','Lada Tel. Casa','required');
				$this->form_validation->set_rules('res_tel_casa_d1','Tel. Casa','required');
				$this->form_validation->set_rules('res_tel_casa_d2','Tel. Casa','required');
				$this->form_validation->set_rules('res_tel_casa_d3','Tel. Casa','required');
				$this->form_validation->set_rules('res_tel_casa_d4','Tel. Casa','required');
			}
			if($this->input->post('res_tel_oficina_d1')){
				$this->form_validation->set_rules('res_tel_oficina_lada','Lada Tel. Oficina','required');
				$this->form_validation->set_rules('res_tel_oficina_d1','Tel. Oficina','required');
				$this->form_validation->set_rules('res_tel_oficina_d2','Tel. Oficina','required');
				$this->form_validation->set_rules('res_tel_oficina_d3','Tel. Oficina','required');
				$this->form_validation->set_rules('res_tel_oficina_d4','Tel. Oficina','required');
			}
			if($this->input->post('res_cel1_d3')){
				$this->form_validation->set_rules('res_cel1_d1','Tel. Celular 1','required');
				$this->form_validation->set_rules('res_cel1_d2','Tel. Celular 1','required');
				$this->form_validation->set_rules('res_cel1_d3','Tel. Celular 1','required');
				$this->form_validation->set_rules('res_cel1_d4','Tel. Celular 1','required');
				$this->form_validation->set_rules('res_cel1_d5','Tel. Celular 1','required');
			}
			
			if($this->input->post()){
				if($this->form_validation->run()){
					
					if($this->input->post('res_tel_casa_d1')){
						$tel_casa = $this->input->post('res_tel_casa_lada').$this->input->post('res_tel_casa_d1').$this->input->post('res_tel_casa_d2').$this->input->post('res_tel_casa_d3').$this->input->post('res_tel_casa_d4');	
					}
				
					if($this->input->post('res_tel_oficina_d1')){
						$tel_oficina = $this->input->post('res_tel_oficina_lada').$this->input->post('res_tel_oficina_d1').$this->input->post('res_tel_oficina_d2').$this->input->post('res_tel_oficina_d3').$this->input->post('res_tel_oficina_d4');	
					}
				
					if($this->input->post('res_cel1_d3')){
						$cel = $this->input->post('res_cel1_d1');
						$cel .=$this->input->post('res_cel1_d2');
						$cel .=$this->input->post('res_cel1_d3');
						$cel .=$this->input->post('res_cel1_d4');
						$cel .=$this->input->post('res_cel1_d5');	
					}
					
					$responsable['paciente'] = $this->input->post('paciente');
					$responsable['nombre'] = $this->input->post('res_nombre');
					$responsable['ap'] = $this->input->post('res_ap');
					$responsable['am'] = $this->input->post('res_am');
					$responsable['parentesco'] = $this->input->post('parentesco');
					$responsable['mail'] = $this->input->post('mail');
					if(isset($tel_casa)){
						$responsable['tel_casa'] = $tel_casa;	
					}
					if(isset($tel_oficina)){
						$responsable['tel_oficina'] = $tel_oficina;
						$responsable['ext_oficina'] = $this->input->post('res_ext_oficina');	
					}
					if(isset($cel)){
						$responsable['cel'] = $cel;	
					}
					
					$this->paciente_modelo->agregar_responsable($responsable);
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Informaci&oacute;n del Responsable guardada';
					$this->detalle($this->input->post('paciente'));
				}else{//Datos incorrectos
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					$datos['menu'] = 'menu_principal';
					$datos['pagina'] = 'paciente/responsable_agregar';
					$this->load->view('plantilla', $datos);
				}
			}else{//No se ha llenado un formulario
				$datos['menu'] = 'menu_principal';
				$datos['pagina'] = 'paciente/responsable_agregar';
				$this->load->view('plantilla', $datos);
			}
		}
		
		function busqueda(){
			if($this->input->post()){
				$this->load->model('paciente_modelo');
				if(! $datos['resultados'] = $this->paciente_modelo->buscar_nombre($this->input->post('nombre')) ){
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'No se han encontrado Pacientes con los datos de b&uacute;squeda proporcionados';
				}else{
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Coincidencias encontradas para "'.$this->input->post('nombre').'"';
				}
				$datos['menu'] = 'menu_principal';
				$datos['pagina'] = 'paciente/paciente_listado';
				$this->load->view('plantilla',$datos);	
			}else{
				$datos['menu'] = 'menu_principal';
				$datos['pagina'] = 'paciente/paciente_listado';
				$this->load->view('plantilla',$datos);
			}
		}
		
		function detalle($id){
			$this->load->model('paciente_modelo');
			
			$datos['paciente'] = $this->paciente_modelo->buscar_id($id);
			$datos['id_paciente'] = $id;
			$datos['menu'] = 'menu_paciente';
			$datos['pagina'] = 'paciente/paciente_ficha';
			
			if(
				($this->paciente_modelo->es_menor($id))&&
				($responsable_aux = $this->paciente_modelo->buscar_responsable($datos['paciente']->responsable))
			){
				$datos['responsable'] = $responsable_aux;
			}
			$this->load->view('plantilla',$datos);
		}
		
		function modificar($id){
			$this->load->model('paciente_modelo');
			$datos['paciente'] = $aux_paciente = $this->paciente_modelo->buscar_id($id);
			if($this->input->post()){
//Venimos del formulario
//Inicio reglas
				$this->form_validation->set_rules('nombre','Nombre','required');
				$this->form_validation->set_rules('ap','Apellido Paterno','required');
				$this->form_validation->set_rules('am','Apellido Materno','required');
				$this->form_validation->set_rules('fecha_nac','Fecha de Nacimiento','required');
				$this->form_validation->set_rules('ocupacion','Ocupaci&oacute;n','');
				$this->form_validation->set_rules('nick','¿C&oacute;mo le gustan que le digan?','required');
				$this->form_validation->set_rules('sexo','Sexo','required');
				$this->form_validation->set_rules('fecha_nac','Fecha de Nacimiento','required');
				$this->form_validation->set_rules('edo_civil','Estado Civil','required');
				
				$this->form_validation->set_rules('calle','Calle','min_length[3]|max_length[40]');
				$this->form_validation->set_rules('num_ext','N&uacute;m.Exterior','alpha_numeric');
				$this->form_validation->set_rules('num_int','N&uacute;m.Interior','alpha_numeric');
				$this->form_validation->set_rules('colonia','Colonia','max_length[40]');
				$this->form_validation->set_rules('ciudad','Ciudad','max_length[40]');
				$this->form_validation->set_rules('estado','Estado','max_length[40]');
				$this->form_validation->set_rules('cp','C&oacute;digo Postal','numeric');
				
				$this->form_validation->set_rules('servicio_alimentos','¿Desea el Servicio de Alimentos Sabor and Light?','required');
				
				$this->form_validation->set_rules('recomendacion','Recomendacion','required');
				if($this->input->post('recomendacion')=='Si'){
					$this->form_validation->set_rules('referencia','Referencia','required|min_length[5]|max_length[50]');	
				}
				
				if($this->input->post('tel_casa_d1')){
					$this->form_validation->set_rules('tel_casa_lada','Lada Tel. Casa','required');
					$this->form_validation->set_rules('tel_casa_d1','Tel. Casa','required');
					$this->form_validation->set_rules('tel_casa_d2','Tel. Casa','required');
					$this->form_validation->set_rules('tel_casa_d3','Tel. Casa','required');
					$this->form_validation->set_rules('tel_casa_d4','Tel. Casa','required');
				}
				if($this->input->post('tel_oficina_d1')){
					$this->form_validation->set_rules('tel_oficina_lada','Lada Tel. Oficina','required');
					$this->form_validation->set_rules('tel_oficina_d1','Tel. Oficina','required');
					$this->form_validation->set_rules('tel_oficina_d2','Tel. Oficina','required');
					$this->form_validation->set_rules('tel_oficina_d3','Tel. Oficina','required');
					$this->form_validation->set_rules('tel_oficina_d4','Tel. Oficina','required');
				}
				if($this->input->post('cel1_d3')){
					$this->form_validation->set_rules('cel1_d1','Tel. Celular 1','required');
					$this->form_validation->set_rules('cel1_d2','Tel. Celular 1','required');
					$this->form_validation->set_rules('cel1_d3','Tel. Celular 1','required');
					$this->form_validation->set_rules('cel1_d4','Tel. Celular 1','required');
					$this->form_validation->set_rules('cel1_d5','Tel. Celular 1','required');
				}
				if($this->input->post('cel2_d3')){
					$this->form_validation->set_rules('cel2_d1','Tel. Celular 2','required');
					$this->form_validation->set_rules('cel2_d2','Tel. Celular 2','required');
					$this->form_validation->set_rules('cel2_d3','Tel. Celular 2','required');
					$this->form_validation->set_rules('cel2_d4','Tel. Celular 2','required');
					$this->form_validation->set_rules('cel2_d5','Tel. Celular 2','required');
				}
				if($this->input->post('radio_d1')){
					$this->form_validation->set_rules('radio_d1','N&uacute;. Radio','required');
					$this->form_validation->set_rules('radio_d2','N&uacute;. Radio','required');
					$this->form_validation->set_rules('radio_d3','N&uacute;. Radio','required');
				}
				if($this->input->post('radio_id_d2')){
					$this->form_validation->set_rules('radio_id_d1','ID Radio','required');
					$this->form_validation->set_rules('radio_id_d2','ID Radio','required');
					$this->form_validation->set_rules('radio_id_d3','ID Radio','required');
				}
				
				if($this->input->post('mail1')){
					$this->form_validation->set_rules('mail1','E-mail 1','required|min_length[3]|max_length[50]|valid_email');
				}
				if($this->input->post('mail2')){
					$this->form_validation->set_rules('mail2','E-mail 2','min_length[3]|max_length[50]|valid_email');
				}
				if($this->input->post('mail3')){
					$this->form_validation->set_rules('mail3','E-mail 3','min_length[3]|max_length[50]|valid_email');
				}
				
				$this->form_validation->set_rules('facturacion','Facturaci&oacute;n','required');
				
				if($this->input->post('facturacion')=='Si'){
					$this->form_validation->set_rules('rfc','R.F.C.','required|max_length[13]');
					$this->form_validation->set_rules('fiscal_calle','Calle','required|min_length[3]|max_length[40]');
					$this->form_validation->set_rules('fiscal_num_ext','N&uacute;m.Exterior','required|alpha_numeric');
					$this->form_validation->set_rules('fiscal_num_int','N&uacute;m.Interior','alpha_numeric');
					$this->form_validation->set_rules('fiscal_colonia','Colonia','required');
					$this->form_validation->set_rules('fiscal_ciudad','Ciudad','required');
					$this->form_validation->set_rules('fiscal_estado','Estado','required');
					$this->form_validation->set_rules('fiscal_cp','C&oacute;digo Postal','numeric');
				}
//Fin de reglas
//Datos validos
			if($this->form_validation->run()){
				$direccion['calle'] = $this->input->post('calle');
				$direccion['num_ext'] = $this->input->post('num_ext');
				$direccion['num_int'] = ($this->input->post('num_int'))?$this->input->post('num_int'):0;
				$direccion['colonia'] = $this->input->post('colonia');
				$direccion['ciudad'] = $this->input->post('ciudad');
				$direccion['estado'] = $this->input->post('estado');
				$direccion['cp'] = ($this->input->post('cp'))?$this->input->post('cp'):0;
//Modificar Direccion
				echo $aux_paciente->direccion;
				if(isset($aux_paciente->direccion)){
					$this->paciente_modelo->modificar_direccion($aux_paciente->direccion,$direccion);
				}else{
					$paciente['direccion'] = $this->paciente_modelo->agregar_direccion($direccion);
				}
				
//Preparacion de numeros telefonicos
			if($this->input->post('tel_casa_d1')){
				$tel_casa = $this->input->post('tel_casa_lada').$this->input->post('tel_casa_d1').$this->input->post('tel_casa_d2').$this->input->post('tel_casa_d3').$this->input->post('tel_casa_d4');	
			}
			if($this->input->post('tel_oficina_d1')){
				$tel_oficina = $this->input->post('tel_oficina_lada').$this->input->post('tel_oficina_d1').$this->input->post('tel_oficina_d2').$this->input->post('tel_oficina_d3').$this->input->post('tel_oficina_d4');	
			}
			if($this->input->post('cel1_d3')){
				$cel1 = $this->input->post('cel1_d1');
				$cel1 .=$this->input->post('cel1_d2');
				$cel1 .=$this->input->post('cel1_d3');
				$cel1 .=$this->input->post('cel1_d4');
				$cel1 .=$this->input->post('cel1_d5');
			}
			if($this->input->post('cel2_d3')){
				$cel2 = $this->input->post('cel2_d1');
				$cel2 .=$this->input->post('cel2_d2');
				$cel2 .=$this->input->post('cel2_d3');
				$cel2 .=$this->input->post('cel2_d4');
				$cel2 .=$this->input->post('cel2_d5');
			}
			if($this->input->post('radio_d1')){
				$radio = $this->input->post('radio_d1');
				$radio .=$this->input->post('radio_d2');
				$radio .=$this->input->post('radio_d3');
			}
			if($this->input->post('radio_id_d2')){
				$radio_id = $this->input->post('radio_id_d1');
				$radio_id .='*';
				$radio_id .=$this->input->post('radio_id_d2');
				$radio_id .='*';
				$radio_id .=$this->input->post('radio_id_d3');
			}
//Fin de Preparacion de numeros telefonicos
			if($this->input->post('facturacion')=='Si'){
				$fiscal['calle'] = $this->input->post('fiscal_calle');
				$fiscal['num_ext'] = $this->input->post('fiscal_num_ext');
				$fiscal['num_int'] = ($this->input->post('fiscal_num_int'))?$this->input->post('fiscal_num_int'):0;
				$fiscal['colonia'] = $this->input->post('fiscal_colonia');
				$fiscal['ciudad'] = $this->input->post('fiscal_ciudad');
				$fiscal['estado'] = $this->input->post('fiscal_estado');
				$fiscal['cp'] = ($this->input->post('fiscal_cp'))?$this->input->post('fiscal_cp'):0;
//Modificar Direccion Fiscal
				if(isset($aux_paciente->direccion_fiscal)){
					$this->paciente_modelo->modificar_direccion($aux_paciente->direccion_fiscal,$fiscal);
				}else{
					$paciente['direccion_fiscal'] = $this->paciente_modelo->agregar_direccion($fiscal);	
				}
					
			}
			$fecha_nac = DateTime::createFromFormat('d-m-Y',$this->input->post('fecha_nac'));
			$paciente['nombre'] = $this->input->post('nombre');
			$paciente['ap'] = $this->input->post('ap');
			$paciente['am'] = $this->input->post('am');
			$paciente['nick'] = $this->input->post('nick');
			$paciente['fecha_ini'] = date('Y-m-d');
			$paciente['fecha_nac'] = $fecha_nac->format('Y-m-d');
			$paciente['referencia'] = $this->input->post('referencia');
			$paciente['sexo'] = $this->input->post('sexo');
			$paciente['edo_civil'] = $this->input->post('edo_civil');
			$paciente['rfc'] = $this->input->post('rfc');
			$paciente['ocupacion'] = $this->input->post('ocupacion');
			$paciente['servicio_alimentos'] = $this->input->post('servicio_alimentos');
			$paciente['tipo'] = 'Recurrente';
			if(isset($tel_casa)){
				$paciente['tel_casa'] = $tel_casa;	
			}
			if(isset($tel_oficina)){
				$paciente['tel_oficina'] = $tel_oficina;
				$paciente['ext_oficina'] = $this->input->post('ext_oficina');
			}	
			if(isset($cel1)){
				$paciente['cel1'] = $cel1;
			}
			if(isset($cel2)){
				$paciente['cel2'] = $cel2;	
			}
			if(isset($radio)){
				$paciente['radio'] = $radio;	
			}
			if(isset($radio_id)){
				$paciente['radio_id'] = $radio_id;	
			}
			$paciente['mail1'] = $this->input->post('mail1');
			$paciente['mail2'] = $this->input->post('mail2');
			$paciente['mail3'] = $this->input->post('mail3');
					
			$this->paciente_modelo->modificar_paciente($aux_paciente->id,$paciente);
			$datos['tipo'] = 'exito';
			$datos['mensaje'] = 'Datos de paciente guardados exitosamente';
			$datos['paciente'] = $this->paciente_modelo->buscar_id($id);
			$datos['tipo'] = 'exito';
			$datos['mensaje'] = 'Informaci&oacute;n del Paciente guardada';
			if($this->input->post('foto')){
				move_uploaded_file($_FILES['foto']['tmp_name'],'/assets/img/paciente/'.$id.'.png');	
			}
			if($this->paciente_modelo->es_menor($id)){//El paciente es menor de edad
				$datos['menu'] = 'menu_paciente';
				$datos['id_paciente'] = $id;
				if(isset($datos['paciente']->responsable)){
					$datos['pagina'] = 'paciente/responsable_modificar';
					$datos['responsable'] = $this->paciente_modelo->buscar_responsable($datos['paciente']->responsable);	
				}else{
					$datos['pagina'] = 'paciente/responsable_agregar';
				}
				$this->load->view('plantilla', $datos);
			}else{//El paciente no es menor de edad
				$this->detalle($id);
			}
//Datos invalidos				
			}else{
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
				
				$datos['id_paciente'] = $id;
				$datos['menu'] = 'menu_paciente';
				$datos['pagina'] = 'paciente/paciente_modificar';
				$datos['direccion'] = FALSE;
				$datos['direccion_fiscal'] = FALSE;
				$datos['responsable'] = FALSE;
				$this->load->view('plantilla',$datos);
			}
//No venimos de un formulario
			}else{
				$datos['direccion'] = (isset($aux_paciente->direccion))?$this->paciente_modelo->buscar_direccion($aux_paciente->direccion):FALSE;
				$datos['direccion_fiscal'] = (isset($aux_paciente->direccion_fiscal))?$this->paciente_modelo->buscar_direccion($aux_paciente->direccion_fiscal):FALSE;
				$datos['responsable'] = (isset($aux_paciente->responsable))?$this->paciente_modelo->buscar_responsable($aux_paciente->responsable):FALSE;
				$datos['id_paciente'] = $id;
				
				$datos['menu'] = 'menu_paciente';
				$datos['pagina'] = 'paciente/paciente_modificar';
				$this->load->view('plantilla',$datos);
			}
		}

		function modificar_responsable($id_paciente){
			$this->load->model('paciente_modelo');
			$paciente = $this->paciente_modelo->buscar_id($id_paciente);
			$datos['id_paciente'] = $id_paciente;
			$datos['responsable'] = $this->paciente_modelo->buscar_responsable($paciente->responsable);
			
			$this->form_validation->set_rules('res_nombre','Nombre','required');
			$this->form_validation->set_rules('res_ap','Apellido Paterno','required');
			$this->form_validation->set_rules('res_am','Apellido Materno','required');
			$this->form_validation->set_rules('parentesco','Parentesco','required');
			$this->form_validation->set_rules('mail','E-mail','required|min_length[3]|max_length[50]|valid_email');
			
			if($this->input->post('res_tel_casa_d1')){
				$this->form_validation->set_rules('res_tel_casa_lada','Lada Tel. Casa','required');
				$this->form_validation->set_rules('res_tel_casa_d1','Tel. Casa','required');
				$this->form_validation->set_rules('res_tel_casa_d2','Tel. Casa','required');
				$this->form_validation->set_rules('res_tel_casa_d3','Tel. Casa','required');
				$this->form_validation->set_rules('res_tel_casa_d4','Tel. Casa','required');
			}
			if($this->input->post('res_tel_oficina_d1')){
				$this->form_validation->set_rules('res_tel_oficina_lada','Lada Tel. Oficina','required');
				$this->form_validation->set_rules('res_tel_oficina_d1','Tel. Oficina','required');
				$this->form_validation->set_rules('res_tel_oficina_d2','Tel. Oficina','required');
				$this->form_validation->set_rules('res_tel_oficina_d3','Tel. Oficina','required');
				$this->form_validation->set_rules('res_tel_oficina_d4','Tel. Oficina','required');
			}
			if($this->input->post('res_cel1_d3')){
				$this->form_validation->set_rules('res_cel1_d1','Tel. Celular 1','required');
				$this->form_validation->set_rules('res_cel1_d2','Tel. Celular 1','required');
				$this->form_validation->set_rules('res_cel1_d3','Tel. Celular 1','required');
				$this->form_validation->set_rules('res_cel1_d4','Tel. Celular 1','required');
				$this->form_validation->set_rules('res_cel1_d5','Tel. Celular 1','required');
			}
			
			if($this->input->post()){
				if($this->form_validation->run()){
					
					if($this->input->post('res_tel_casa_d1')){
						$tel_casa = $this->input->post('res_tel_casa_lada').$this->input->post('res_tel_casa_d1').$this->input->post('res_tel_casa_d2').$this->input->post('res_tel_casa_d3').$this->input->post('res_tel_casa_d4');	
					}
				
					if($this->input->post('res_tel_oficina_d1')){
						$tel_oficina = $this->input->post('res_tel_oficina_lada').$this->input->post('res_tel_oficina_d1').$this->input->post('res_tel_oficina_d2').$this->input->post('res_tel_oficina_d3').$this->input->post('res_tel_oficina_d4');	
					}
				
					if($this->input->post('res_cel1_d3')){
						$cel = $this->input->post('res_cel1_d1');
						$cel .=$this->input->post('res_cel1_d2');
						$cel .=$this->input->post('res_cel1_d3');
						$cel .=$this->input->post('res_cel1_d4');
						$cel .=$this->input->post('res_cel1_d5');	
					}
					
					$responsable['nombre'] = $this->input->post('res_nombre');
					$responsable['ap'] = $this->input->post('res_ap');
					$responsable['am'] = $this->input->post('res_am');
					$responsable['parentesco'] = $this->input->post('parentesco');
					$responsable['mail'] = $this->input->post('mail');
					if(isset($tel_casa)){
						$responsable['tel_casa'] = $tel_casa;	
					}
					if(isset($tel_oficina)){
						$responsable['tel_oficina'] = $tel_oficina;
						$responsable['ext_oficina'] = $this->input->post('res_ext_oficina');	
					}
					if(isset($cel)){
						$responsable['cel'] = $cel;	
					}
					
					$this->paciente_modelo->modificar_responsable($this->input->post('responsable'),$responsable);
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Informaci&oacute;n del Responsable guardada';
					$this->detalle($id_paciente);
				}else{//Datos incorrectos
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					$datos['menu'] = 'menu_paciente';
					$datos['pagina'] = 'paciente/responsable_modificar';
					$this->load->view('plantilla', $datos);
				}
			}else{//No se ha llenado un formulario
				$datos['menu'] = 'menu_paciente';
				$datos['pagina'] = 'paciente/responsable_modificar';
				$this->load->view('plantilla', $datos);
			}
		}
		
		function listado(){
			$this->load->model('paciente_modelo');
			$datos['resultados'] = $this->paciente_modelo->buscar('');
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se ha dado de alta ningun Paciente';
			}
			$datos['menu'] = 'menu_principal';
			$datos['pagina'] = 'paciente/paciente_listado';
			$this->load->view('plantilla',$datos);
		}
		
		function borrar($id){
			$this->load->model('paciente_modelo');
			$this->paciente_modelo->borrar($id);
			$datos['resultados'] = $this->paciente_modelo->buscar('');
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se ha dado de alta ningun Paciente';
			}
			$datos['tipo'] = 'exito';
			$datos['mensaje'] = 'Expediente de Paciente Borrado Exitosamente';
			$datos['menu'] = 'menu_principal';
			$datos['pagina'] = 'paciente/paciente_listado';
			$this->load->view('plantilla',$datos);
		}
    }
?>