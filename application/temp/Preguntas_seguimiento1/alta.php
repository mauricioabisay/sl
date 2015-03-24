<?php
   	class Alta extends CI_Controller{

	public function __construct() {

	parent::__construct();

	$this->load->library('form_validation');

	$this->load->helper('url');


}
	
	public function alta_preguntas_seg()
	{
		$this->form_validation->set_rules('cumplimiento','','required|is_natural|less_than[11]');
		
		
		$this->form_validation->set_rules('hambre','','required');
		if ($this->input->post('hambre') == 'si')
		{
			$this->form_validation->set_rules('hambre_horas','','required');
			$this->form_validation->set_rules('hambre_minutos','','required');
			$this->form_validation->set_rules('hambre_tiempo','','required');
			$this->form_validation->set_rules('hambre_hora_relativa','','required');
			
			$hambre_horas = $this->input->post('hambre_horas');
			$hambre_minutos = $this->input->post('hambre_minutos');
			$hambre_tiempo = $this->input->post('hambre_tiempo');
			if ($hambre_tiempo== 'pm')
				$hambre_horas= $hambre_horas + 12;
			
			$hambre_hora = $hambre_horas.':'.$hambre_minutos.':'.'00';
			$hambre_hora_relativa=$this->input->post('hambre_hora_relativa');
		}
		else{
			$hambre_hora= NULL;
			$hambre_hora_relativa=NULL;
		}
	
		$this->form_validation->set_rules('ansiedad','','required');
		if ($this->input->post('ansiedad') == 'si')
		{
			$this->form_validation->set_rules('ansiedad_horas','','required');
			$this->form_validation->set_rules('ansiedad_minutos','','required');
			$this->form_validation->set_rules('ansiedad_tiempo','','required');
			$this->form_validation->set_rules('ansiedad_hora_relativa','','required');
			
			$ansiedad_horas = $this->input->post('ansiedad_horas');
			$ansiedad_minutos = $this->input->post('ansiedad_minutos');
			$ansiedad_tiempo = $this->input->post('ansiedad_tiempo');
			if ($ansiedad_tiempo== 'pm')
				$ansiedad_horas= $ansiedad_horas + 12;
			
			$ansiedad_hora = $ansiedad_horas.':'.$ansiedad_minutos.':'.'00';
			$ansiedad_hora_relativa=$this->input->post('ansiedad_hora_relativa');
		}
		else{
			$ansiedad_hora= NULL;
			$ansiedad_hora_relativa=NULL;
		}
		
		$this->form_validation->set_rules('perdida_peso','','required');
		$this->form_validation->set_rules('eliminar_comida','','required');
		if ($this->input->post('eliminar_comida') == 'si')
		{
			$this->form_validation->set_rules('tiempo_eliminar','','required');
			$aux = $this->input->post('tiempo_eliminar');
			$tiempo_eliminar = "";
				for($i=0; $i < sizeof($aux); $i++){					
					$tiempo_eliminar .= ''.$aux[$i].'';
					$tiempo_eliminar .= ($i+1==sizeof($aux))?"":",";
				}
			
				
			$this->form_validation->set_rules('tiempo_eliminar_razon','','required|max_length[255]');
		}
		else{
			$tiempo_eliminar=NULL;
		}
		
		$this->form_validation->set_rules('aumentar_comida','','required');
		if ($this->input->post('aumentar_comida') == 'si')
		{
			$this->form_validation->set_rules('tiempo_agregar','','required');
			$aux = $this->input->post('tiempo_agregar');
			$tiempo_agregar = "";
				for($i=0; $i < sizeof($aux); $i++){					
					$tiempo_agregar .= ''.$aux[$i].'';
					$tiempo_agregar .= ($i+1==sizeof($aux))?"":",";
				}
			$this->form_validation->set_rules('tiempo_agregar_razon','','required|max_length[255]');
		}
		else{
			$tiempo_agregar=NULL;
	}
		$this->form_validation->set_rules('alimento_eliminar','','required|max_length[255]');
		$this->form_validation->set_rules('alimento_agregar','','required|max_length[255]');
		$this->form_validation->set_rules('conservar','','required|max_length[255]');
		$this->form_validation->set_rules('motivacion','','required|is_natural|less_than[11]');
		$this->form_validation->set_rules('desgaste','','required|is_natural|less_than[11]');
		$this->form_validation->set_rules('meta_fecha','','required|is_natural_no_zero');
		$this->form_validation->set_rules('meta_valor','','required|callback_decimal');
		$this->form_validation->set_rules('hizo_tareas','','required');
		if ($this->input->post('hizo_tareas') == 'si')
		{
			$this->form_validation->set_rules('presentadas','','required');
			if($this->input->post('presentadas')=='no'){
				$this->form_validation->set_rules('tareas','','required|max_length[255]');
			}
		}
		else
		{
			$this->form_validation->set_rules('tareas','','required|max_length[255]');	
		}
		$this->form_validation->set_rules('ejercicio','','required');
		if ($this->input->post('ejercicio') == 'si')
		{
			$this->form_validation->set_rules('ejercicio_duracion','','required|is_natural_no_zero|less_than[65535]');
			$this->form_validation->set_rules('ejercicio_frec','','required|is_natural_no_zero|less_than[8]');
			$this->form_validation->set_rules('ejercicio_tipo','','required');
			$aux = $this->input->post('ejercicio_tipo');
				for($i=0; $i < sizeof($aux); $i++){
					if($aux[$i]=='otro')
					$this->form_validation->set_rules('ejercicio_otro','','required|max_length[30]|alpha');
				}
			$aux = $this->input->post('ejercicio_tipo');
			$ejercicio_tipo = "";
				for($i=0; $i < sizeof($aux); $i++){					
					$ejercicio_tipo .= ''.$aux[$i].'';
					$ejercicio_tipo .= ($i+1==sizeof($aux))?"":",";
				}
			$ejercicio_duracion=$this->input->post('ejercicio_duracion');
			$ejercicio_frec=$this->input->post('ejercicio_frec');
			$ejercicio_otro=$this->input->post('ejercicio_otro');
		}
		else{
			$ejercicio_duracion=NULL;
			$ejercicio_frec=NULL;
			$ejercicio_tipo=NULL;
			$ejercicio_otro=NULL;
		}
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('form_preguntas_seg');
		}
		else
		{
			$seguimiento['evaluacion']='10';
			$seguimiento['cumplimiento']=$this->input->post('cumplimiento');	
			$seguimiento['hambre_hora_relativa']=$hambre_hora_relativa;	
			$seguimiento['hambre_hora']=$hambre_hora;
			$seguimiento['ansiedad_hora_relativa']=$ansiedad_hora_relativa;	
			$seguimiento['ansiedad_hora']=$ansiedad_hora;
			$seguimiento['perdida_peso']=$this->input->post('perdida_peso');
			$seguimiento['tiempo_eliminar_razon']=$this->input->post('tiempo_eliminar_razon');
			$seguimiento['tiempo_eliminar']=$tiempo_eliminar;
			$seguimiento['tiempo_agregar_razon']=$this->input->post('tiempo_agregar_razon');
			$seguimiento['tiempo_agregar']=$tiempo_agregar;
			$seguimiento['alimento_eliminar']=$this->input->post('alimento_eliminar');
			$seguimiento['alimento_agregar']=$this->input->post('alimento_agregar');
			$seguimiento['conservar']=$this->input->post('conservar');
			$seguimiento['motivacion']=$this->input->post('motivacion');
			$seguimiento['desgaste']=$this->input->post('desgaste');
			$seguimiento['meta_fecha']=$this->input->post('meta_fecha');
			$seguimiento['meta_valor']=$this->input->post('meta_valor');
			$seguimiento['tareas']=$this->input->post('tareas');
			$seguimiento['ejercicio_duracion']=$ejercicio_duracion;
			$seguimiento['ejercicio_frec']=$ejercicio_frec;
			$seguimiento['ejercicio_tipo']=$ejercicio_tipo;
			$seguimiento['ejercicio_otro']=$ejercicio_otro;
			$seguimiento['ejercicio']=$this->input->post('ejercicio');
			$seguimiento['hambre']=$this->input->post('hambre');
			$seguimiento['ansiedad']=$this->input->post('ansiedad');
				
			$this->load->model('modelo_formularios');
			$this->modelo_formularios->alta_preguntas_seg($seguimiento);
			$this->load->view('form_preguntas_seg');
		}
	}
	
		
	public function index(){
	$this->load->view('form_evaluacion');
}

}
?>