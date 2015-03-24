<?php
    /**
     * 
     */
    class Banner extends CI_Controller {
        
        function __construct() {
            parent::__construct();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->library('session');
        }
		
		function index(){
			/*$datos['menu'] = 'menu_principal';
			$datos['pagina'] = 'paciente_listado';
			$this->load->view('plantilla',$datos);*/
		}
		
		function banner_main(){
			$this->load->view('banner');
		}
		
		function banner_paciente($id){
			$this->load->model('paciente_modelo');
			$datos['paciente'] = $this->paciente_modelo->buscar_id($id);
			$datos['edad'] = $this->paciente_modelo->edad($id);
			$this->load->view('banner',$datos);
		}
		
    }
?>