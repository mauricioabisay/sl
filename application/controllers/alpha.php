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
			$this->form_validation->set_error_delimiters('<span class="advertencia"><img src="'.base_url().'/assets/img/advertencia.png" width="15px" height="15px"><strong>', '</strong></span>');
        }
		
		function index(){
			$this->load->view('comentario/comentario_agregar',$datos);
		}
		
		function agregar(){
			if($this->input->post()){
				$this->form_validation->set_rules('','','');
				if($this->form_validation->run()){
					
				}else{
					
				}
			}else{
				
			}
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