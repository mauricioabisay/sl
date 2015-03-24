<?php
   	class Alta extends CI_Controller{

	public function __construct() {

	parent::__construct();

	$this->load->library('form_validation');

	$this->load->helper('url');


}
	public function alta_antecedentes()
	{
		
		if ($this->input->post())
		{
			$this->form_validation->set_rules('alcohol','','required');
			if ($this->input->post('alcohol') == 'si')
			{
				$this->form_validation->set_rules('alcohol_valor_frec','','required|is_natural_no_zero');
				$this->form_validation->set_rules('alcohol_tipo_frec','','required');
				$this->form_validation->set_rules('copas','','required');
				$this->form_validation->set_rules('alcohol_tipo','','required');
				$aux = $this->input->post('alcohol_tipo');
				for($i=0; $i < sizeof($aux); $i++){
					if($aux[$i]=='otro')
					$this->form_validation->set_rules('alcohol_otro','','required|min_length[3]|max_length[30]|alpha');
				}
								
				$alcohol_valor_frec = $this->input->post('alcohol_valor_frec');
				$alcohol_tipo_frec = $this->input->post('alcohol_tipo_frec');
				$copas = $this->input->post('copas');
				
				$aux = $this->input->post('alcohol_tipo');
				$alcohol_tipo = "";
				for($i=0; $i < sizeof($aux); $i++){					
					$alcohol_tipo .= ''.$aux[$i].'';
					$alcohol_tipo .= ($i+1==sizeof($aux))?"":",";
				}
				$alcohol_otro = $this->input->post('alcohol_otro');
				
			}
						
			else {
				$alcohol_valor_frec= NULL;
				$alcohol_tipo_frec = NULL;
				$copas = NULL;
				$alcohol_tipo = NULL;
				$alcohol_otro = NULL;
		}
				$this->form_validation->set_rules('fuma','','required');
				if ($this->input->post('fuma') == 'si')
				{
					$this->form_validation->set_rules('fuma_valor','','required|is_natural_no_zero');
					$this->form_validation->set_rules('fuma_tiempo','','required');
					$this->form_validation->set_rules('cigarros','','required|is_natural_no_zero');
					$this->form_validation->set_rules('fuma_tipo_frec','','required');
					
					$fuma_valor = $this->input->post('fuma_valor');
					$fuma_tiempo = $this->input->post('fuma_tiempo');
					$cigarros = $this->input->post('cigarros');
					$fuma_tipo_frec = $this->input->post('fuma_tipo_frec');
				}
				else {
					$fuma_valor = NULL;
					$fuma_tiempo = NULL;
					$cigarros = NULL;
					$fuma_tipo_frec = NULL;
			}
	
				$this->form_validation->set_rules('ejercicio','','required');
				if ($this->input->post('ejercicio') == 'si')
				{
					$this->form_validation->set_rules('ejercicio_valor_frec','','required|is_natural_no_zero');
					$this->form_validation->set_rules('ejercicio_tipo_frec','','required');
					$this->form_validation->set_rules('duracion','','required|is_natural_no_zero');
					$this->form_validation->set_rules('ejercicio_tipo','','required');
					
					$aux = $this->input->post('ejercicio_tipo');
					for($i=0; $i < sizeof($aux); $i++){
						if($aux[$i]=='otro')
							$this->form_validation->set_rules('ejercicio_otro','','required|min_length[3]|max_length[30]|alpha');
					}
					$aux = $this->input->post('ejercicio_tipo');
					$ejercicio_tipo = "";
					for($i=0; $i < sizeof($aux); $i++){					
						$ejercicio_tipo .= ''.$aux[$i].'';
						$ejercicio_tipo .= ($i+1==sizeof($aux))?"":",";
					}
					
					$ejercicio_valor_frec = $this->input->post('ejercicio_valor_frec');
					$ejercicio_tipo_frec = $this->input->post('ejercicio_tipo_frec');
					$duracion = $this->input->post('duracion');
					$ejercicio_otro = $this->input->post('ejercicio_otro');
				}
				else {
					$ejercicio_tipo = NULL;
					$ejercicio_valor_frec = NULL;
					$ejercicio_tipo_frec = NULL;
					$duracion = NULL;
					$ejercicio_otro = NULL;
				}
				$this->form_validation->set_rules('embarazo','','required');
				if ($this->input->post('embarazo') == 'si')
				{
					$this->form_validation->set_rules('gesta','','required|is_natural_no_zero');
					$this->form_validation->set_rules('semana','','required|is_natural');
					$this->form_validation->set_rules('lactancia','','required');
					
					$gesta = $this->input->post('gesta');
					$semana = $this->input->post('semana');
					$lactancia = $this->input->post('lactancia');
				}
				else {
					$gesta = NULL;
					$semana = NULL;
					$lactancia = NULL;
				}
	}
	
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->view('form_antecedentes');
	}
	else
	{
		
		
		
		$antecedentes['paciente']= $this->input->post('paciente');
		$antecedentes['alcohol']= $this->input->post('alcohol');
		$antecedentes['alcohol_valor_frec']= $alcohol_valor_frec;
		$antecedentes['alcohol_tipo_frec']= $alcohol_tipo_frec;;
		$antecedentes['alcohol_tipo']= $alcohol_tipo;
		$antecedentes['copas']= $copas;
		$antecedentes['fuma']= $this->input->post('fuma');
		$antecedentes['fuma_valor']= $fuma_valor;
		$antecedentes['fuma_tiempo']= $fuma_tiempo;
		$antecedentes['cigarros']= $cigarros;
		$antecedentes['fuma_tipo_frec']= $fuma_tipo_frec;
		$antecedentes['embarazo']= $this->input->post('embarazo');
		$antecedentes['gesta']= $gesta;
		$antecedentes['semana']= $semana;
		$antecedentes['lactancia']= $lactancia;
		$antecedentes['ejercicio']= $this->input->post('ejercicio');
		$antecedentes['ejercicio_tipo_frec']= $ejercicio_tipo_frec;
		$antecedentes['ejercicio_valor_frec']= $ejercicio_valor_frec;
		$antecedentes['duracion']= $duracion;
		$antecedentes['ejercicio_tipo']= $ejercicio_tipo;
		$antecedentes['alcohol_otro']= $alcohol_otro;
		$antecedentes['ejercicio_otro']= $ejercicio_otro;
		
		$this->load->model('modelo_formularios');
		$this->modelo_formularios->alta_antecedentes($antecedentes);
		$this->load->view('form_antecedentes');
	}
	
	

}	
	
	
public function index(){
	$this->load->view('form_evaluacion');
}
}
?>