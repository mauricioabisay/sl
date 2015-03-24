<?php
    /**
     * 
     */
    class Comentario extends CI_Controller {
        
        function __construct() {
            parent::__construct();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->load->library('pagination');
			$this->form_validation->set_error_delimiters('<span class="advertencia"><img src="'.base_url().'/assets/img/advertencia.png" width="15px" height="15px"><strong>', '</strong></span>');
        }
		
		function index(){
		}
		
		function agregar($paciente){
			$datos['id_paciente'] = $paciente;
			$this->load->model('comentario_modelo');
//Cargando Listado Mini
			$inicio = ($this->uri->segment(4))?$this->uri->segment(4):0;
			$datos['resultados'] = $this->comentario_modelo->listado_mini($datos['id_paciente'],$inicio);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han capturado Comentarios sobre el Paciente';
			}
			$pag_config['base_url'] = "".site_url()."/comentario/agregar/".$datos['id_paciente']."";
			$pag_config['total_rows'] = $this->comentario_modelo->total($datos['id_paciente']);
			$pag_config['per_page'] = 4;
			$pag_config['uri_segment'] = 4;
			$this->pagination->initialize($pag_config);
//Fin Carga Listado Mini
			$datos['comentario'] = $this->comentario_modelo->buscar_paciente_fecha($paciente,date('Y-m-d'));
			if($this->input->post()){
//Venimos de un formulario
				$this->form_validation->set_rules('comentario','Comentario','required');
				if($this->form_validation->run()){
					$comentario['comentario'] = $this->input->post('comentario');
//Datos Validos
					if(isset($datos['comentario'])&&$datos['comentario']){
	//Ya hay un comentario el dia de hoy
						$this->comentario_modelo->modificar($datos['comentario']->id,$comentario);
					}else{
	//No hay comentario el dia de hoy
						$comentario['paciente'] = $paciente;
						$comentario['fecha'] = date('Y-m-d');
						$comentario['comentario'] = $this->input->post('comentario');
						$this->comentario_modelo->agregar($comentario);
					}
				}else{
//Datos Invalidos
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'Algunos datos proporcionados no son v&aacute;lidos';
				}
			}else{
//No venimos de un formulario
			}
			$this->load->view('comentario/comentario',$datos);
		}
		
		function busqueda(){
		}
		
		function detalle($id){
			$this->load->model('comentario_modelo');
			$datos['comentario'] = $this->comentario_modelo->buscar_id($id);
			$datos['id_paciente'] = $datos['comentario']->paciente;
//Cargando Listado Mini
			$inicio = ($this->uri->segment(4))?$this->uri->segment(4):0;
			$datos['resultados'] = $this->comentario_modelo->listado_mini($datos['id_paciente'],$inicio);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han capturado Comentarios sobre el Paciente';
			}
			$pag_config['base_url'] = "".site_url()."/comentario/agregar/".$datos['id_paciente']."";
			$pag_config['total_rows'] = $this->comentario_modelo->total($datos['id_paciente']);
			$pag_config['per_page'] = 4;
			$pag_config['uri_segment'] = 4;
			$this->pagination->initialize($pag_config);
//Fin Carga Listado Mini
			$this->load->view('comentario/comentario_detalle',$datos);
		}
		
		function modificar($id){
		}
		
		function borrar($id){
			$this->load->model('comentario_modelo');
			$comentario = $this->comentario_modelo->buscar_id($id);
			$datos['id_paciente'] = $comentario->paciente;
			$this->comentario_modelo->borrar($id);			
//Cargando Listado Mini
			$inicio = ($this->uri->segment(4))?$this->uri->segment(4):0;
			$datos['resultados'] = $this->comentario_modelo->listado_mini($datos['id_paciente'],$inicio);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han capturado Comentarios sobre el Paciente';
			}
			$pag_config['base_url'] = "".site_url()."/comentario/agregar/".$datos['id_paciente']."";
			$pag_config['total_rows'] = $this->comentario_modelo->total($datos['id_paciente']);
			$pag_config['per_page'] = 4;
			$pag_config['uri_segment'] = 4;
			$this->pagination->initialize($pag_config);
//Fin Carga Listado Mini
			$datos['tipo'] = 'exito';
			$datos['mensaje'] = 'Comentario borrado exitosamente.';
			$datos['comentario'] = $this->comentario_modelo->buscar_paciente_fecha($datos['id_paciente'],date('Y-m-d'));
			$this->load->view('comentario/comentario',$datos);
		}
		
		function listado(){
		}
		
		function listado_mini($paciente){
			$datos['id_paciente'] = $paciente;
			$inicio = ($this->uri->segment(4))?$this->uri->segment(4):0;
			$datos['resultados'] = $this->comentario_modelo->listado_mini($datos['id_paciente'],$inicio);
			if(!$datos['resultados']){
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'No se han capturado Comentarios sobre el Paciente';
			}
			$pag_config['base_url'] = "".site_url()."/comentario/listado_mini/".$datos['id_paciente']."";
			$pag_config['total_rows'] = $this->comentario_modelo->total($datos['id_paciente']);
			$pag_config['per_page'] = 4;
			$pag_config['uri_segment'] = 4;
			$this->pagination->initialize($pag_config);
			
			$this->load->view('comentario/comentario',$datos);
		}
    }
?>