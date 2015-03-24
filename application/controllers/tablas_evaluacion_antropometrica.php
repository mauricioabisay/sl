<?php
    /**
     * 
     */
    class Tablas_evaluacion_antropometrica extends CI_Controller {
        
        function __construct() {
            parent::__construct();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->library('session');
        }
		
		function ninos_waterlow_peso_edad(){
			$this->load->model('tablas_evaluacion_antropometrica_modelo');
			$datos['titulo'] = 'Waterlow Peso/Edad';
			$datos['tabla'] = $this->tablas_evaluacion_antropometrica_modelo->ninos_waterlow('peso_edad');
			$this->load->view('evaluacion_antropometrica/extras/tabla_evaluacion_antropometrica',$datos);
		}
		
		function ninos_waterlow_peso_est(){
			$this->load->model('tablas_evaluacion_antropometrica_modelo');
			$datos['titulo'] = 'Waterlow Peso/Estatura';
			$datos['tabla'] = $this->tablas_evaluacion_antropometrica_modelo->ninos_waterlow('peso_est');
			$this->load->view('evaluacion_antropometrica/extras/tabla_evaluacion_antropometrica',$datos);
		}
		
		function ninos_waterlow_est_edad(){
			$this->load->model('tablas_evaluacion_antropometrica_modelo');
			$datos['titulo'] = 'Waterlow Estatura/Edad';
			$datos['tabla'] = $this->tablas_evaluacion_antropometrica_modelo->ninos_waterlow('est_edad');
			$this->load->view('evaluacion_antropometrica/extras/tabla_evaluacion_antropometrica',$datos);
		}
		
		function ninos_puntuacion_z_peso_edad(){
			$this->load->model('tablas_evaluacion_antropometrica_modelo');
			$datos['titulo'] = 'Puntuaci&oacute;n Z Peso/Edad';
			$datos['tabla'] = $this->tablas_evaluacion_antropometrica_modelo->ninos_puntuacion_z('peso_edad');
			$this->load->view('evaluacion_antropometrica/extras/tabla_evaluacion_antropometrica',$datos);
		}
		
		function ninos_puntuacion_z_peso_est(){
			$this->load->model('tablas_evaluacion_antropometrica_modelo');
			$datos['titulo'] = 'Puntuaci&oacute;n Z Peso/Estatura';
			$datos['tabla'] = $this->tablas_evaluacion_antropometrica_modelo->ninos_puntuacion_z('peso_est');
			$this->load->view('evaluacion_antropometrica/extras/tabla_evaluacion_antropometrica',$datos);
		}
		
		function ninos_puntuacion_z_est_edad(){
			$this->load->model('tablas_evaluacion_antropometrica_modelo');
			$datos['titulo'] = 'Puntuaci&oacute;n Z Estatura/Edad';
			$datos['tabla'] = $this->tablas_evaluacion_antropometrica_modelo->ninos_puntuacion_z('est_edad');
			$this->load->view('evaluacion_antropometrica/extras/tabla_evaluacion_antropometrica',$datos);
		}
		
		function ninos_evaluacion($evaluacion){
			$this->load->model('tablas_evaluacion_antropometrica_modelo');
			switch($evaluacion){
				case 'imc':{
					$datos['titulo'] = '&Iacute;ndice de Masa Corporal';		
					break;
				}
				case 'cabeza_edad':{
					$datos['titulo'] = 'Circunferencia Cef&aacute;lica';
					break;
				}
				case 'brazo_edad':{
					$datos['titulo'] = 'Circunferencia de Brazo';
					break;
				}
			}
			$datos['tabla'] = $this->tablas_evaluacion_antropometrica_modelo->ninos_evaluacion($evaluacion);
			$this->load->view('evaluacion_antropometrica/extras/tabla_evaluacion_antropometrica',$datos);
		}
		
		function adultos_evaluacion($evaluacion,$sexo){
			$this->load->model('tablas_evaluacion_antropometrica_modelo');
			switch($evaluacion){
				case 'imc':{
					$datos['titulo'] = '&Iacute;ndice de Masa Corporal';		
					break;
				}
				case 'cintura_cadera':{
					$datos['titulo'] = '&Iacute;ndice Cintura/Cadera';
					break;
				}
				case 'complexion':{
					$datos['titulo'] = 'Complexi&oacute;n';
					break;
				}
			}
			$datos['tabla'] = $this->tablas_evaluacion_antropometrica_modelo->adultos_evaluacion($evaluacion,$sexo);
			$this->load->view('evaluacion_antropometrica/extras/tabla_evaluacion_antropometrica',$datos);
		}
		
		function busqueda(){
		}
		
		function detalle($id){
		}
		
		function modificar($id){
		}
		
		function borrar($id){
		}
		
		function listado(){
		}
    }
?>