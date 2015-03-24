<?php
    /**
     * 
     */
    class Medicamento extends CI_Controller {
        
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
			$datos['pagina_frame'] = ''.site_url().'/medicamento/listado/'.$id.'';
			$datos['listado'] = "".site_url()."/medicamento/listado_mini/".$id."";
			$this->load->view('plantilla',$datos);
		}
		
		function modificar($id,$status){
			$this->load->model('medicamento_modelo');
			$paciente_aux = $this->medicamento_modelo->modificar_estado($id,$status);
			$datos['id_paciente'] = $paciente_aux->paciente;
			$datos['menu'] = 'menu_paciente';
			$this->load->model('medicamento_modelo');
			$datos['tipo'] = 'exito';
			$datos['mensaje'] = 'Estado del Medicamento actualizado';
			$datos['resultados'] = $this->medicamento_modelo->buscar($datos['id_paciente']);
			$this->load->view('medicamento/medicamento_listado',$datos);
		}
		
		public function borrar($fecha_id,$id_paciente){
			$this->load->model('medicamento_modelo');
			$this->medicamento_modelo->borrar($fecha_id,$id_paciente);
			$datos['resultados'] = $this->medicamento_modelo->buscar($id_paciente);
			$datos['pagina_frame']="".site_url().'/welcome/blank'."";
			$datos['menu'] = 'menu_paciente';
			$datos['id_paciente'] = $id_paciente;
			$datos['listado'] = "".site_url()."/medicamento/listado_mini/".$id_paciente."";
			$this->load->view('plantilla',$datos);
			
		}
		
		function listado_mini($paciente){
			$datos['id_paciente'] = $paciente;
			$this->load->model('medicamento_modelo');
			$inicio = ($this->uri->segment(4))?$this->uri->segment(4):0;
			$datos['resultados_mini'] = $this->medicamento_modelo->listado_mini($datos['id_paciente'],$inicio);
			if(!$datos['resultados_mini']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han realizado Evaluaciones al Paciente';
			}
			$this->load->library('pagination');
			$pag_config['base_url'] = "".site_url()."/medicamento/listado_mini/".$datos['id_paciente']."";
			$pag_config['total_rows'] = $this->medicamento_modelo->total($datos['id_paciente']);
			$pag_config['per_page'] = 10;
			$pag_config['uri_segment'] = 4;
			$this->pagination->initialize($pag_config);
			$this->load->view('medicamento/medicamento_listado_mini',$datos);
		}
		
		function listado($id){
			$this->form_validation->set_rules('nombre[]','Nombre','required|min_length[3]|max_length[30]');
			$this->form_validation->set_rules('valor_frec[]','Valor','required|is_natural_no_zero');
			$this->form_validation->set_rules('tipo_frec[]','Tipo','');
			$this->form_validation->set_rules('causa[]','Causa','required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('fecha_ini_mes[]','Fecha Inicio','required');
			$this->form_validation->set_rules('fecha_ini_a[]','Fecha Inicio','required');
			$this->form_validation->set_rules('status[]','Estado','');
			$this->form_validation->set_rules('horas[]','Horas','');
			$this->form_validation->set_rules('minutos[]','Minutos','');
			$this->form_validation->set_rules('ampm[]','Am/Pm','');
			
			if($this->input->post()){
//Venimos de un formulario
				$datos['id_paciente'] = $this->input->post('paciente');
//Datos validos
				if($this->form_validation->run()){
					$tipo_med = $this->input->post('tipo_med');
					$nombre = $this->input->post('nombre');
					$valor_frec = $this->input->post('valor_frec');
					$tipo_frec = $this->input->post('tipo_frec');
					$causa = $this->input->post('causa');
					$fecha_ini_mes = $this->input->post('fecha_ini_mes');
					$fecha_ini_a = $this->input->post('fecha_ini_a');
					$status = $this->input->post('status');
					$horario_h = $this->input->post('horas');
					$horario_m = $this->input->post('minutos');
					$horario_ampm = $this->input->post('ampm');
					
					for($i=0;$i<sizeof($nombre);$i++){
						$medicamento['tipo_med'] = $tipo_med[$i];
						$medicamento['nombre'] = $nombre[$i];
						$medicamento['valor_frec'] = $valor_frec[$i];
						$medicamento['tipo_frec'] = $tipo_frec[$i];
						$medicamento['causa'] = $causa[$i];
						$medicamento['fecha_ini'] = $fecha_ini_mes[$i].'-'.$fecha_ini_a[$i];
						$medicamento['paciente'] = $datos['id_paciente'];
						$medicamento['status'] = $status[$i];
						$medicamento['fecha_id'] = date('Y-m-d');
//Alta exitosa de Medicamento
						$this->load->model('medicamento_modelo');
						$id_medicamento = $this->medicamento_modelo->agregar_medicamento($medicamento);
						$datos['tipo'] = 'exito';
						$datos['mensaje'] = 'Medicamento guardado';			
						for($j=0;$j<$valor_frec[$i];$j++){
					 		$medicamento_horario['medicamento'] = $id_medicamento;	
							$medicamento_horario['horario'] = $horario_h[$j].':'.$horario_m[$j].' '.$horario_ampm[$j];
//Alta exitosa de Horario de Medicamento
							$this->medicamento_modelo->agregar_medicamento_horario($medicamento_horario);
						}
					}
//Datos invalidos	
				}else{
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					
					$datos['tipo_med'] = $this->input->post('tipo_med');
					$datos['nombre'] = $this->input->post('nombre');
					$datos['valor_frec'] = $this->input->post('valor_frec');
					$datos['tipo_frec'] = $this->input->post('tipo_frec');
					$datos['causa'] = $this->input->post('causa');
					$datos['fecha_ini_mes'] = $this->input->post('fecha_ini_mes');
					$datos['fecha_ini_a'] = $this->input->post('fecha_ini_a');
					$datos['status'] = $this->input->post('status');
					$datos['horas'] = $this->input->post('horas');
					$datos['minutos'] = $this->input->post('minutos');
					$datos['ampm'] = $this->input->post('ampm');
							
				}
//No venimos de un formulario
			}else{
				$datos['id_paciente'] = $id;
			}
			$datos['menu'] = 'menu_paciente';
			$this->load->model('medicamento_modelo');
			$datos['resultados'] = $this->medicamento_modelo->buscar($id);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han encontrado Medicamentos recetados al Paciente';
			}
			$this->load->view('medicamento/medicamento_listado',$datos);
		}

		function listado_fecha($id,$fecha){
			$datos['id_paciente'] = $id;
			$fecha_aux = DateTime::createFromFormat('Y-m-d',$fecha);
			$datos['fecha'] = $fecha_aux->format('d-m-Y');
			$datos['menu'] = 'menu_paciente';
			$this->load->model('medicamento_modelo');
			$datos['resultados'] = $this->medicamento_modelo->buscar_fecha($id,$fecha);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han encontrado Medicamentos recetados al Paciente';
			}
			$ultima_fecha = $this->medicamento_modelo->ultima_fecha($id); 
			if($fecha==$ultima_fecha->fecha){
				$this->load->view('medicamento/medicamento_listado',$datos);
			}else{
				$this->load->view('medicamento/medicamento_listado_detalle',$datos);	
			}
		}
		
		function modificar_datos($id){
			$this->form_validation->set_rules('nombre[]','Nombre','required|min_length[3]|max_length[30]');
			$this->form_validation->set_rules('valor_frec[]','Valor','required|is_natural_no_zero');
			$this->form_validation->set_rules('tipo_frec[]','Tipo','');
			$this->form_validation->set_rules('causa[]','Causa','required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('fecha_ini_mes[]','Fecha Inicio','required');
			$this->form_validation->set_rules('fecha_ini_a[]','Fecha Inicio','required');
			$this->form_validation->set_rules('status[]','Estado','');
			$this->form_validation->set_rules('horas[]','Horas','');
			$this->form_validation->set_rules('minutos[]','Minutos','');
			$this->form_validation->set_rules('ampm[]','Am/Pm','');
			
			if($this->input->post()){
//Venimos de un formulario
				$datos['id_paciente'] = $this->input->post('paciente');
//Datos validos
				if($this->form_validation->run()){
					$id_medicamento = $this->input->post('id_medicamento');
					$tipo_med = $this->input->post('tipo_med');
					$nombre = $this->input->post('nombre');
					$valor_frec = $this->input->post('valor_frec');
					$tipo_frec = $this->input->post('tipo_frec');
					$causa = $this->input->post('causa');
					$fecha_ini_mes = $this->input->post('fecha_ini_mes');
					$fecha_ini_a = $this->input->post('fecha_ini_a');
					$status = $this->input->post('status');
					$horario_h = $this->input->post('horas');
					$horario_m = $this->input->post('minutos');
					$horario_ampm = $this->input->post('ampm');
					$id_horario = $this->input->post('id_horario');
					$num_horarios = 0;
					
					for($i=0;$i<sizeof($nombre);$i++){
						$medicamento['tipo_med'] = $tipo_med[$i];
						$medicamento['nombre'] = $nombre[$i];
						$medicamento['valor_frec'] = $valor_frec[$i];
						$medicamento['tipo_frec'] = $tipo_frec[$i];
						$medicamento['causa'] = $causa[$i];
						$medicamento['fecha_ini'] = $fecha_ini_mes[$i].'-'.$fecha_ini_a[$i];
						$medicamento['paciente'] = $datos['id_paciente'];
						$medicamento['status'] = $status[$i];
						$medicamento['fecha_id'] = date('Y-m-d');
//Alta exitosa de Medicamento
						$this->load->model('medicamento_modelo');
						$this->medicamento_modelo->modificar_medicamento($id_medicamento[$i],$medicamento);
							
						$num_horarios = $num_horarios + $valor_frec[$i];
					}
					for($j=0;$j<$num_horarios;$j++){	
							$medicamento_horario['horario'] = $horario_h[$j].':'.$horario_m[$j].' '.$horario_ampm[$j];
							$this->medicamento_modelo->modificar_medicamento_horario($id_horario[$j],$medicamento_horario);
						}
					$datos['menu'] = 'menu_paciente';
					$this->load->model('medicamento_modelo');
					$datos['resultados'] = $this->medicamento_modelo->buscar($id);
					if(!$datos['resultados']){
						$datos['tipo'] = 'advertencia';
						$datos['mensaje'] = 'No se han encontrado Medicamentos recetados al Paciente';
					}
					else{
						$datos['tipo'] = 'exito';
						$datos['mensaje'] = 'Medicamentos modificados correctamente';	
					}
					$this->load->view('medicamento/medicamento_listado',$datos);
//Datos invalidos	
				}else{
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
					
					$datos['tipo_med'] = $this->input->post('tipo_med');
					$datos['nombre'] = $this->input->post('nombre');
					$datos['valor_frec'] = $this->input->post('valor_frec');
					$datos['tipo_frec'] = $this->input->post('tipo_frec');
					$datos['causa'] = $this->input->post('causa');
					$datos['fecha_ini_mes'] = $this->input->post('fecha_ini_mes');
					$datos['fecha_ini_a'] = $this->input->post('fecha_ini_a');
					$datos['status'] = $this->input->post('status');
					$datos['horas'] = $this->input->post('horas');
					$datos['minutos'] = $this->input->post('minutos');
					$datos['ampm'] = $this->input->post('ampm');
							
				}
				
//No venimos de un formulario
			}else{
				$this->load->model('medicamento_modelo');
				$datos['id_paciente'] = $id;
				$datos['medicamentos']= $this->medicamento_modelo->buscar($id);
				$datos['horarios']=$this->medicamento_modelo->buscar_horarios($id);
				$this->load->view('medicamento/medicamento_modificar',$datos);
			}
			$datos['menu'] = 'menu_paciente';
			$this->load->model('medicamento_modelo');
			$datos['resultados'] = $this->medicamento_modelo->buscar($id);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han encontrado Medicamentos recetados al Paciente';
			}	
		}

		function detalle_id($medicamento){
			$this->load->model('medicamento_modelo');
			$datos['menu'] = 'menu_paciente';
			$datos['medicamento'] = $this->medicamento_modelo->buscar_medicamento_id($medicamento);
			$datos['horarios'] = $this->medicamento_modelo->buscar_horarios_medicamento($medicamento);
			$this->load->view('medicamento/medicamento_ficha',$datos);
		}
		
			
    }
?>