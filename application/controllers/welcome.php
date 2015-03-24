<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	
	public function index(){
		/*$datos['menu'] = 'menu_principal';
		$datos['pagina'] = 'bienvenida';
		$this->load->view('plantilla',$datos);*/
		$this->load->view('inicio_sesion');
	}
	
	public function iniciar_sesion(){
		$this->form_validation->set_rules('usuario','usuario','required');
		$this->form_validation->set_rules('pass','password','required');
		
		if($this->form_validation->run()){
			$this->load->model('usuario_modelo');
//Obtiene los datos del usuario cuyo nombre de usuario se ingreso en el formulario de inicio de sesión
					$datos_usuario = $this->usuario_modelo->buscar_nick_id($this->input->post('usuario'));
					if ($datos_usuario != false){
						$user['usuario'] = $this->input->post('usuario');
						$user['id'] = $datos_usuario->id_usuario;
						$user['tipo'] = $datos_usuario->tipo;
						if ( $datos_usuario->pass == $this->input->post('pass') ){
							$this->session->set_userdata($user);
							if(($datos_usuario->nombre_tipo=="Administrador")||($datos_usuario->nombre_tipo=="Doctor")){
								$datos['menu'] = 'menu_principal';	
							}elseif($datos_usuario->nombre_tipo=="Recepcionista"){
								$datos['menu'] = 'menu_cita';	
							}elseif($datos_usuario->nombre_tipo=="Practicante"){
								$datos['menu'] = 'menu_principal';
							}
							$this->session->set_userdata('usr',$datos_usuario->id_usuario);
							$this->session->set_userdata('tipo_usr',$datos_usuario->nombre_tipo);
							$datos['pagina'] = 'bienvenida';
							$this->load->view('plantilla',$datos);
						}else{
							$datos['usuario'] = $this->input->post('usuario');
							$datos['tipo'] = 'error';
							$datos['mensaje'] = 'La contraseña es incorrecta';
							$this->load->view('inicio_sesion', $datos);
						}
					}
					else{
						$datos['tipo'] = 'error';
						$datos['mensaje'] = 'El nombre de usuario no existe';
						$this->load->view('inicio_sesion', $datos);
					}
		}
		else{
			$datos['tipo'] = 'error';
			$datos['mensaje'] = 'Necesita proporcionar un nombre de usuario y contraseña';
			$this->load->view('inicio_sesion');
		}
	}

	public function admin_paciente(){
		$datos['menu'] = 'menu_principal';
		$datos['pagina'] = 'bienvenida';
		$this->load->view('plantilla',$datos);
	}
	
	public function cerrar_sesion(){
		$this->session->sess_destroy();
		$this->index();
	}
	
	public function blank(){
		$datos['tipo']="exito";
		$datos['mensaje']="Datos eliminados correctamente";
		$this->load->view('blank',$datos);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */