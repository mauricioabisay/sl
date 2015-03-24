<?php

class Patologias extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library("form_validation");
		$this->load->library('session');
		$this->form_validation->set_error_delimiters('<span class="advertencia"><img src="'.base_url().'/assets/img/advertencia.png" width="15px" height="15px"><strong>', '</strong></span>');
	}
	
	public function index(){
		$this->load->model('patologias_modelo');
		$datos['clasificaciones']=$this->patologias_modelo->obtenerClasificaciones();
		$datos['menu'] = 'menu_principal';
		$datos['pagina'] = 'patologias/patologias_consultar';
		$this->load->view('plantilla',$datos);
	}
	
	//Función para cargar las patologías en el segundo select
	public function patologias_select(){
    	$clasificacion=$_GET['id'];
    	$this->load->model('patologias_modelo');
		$datos['patologias']=$this->patologias_modelo->obtenerPatologias($clasificacion);
		$this->load->view('patologias/patologias_select',$datos);
	}
	
	//Función para cargar las clasificaciones al agregar una nueva patología
	public function nueva_patologia(){
		$this->load->model('patologias_modelo');
		$datos['clasificaciones']=$this->patologias_modelo->obtenerClasificaciones();
		$this->load->view('patologias/patologias_agregar',$datos);
	}
	
	//Función para cargar los valores (hc_min,hc_max,pro_min,pro_max...) de la patología seleccionada
	public function buscar(){
		$this->load->model('patologias_modelo');
		$patologia=$_GET['id'];
		$datos['patologia']=$this->patologias_modelo->buscar($patologia);
		$this->load->view('patologias/patologias_valores',$datos);
	}
	
	//Función para eliminar la patología seleccionada
	public function eliminar(){
		$this->load->model('patologias_modelo');
		$patologia=$_GET['id'];
		$this->patologias_modelo->eliminar($patologia);
	}

	//Función que manda los valores de la consulta para poder modificarlos
	public function modificar(){
		$this->form_validation->set_rules('patologia','','required|min_length[3]|max_length[60]');
		$this->form_validation->set_rules('clasificacion','','required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('caracteristicas','','min_length[3]');
		//$this->form_validation->set_rules('elementos_poner','','min_length[3]');
		//$this->form_validation->set_rules('elementos_quitar','','min_length[3]');

		if ($this->input->post()){
			if ($this->form_validation->run()){
				$id= $this->input->post('id_patologia');
				$id_clasificacion = $this->input->post('id_clasificacion');
				$clasificacion['clasificacion'] = $this->input->post('clasificacion');
				$valores['nombre']=$this->input->post('patologia');
				$valores['caracteristicas']= $this->input->post('caracteristicas');
				//$valores['elementos_poner']= $this->input->post('elementos_poner');
				//$valores['elementos_quitar']= $this->input->post('elementos_quitar');
			
				$this->load->model('patologias_modelo');
				//Se modifican los valores de la patología
				$this->patologias_modelo->modificar_id($id,$valores);
				//Se modifica la clasificación
				$this->patologias_modelo->modificar_clasificacion($id_clasificacion,$clasificacion);
				
				//Se recarga el formulario de consulta
				$datos['tipo']='exito';
				$datos['mensaje']='Patolog&iacute;a modificada';
				$datos['clasificaciones']=$this->patologias_modelo->obtenerClasificaciones();
				$datos['menu'] = 'menu_principal';
				$datos['pagina'] = 'patologias/patologias_consultar';
				$this->load->view('plantilla',$datos);
			}else{
				$datos['tipo'] = 'advertencia';
				$datos['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
				
				$id= $this->input->post('id_patologia');
				//Si hay un error de validación se cargan los datos modificados del formulario sin guardar en la bd
				$datos['resultados']=NULL;	
				$datos['patologia']=$this->input->post('patologia');
				$datos['clasificacion']=$this->input->post('clasificacion');
				$datos['caracteristicas']=$this->input->post('caracteristicas');
				//$datos['elementos_poner']= $this->input->post('elementos_poner');
				//$datos['elementos_quitar']= $this->input->post('elementos_quitar');
				
				$this->load->view('patologias/patologias_modificar',$datos);
			}	
		}else{
			$patologia=$_GET['id'];
			$this->load->model('patologias_modelo');
			$datos['resultados']=$this->patologias_modelo->buscar_clasificacion($patologia);
			$datos['mensaje']="";
			$this->load->view('patologias/patologias_modificar',$datos);
		}
	}
	
	//Función para consultar las patologías
	public function consultar(){
		$this->load->model('patologias_modelo');
		$datos['clasificaciones']=$this->patologias_modelo->obtenerClasificaciones();
		$this->load->view('patologias/patologias_consultar',$datos);
	}
	
	
	
	//Función para agregar una nueva patología
	public function agregar(){
		$this->form_validation->set_rules('nueva_patologia','','required|min_length[3]|max_length[60]');
		$this->form_validation->set_rules('clasificacion','','required');
		$this->form_validation->set_rules('caracteristicas','','min_length[3]');
		$this->form_validation->set_rules('elementos_poner','','min_length[3]');
		$this->form_validation->set_rules('elementos_quitar','','min_length[3]');
		
		if ($this->input->post()){
			if ($this->form_validation->run()){
				$patologia['clasificacion']= $this->input->post('clasificacion');
				$patologia['nombre']= $this->input->post('nueva_patologia');				
				$patologia['caracteristicas']= $this->input->post('caracteristicas');
				//$patologia['elementos_poner']= $this->input->post('elementos_poner');
				//$patologia['elementos_quitar']= $this->input->post('elementos_quitar');
			
				$this->load->model('patologias_modelo');
				$this->patologias_modelo->agregar($patologia);
				
				//Se recarga el formulario con la patología agregada
				$datos['tipo']='exito';
				$datos['mensaje']='Patolog&iacute;a guardada';
				$datos['clasificaciones']=$this->patologias_modelo->obtenerClasificaciones();
				$datos['menu'] = 'menu_principal';
				$datos['pagina'] = 'patologias/patologias_consultar';
				$this->load->view('plantilla',$datos);
			}else{
				$patologia['tipo'] = 'advertencia';
				$patologia['mensaje'] = 'La informaci&oacute;n proporcionada es inv&aacute;lida';
				
				$patologia['nombre']= $this->input->post('nueva_patologia');
				$patologia['caracteristicas']= $this->input->post('caracteristicas');
				$patologia['clasificacion']=$this->input->post('clasificacion');
				$patologia['elementos_poner']= $this->input->post('elementos_poner');
				$patologia['elementos_quitar']= $this->input->post('elementos_quitar');
				
				$this->load->view('patologias/patologias_agregar',$patologia);
			}	
		}else{
			//Se cargan las clasificaciones que existen
			$this->load->model('patologias_modelo');
			$datos['mensaje']="";	
			$datos['clasificaciones']=$this->patologias_modelo->obtenerClasificaciones();
			$this->load->view('patologias/patologias_agregar',$datos);
		}
	}

}